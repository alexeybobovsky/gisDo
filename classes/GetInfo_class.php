<?php
class GetInfo  extends GetContent  
	{
	var $last_query;
	var $child = array();
	var $idInUse = array();
	var $childNum;
	var $childLevel;
	var $rekCount;
	function GetFutureBrotherList($curNode) //29_05_07 возвращает список  всех детей узла 1-гу уровня в список
		{
		$brotherList = $this->GetChildren1Level($curNode, 0, 1);
		$cnt = 0;
		$lastOrder = 0;
//		print_r($brotherList);
		for($i=0; $i<count($brotherList); $i++)
			{
			if(($brotherList[$i]['catalog']['sc_id'] != $curNode)&&($brotherList[$i]['catalog']['sc_menu']))
				{
				$list['text'][$cnt] = 'Перед "';
				$list['text'][$cnt] .= ($brotherList[$i]['body']['caption'])?$brotherList[$i]['body']['caption']:$brotherList[$i]['catalog']['sc_name'];
				$list['text'][$cnt] .= '"';
				$list['value'][$cnt] = $brotherList[$i]['catalog']['sc_order'];
				$lastOrder = $brotherList[$i]['catalog']['sc_order'];
				$cnt++;
				}		
			}
		$list['text'][] = 'Последний';
		$list['value'][] = $lastOrder+1;		
		$list['default'] = $lastOrder+1;
//		print_r($list);*/
		return $list;		
		}	

	function GetInfoTree($startId, $type) /*29_05_07 получает  дерево несистемных объектов + корень*/
		{
		$treeInfo = array();
		$this->GetChildren($startId, 0, $type, 0, 0, -1, 0, 2);
		$treeTmp = $this->child;
		$this->Reset();
//		print_r($treeTmp);
		$treeInfo[0] = array('haveBrother' =>0, 'level'=>0, 'right'=>3, 'body'=>
						array(0 => array('name' => 'caption', 'value' => 'Корень сайта')), 
						'numChild' => 10, 'catalog' => array('sc_id'=>0, 'sc_name' => 'root', 'sc_menu' => 1, 'sc_published' => 1));
//		 = $firstNode;
		for($i=0; $i<count($treeTmp); $i++)
			{
			$treeInfo[$i+1] = $treeTmp[$i];
			$treeInfo[$i+1]['level'] ++; 
			}
		return $treeInfo;		
		}		
	function GetBrotherList($curNode) //29_05_07 возвращает список  всех братьев узла
		{
//		echo $curNode;
//		print_r($tree);GetBrothers($id)
		$brotherList = $this->GetBrothers($curNode);
//		print_r($treeTmp[3]);
		$cnt = 0;
		$curOrder = 0;
		for($i=0; $i<count($brotherList); $i++)
			{
			if(($brotherList[$i]['catalog']['sc_id'] != $curNode)&&($brotherList[$i]['catalog']['sc_menu']))
				{
				$list['text'][$cnt] = ($curOrder)?'После ':'Перед ';
				$list['text'][$cnt] .= ($brotherList[$i]['body']['caption'])?$brotherList[$i]['body']['caption']:$brotherList[$i]['catalog']['sc_name'];
				$list['value'][$cnt] = $brotherList[$i]['catalog']['sc_order'];
				$cnt++;
				}		
			elseif($brotherList[$i]['catalog']['sc_id'] == $curNode)
				{
				$list['default'] = $brotherList[$i]['catalog']['sc_order'];
				$list['text'][$cnt] = 'Текущая позиция';
				$list['value'][$cnt] = $brotherList[$i]['catalog']['sc_order'];
				$curOrder ++;
				$cnt++;
				}
			}
//		print_r($list);
		return $list;		
		}	
	function GetNodeList($tree, $curNode) //возвращает список  категорий
		{
//		print_r($tree);
		$curParentId = $tree[0]['catalog']['sc_parId'];
		$curParentStr[0] = '/';		
		$cnt = 0;
		$skip = 0;
		for($i=0; $i<count($tree); $i++ )
			{
//			if(($skip)&&($tree[$i]['level']<$tree[$i-1]['level']))
			if(($skip)&&($curNode!=$tree[$i]['catalog']['sc_id']))
				{
				$skip=0;
				}
			if(((!$curNode)||(($curNode)&&($curNode!=$tree[$i]['catalog']['sc_id'])))&&(!$skip))
				{
//			echo $curNode.' = '.$tree[$i]['catalog']['sc_id'].'/'.$tree[$i]['catalog']['sc_name'].'; skip = '.$skip.'; level = '.$tree[$i]['level'].'; '.$tree[$i]['body']['caption'].'<br>';				
				$list['text'][$cnt] = ($tree[$i]['level'])?$curParentStr[$tree[$i]['level']].'/':'';
				$list['text'][$cnt] .= ($i)?$tree[$i]['body']['caption']:'/';//$tree[$i]['catalog']['sc_name'];
				$list['value'][$cnt] = $tree[$i]['catalog']['sc_id'];
				$curParentStr[$tree[$i]['level']+1] = ($i)?$list['text'][$cnt]:'' ;
				$cnt++;
				}
			elseif ($curNode==$tree[$i]['catalog']['sc_id'])
				{
				$skip = 1;
				$tmpCaption = ($tree[$i]['level'])?$curParentStr[$tree[$i]['level']].'/':'';
				$tmpCaption .= ($i)?$tree[$i]['body']['caption']:'/';//$tree[$i]['catalog']['sc_name'];
				$curParentStr[$tree[$i]['level']+1] = ($i)?$tmpCaption:'' ;
				}				
			}
		return $list;		
		}	
	function GetCategory($id) //возвращает категорию статей с аттрибутами
		{
		$ret = $this->GetCurNode($id, 0);
		return $ret;		
		}	
/********************************************************************/
	}
?>