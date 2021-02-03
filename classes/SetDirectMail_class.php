<? 
class SetDirectMail
	{
	var $last_query;
	var $last_id;
	function DelDM($id) /*30_10_2007 удаляет рассылку полностю*/
		{
		$ret = array();
		$query_delete_att = 'DELETE from  `directmail_attachments` where `id` = \''.$id.'\' ';
		$query_delete_sub = 'DELETE from  `directmail_subscribers` where `mail_id` = \''.$id.'\' ';
		$query_delete_DM = 'DELETE from  `directmail_list` where `id` = \''.$id.'\' ';
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query ($query_delete_att);		
		$LNK->Query ($query_delete_sub);		
		$LNK->Query ($query_delete_DM);		
		if($LNK->error)
			{
			$ret['error'] = 1;
			$ret['errorMsg'] = $LNK->error_string;// = $LNK->error_string;
			}
		else
			{
			$ret['error'] = 0;
			}
		return $ret;		
		}
	function DelSubsciber($id, $user) /*30_10_2007 удаляет подписчика в рассылке*/
		{
		$ret = array();
		$query_delete = 'DELETE from  `directmail_subscribers` where `mail_id` = \''.$id.'\' AND `user_id` = \''.$user.'\'';
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query ($query_delete);		
		if($LNK->error)
			{
			$ret['error'] = 1;
			$ret['errorMsg'] = $LNK->error_string;// = $LNK->error_string;
			}
		else
			{
			$ret['error'] = 0;
			}
		return $ret;		
		}
	function DellAttachment($id, $file) /*30_10_2007 удаляет вложение в рассылке*/
		{
		$ret = array();
		$query_delete = 'DELETE from  `directmail_attachments` where `id` = \''.$id.'\' AND file like \''.$file.'\'';
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query ($query_delete);		
		if($LNK->error)
			{
			$ret['error'] = 1;
			$ret['errorMsg'] = $LNK->error_string;// = $LNK->error_string;
			}
		else
			{
			$ret['error'] = 0;
			}
		return $ret;		
		}
	function EditDM($id, $post) /*15_10_2007 редактирует рассылку*/
		{
		$ret = array();
		$query_insert = 'UPDATE `directmail_list` SET ';
		$parStr = '';
		$regDate = time();
		if($post['NAME']) 
			{
			if($parStr) 
				$parStr .= ', ';
			$parStr .= ' `subject` = \''.$post['NAME'].'\'';
			}
		if($post['BODY']) 
			{
			if($parStr) 
				$parStr .= ', ';
			$parStr .= ' `body` = \''.$post['BODY'].'\'';
			}
		if(isset($post['status'])) 
			{
			if($parStr) 
				$parStr .= ', ';
			$parStr .= ' `status` = \''.$post['status'].'\'';
			}
		if($post['SEND_date']) 
			{
			if($parStr) 
				$parStr .= ', ';
			$parStr .= ' `date` = FROM_UNIXTIME(\''.$post['SEND_date'].'\')';
			}
		$query_insert .= $parStr.' WHERE `id` = \''.$id.'\'';
//		echo $query_insert;
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query ($query_insert);		
		if($LNK->error)
			{
			$ret['error'] = 1;
			$ret['errorMsg'] = $LNK->error_string;// = $LNK->error_string;
			}
		else
			{
			$ret['error'] = 0;
			$ret['last_id'] = $LNK->last_id;// = $LNK->error_string;
			}
		return $ret;
		}
	function AddAttachment($id, $file)/*25_10_2007 добавляет */	
		{
		$query_insert = 'INSERT INTO `directmail_attachments` SET ';
		$query_insert.= '`id` = \''.$id.'\', file = \''.$file.'\'';
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query ($query_insert);		
		if($LNK->error)
			{
			$ret['error'] = 1;
			$ret['errorMsg'] = $LNK->error_string;// = $LNK->error_string;
			}
		else
			{
			$ret['error'] = 0;
			$ret['last_id'] = $LNK->last_id;// = $LNK->error_string;
			}
		return $ret;		
		}
	function AddSubsciber($id, $subsciber)/*25_10_2007 добавляет */	
		{
		$query_insert = 'INSERT INTO `directmail_subscribers` SET ';
		$query_insert.= '`mail_id` = \''.$id.'\', user_id = \''.$subsciber.'\'';
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query ($query_insert);		
		if($LNK->error)
			{
			$ret['error'] = 1;
			$ret['errorMsg'] = $LNK->error_string;// = $LNK->error_string;
			}
		else
			{
			$ret['error'] = 0;
			$ret['last_id'] = $LNK->last_id;// = $LNK->error_string;
			}
		return $ret;		
		}
	function CreateMessage($post) /*25_10_2007 добавляет рассылку*/
		{
		$ret = array();
		$query_insert = 'INSERT INTO `directmail_list` SET ';
		if($post['subject']) 
			$query_insert .= ' `subject` = \''.$post['subject'].'\'';
		if($post['body']) 
			$query_insert .= ', `body` = \''.$post['body'].'\'';
		if($post['code']) 
			$query_insert .= ', `code` = \''.$post['code'].'\'';
		if($post['date']) 
			$query_insert .= ', `date` = FROM_UNIXTIME(\''.$post['date'].'\')';
		if($post['status']) 
			$query_insert .= ', `status` = \''.$post['status'].'\'';

//		echo $query_insert;
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query ($query_insert);		
		if($LNK->error)
			{
			$ret['error'] = 1;
			$ret['errorMsg'] = $LNK->error_string;// = $LNK->error_string;
			}
		else
			{
			$ret['error'] = 0;
			$ret['last_id'] = $LNK->last_id;// = $LNK->error_string;
			}
		return $ret;
		}
		
	}
?>