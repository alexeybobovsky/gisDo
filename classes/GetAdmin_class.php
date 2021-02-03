<?php
//require_once("main.inc.php");
class GetAdmin
	{
	var $last_query;
	var $child = array();
	var $idInUse = array();
	var $childNum;
	var $childLevel;
	var $rekCount;


	function getAllRemindedUsers() //17_10_07 Вытаскивает всех пользователей, запрсивших восстановление пароля 
		{
		$query = 'SELECT * FROM `users` WHERE `user_reminded_pasword` != \'\' ';
		$ret_arr  = array('user_id', 'user_reminded_date');
		$LNK= new DBLink;		
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, true);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		
		return $ret;		
		}
	function getAllQueryedUsers() //17_10_07 Вытаскивает всех неподтвержденных новых пользователей 
		{
		$query = 'SELECT * FROM `users` WHERE `user_registation_status` = \'Q\' and `is_group` = 0 and `is_system` = 0';
		$ret_arr  = array('user_id', 'user_regdate');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, true);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;		
		}
	function GetGroups($dir, $systemInclude) /*получает группы пользователей */
		{
		$ret = 0;
		$inpSys = (!$systemInclude)?' AND is_system=0 ':'';
		switch ($dir)
			{
			case 0: $inp = 'user_id' ; break;
			case 1: $inp = 'user_id DESC' ; break;
			case 2: $inp = 'user_name' ; break;
			case 3: $inp = 'user_name DESC' ; break;
			default : $inp = 'user_id' ; 
			}
		$query = 'SELECT * FROM users WHERE is_group = 1 '.$inpSys.' ORDER BY '.$inp;		
		$ret_arr  = array('user_id', 'user_name', 'is_system');
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
	function GetAllUsers($dir, $systemInclude) /*получает всех пользователей */
		{
		$ret = 0;
		$inpSys = (!$systemInclude)?' AND is_system=0 ':'';
		switch ($dir)
			{
			case 0: $inp = 'user_id' ; break;
			case 1: $inp = 'user_id DESC' ; break;
			case 2: $inp = 'user_name' ; break;
			case 3: $inp = 'user_name DESC' ; break;
			default : $inp = 'user_id' ; 
			}
		$inpFam = ($_SESSION['filterUsers']['fltrName'])?' AND user_last_name LIKE \''.$_SESSION['filterUsers']['fltrName'].'%\' ':'';
//		if()
		$query = 'SELECT * FROM users WHERE is_group = 0 '.$inpSys.$inpFam.'  ORDER BY '.$inp;		
//		$ret_arr  = array('user_id', 'user_name');
		$ret_arr  = array('user_id', 'user_name', 'is_group', 'is_system', 'user_password', 'user_reminded_pasword', 'user_reminded_date', 'user_reminded_code', 'user_email', 'user_regdate', 'user_status', 'user_last_ip', 'user_time_last_update', 'user_registation_status', 'user_avatar', 'user_sid', 'user_first_name', 'user_so_name', 'user_last_name', 'user_icq_uin', 'user_about', 'zipCode', 'city', 'phone', 'address' );
//		$ret_arr  = array('user_id', 'user_name', 'is_group', 'is_system', 'user_password', 'user_email', 'user_regdate', 'user_status', 'user_last_ip', 'user_time_last_update', 'user_registation_status', 'user_avatar', 'user_sid');
		$LNK= new DBLink;
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if ($LNK->GetNumRows())
			{
			$retTmp = $LNK->GetData($ret_arr, true);
			if($_SESSION['filterUsers']['fltrGroups'])
				{
				global $USER;
				$retF = array();
				for($i=0; $i<count($retTmp); $i++)
					{					
					if($USER->userInGroup($retTmp[$i]['user_id'], $_SESSION['filterUsers']['fltrGroups']))
						{
						$retF[] = $retTmp[$i];
						}
					}
				$ret = $retF;				
				}
			else
				$ret = $retTmp;
			}
		else
			{
			$ret = 0;
			}
		return $ret;		
		}	
	function GetGroupUsers($dir, $gId) /*получает всех пользователей, которые входят в группу*/
		{
		$ret = 0;
		switch ($dir)
			{
			case 0: $inp = 'user_id' ; break;
			case 1: $inp = 'user_id DESC' ; break;
			case 2: $inp = 'user_name' ; break;
			case 3: $inp = 'user_name DESC' ; break;
			default : $inp = 'user_id' ; 
			}
		$query = 'SELECT * FROM users, userToUser WHERE userToUser.group_id = '.$gId.' AND userToUser.user_id = users.user_id';		
		$ret_arr  = array('user_id', 'user_name');
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
	function GetCurUser($name, $value) /*получает пользователя*/
		{
		$cond = ($name == 'id')?' user_id = '.$value:' user_name = '.$value;
		$ret = 0;
		$query = 'SELECT * FROM users WHERE '.$cond;		
		$ret_arr  = array('user_id', 'user_name', 'is_group', 'is_system', 'user_password', 'user_reminded_pasword', 'user_reminded_date', 'user_reminded_code', 'user_email', 'user_regdate', 'user_status', 'user_last_ip', 'user_time_last_update', 'user_registation_status', 'user_avatar', 'user_sid', 'user_first_name', 'user_so_name', 'user_last_name', 'user_icq_uin', 'user_about', 'zipCode', 'city', 'phone', 'address' );
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
	function GetUserPar($id, $param) /*получает параметр учетки*/
		{
		$query = 'SELECT * FROM users WHERE user_id = '.$id;
		$ret_arr  = $param; //array('sc_id','sc_handler', 'sc_bodyTable', 'sc_bodyIdName', 'sc_name', 'sc_menu', 'lang_id', 'sc_order');
		$LNK= new DBLink;
//		$ret=array();
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
	function GetUserGroups($dir, $uId) /*получает все группы в которые входит пользователь*/
		{
		$ret = 0;
		switch ($dir)
			{
			case 0: $inp = 'user_name' ; break;
			case 1: $inp = 'user_id DESC' ; break;
			case 2: $inp = 'user_id' ; break;
			case 3: $inp = 'user_name DESC' ; break;
			default : $inp = 'user_id' ; 
			}
		$query = 'SELECT * FROM users, userToUser WHERE userToUser.user_id = '.$uId.' AND group_id = users.user_id';		
		$ret_arr  = array('group_id', 'user_name');
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
	function GetAllGroups($dir) /*получает все группы*/
		{
		$ret = 0;
		switch ($dir)
			{
			case 0: $inp = 'user_id' ; break;
			case 1: $inp = 'user_id DESC' ; break;
			case 2: $inp = 'user_name' ; break;
			case 3: $inp = 'user_name DESC' ; break;
			default : $inp = 'user_id' ; 
			}
		$query = 'SELECT * FROM users WHERE is_group = 1  ORDER BY '.$inp;		
		$ret_arr  = array('user_id', 'user_name', 'is_system');
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
	function GetUsers($dir) /*получает всех пользователей*/
		{
		$ret = 0;
		switch ($dir)
			{
			case 0: $inp = 'user_id' ; break;
			case 1: $inp = 'user_id DESC' ; break;
			case 2: $inp = 'user_name' ; break;
			case 3: $inp = 'user_name DESC' ; break;
			case 4: $inp = 'user_status' ; break;
			case 5: $inp = 'user_status DESC' ; break;
			case 6: $inp = 'user_time_last_update' ; break;
			case 7: $inp = 'user_time_last_update DESC' ; break;
			default : $inp = 'user_id' ; 
			}
		$query = 'SELECT * FROM users WHERE is_group = 0  ORDER BY '.$inp;		
		$ret_arr  = array('user_id', 'user_name', 'is_group', 'is_system', 'user_password', 'user_email', 'user_regdate', 'user_status', 'user_last_ip', 'user_time_last_update', 'user_registation_status', 'user_avatar', 'user_sid');
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