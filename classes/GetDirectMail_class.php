<?php 
//require_once("main.inc.php");
class GetDirectMail extends GetContent  
	{
	var $last_query;
	var $child = array();
	var $idInUse = array();
	var $childNum;
	var $childLevel;
	var $rekCount;
	
	function GetAttachments($id) /* 2007_10_24 получает вложения */
		{
		$ret = 0;
		$inp_pub = ($status)?'':''; 		
//		$inp_lim = ($limit)?'LIMIT '.$limit:'';
		$query = 'SELECT * FROM `directmail_attachments` WHERE `id` = \''.$id.'\'';
		$ret_arr  = array('id', 'file');
		$LNK= new DBLink;
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if ($LNK->GetNumRows())
			{
			$ret = $LNK->GetData($ret_arr, true);
			}
		else
			{
			$ret = 0;
			}
		return $ret;		
		}		
	function GetSubscribers($id) /* 2007_10_23 получает подписчиков */
		{
		$ret = 0;
		$inp_pub = ($status)?'':''; 		
//		$inp_lim = ($limit)?'LIMIT '.$limit:'';
		$query = 'SELECT * FROM `directmail_subscribers` WHERE `mail_id` = \''.$id.'\'';
		$ret_arr  = array('mail_id', 'user_id');
		$LNK= new DBLink;
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if ($LNK->GetNumRows())
			{
			$ret = $LNK->GetData($ret_arr, true);
			}
		else
			{
			$ret = 0;
			}
		return $ret;		
		}		
	function GetCurrentDM($id) /* 2007_10_23 получает текущую рассылку*/
		{
		$ret = 0;
		$query = 'SELECT * FROM `directmail_list` WHERE id = \''.$id.'\'';
		$ret_arr  = array('id', 'code', 'subject' ,'body' ,'date', 'status');
		$LNK= new DBLink;
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if ($LNK->GetNumRows())
			{
			$ret = $LNK->GetData($ret_arr, false);
			}
		else
			{
			$ret = 0;
			}
		return $ret;		
		}		
	function GetDMList() /* 2007_10_23 получает список всех рассылок*/
		{
		$ret = 0;
		$query = 'SELECT * FROM `directmail_list` ORDER BY `date` DESC, `subject`';
		$ret_arr  = array('id', 'subject' ,'body' ,'date', 'status');
		$LNK= new DBLink;
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if ($LNK->GetNumRows())
			{
			$ret = $LNK->GetData($ret_arr, true);
			}
		else
			{
			$ret = 0;
			}
		return $ret;		
		}		



	}
?>
