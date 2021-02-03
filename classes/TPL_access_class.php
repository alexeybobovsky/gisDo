<?
class ACCESS_TEMPLATE extends TEMPLATE  
	{
	function UsersWithoutRightsList($users, $groups, $excluded, $showUsers)	
		{
		$cnt = 0;
		for($i=0; $i<count($groups); $i++)
			{
			if(!in_array($groups[$i]['user_id'], $excluded))
				{
				$tmp[$cnt]['user_id'] = $groups[$i]['user_id'];
				$tmp[$cnt]['user_name'] = $groups[$i]['user_name'];
				$tmp[$cnt]['user_type'] = 'groups';				
				$cnt++;
				}
			}
		if($showUsers)
			{
			for($i=0; $i<count($users); $i++)
				{
				if(!in_array($users[$i]['user_id'], $excluded))
					{
					$tmp[$cnt]['user_id'] = $users[$i]['user_id'];
					$tmp[$cnt]['user_name'] = $users[$i]['user_name'];
					$tmp[$cnt]['user_type'] = 'users';				
					$cnt++;
					}
				}
			}		
		return $tmp;		
		}
	function RightList($obj_id, $rights)
		{
		global $CNT; // = new GetContent;
		global $USER;
		$form = array(
						'action' => '/upload/set/',
						'name' => 'NEWFILE',
						'emptyCheck' => 0
						);
		$table = array(
						'label' => 'Права на объект '.$CNT->GetCurNodePar($obj_id, 'sc_name'),
						'bodyId' => 'RightList',
						'colHeader' => array('#', 'Имя', 'Доступ', 'Унаследован от', 'удалить'),
						'colStyle' => array('', '', 'editable_select', '', ''),
						'colAlias' => array('rightType', 'userName', 'right', 'inherit')
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$full_ret['table']  = $this->TPL_CreateTable($table);
		$r_tmp = $rights;
		$r_Cnt = 0;
		$users = array();
		$rightAlias = array(0 =>'нет доступа', 1 => 'чтение', 3 => 'запись', 7 => 'полный доступ');
		for($i=0; $i<count($r_tmp); $i++)
			{
			for($l=0; $l<(strlen($r_tmp[$i]['right'])); $l++)
				{
				$rAr[$l] =  substr($r_tmp[$i]['right'], $l, 1);
				}
			if(($r_tmp[$i]['rightType']=='root')||($r_tmp[$i]['rightType']=='owner'))
				{
					if($r_tmp[$i]['userId']>1)
						{
						$usId = $r_tmp[$i]['userId'];
						$r_r[$r_Cnt]['userName'] = $USER->getUserParam('user_id', $usId , 'user_name');
						$r_r[$r_Cnt]['userId'] = $r_tmp[$i]['userId'];
						$r_r[$r_Cnt]['userType'] = $r_tmp[$i]['userType'];
						$r_r[$r_Cnt]['rightId'] = $r_tmp[$i]['rightId'];
						$r_r[$r_Cnt]['inherit'] = $r_tmp[$i]['inherit'];
						$r_r[$r_Cnt]['rightSrc'] = $rAr[0];
						$r_r[$r_Cnt]['right'] = $rightAlias[$rAr[0]];
						$r_r[$r_Cnt]['cnt'] = $r_Cnt;
						$r_Cnt ++;
						}
					$usId =  $USER->getSystemGroup('user_id');
					$r_r[$r_Cnt]['userName'] = $USER->getUserParam('user_id', $usId , 'user_name');
					$r_r[$r_Cnt]['userType'] = 'group';//$r_tmp[$i]['userType'];
					$r_r[$r_Cnt]['userId'] = $usId;
					$r_r[$r_Cnt]['rightId'] = $r_tmp[$i]['rightId'];
					$r_r[$r_Cnt]['inherit'] = $r_tmp[$i]['inherit'];
					$r_r[$r_Cnt]['right'] = $rightAlias[$rAr[2]];				
					$r_r[$r_Cnt]['rightSrc'] = $rAr[2];
					$r_r[$r_Cnt]['cnt'] = $r_Cnt;
					$r_Cnt ++;
				}
			if(($r_tmp[$i]['rightType']=='parent')||($r_tmp[$i]['rightType']=='current'))
				{
					$usId = $r_tmp[$i]['userId'];
					$r_r[$r_Cnt]['rightId'] = $r_tmp[$i]['rightId'];
					$r_r[$r_Cnt]['userType'] = $r_tmp[$i]['userType'];
					$r_r[$r_Cnt]['userName'] = $r_tmp[$i]['userName'];
					$r_r[$r_Cnt]['userId'] = $r_tmp[$i]['userId'];
					$r_r[$r_Cnt]['inherit'] = $r_tmp[$i]['inherit'];//($r_tmp[$i]['inherit'])?$CNT->GetCurNodePar($r_tmp[$i]['inherit'], 'sc_name'):'';
					$r_r[$r_Cnt]['right'] = ($r_r[$r_Cnt]['userType']=='user')?$rightAlias[$rAr[0]]:$rightAlias[$rAr[1]];
					$r_r[$r_Cnt]['rightSrc'] = ($r_r[$r_Cnt]['userType']=='user')?$rAr[0]:$rAr[1];
					$r_r[$r_Cnt]['cnt'] = $r_Cnt;
					$r_Cnt ++;
				}
			}
		$r2 = array();
		$i = 0;
		$stop=0;
		do
			{
			$num = $r_r[$i]['userId'];
//				echo $num,'<br>';
			if(!isset($r2[$num]))
				{
				$r2[$num] = $r_r[$i];
				if(($USER->getUserParam('user_id', $num , 'is_group'))&&($USER->getUserParam('user_id', $num , 'is_system')))
					{
					$stop++;
					}
				}
			$i++;
			}
		while (($i<=count($r_r))&&(!$stop));
		$ar = array();
		while (list ($key2, $val2) = each ($r2)) 
			{
			$ar[$r2[$key2]['cnt']] = $val2;
			}
		ksort($ar, SORT_NUMERIC);
		$userList = array();
		while (list ($key2, $val2) = each ($ar)) 
			{
			$userList[] = $val2['userId'];
			$ar_r[] = $val2;
			}
//		$full_ret['_rights'] = $r_tmp;
		$full_ret['rights'] = $ar_r;
		$full_ret['obj_id'] = $obj_id;
		$full_ret['userList'] = $userList;
//		$full_ret['rights_'] = $rights;
		return $full_ret;						
		}
	function ShowArchive($location)
		{
		$form = array(
						'action' => $location,
						'name' => 'articleForm',
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => '');
		$ar[] = array('name' => 'curUrl', 
					'id' => 'IDcurUrl', 
					'type' => 'hidden', 
					'default' => $location);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}				
		return $full_ret;								
		}		
	function getPropertiesForm()
		{
		global $CONST;
		$table = array(
						'label' => 'Права',
						'bodyId' => 'category'
//						'colHeader' => array('Добавить', 'Редактировать', 'Удалить')
						);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		return $full_ret;						
		}	
	function getTree($tree) /*05_06_2007*/
		{
		global $CONST;
		global $ACL;
		$table = array(
						'label' => 'Разделы сайта',
						'bodyId' => 'TREE'						
						);
		$CONT =  new GetContent;

		$full_ret['lang'] = $CONT->GetAllLanguages(2);
		$full_ret['lang'][0] = 'any';
		$full_ret['table_tree'] = $this->TPL_CreateTable($table);
		
		$tr= array();
		for($i=0; $i<count($tree); $i++)
			{
			$this->Reset();
			$this->GetParents($tree[$i]['catalog']['sc_parId'], $tree, $i);
//			print_r($this->parents);
			$tree[$i]['parents'] = $this->parents;
			if(($_SESSION['curNode'])&&($tree[$i]['catalog']['sc_id'] == $_SESSION['curNode']))
				{
				$visibleNodes = $this->parents;
				$curNode['id'] = $_SESSION['curNode'];
				$curNode['right'] = $ACL->GetClosedParentRight($_SESSION['curNode']);
				$full_ret['curNode'] = $curNode;
//				print_r($visibleNodes);
				unset($_SESSION['curNode']);				
				}
			}
		$cnt = 0;
		for($i=0; $i<count($tree); $i++)
			{
			$name = '';
			$article = 0;
			for($n=0; $n<count($tree[$i]['body']); $n++)
				{
				if($tree[$i]['body'][$n]['name'] == 'caption')
					$name = $tree[$i]['body'][$n]['value'];
				}
			$tr[$cnt]['name'] = ($name)?$name:$tree[$i]['catalog']['sc_name'];
			$tr[$cnt]['type'] = ($article)?'article':'category';

			$tr[$cnt]['path'] = $tree[$i]['path'];
			$tr[$cnt]['nodeName'] = $tree[$i]['catalog']['sc_name'];
			$tr[$cnt]['id'] = $tree[$i]['catalog']['sc_id'];
			$tr[$cnt]['level'] = $tree[$i]['level'];
			if($tree[$i]['level']>0)
				{
				for($k=0; $k<count($tree[$i]['parents']); $k++)
					{
					for($m=0; $m<count($tree); $m++)
						{
						if(($tree[$m]['catalog']['sc_id'] == $tree[$i]['parents'][$k])&&($tree[$m]['haveBrother']))
							{
//							echo '<br>vr: name = '.$tree[$i]['catalog']['sc_name'].'; name2 = '.$tree[$m]['catalog']['sc_name'].'; lvl = '.$k.';';
							$tr[$cnt]['img'][$k] = 'vr';
							}
						elseif(($tree[$m]['catalog']['sc_id'] == $tree[$i]['parents'][$k])&&(!$tree[$m]['haveBrother']))
							{
//							echo '<br>sp: name = '.$tree[$i]['catalog']['sc_name'].'; name2 = '.$tree[$m]['catalog']['sc_name'].'; lvl = '.$k.';';
							$tr[$cnt]['img'][$k] = 'sp';
							}
						
						}
					 
					}
				if($tree[$i]['numChild'])
					{
					$tr[$cnt]['img'][$tree[$i]['level']] = '3n';
					if(!$tree[$i]['haveBrother'])
						$tr[$cnt]['img'][$tree[$i]['level']] = 'endn';																	
					$tr[$cnt]['img'][] = 'folder';
					$tr[$cnt]['havechild'] = 1;
					}
				else
					{
					$tr[$cnt]['img'][$tree[$i]['level']] = '3s';
					if(!$tree[$i]['haveBrother'])
						$tr[$cnt]['img'][$tree[$i]['level']] = 'ends';
					$tr[$cnt]['img'][] = ($tr[$cnt]['type'] == 'article')?'node':'folder';
					$tr[$cnt]['havechild'] = 0;						
					}
				}
			elseif(!$tree[$i]['level'])
				{
				$next = 0;
				for($m=$i+1; $m<count($tree); $m++)
					{
					if($tree[$m]['level']==0)
						{
						$next ++;
						}			
					}
				if($tree[$i]['numChild'])
					{
					$tr[$cnt]['img'][0] = ($next>0)?'3n':'endn';
					$tr[$cnt]['img'][] = 'folder';
					$tr[$cnt]['havechild'] = 1;
					}
				else
					{
					$tr[$cnt]['img'][0] = ($next>0)?'3s':'ends';					
					$tr[$cnt]['img'][] = 'node';
					$tr[$cnt]['havechild'] = 0;
					}
				}
			$tr[$cnt]['right'] = $tree[$i]['right'];
			$bcount = $cnt;
			$cnt++;
			}		
		for($i=0; $i<count($tr); $i++)
			{
			if(($tr[$i+1])&&($tr[$i]['level']<$tr[$i+1]['level']))
				{
				if((!$i)||((isset($visibleNodes))&&(in_array($tr[$i]['id'], $visibleNodes))))
					{					
//					echo '<br>'.$tr[$i+1]['id'];
					$tr[$i+1]['visible'] = 1;
					}					
				$tr[$i+1]['topen'] = 1;
				$lvl[$tr[$i]['level']] = 1;
				}
			if(($tr[$i+1])&&($tr[$i]['level']>$tr[$i+1]['level']))
				{
				$cnt = 0;
				$tr[$i]['tclose'] = 0;
				do
					{
					$cnt++;
					if($lvl[$tr[$i]['level']-$cnt]);
						{
						$lvl[$tr[$i]['level']-$cnt] = 0;
						$tr[$i]['tclose'] ++;
						}
					}
				while(($tr[$i+1]['level'] + $cnt)<$tr[$i]['level']);
//				$tr[$i]['topen'] = 1
				}
			if(!$tr[$i+1])
				{
				$cnt = 0;
				$tr[$i]['tclose'] = 0;
				do
					{
					$cnt++;
					if($lvl[$tr[$i]['level']-$cnt]);
						{
						$lvl[$tr[$i]['level']-$cnt] = 0;
						$tr[$i]['tclose'] ++;
						}
					}
				while($tr[$i]['level']-$cnt);
				}
			}
		$full_ret['Stree'] = $tr;
		$full_ret['rootRight'] = $ACL->GetRootRight();
//		$full_ret['tree'] = $tree;
		return $full_ret;
		}	
	}
?>