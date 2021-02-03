<?php
class GetAccess  extends GetContent  
	{
	var $last_query;
	var $child = array();
	var $idInUse = array();
	var $childNum;
	var $childLevel;
	var $rekCount;

	function GetUserForRightManip() /*получает всех пользователей  дл€ редактировани€ прав - все кроме root */
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
		$query = 'SELECT * FROM users WHERE is_group = 0 AND user_id>1 ORDER BY '.$inp;		
//		$ret_arr  = array('user_id', 'user_name');
		$ret_arr  = array('user_id', 'user_name', 'is_group', 'is_system', 'user_password', 'user_reminded_pasword', 'user_reminded_date', 'user_reminded_code', 'user_email', 'user_regdate', 'user_status', 'user_last_ip', 'user_time_last_update', 'user_registation_status', 'user_avatar', 'user_sid', 'user_first_name', 'user_so_name', 'user_last_name', 'user_icq_uin', 'user_about', 'zipCode', 'city', 'phone', 'address' );
//		$ret_arr  = array('user_id', 'user_name', 'is_group', 'is_system', 'user_password', 'user_email', 'user_regdate', 'user_status', 'user_last_ip', 'user_time_last_update', 'user_registation_status', 'user_avatar', 'user_sid');
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
	function GetSiteTree() /*29_05_07 получает  дерево несистемных объектов + корень*/
		{
		$treeInfo = array();
		$this->GetChildren(0, 0, 2, 0, 0, 3, 0, 0);

		$treeTmp = $this->child;
		$this->Reset();		
//		print_r($treeTmp);
		$treeInfo[0] = array('haveBrother' =>0, 'level'=>0, 'right'=>3, 'body'=>
						array(0 => array('name' => 'caption', 'value' => ' орень сайта')), 
						'numChild' => 10, 'catalog' => array('sc_id'=>0, 'sc_name' => 'root', 'sc_menu' => 1, 'sc_published' => 1));
//		 = $firstNode;
		$cnt = 1;
//		$cnt = 0;
		for($i=0; $i<count($treeTmp); $i++)
			{
			if(is_array($treeTmp[$i]['catalog']))
				{
				$treeInfo[$cnt] = $treeTmp[$i];
				$treeInfo[$cnt]['level'] ++; 
				$cnt ++;
				}
			}
		return $treeInfo;		
		}		

	}
?>