<?
class SetContent
	{
	var $last_query;
	var $last_id;
	function createConst($param) /*06_05_08 Создание константы*/
		{
		$LNK= new DBLink;				
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);	
		$queryInsert = 'INSERT INTO `config` SET conf_name = \''.$param['name'].'\', conf_value = \''.$param['value'].'\', conf_comment = \''.$param['about'].'\'';
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
	function deleteConst($id) /*06_05_08 Удаление константы*/
		{
		$LNK= new DBLink;				
		$queryInsert = 'DELETE FROM `config` WHERE  conf_id = \''.intval($id).'\'';
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
	function updateConst($id, $param) /*06_05_08 Изменение константы*/
		{

		$LNK= new DBLink;				
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);	
		$valuesInTable = array('NAME' => 'conf_name', 'VALUE' => 'conf_value', 'ABOUT' => 'conf_comment', 'id' => 'conf_id');
/*		$valuesInPost = array('firms' => array('NAME'), 'obj_types' => array('NAME'), 
								'obj_prop' => array('NAME', 'DESCRIPTION'));*/
		$queryInsert = 'UPDATE `config` SET ';
		$cnt = 0;
		while (list ($key, $val) = each ($param)) 
			{
			if($cnt)
				$queryInsert .= ', ';
			$queryInsert .= '`'.$valuesInTable[$key].'` = \''.$val.'\'  ';						
			$cnt ++;
			}
		$queryInsert .= ' WHERE '.$valuesInTable['id'].' = '.$id;
//		echo $queryInsert;
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
	
	function changeStatus($id)
		{
		global $CNT;
		$node = $CNT->GetCurNode($id, -1);
		$menu = ($node['catalog']['sc_published'])?0:1;
		$ret['error'] = 0;
		if(!$this->SetNodPar($id, 'published', $menu))		
			{
			$ret['old_status'] = $menu;	
			$ret['error'] = 1;	
			}
		return $ret; 
		}
	function changeMenuStatus($id)
		{
		global $CNT;
		$node = $CNT->GetCurNode($id, -1);
		$menu = ($node['catalog']['sc_menu'])?0:1;
		$ret['error'] = 0;
		if(!$this->SetNodPar($id, 'menu', $menu))		
			{
			$ret['old_status'] = $menu;	
			$ret['error'] = 1;	
			}
		return $ret; 
		}
	function changeOrder($id, $newPosition)
		{
		global $CNT;
		$setNodeId = $id;
//		$failureMes = 'update error';
		$error = 0;
		$brothers = $CNT->GetBrothers($setNodeId);
		for($i=0; $i<count($brothers); $i++)
			{
			if($brothers[$i]['catalog']['sc_id'] == $setNodeId)
				$oldPosition = $i;
			}
		$D = $oldPosition - $newPosition;
		for($i=0; $i<count($brothers); $i++)
			{
			if(($i<$oldPosition)&&($i<$newPosition))
				{
				$curNodeId = $brothers[$i]['catalog']['sc_id'];
				$curIndex = $i;
//				$TM->TimeCalc('1');
				}
			elseif(($i==$newPosition))
				{
				$curNodeId = $brothers[$oldPosition]['catalog']['sc_id'];
				$curIndex = $i;
				$successMes  = $i;
//							$TM->TimeCalc('2');
				}
			elseif(($i>$newPosition)&&($i>$oldPosition))
				{
				$curNodeId = $brothers[$i]['catalog']['sc_id'];
				$curIndex = $i;
//							$TM->TimeCalc('3');
				}
			/******************$D>0***************************/
			elseif(($D>0)&&($i>$newPosition)&&($i<=$oldPosition))
				{
				$curNodeId = $brothers[$i-1]['catalog']['sc_id'];
				$curIndex = $i;
//							$TM->TimeCalc('4');
				}
			/******************$D<0***************************/							
			elseif(($D<0)&&($i>=$oldPosition)&&($i<$newPosition))
				{
				$curNodeId = $brothers[$i+1]['catalog']['sc_id'];
				$curIndex = $i;
				}
			if(!$this->SetNodPar($curNodeId, 'order', $curIndex))
				{
				$error ++;
				}
			}					
		return $error;
		}
	function DeleteParamByName($nodeId, $bodyName)
		{
		$ret = 0;
		$LNK= new DBLink;				
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$query_delete_body = 'Delete from SiteBody  where sc_id = '.$nodeId.' AND sb_name = \''.$bodyName.'\'';
		$LNK->Query ($query_delete_body);		
		if(!$LNK->error)
			{			
			$ret++;// = $LNK->error_string;
			}
		return $ret;
		}
	function DeleteParam($bodyId)
		{
		$ret = 0;
		$LNK= new DBLink;				
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$query_delete_body = 'Delete from SiteBody  where sb_id = '.$bodyId;
		$LNK->Query ($query_delete_body);		
		if(!$LNK->error)
			{			
			$ret++;// = $LNK->error_string;
			}
		return $ret;
		}
	function editAddPar($body, $id, $whereIn)
		{
		$ret = 0;
		if(is_array($whereIn))		
			$where = ' WHERE  sc_id = '.$whereIn['sc_id'].' AND sb_name = \''.$whereIn['sb_name'].'\'';
		else
			$where = 'WHERE  sb_id = '.$id;
		
		$LNK= new DBLink;			
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$query_new_body = 'UPDATE SiteBody SET ';
		if($body['value'])
			$query_new_body .= ' sb_value = \''.$body['value'].'\' ';
		if($body['name'])
			$query_new_body .= ', sb_name = \''.$body['name'].'\' ';
		if($body['type'])
			$query_new_body .= ', sb_type = \''.$body['type'].'\' ';
		$query_new_body .= $where;
//		'WHERE  sb_id = '.$id;
		
		$LNK->Query ($query_new_body);
		if(!$LNK->error)
			{
			$ret++;
			}
		return $ret;
		}
	function AddParToNode($body, $id)
		{
		$ret = 0;
		$LNK= new DBLink;				
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$query_new_body = 'INSERT INTO SiteBody SET ';
		if($body['name'])
			$query_new_body .= ' sb_name = \''.$body['name'].'\'';
		if($body['value'])
			$query_new_body .= ', sb_value = \''.$body['value'].'\'';
		if($body['type'])
			$query_new_body .= ', sb_type = \''.$body['type'].'\'';
		$query_new_body .= ', sc_id = '.$id;
		
		$LNK->Query ($query_new_body);
		if(!$LNK->error)
			{
			$ret++;
			}
		return $ret;
		}
	function CreateNodeWithBody($param, $body)
		{
//		print_r($param);
		$ret = $bodyCnt = 0;
		$CNT = new GetContent;
		$LNK= new DBLink;				
		global $USER;
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$query_new_node = 'INSERT INTO SiteCatalog SET ';
		if($param['name'])
			$query_new_node .= ' sc_name = \''.$param['name'].'\'';
		if($param['parId'])
			{
			$thread = $CNT->GetCurNodePar($param['parId'], 'sc_thread');
			if((!$thread)&&($thread==$param['parId']))
				$thread = -1;
			elseif((!$thread)&&($thread!=$param['parId']))
				$thread = $param['parId'];
			$query_new_node .= ', sc_parId = '.$param['parId'].', sc_thread = '.$thread;
			}
		else
			{
			$thread = -1;			
			}
		if($param['order'])
			$query_new_node .= ', sc_order = '.$param['order'];
		if($param['lang'])
			$query_new_node .= ', lang_id = '.$param['lang'];
		if($param['handler'])
			$query_new_node .= ', sc_handler = \''.$param['handler'].'\'';
		if($param['is_menu'])
			$query_new_node .= ', sc_menu = '.$param['is_menu'];
		if(isset($param['sc_published']))
			$query_new_node .= ', sc_published = '.$param['sc_published'];
		else
			$query_new_node .= ', sc_published = 1';
		$query_new_node .= ', user_id = '.$USER->id;
//		$query_new_node += '';
//		echo $query_new_node;
		$LNK->Query ($query_new_node);
		if(!$LNK->error)
			{
			$lastId =  $LNK->last_id;
			$ret++;// = $LNK->error_string;
			if($thread<0) 
				$this->SetNodPar($lastId, 'sc_thread', $lastId);
			if(count($body))
				{
				for($i=0; $i<count($body); $i++)
					{
					$query_new_body = 'INSERT INTO SiteBody SET ';
					if($body[$i]['name'])
						$query_new_body .= ' sb_name = \''.$body[$i]['name'].'\'';
					if($body[$i]['value'])
						$query_new_body .= ', sb_value = \''.$body[$i]['value'].'\'';
					if($body[$i]['type'])
						$query_new_body .= ', sb_type = \''.$body[$i]['type'].'\'';
					$query_new_body .= ', sc_id = '.$lastId;
					
					$LNK->Query ($query_new_body);
					if(!$LNK->error)
						{
						$bodyCnt++;
						}
					}
				$ret = ($bodyCnt == count($body))?$lastId:0;					
				}
			}
		return $ret;
		}
	function DeleteNode($nodeId, $delBody)
		{
		$ret = 0;
		$LNK= new DBLink;				
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$query_delete_node = 'Delete from SiteCatalog where sc_id = '.$nodeId;
		$query_delete_body = 'Delete from SiteBody  where sc_id = '.$nodeId;
		$LNK->Query ($query_delete_node);		
		if(!$LNK->error)
			{			
			$ret++;// = $LNK->error_string;
			if($delBody)
				$LNK->Query ($query_delete_body);	
				if(!$LNK->error)
					{			
					$ret++;// = $LNK->error_string;
					}			
			}
/*		else
			{
			}*/
		if($ret>1)
			return 1;
		else
			return 0;
		}
	function SetNodPar($nodeId, $parName, $parVal)
		{
//		if
		switch($parName)
			{
			case 'name': $colName = 'sc_name'; break;
			case 'lang': $colName = 'lang_id'; break;
			case 'order': $colName = 'sc_order'; break;
			case 'menu': $colName = 'sc_menu'; break;
			case 'system': $colName = 'sc_system'; break;
			case 'published': $colName = 'sc_published'; break;
			case 'handler': $colName = 'sc_handler'; break;
			case 'order': $colName = 'sc_order'; break;
			case 'sc_thread': $colName = 'sc_thread'; break;
			case 'sc_parId': $colName = 'sc_parId'; break;
			}
		$ret = 0;
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$query_update = 'UPDATE SiteCatalog SET '.$colName.' = \''.$parVal.'\' where sc_id = '.$nodeId;
		$LNK->Query ($query_update);		
		if(!$LNK->error)
			{
			$ret++;// = $LNK->error_string;
			}
/*		else
			{
			}*/
		return $ret;
		}
	}
	

?>