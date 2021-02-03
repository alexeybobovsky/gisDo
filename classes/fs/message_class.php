<?
class messageBase
	{
	var $last_query;
	var $last_id;
	var $rekCount;
	var $messagesList = array();
	var $messagesTree = array();
	var $messagesUsed = array();
	function getLastConstrMessageList($ROUT, $limit) //23_07_2014 получает последние стройки с сообщениями - 1 стройка - одно сообщение
		{
		$limitAdd = ($limit)? ' LIMIT '.intval($limit).' ' : ' ';
//		$query = 'SELECT * 
		
		$query1 = 'SELECT obj_id
						FROM gd_object
						WHERE obj_lastComDate > 0
						ORDER BY obj_lastComDate DESC '.$limitAdd;
						
		$ret_arr1  = array('obj_id');
		$ret_arr2  = array('user_name', 'comDate', 'user_id', 'obj_name', 'obj_id', 'firm_name', 'comm_id', 'comm_body', 'comm_date', 'comm_hidden', 'comm_subject', 'comm_parId', 'com_replyNum', 'comm_lvl', 'displayName', 'up_id', 'up_name', 'up_fullName');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);	
		$LNK->Query($query1);
		if($LNK->GetNumRows())
			{
			$ret1 = $LNK->GetData($ret_arr1, true);
			for($i = 0; $i<count($ret1); $i++)
				{
				$query2 = 'SELECT obj_id, obj_name, comm_body, comm_date, user_name, displayName, up_name, users.up_id, up_fullName 
								FROM `users` LEFT JOIN userProviders ON userProviders.up_id = users.up_id, 	
								`gd_comments`, `gd_object` 											
								WHERE gd_object.obj_id = gd_comments.comm_objId 
								AND gd_object.obj_id = \''.$ret1[$i]['obj_id'].'\'
								AND gd_comments.comm_objType = \'constr\' 
								AND gd_comments.comm_auth = users.user_id 
								AND gd_comments.comm_subject = \'c\' 
								AND gd_comments.comm_hidden = 0 
								ORDER BY comm_date DESC LIMIT 1';
				$LNK->Query($query2);
				$ret2 = $LNK->GetData($ret_arr2, false);
				if($LNK->GetNumRows())
					{
					$commentDate = strtotime($ret2['comm_date']);
					$ruDate = $ROUT->GetRusData($commentDate);
					$ret2['displayName'] 	= ((trim($ret2['displayName'])!='') && ($ret2['displayName'] != 'NULL')) ? $ret2['displayName'] : $ret2['user_name'];
					$ret2['providerName']  	= $ret2['up_name'];
					$ret2['providerTitle']  	= $ret2['up_fullName'];
					$ret2['providerId'] 		= $ret2['up_id'];
					$ret2['comm_body'] 		= strip_tags($ret2['comm_body']);
					$ret2['comm_bodyShort'] 	= $ROUT->getSmartCutedString($ret2['comm_body'], 90) ;				
					$ret2['comm_date_ru'] 	= $ruDate['date'].' '.$ruDate['month'].' ';
					$ret2['comm_date_ru'] 	.= (date("Y",time())!=$ruDate['year'])?' '.$ruDate['year'].' ':'';
					if($commentDate >= $today )
						$ret2['comm_time'] 	= date('H', $commentDate).':'.date('i', $commentDate);
					else
						$ret2['comm_time'] 	= '';					
					$ret[] = $ret2;
					}
				}
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}
	function getMessageThread($objType, $id, $dir, $hidden, $subj, $parent ) //22_07_2014 получает ветку комментариев
		{
		$this->messagesList = $this->getCommentsOfObjSmart($objType, $id, $dir, $hidden, $subj, 0, 0);
		if($this->messagesList)
			{
			$this->getMessRecursive($parent);
			return $this->messagesTree;
			}
		else
			return 0;
		
		}
		
		
		
	function generateTree($objType, $id, $dir, $hidden, $subj) //09_07_2014 получает дерево коментариев об объекте
		{
//		$this->rekCount = 0;
		$this->messagesList = $this->getCommentsOfObjSmart($objType, $id, $dir, $hidden, $subj, 0, 0);
		if($this->messagesList)
			{
			$this->getMessRecursive(0, 0);
			return $this->messagesTree;
			}
		else
			return 0;
		}
	function getMessRecursive($parent) //09_07_2014 
		{
//		$this->rekCount++;
//		$iteration = $this->rekCount;
/*		echo 'cur count = '.$this->rekCount.'; 
';*/
		for($i=0; $i<count($this->messagesList); $i++)
			{
			if((!in_array($this->messagesList[$i]['comm_id'], $this->messagesUsed))&&(($this->messagesList[$i]['comm_parId']==$parent)||(!$parent)))
				{
/*				echo 'cur iteration - '.$iteration.'; cur id - '.$this->messagesList[$i]['comm_id'].'; 
';*/
				$this->messagesUsed[] = $this->messagesList[$i]['comm_id'];
				$mesTmp = $this->messagesList[$i];
//				$mesTmp['lvl'] = $lvl;
				$this->messagesTree[] = $mesTmp;
//				print_r($mesTmp);
				if($mesTmp['com_replyNum']>0)
					$this->getMessRecursive($this->messagesList[$i]['comm_id']);
				}
			}
		
		}
	function generateTree_() //12_10_2009 получает заданное количество комментариев о фирме
		{
		for($i=0; $i<count($this->messagesList); $i++)
			{
			if(!$this->messagesList[$i]['comm_parId'])
				$this->messagesTree[] = $this->messagesList[$i];
			$commentDate = strtotime($ret[$i]['comm_date']);
			$ruDate = $ROUT->GetRusData($commentDate);
			$ret[$i]['displayName'] 	= ((trim($ret[$i]['displayName'])!='') && ($ret[$i]['displayName'] != 'NULL')) ? $ret[$i]['displayName'] : $ret[$i]['user_name'];
			$ret[$i]['providerName']  	= $ret[$i]['up_name'];
			$ret[$i]['providerTitle']  	= $ret[$i]['up_fullName'];
			$ret[$i]['providerId'] 		= $ret[$i]['up_id'];
			$ret[$i]['comm_body'] 		= nl2br($ret[$i]['comm_body']);
			$ret[$i]['comm_date_ru'] 	= $ruDate['date'].' '.$ruDate['month'].' ';
			$ret[$i]['comm_date_ru'] 	.= (date("Y",time())!=$ruDate['year'])?' '.$ruDate['year'].' ':'';
			if($commentDate >= $today )
				$ret[$i]['comm_time'] 	= date('H', $commentDate).':'.date('i', $commentDate);
			else
				$ret[$i]['comm_time'] 	= '';					
			//$comments[$i]['showEdit'] = (($USER->id == $comments[$i]['user_id'])||($ACL->GetClosedParentRight($allMenu['curNodeId'])>1))?1:0;
			$ret[$i]['showHide'] = ($hidden)?1:0;
			$ret[$i]['showDelete'] = ($hidden)?1:0;
			}
		
		}
	function getCommentsOfObjSmart($objType, $id, $dir, $hidden, $subj, $num, $onlyCnt) //12_10_2009 получает заданное количество комментариев о фирме
		{
		global $ROUT;
		$showLast = 2;
		$rows = ($onlyCnt)?'COUNT(*)':'*';

		$dirAdd  = ($dir)?' ASC ':' DESC ';
		$statusAdd = ($hidden)?'':' AND comm_hidden = 0 ';
		$limitAdd = ($num)? ' LIMIT '.intval($num).' ' : ' ';
		$tableNames = array('constr' => 'gd_object', 'firm' => 'gd_firm');
		$indexNames = array('constr' => 'obj_id', 'firm' => 'firm_id');
		
		$query = 'SELECT  '.$rows.' 
						FROM `users` LEFT JOIN userProviders ON userProviders.up_id = users.up_id, 	
						`gd_comments`, `'.$tableNames[$objType].'` 											
						WHERE '.$tableNames[$objType].'.'.$indexNames[$objType].' = gd_comments.comm_objId 
						AND gd_comments.comm_objType = \''.$objType.'\' 
						AND gd_comments.comm_auth = users.user_id 
						AND gd_comments.comm_subject = \''.$subj.'\' 
						AND gd_comments.comm_objId = \''.intval($id).'\''.$statusAdd.'
						ORDER BY comm_date '.$dirAdd.$limitAdd;
		$ret_arr  = array('user_name', 'user_id', $indexNames[$objType], 'firm_name', 'comm_id', 'comm_body', 'comm_date', 'comm_hidden', 'comm_subject', 'comm_parId', 'com_replyNum', 'comm_lvl', 'displayName', 'up_id', 'up_name', 'up_fullName');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			if($onlyCnt)
				$ret = $LNK->GetData('COUNT(*)', false);
			else
				{
				$ret = $LNK->GetData($ret_arr, true);
				$today  = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
				for($i=0; $i<count($ret); $i++)
					{
					$commentDate = strtotime($ret[$i]['comm_date']);
					$ruDate = $ROUT->GetRusData($commentDate);
					$ret[$i]['comNum'] 	= $i;
					$ret[$i]['displayName'] 	= ((trim($ret[$i]['displayName'])!='') && ($ret[$i]['displayName'] != 'NULL')) ? $ret[$i]['displayName'] : $ret[$i]['user_name'];
					$ret[$i]['providerName']  	= $ret[$i]['up_name'];
					$ret[$i]['providerTitle']  	= $ret[$i]['up_fullName'];
					$ret[$i]['providerId'] 		= $ret[$i]['up_id'];
					$ret[$i]['comm_body'] 		= nl2br($ret[$i]['comm_body']);
					$ret[$i]['comm_date_ru'] 	= $ruDate['date'].' '.$ruDate['month'].' ';
					$ret[$i]['comm_date_ru'] 	.= (date("Y",time())!=$ruDate['year'])?' '.$ruDate['year'].' ':'';
					if($commentDate >= $today )
						$ret[$i]['comm_time'] 	= date('H', $commentDate).':'.date('i', $commentDate);
					else
						$ret[$i]['comm_time'] 	= '';					
					//$comments[$i]['showEdit'] = (($USER->id == $comments[$i]['user_id'])||($ACL->GetClosedParentRight($allMenu['curNodeId'])>1))?1:0;
					$ret[$i]['showHide'] = ($hidden)?1:0;
					$ret[$i]['showDelete'] = ($hidden)?1:0;
					$ret[$i]['showLast'] = ($i<(count($ret)-$showLast))?0:1;
					}
				$this->messagesList = $ret;
				}
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}		
	function getCurCommentOfConstr($id) //13_06_2013 получает конкретный комментарий по идентификатору
		{
		global $ROUT;
		$query = 'SELECT  * 
						FROM `users` LEFT JOIN userProviders ON userProviders.up_id = users.up_id, 	
						`gd_comments`, `gd_object` 											
						WHERE gd_object.obj_id = gd_comments.comm_objId 
						AND gd_comments.comm_auth = users.user_id 
						AND gd_comments.comm_id = \''.intval($id).'\' ';
		$ret_arr  = array('user_name', 'user_id', 'com_replyNum', 'obj_id', 'obj_name', 'comm_id', 'comm_parId', 'comm_body', 'comm_objType', 'comm_date', 'comm_hidden', 'comm_subject', 'displayName', 'up_id', 'up_name', 'up_fullName', 'comm_lvl');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, false);
			$today  = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
			$commentDate = strtotime($ret['comm_date']);
			$ruDate = $ROUT->GetRusData($commentDate);
			$ret['displayName'] 	= ((trim($ret['displayName'])!='') && ($ret['displayName'] != 'NULL')) ? $ret['displayName'] : $ret['user_name'];
			$ret['providerName']  	= $ret['up_name'];
			$ret['providerTitle']  	= $ret['up_fullName'];
			$ret['providerId'] 		= $ret['up_id'];
			$ret['objId'] 			= $ret['obj_id'];
			$ret['comm_body'] 		= nl2br($ret['comm_body']);
			$ret['comm_date_ru'] 	= $ruDate['date'].' '.$ruDate['month'].' ';
			$ret['comm_date_ru'] 	.= (date("Y",time())!=$ruDate['year'])?' '.$ruDate['year'].' ':'';
			if($commentDate >= $today )
				$ret['comm_time'] 	= date('H', $commentDate).':'.date('i', $commentDate);
			else
				$ret['comm_time'] 	= '';					
			//$comments[$i]['showEdit'] = (($USER->id == $comments[$i]['user_id'])||($ACL->GetClosedParentRight($allMenu['curNodeId'])>1))?1:0;
			$ret['showHide'] = ($hidden)?1:0;
			$ret['showDelete'] = ($hidden)?1:0;
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}		
	function getMessOfObjByType($objType, $objId, $messType) //2013_02_20 Получение отзывов для объекта по типу 
		{
		$LNK= new DBLink;				
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);	
		$typeFilter = ($messType == '')? '' : ' comm_subject =  	\''.$messType.'\' AND ';
		$query = 'SELECT  * from  `gd_comments` 
													LEFT JOIN users ON comm_auth = user_id
													WHERE 	'.$typeFilter.'
													comm_objType= 		\''.$objType.'\'  AND
													comm_objId = 		\''.$objId.'\'     
													ORDER BY comm_date DESC';
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret_arr  = array('user_name', 'user_id',  'comm_id', 'comm_parId', 'comm_subject', 'comm_body', 'comm_auth', 'comm_authName', 'comm_objType', 'comm_objId', 'comm_date', 'comm_hidden');
			$ret = $LNK->GetData($ret_arr, true);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}
	function add($objType, $objId, $parId, $auth, $authName, $subject, $body, $hidden)
		{
		if($parId)
			{
			$parentMess = $this->getCurCommentOfConstr($parId);
			$lvl = $parentMess['comm_lvl'] + 1;
			}
		else
			$lvl = 0;
		global $USER;
		$LNK= new DBLink;	
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);	
		$queryInsert = 'INSERT INTO `gd_comments` SET 	
													comm_subject =  	\''.$subject.'\', 
													comm_body =  		\''.$body.'\', 
													comm_auth = 		\''.$auth.'\', 
													comm_authName = 	\''.$authName.'\', 
													comm_objType= 		\''.$objType.'\',
													comm_objId = 		\''.$objId.'\', 
													comm_parId = 		\''.$parId.'\', 
													comm_hidden = 		\''.$hidden.'\', 
													comm_lvl 	= 		\''.$lvl.'\', 
													comm_date  = FROM_UNIXTIME( \''.time().'\')';
		$LNK->Query($queryInsert);
		if($LNK->error)
			{
			$ret['error'] = 1;
			$ret['errorMsg'] = $LNK->error_string;// = $LNK->error_string;
			}
		else
			{
			$ret['error'] = 0;
			$ret['last_id'] = $LNK->last_id;// = $LNK->error_string;
			$this->addChild($parId);
			}
		return $ret;		
		}
	function delete($comId)
		{
		$LNK= new DBLink;				
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);	
		$queryDelete = 'DELETE from `gd_comments` WHERE comm_id = \''.intval($comId).'\'';
		$LNK->Query($queryDelete);
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
	function decreaseChildNum($comId)
		{
		$LNK= new DBLink;				
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);	
		$queryInsert = 'UPDATE `gd_comments` 	SET 	com_replyNum = com_replyNum - 1
												WHERE 	comm_id = \''.intval($comId).'\'';
		$LNK->Query($queryInsert);
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
	function addChild($comId)
		{
		$LNK= new DBLink;				
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);	
		$queryInsert = 'UPDATE `gd_comments` 	SET 	com_replyNum = com_replyNum+ 1
												WHERE 	comm_id = \''.intval($comId).'\'';
		$LNK->Query($queryInsert);
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
	function toggleState($comId, $newState)
		{
		$LNK= new DBLink;				
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);	
		$queryInsert = 'UPDATE `gd_comments` 	SET 	comm_hidden = \''.$newState.'\'
												WHERE 	comm_id = \''.intval($comId).'\'';
		$LNK->Query($queryInsert);
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
	
/***************************OLD************************************************/	
	}
?>