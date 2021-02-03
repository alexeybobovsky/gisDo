<?php
//require_once("main.inc.php");
class GetOrganization
	{
	var $last_query;
	var $child = array();
	var $idInUse = array();
	var $childNum;
	var $childLevel;
	var $rekCount;
	var $usr;
	function GetOrganization() /*2014_02_17 */
		{
		global $USER;
		$this->usr = $USER;
		}
/***************************************FOR IMPORT ONLY***********************************************	*/
	function getFotoPositionCnt($objId) /*2014_02_17 */
		{
		$query = 'SELECT MAX(distinct `foto_position`) as positionCnt  FROM `fs_objFoto` WHERE `obj_id` = '.$objId;
		$ret_arr  = array('positionCnt');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData('positionCnt', false);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}		
	function getAllObjectsWithFoto_IMP() /*2013_11_19 получене офиса по id*/
		{
		$query = 'SELECT DISTINCT  obj_id FROM fs_objFoto					
					ORDER BY foto_date ASC';
		$ret_arr  = array('obj_id');
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
	function getItemOfFirms_IMP($objId) /*2013_12_6 получене всех строек */
		{
		$query = 'SELECT * FROM jos_js_res_category WHERE id=\''.intval($objId).'\'';
		$ret_arr  = array('id', 'name', 'description', 'alias');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, false);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}		
	function getAllItemsObj_IMP() /*2013_12_6 получене всех строек */
		{
		$query = 'SELECT * FROM gd_object ORDER BY obj_id';
		$ret_arr  = array(	'obj_id', 
							'obj_rank', 
							'obj_hidden', 
							'obj_name', 
							'obj_www', 
							'obj_projDoc', 
							'obj_info', 
							'obj_firmZakaz', 
							'obj_firmPodr', 
							'obj_state', 
							'obj_district', 
							'obj_dateStart', 
							'obj_dateEnd', 
							'obj_adrString', 
							'obj_geoX', 'obj_geoY', 
							'obj_positionStatus', 
							'obj_pointCnt', 
							'obj_updDate', 
							'obj_viewCount', 
							'old_id', 
							'old_alias', 
							'obj_material');
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
	function getAllItemsFirms_IMP() /*2013_12_6 получене всех строек */
		{
		$query = 'SELECT * FROM jos_js_res_category WHERE parent=7 ORDER BY name';
		$ret_arr  = array('id', 'name', 'description', 'alias');
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
	function getItemOfRecordConstr_IMP($objId) /*2013_12_6 получене всех строек */
		{
		$query = 'SELECT * FROM jos_js_res_record_values WHERE record_id = \''.intval($objId).'\'ORDER BY field_id';
		$ret_arr  = array('field_id', 'id', 'field_value', 'record_id', 'params');
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
	function getAllItemsConstr_IMP() /*2013_12_6 получене всех строек */
		{
		$query = 'SELECT id , title
					FROM jos_js_res_record 
					ORDER BY id';
		$ret_arr  = array('id', 'title');
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
	function __getAllItemsConstr_IMP() /*2013_12_6 получене всех строек */
		{
		$query = 'SELECT jos_js_res_record.id as recordId, title, field_id, field_value 
					FROM jos_js_res_record_values, jos_js_res_record 
					WHERE jos_js_res_record.id = record_id
					ORDER BY jos_js_res_record.id, field_id';
		$ret_arr  = array('field_id', 'recordId', 'field_value');
		$LNK= new DBLink;		
		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
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
	function _getAllItemsConstr_IMP() /*2013_12_6 получене всех строек */
		{
		$query = 'SELECT * FROM jos_js_res_record_values ORDER BY record_id, field_id';
		$ret_arr  = array('field_id', 'id', 'field_value', 'record_id', 'params');
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
/***************************************FOR IMPORT ONLY***********************************************	*/
/***************************************FOR INDEX ONLY***********************************************	*/
	function getAllFirmListService()/*2013_09_17 получене всех фирм СЕРВИСНАЯ ФУНКЦИЯ*/	
		{
		$query = 'SELECT  *	FROM `gd_firm`';
		$ret_arr  = array('firm_id', 'firm_name',  'firm_info',  'firm_adrString',  'firm_phone',  'firm_www');
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
	function getStrFromIndex($str)/*2013_09_20 поиск в индексе*/	
		{
		$query = 'SELECT  *	FROM `gd_index` where text like \'%'.$str.'%\'';
		$ret_arr  = array('index_id', 'obj_type',  'obj_id', 'text');
		$LNK= new DBLink;		
///		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
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
/***************************************FOR INDEX ONLY***********************************************	*/

/***************************************MESSAGES***********************************************	*/

	function getCommentsOfObjSmart($objType, $id, $dir, $hidden, $subj, $num, $onlyCnt) //12_10_2009 получает заданное количество комментариев о фирме
		{
		global $ROUT;
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
		$ret_arr  = array('user_name', 'user_id', $indexNames[$objType], 'firm_name', 'comm_id', 'comm_body', 'comm_date', 'comm_hidden', 'comm_subject', 'displayName', 'up_id', 'up_name', 'up_fullName');
		$LNK= new DBLink;		
		//$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
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
		$ret_arr  = array('user_name', 'user_id', 'obj_id', 'obj_name', 'comm_id', 'comm_body', 'comm_objType', 'comm_date', 'comm_hidden', 'comm_subject', 'displayName', 'up_id', 'up_name', 'up_fullName');
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
/***************************************MESSAGES***********************************************	*/
		
	function getConstrMostImg($objId) /*2015_08_24 отдавать рендер и последние фото стройки*/
		{
		$objProp = 			$this->getObjectProperties($objId, 0);
		$objFoto = 			$this->getLastFotoOfObj($objId);
		$render = '';
		if($objProp)
			{
			for($i = 0; $i< sizeof($objProp); $i++)
				{
				if(($objProp[$i]['property_name'] == 'fotoRender')&&(!$render))
					{
					$render =  $objProp[$i]['prop_value'];
					}
				}
			}
		if($render)
			$ret[] = $render;
//		print_r($objFoto);
		if($objFoto)
			for($l=0; $l<sizeof($objFoto); $l++)
				$ret[] = $objFoto[$l]['foto_src'];
	//		print_r($ret);
		return $ret;
		}
	function getFilterFromURL($url) /*2014_04_29 генерация массива фильтра по урлу*/
		{
		$urlArr = explode('_', $url);
		$str = $urlArr[1];
//		alert(str);
		
		if($str != '')
			{
			$filterArr =  explode('-', $str);
			$filter = array();
			for($i=0; $i<count($filterArr);  $i++ )
				{
				$parArr = explode('~', $filterArr[$i]);
				if($parArr[0] == 'state')
					{
					$filter['state'] = $parArr[1];
					}
				elseif($parArr[0] == 'material')
					{
					$filter['material'] = $parArr[1];			
					}
				elseif($parArr[0] == 'spec')
					{
					$filter['spec'] = $parArr[1];			
					}
				elseif($parArr[0] == 'district')
					{
					$filter['district'] = $parArr[1];			
					}
				elseif($parArr[0] == 'start')
					{
					$filter['dateStart'] = $parArr[1];			
					}
				elseif($parArr[0] == 'end')
					{
					$filter['dateEnd'] = $parArr[1];			
					}
				}
			return (count($filter)) ? $filter : 0;
			}
		else
			return 0;		
		}
	function getConstrFilterTitle($filter, $auto = 1) /*2014_04_29 генерация заголовка по фильтру*/
		{
		$title = $h1 = $description = '';
//		print_r($filter);
		if($filter['spec']=='')
			{
			if($filter['state']!='')
				{
				switch($filter['state'])
					{
					case 0 :
						{
						$title = 'Все новостройки ';
						$auto = 1;
						}
					break;
					case 1 :
						{
//						$title = 'Строящиеся объекты ';
						$title = ($auto) ?'Строящиеся объекты и жилые комплексы ' :'Строящиеся объекты и жилые комплексы в Иркутске';
						$h1 = 'Строящиеся жилые комплексы';
						$description = 'Полный обзор строящихся объектов и жилых комплексов в Иркутске. На нашем сайте вы найдете информацию и фотографии всех строящихся жилых комплексов города.';
//						$auto = 0;
						}
					break;
					case 2 :
						{
//						$title = 'Готовые новостройки ';
						$title = ($auto) ?'Готовые новостройки ' :'Готовые новостройки Иркутска';
						$h1 = 'Готовые новостройки';
						$description = 'На сайте ФотоСтроек вы найдете эксклюзивные фото готовых новостроек Иркутска. Специально для вас все готовые новостройки Иркутска на страницах нашего сайта.';
//						$auto = 0;
						}
					break;
					case 3 :
						{
//						$title = 'Запланированные новостройки ';
						$title = ($auto) ?'Планируемые новостройки, будущие жилые комплексы ' :'Планируемые новостройки, будущие жилые комплексы Иркутска';
						$h1 = 'Планируемые новостройки';
						$description = 'Хотите узнать где в Иркутске в ближайшее время появятся будущие новостройки? Тогда переходите на наш сайт и вы уведете все планируемые новостройки города.';
//						$auto = 0;
						}
					break;
					case 4 :
						{
						$title = 'Замороженные новостройки ';
						$auto = 1;
						}
					break;
					}
				}
			else
				$title = 'Новостройки ';
			if($filter['district']!='')
				{
				switch($filter['district'])
					{
	/*				case 0 :
						$title = 'Все новостройки ';
					break;*/
					case 1 :
						{
						if($auto)
							{
							$title .= 'в Правобережном округе ';
							}
						else
							{
							$title = 'Новостройки Правобережный район Иркутска';
							$h1 = 'Новостройки в Правобережном округе';
							$description = 'На сайте Фотостроек вы сможете посмотреть все новостройки в Правобережном округе Иркутска. Только у нас полная информация о готовности новостроек в Правобережном округе с фото и возможностью комментировать.';
							}
						}
					break;
					case 2 :
						{
						if($auto)
							{
							$title .= 'в Октябрьском районе ';
							}
						else
							{
							$title = 'Новостройки в Октябрьском районе Иркутска';
							$h1 = 'Новостройки в Октябрьском районе';
							$description = 'Специально для пользователей сайта FotoStroek.ru мы собрали все новостройки в Октябрьском районе города Иркутская. У нас вы можете посмотреть фото новостроек Октябрьского района города.';
							}
						}
					break;
					case 3 :
						{
						if($auto)
							{
							$title .= 'в Свердловском районе ';
							}
						else
							{
							$title = 'Новостройки в Свердловском районе Иркутска';
							$h1 = 'Новостройки в Свердловском районе';
							$description = 'Вся информация о новостройках в Свердловском районе Иркутска на сайте FotoStroek.ru. У нас мы можете мониторить новостройки Свердловского района города и оставлять свои комментарии.';
							}
						}
					break;
					case 4 :
						{
						if($auto)
							{
							$title .= 'в Ленинском районе ';
							}
						else
							{
							$title = 'Новостройки Иркутска в Ленинском районе';
							$h1 = 'Новостройки в Ленинском районе';
							$description = 'Все новостройки Ленинского района города Иркутска на сайте FotoStroek.ru. У нас вы сможете найти все новостройки в Ленинском районе, а так же посмотреть их фото и почитать комментарии. ';
							}
						}
					break;
					}
				$title .= ($auto) ? 'Иркутска' : '';
				}
			else
				$title .= ($auto) ? 'в Иркутске' : '';
			}
		else
			{
			$auto = 1;
			switch($filter['spec'])
				{
				case 'lastFoto' :
					$title = 'Обновившиеся новостройки Иркутска за 30 дней ';
				break;
				case 'lastObj' :
					$title = 'Новые стройки Иркутска за 6 месяцев ';
				break;
				case 'completed' :
					$title = 'Завершенные стройки Иркутска за 6 месяцев ';
				break;
				case 'all' :
					$title = 'Все новостройки от начала проекта';
				break;
				}
			
			}
		if($auto)
			return $title;				
		else
			return array('title' => $title, 'h1' => $h1, 'description' =>$description);
//			return $title;				
		}		
		
		
	function getDateIntervalsConstr() /*2014_01_13 получене старта и окончание мониторинга*/
		{
		$query = 'SELECT  	MIN(obj_monStart) as monStartBegin,  	MAX(obj_monStart) as monStartEnd,  
							MIN(obj_monEnd) as monEndBegin,  		MAX(obj_monEnd) as monEndEnd,  
							MIN(obj_dateStart) as dateStartBegin,  	MAX(obj_dateStart) as dateStartEnd,  
							MIN(obj_dateEnd) as dateEndBegin,  		MAX(obj_dateEnd) as dateEndEnd
					FROM gd_object';
		$ret_arr  = array('monStartBegin', 'monStartEnd', 'monEndBegin', 'monEndEnd', 'dateStartBegin', 'dateStartEnd', 'dateEndBegin', 'dateEndEnd');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($numRows = $LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, false);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}		
	function getPeriodFotoOfObj($objId) /*2014_01_13 получене старта и окончание мониторинга*/
		{
		$query = 'SELECT  DISTINCT foto_date FROM fs_objFoto
					WHERE obj_id = \''.intval($objId).'\'
					ORDER BY foto_date';
		$ret_arr  = array('foto_date');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($numRows = $LNK->GetNumRows())
			{		
			$retTmp = $LNK->GetData($ret_arr, true);
			$ret['monitoringStart'] = 	$retTmp[0]['foto_date'];
			$ret['monitoringEnd'] = 	$retTmp[$numRows-1]['foto_date'];
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}		
	function getLastFotoOfObj($objId) /*2013_12_6 получене фотографий объекта по сессии*/
		{
		$query = 'SELECT * FROM fs_objFoto
					WHERE obj_id = \''.intval($objId).'\'
					ORDER BY foto_date DESC, foto_position';
		$ret_arr  = array('foto_id', 'foto_date', 'foto_captureNumber', 'foto_src', 'foto_position', 'foto_date');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$retTmp = $LNK->GetData($ret_arr, true);
			for($i=0; $i<sizeof($retTmp); $i++)
				{
				if(!$i) $curDate = $retTmp[$i]['foto_date'];
				if($retTmp[$i]['foto_date'] == $curDate )
					$ret[] = $retTmp[$i];
				}
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}		
	function getFotoOfObjOrdered($objId, $order) /*2013_12_6 получене фотографий объекта по сессии*/
		{
		$query = 'SELECT * FROM fs_objFoto
					WHERE obj_id = \''.intval($objId).'\'
					ORDER BY '.$order;
		$ret_arr  = array('foto_id', 'foto_date', 'foto_captureNumber', 'foto_src', 'foto_position', 'foto_date');
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
	function getFotoOfObj($objId) /*2013_12_6 получене фотографий объекта по сессии*/
		{
		$query = 'SELECT * FROM fs_objFoto
					WHERE obj_id = \''.intval($objId).'\'
					ORDER BY foto_date ';
		$ret_arr  = array('foto_id', 'foto_date', 'foto_captureNumber', 'foto_src', 'foto_position', 'foto_date');
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
	function getFotoOfSet($objId, $setId) /*2013_12_6 получене фотографий объекта по сессии*/
		{
		$query = 'SELECT * FROM fs_objFoto
					WHERE obj_id = \''.intval($objId).'\'
					AND foto_captureNumber = \''.intval($setId).'\'
					ORDER BY foto_position ';
		$ret_arr  = array('foto_id', 'foto_date', 'foto_captureNumber', 'foto_src', 'foto_position', 'foto_date');
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
	function getObjectFotoDateList($objId) /*2013_11_19 получене офиса по id*/
		{
		$query = 'SELECT DISTINCT  foto_date, foto_captureNumber  FROM fs_objFoto
					WHERE obj_id = \''.intval($objId).'\'
					ORDER BY foto_captureNumber DESC';
		$ret_arr  = array('foto_date', 'foto_captureNumber');
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
	function getObjectCaptureCnt($objId) /*2014_02_27 получене последней съемки из таблицы фото*/
		{
		$query = 'SELECT MAX(foto_captureNumber)  AS lastCapture FROM fs_objFoto
					WHERE obj_id = \''.intval($objId).'\'';
		$ret_arr  = array('obj_id', 'cityId', 'city_name', 'obj_rank', 'obj_hidden', 'obj_name', 'obj_www', 'obj_projDoc', 'obj_info', 'obj_firmZakaz', 'obj_firmPodr', 'obj_state', 'obj_district', 'obj_dateStart', 'obj_dateEnd', 'obj_adrString', 'obj_geoX', 'obj_geoY', 'obj_pointCnt', 'obj_updDate', 'obj_viewCount', 'obj_material');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
/*			$ret = $LNK->GetData($ret_arr, false);*/
			$ret = $LNK->GetData('lastCapture', false);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}	
	
	function getAllFirm($city, $showAll, $onlyCnt)	/*2013_11_15 получене всех фирм СЕРВИСНАЯ ФУНКЦИЯ*/	
		{
//		$ret_arr  = array('firm_id', 'firm_name', 'firm_nameTranslit');
		$ret_arr  = array('firm_id', 'cityId', 'firm_name', 'firm_nameTranslit', 'firm_rank', 'firm_status', 'firm_views', 'firm_logo', 'firm_www', 'firm_info', 'firm_creationDate' , 'firm_modifyDate', 'firm_adrString', 'firm_phone', 'firm_geoX', 'firm_geoY', 'old_id', 'old_alias');
		$secureAdd = ($showAll)?'':' AND gd_firm.firm_status = 1 ';			
		$query = 'SELECT  *	FROM `gd_firm` WHERE city_id = '.$city.' '.$secureAdd.' ORDER BY firm_name';		
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{
			if($onlyCnt)
				$ret = $LNK->GetData('COUNT(*)', false);
			else
				$ret = $LNK->GetData($ret_arr, true);
			}
		else 
		$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}		
	function getMaterialById($matId) /*2013_11_13 получене всех материалов */
		{
		$query = 'SELECT  * FROM `fs_materials`
					WHERE material_id = \''.trim($matId).'\'';
		$ret_arr  = array('material_id', 'material_value');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData( 'material_value', false);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}		
	function getMaterialsByName($matName) /*2013_11_13 получене всех материалов */
		{
		$query = 'SELECT  * FROM `fs_materials`
					WHERE material_value like \'%'.trim($matName).'%\'';
		$ret_arr  = array('material_id', 'material_value');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData( 'material_id', false);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}			
	function getListOfMaterialsAll() /*2013_11_13 получене всех материалов */
		{
		$query = 'SELECT  * FROM `fs_materials`
					ORDER BY material_value';
		$ret_arr  = array('material_id', 'material_value');
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
	function getDistrictListOfCity($city, $assoc) /*2013_11_13 получене всех районов города */
		{
		$query = 'SELECT  * FROM `fs_district`
					WHERE  city_id = \''.$city.'\'  
					ORDER BY district_name';
		$ret_arr  = array('district_id', 'district_name');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$retArr = $LNK->GetData($ret_arr, true);
			if($assoc)
				{
				for($i=0; $i<sizeof($retArr); $i++)
					{
					$propArr[$retArr[$i]['district_id']] = $retArr[$i]['district_name'];
					}
				$ret = $propArr;
				}
			else
				{
				$ret = $retArr;
				}
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}		

	function getObjectPropertiesCurrent($id) /*2013_11_22 получене параметров офиса по id*/
		{
		$query = 'SELECT  *, gd_objPropList.op_id AS property_id, op_name AS property_name, op_description AS property_description
						FROM `gd_objPropList`, `gd_objProperties`
						WHERE gd_objPropList.op_id = gd_objProperties.op_id
						AND item_id = \''.intval($id).'\'';
		$ret_arr  = array('item_id', 'property_id', 'property_name', 'property_description', 'op_type', 'prop_value', 'op_order');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, false);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		
		}
	function getObjectProperties($id, $assoc) /*2012_11_07 получене параметров офиса по id*/
		{
//		global $ROUT;
//		print_r($filter);
		$query = 'SELECT  *, gd_objPropList.op_id AS property_id, op_name AS property_name, op_description AS property_description
						FROM `gd_objPropList`, `gd_objProperties`
						WHERE gd_objPropList.op_id = gd_objProperties.op_id
						AND gd_objPropList.obj_id = \''.intval($id).'\' ORDER BY op_order, property_id, prop_value';
		$ret_arr  = array('item_id', 'property_id', 'property_name', 'property_description', 'op_type', 'prop_value', 'op_order');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$retArr = $LNK->GetData($ret_arr, true);
			if($assoc)
				{
				for($i=0; $i<sizeof($retArr); $i++)
					{
					$propArr = array();
					$propName = $retArr[$i]['property_name'];
					$propArr['title']  = $retArr[$i]['property_description'];
					$propArr['value']  = $retArr[$i]['prop_value'];
					$propArr['order']  = $retArr[$i]['op_order'];
					$propArr['id']  = $retArr[$i]['property_id'];
					$ret[$propName][] = $propArr;
					}
				}
			else
				{
				$ret = $retArr;
				}
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}
	function getObjectAll($cityId) /*2013_11_19 получене офиса по id*/
		{
		$query = 'SELECT *, gd_city.city_id AS cityId FROM gd_city, gd_object					
					WHERE gd_object.city_id = gd_city.city_id
					AND gd_object.city_id = \''.intval($cityId).'\'';
		$ret_arr  = array(	'obj_id', 
							'cityId', 
							'city_name', 
							'obj_rank', 
							'obj_hidden', 
							'obj_name', 
							'obj_www', 
							'obj_projDoc', 
							'obj_info', 
							'obj_sales', 
							'obj_firmZakaz', 
							'obj_firmPodr', 
							'obj_state', 
							'obj_district', 
							'obj_dateStart', 
							'obj_dateEnd', 
							'obj_monStart', 
							'obj_monEnd', 
							'obj_lastCapture', 
							'obj_adrString', 
							'obj_geoX', 'obj_geoY', 
							'obj_positionStatus', 
							'obj_pointCnt', 
							'obj_updDate', 
							'obj_viewCount', 
							'old_id', 
							'old_alias', 
							'obj_material');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret =  $LNK->GetData($ret_arr, true);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}
	function getObjectByName($name, $iScheck) /*2013_11_19 получене офиса по id*/
		{
		$query = 'SELECT *, gd_city.city_id AS cityId FROM gd_city, gd_object					
					WHERE gd_object.city_id = gd_city.city_id
					AND obj_name LIKE \''.trim($name).'\'';
		$ret_arr  = array(	'obj_id', 
							'cityId', 
							'city_name', 
							'obj_rank', 
							'obj_hidden', 
							'obj_name', 
							'obj_nameTranslit', 
							'obj_www', 
							'obj_projDoc', 
							'obj_info', 
							'obj_firmZakaz', 
							'obj_firmPodr', 
							'obj_state', 
							'obj_district', 
							'obj_dateStart', 
							'obj_dateEnd', 
							'obj_monStart', 
							'obj_monEnd', 
							'obj_lastCapture', 
							'obj_adrString', 
							'obj_geoX', 'obj_geoY', 
							'obj_positionStatus', 
							'obj_pointCnt', 
							'obj_updDate', 
							'obj_viewCount', 
							'old_id', 
							'old_alias', 
							'obj_material');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = ($iScheck) ? 1 : $LNK->GetData($ret_arr, false);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}	
	function getObjectByOldId($id) /*2014_05_05 получене офиса по старому id*/
		{
		$query = 'SELECT *, gd_city.city_id AS cityId FROM gd_city, gd_object 
					LEFT JOIN gd_firm ON
						obj_firmZakaz = firm_id
					WHERE gd_object.city_id = gd_city.city_id
					AND gd_object.old_id = \''.intval($id).'\'';
		$ret_arr  = array(	'obj_id', 
							'cityId', 
							'obj_sales', 
							'firm_name', 
							'city_name', 
							'obj_rank', 
							'obj_hidden', 
							'obj_name', 
							'obj_nameTranslit', 
							'obj_www', 
							'obj_projDoc', 
							'obj_info', 
							'obj_firmZakaz', 
							'obj_firmPodr', 
							'obj_state', 
							'obj_district', 
							'obj_dateStart', 
							'obj_dateEnd', 
							'obj_monStart', 
							'obj_monEnd', 
							'obj_lastCapture', 
							'obj_adrString', 
							'obj_geoX', 'obj_geoY', 
							'obj_positionStatus', 
							'obj_pointCnt', 
							'obj_updDate', 
							'obj_viewCount', 
							'old_id', 
							'old_alias', 
							'obj_material');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, false);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}	
	function getObjectById($id) /*2013_11_19 получене офиса по id*/
		{
		$hidden = ($this->usr->isMng) ? '' : ' AND obj_hidden  = 0 ' ;		
		$query = 'SELECT *, gd_city.city_id AS cityId FROM gd_city, gd_object 
					LEFT JOIN gd_firm ON
						obj_firmZakaz = firm_id
					WHERE gd_object.city_id = gd_city.city_id
					AND gd_object.obj_id = \''.intval($id).'\''.$hidden;
		$ret_arr  = array(	'obj_id', 
							'cityId', 
							'obj_sales', 
							'firm_name', 
							'city_name', 
							'obj_rank', 
							'obj_hidden', 
							'obj_name', 
							'obj_nameTranslit', 
							'obj_www', 
							'obj_projDoc', 
							'obj_info', 
							'obj_firmZakaz', 
							'obj_firmPodr', 
							'obj_state', 
							'obj_district', 
							'obj_dateStart', 
							'obj_dateEnd', 
							'obj_monStart', 
							'obj_monEnd', 
							'obj_lastCapture', 
							'obj_adrString', 
							'obj_geoX', 'obj_geoY', 
							'obj_positionStatus', 
							'obj_pointCnt', 
							'obj_updDate', 
							'obj_viewCount', 
							'old_id', 
							'old_alias', 
							'obj_material');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, false);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}	
	function getObjectByIdOld($id)
		{
//		print_r($filter);
		$query = 'SELECT  *, gd_city.city_id AS cityId FROM `gd_object`, `gd_firm` ,  `gd_city` 
						WHERE gd_object.city_id = gd_city.city_id
						AND gd_object.firm_id = gd_firm.firm_id
						AND gd_object.obj_id = \''.intval($id).'\'';
		$ret_arr  = array('cityId', 'city_name', 'firm_id', 'firm_status', 'firm_name', 'firm_www', 'firm_info', 'firm_nameTranslit', 'firm_rank', 'firm_comments', 'obj_description', 'obj_id', 'obj_rank', 'obj_hidden', 'obj_mapStatus');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, false);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}
	
	function getCityId($cityName) /*2012_11_06 получене города по названию*/
		{
		$query = 'SELECT  *	FROM `gd_city` WHERE city_name like (\''.trim($cityName).'\')';
		$ret_arr  = array('city_id', 'city_name');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$retArr = $LNK->GetData($ret_arr, false);
			$ret = $retArr['city_id'];
			}
		else 
		$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}



	function getConstrListAllMonitoring($cityId, $onlyCnt) /*2014_04_07 все объекты с фотографиями*/
		{
		$hidden = ($this->usr->isMng) ? '' : ' AND obj_hidden  = 0 ' ;
		$rows = ($onlyCnt)?'COUNT(*)':'*, gd_city.city_id AS cityId';
		$query = 'SELECT '.$rows.' FROM gd_city, gd_object
					LEFT JOIN gd_firm ON
						obj_firmZakaz = firm_id		
					WHERE gd_object.city_id = gd_city.city_id AND gd_city.city_id = '.$cityId.' '.$hidden.'
			AND obj_monStart != \'\' ORDER BY obj_name ';
		$ret_arr  = array(	'obj_id', 
							'cityId', 
							'obj_sales', 
							'firm_name', 
							'city_name', 
							'obj_rank', 
							'obj_hidden', 
							'obj_name', 
							'obj_www', 
							'obj_projDoc', 
							'obj_info', 
							'obj_firmZakaz', 
							'obj_firmPodr', 
							'obj_state', 
							'obj_district', 
							'obj_dateStart', 
							'obj_dateEnd', 
							'obj_monStart', 
							'obj_monEnd', 
							'obj_lastCapture', 
							'obj_adrString', 
							'obj_geoX', 
							'obj_geoY', 
							'obj_pointCnt', 
							'obj_updDate', 
							'obj_viewCount', 
							'obj_material');
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
				}
			}
		else 
		$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}	
		
	function getConstrListReady($cityId, $date, $onlyCnt) /*2014_04_07 сданные объекты за промежуток  времени*/
		{
		$hidden = ($this->usr->isMng) ? '' : ' AND obj_hidden  = 0 ' ;
		$rows = 'distinct foto_date,  fs_objFoto.obj_id';
		$query1 = 'SELECT '.$rows.'
							FROM gd_object,  fs_objFoto
							WHERE city_id = '.$cityId.' 
							AND obj_lastCapture = foto_captureNumber
							AND fs_objFoto.obj_id = gd_object.obj_id 
							AND obj_state = 2 
							AND foto_date > \''.$date.'\''.$hidden.'
							order by foto_date DESC';
		$ret_arr1  = array(	'obj_id',	'foto_date');

		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query1);
		if($num = $LNK->GetNumRows())
			{		
//			echo $num;
			if($onlyCnt)
				$ret = $num;
			else
				{
				$retArr = $LNK->GetData($ret_arr1, true);
				$objArr = array();
				for($i=0; $i<sizeof($retArr); $i++)
					{
					if(!in_array($retArr[$i]['obj_id'], $objArr))
						{
						$objArr[] = $retArr[$i]['obj_id'];
						$tmpArr = $this->getObjectById($retArr[$i]['obj_id']);
						$tmpArr['foto_date'] = $retArr[$i]['foto_date'];
						$retList[] = $tmpArr;
						}
	//				$propArr[$retArr[$i]['district_id']] = $retArr[$i]['district_name'];
					}			
				$ret['num'] = $num;
				$ret['list'] = $retList;
				}
			}
		else 
			$ret = 0;
		return $ret;	
	
		}		
		
	function getConstrListByMonitoringStart($cityId, $date, $onlyCnt) /*2014_04_07 новые объекты*/
		{
		$rows = 'distinct foto_date,  fs_objFoto.obj_id, obj_hidden';
//		$hidden = ($this->usr->isMng) ? '' : ' AND obj_hidden  = 0 ' ;
		$hidden = ' AND obj_hidden  = 0 ';
		$query1 = 'SELECT '.$rows.'
							FROM gd_object,  fs_objFoto
							WHERE city_id = '.$cityId.' 
							AND foto_captureNumber = 1
							AND gd_object.obj_id = fs_objFoto.obj_id
							AND foto_date > \''.$date.'\''.$hidden.'
							order by foto_date DESC';
		$ret_arr1  = array(	'obj_id',	'foto_date', 'obj_hidden');

		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query1);
		if($num = $LNK->GetNumRows())
			{		
//			echo $num;
			if($onlyCnt)
				$ret = $num;
			else
				{
				$retArr = $LNK->GetData($ret_arr1, true);
				$objArr = array();
				for($i=0; $i<sizeof($retArr); $i++)
					{
					if((!in_array($retArr[$i]['obj_id'], $objArr)))
						{
						$objArr[] = $retArr[$i]['obj_id'];
						$tmpArr = $this->getObjectById($retArr[$i]['obj_id']);
						$tmpArr['foto_date'] = $retArr[$i]['foto_date'];
						$retList[] = $tmpArr;
						}
	//				$propArr[$retArr[$i]['district_id']] = $retArr[$i]['district_name'];
					}			
				$ret['num'] = $num;
				$ret['list'] = $retList;
				}
			}
		else 
			$ret = 0;
		return $ret;				
		}
		
	function getConstrListLastFotoDate($cityId, $date, $onlyCnt)
		{
//		print_r($filter);
		$rows = 'distinct foto_date,  fs_objFoto.obj_id';
		$hidden = ($this->usr->isMng) ? '' : ' AND obj_hidden  = 0 ' ;
		$query1 = 'SELECT '.$rows.'
							FROM gd_object,  fs_objFoto
							WHERE city_id = '.$cityId.' 
							AND obj_lastCapture = foto_captureNumber
							AND foto_date > \''.$date.'\' '.$hidden.'
							order by foto_date DESC';
		$ret_arr1  = array(	'obj_id',	'foto_date');

		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query1);
		if($num = $LNK->GetNumRows())
			{		
//			echo $num;
			if($onlyCnt)
				$ret = $num;
			else
				{
				$retArr = $LNK->GetData($ret_arr1, true);
				$objArr = array();
				for($i=0; $i<sizeof($retArr); $i++)
					{
					if(!in_array($retArr[$i]['obj_id'], $objArr))
						{
						$objArr[] = $retArr[$i]['obj_id'];
						$tmpArr = $this->getObjectById($retArr[$i]['obj_id']);
						$tmpArr['foto_date'] = $retArr[$i]['foto_date'];
						$retList[] = $tmpArr;
						}
	//				$propArr[$retArr[$i]['district_id']] = $retArr[$i]['district_name'];
					}			
				$ret['num'] = $num;
				$ret['list'] = $retList;
				}
			}
		else 
			$ret = 0;
		return $ret;				
		}		
	function getConstrListMostViewedLimit($cityId, $limit) 
		{
//		print_r($filter);
		$query1 = 'SELECT * FROM gd_city, gd_object 
							WHERE gd_city.city_id = '.$cityId.' AND obj_hidden  = 0
							order by obj_viewCount DESC LIMIT '.$limit.'';
		$ret_arr  = array(	'obj_id', 'gd_city',						
							'city_name', 
							'obj_rank', 
							'obj_hidden', 
							'obj_name', 
							'obj_nameTranslit', 
							'obj_www', 
							'obj_projDoc', 
							'obj_info', 
							'obj_firmZakaz', 
							'obj_firmPodr', 
							'obj_state', 
							'obj_district', 
							'obj_dateStart', 
							'obj_dateEnd', 
							'obj_monStart', 
							'obj_monEnd', 
							'obj_lastCapture', 
							'obj_adrString', 
							'obj_geoX', 'obj_geoY', 
							'obj_positionStatus', 
							'obj_pointCnt', 
							'obj_updDate', 
							'obj_viewCount', 
							'old_id', 
							'old_alias', 
							'obj_material');

		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query1);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, true);
			}
		else 
		$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}			
	function getConstrListLastFotoLimit($cityId, $limit)
		{
//		print_r($filter);
		$query1 = 'SELECT distinct foto_date,  fs_objFoto.obj_id
							FROM gd_object,  fs_objFoto
							WHERE city_id = '.$cityId.' 
							AND obj_lastCapture = foto_captureNumber
							order by foto_date DESC LIMIT '.$limit.'';
		$ret_arr1  = array(	'obj_id');

		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query1);
		if($LNK->GetNumRows())
			{		
			$retArr = $LNK->GetData($ret_arr1, true);
			for($i=0; $i<sizeof($retArr); $i++)
				{
				$ret[] = $this->getObjectById($retArr[$i]['obj_id']);
//				$propArr[$retArr[$i]['district_id']] = $retArr[$i]['district_name'];
				}			
			}
		else 
		$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}		
	function getConstrListByFirm($firmId, $onlyCnt)
		{
//		print_r($filter);
//		print_r($this->usr);
//		echo 'mng - '.$this->usr->isMng;
		$rows = ($onlyCnt)?'COUNT(*)':'*';
		$hidden = ($this->usr->isMng) ? '' : ' AND obj_hidden  = 0 ' ;
		$query = 'SELECT '.$rows.' FROM gd_object, gd_firm
					WHERE (obj_firmZakaz = \''.intval($firmId).'\' OR obj_firmPodr = \''.intval($firmId).'\')
					AND gd_firm.firm_id = \''.intval($firmId).'\''.$hidden.'  
					ORDER BY obj_name, obj_updDate DESC';
		$ret_arr  = array(	'obj_id', 
							'cityId', 
							'obj_sales', 
							'firm_name', 
							'city_name', 
							'obj_rank', 
							'obj_hidden', 
							'obj_name', 
							'obj_www', 
							'obj_projDoc', 
							'obj_info', 
							'obj_firmZakaz', 
							'obj_firmPodr', 
							'obj_state', 
							'obj_district', 
							'obj_dateStart', 
							'obj_dateEnd', 
							'obj_monStart', 
							'obj_monEnd', 
							'obj_lastCapture', 
							'obj_adrString', 
							'obj_geoX', 
							'obj_geoY', 
							'obj_pointCnt', 
							'obj_updDate', 
							'obj_viewCount', 
							'obj_material');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			if($onlyCnt)
				$ret = $LNK->GetData('COUNT(*)', false);
			else
				$ret = $LNK->GetData($ret_arr, true);
			}
		else 
		$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}		
	function getConstrListByFilter($filter)
		{
//		print_r($filter);
		$filterAdd = '';
		$filterAdd .= '	AND  gd_city.city_id = '.$filter['city'].' ';
		$filterAdd .= ($filter['state']) ? '	AND  obj_state =  '.$filter['state'].' ' : '';
		$filterAdd .= ($filter['district']) ? '	AND  obj_district =  '.$filter['district'].' ' : '';
		$filterAdd .= ($filter['material']) ? '	AND  obj_material =  '.$filter['material'].' ' : '';
		$hidden = ($this->usr->isMng) ? '' : ' AND obj_hidden  = 0 ' ;
		if($filter['dateStart'])
			{
			$filterAdd .= ' AND  (obj_monStart <=  \''.$filter['dateEnd'].'\'  AND  obj_monEnd >=  \''.$filter['dateStart'].'\' )';			
			}
		$query = 'SELECT *, gd_city.city_id AS cityId FROM gd_city, gd_object
					LEFT JOIN gd_firm ON
						obj_firmZakaz = firm_id		
					WHERE gd_object.city_id = gd_city.city_id 
			'.$filterAdd.$hidden.' ';
		$ret_arr  = array(	'obj_id', 
							'cityId', 
							'obj_sales', 
							'firm_name', 
							'city_name', 
							'obj_rank', 
							'obj_hidden', 
							'obj_name', 
							'obj_www', 
							'obj_projDoc', 
							'obj_info', 
							'obj_firmZakaz', 
							'obj_firmPodr', 
							'obj_state', 
							'obj_district', 
							'obj_dateStart', 
							'obj_dateEnd', 
							'obj_monStart', 
							'obj_monEnd', 
							'obj_lastCapture', 
							'obj_adrString', 
							'obj_geoX', 
							'obj_geoY', 
							'obj_pointCnt', 
							'obj_updDate', 
							'obj_viewCount', 
							'obj_material');
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
	function getFirmListByFilter($filter)
		{
		$filterAdd = '';
		$filterAdd .= '	AND  gd_city.city_id = '.$filter['city'].' ';
		$filterAdd .= '	AND  firm_status = 1 ';
		$query = 'SELECT  *, gd_city.city_id AS cityId FROM gd_city,  `gd_firm` 
			WHERE  gd_firm.city_id = gd_city.city_id '.$filterAdd.' ';
		$ret_arr  = array('firm_id', 'cityId', 'firm_name', 'firm_nameTranslit', 'firm_rank', 'firm_status', 'firm_views', 'firm_logo', 'firm_www', 'firm_info', 'firm_creationDate' , 'firm_modifyDate', 'firm_adrString', 'firm_phone', 'firm_geoX', 'firm_geoY');
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
	function getFirmListPopular($city, $limit)
		{
		$orderAdd = ' ORDER BY firm_views DESC';
		$filterAdd = '';
		$filterAdd .= '	AND  gd_city.city_id = '.$city.' ';
		$filterAdd .= '	AND  firm_status = 1 ';
		$query = 'SELECT  *, gd_city.city_id AS cityId FROM gd_city,  `gd_firm` 
			WHERE  gd_firm.city_id = gd_city.city_id '.$filterAdd.' '.$orderAdd.' limit '.$limit;
		$ret_arr  = array('firm_id', 'cityId', 'firm_name', 'firm_nameTranslit', 'firm_rank', 'firm_status', 'firm_views', 'firm_logo', 'firm_www', 'firm_info', 'firm_creationDate' , 'firm_modifyDate', 'firm_adrString', 'firm_phone', 'firm_geoX', 'firm_geoY');
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
	function getFirmListByOrder($city, $oder)
		{
		$orderAdd = ' ORDER BY firm_name '.$oder;
		$filterAdd = '';
		$filterAdd .= '	AND  gd_city.city_id = '.$city.' ';
		$filterAdd .= '	AND  firm_status = 1 ';
		$query = 'SELECT  *, gd_city.city_id AS cityId FROM gd_city,  `gd_firm` 
			WHERE  gd_firm.city_id = gd_city.city_id '.$filterAdd.' '.$orderAdd;
		$ret_arr  = array('firm_id', 'cityId', 'firm_name', 'firm_nameTranslit', 'firm_rank', 'firm_status', 'firm_views', 'firm_logo', 'firm_www', 'firm_info', 'firm_creationDate' , 'firm_modifyDate', 'firm_adrString', 'firm_phone', 'firm_geoX', 'firm_geoY');
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
	function getCurFirm($id)
		{
		$query = 'SELECT  *, gd_city.city_id AS cityId FROM gd_city,  `gd_firm` WHERE  gd_firm.city_id = gd_city.city_id AND firm_id = \''.intval($id).'\' ';
		$ret_arr  = array('firm_id', 'cityId', 'firm_name', 'firm_nameTranslit', 'firm_rank', 'firm_status', 'firm_views', 'firm_logo', 'firm_www', 'firm_info', 'firm_creationDate' , 'firm_modifyDate', 'firm_adrString', 'firm_phone', 'firm_geoX', 'firm_geoY');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, false);
			}
		else 
		$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}			
	function getCurFirmByOldId($id)
		{
		$query = 'SELECT  *, gd_city.city_id AS cityId FROM gd_city,  `gd_firm` WHERE  gd_firm.city_id = gd_city.city_id AND old_id = \''.intval($id).'\' ';
		$ret_arr  = array('firm_id', 'cityId', 'firm_name', 'firm_nameTranslit', 'firm_rank', 'firm_status', 'firm_views', 'firm_logo', 'firm_www', 'firm_info', 'firm_creationDate' , 'firm_modifyDate', 'firm_adrString', 'firm_phone', 'firm_geoX', 'firm_geoY', 'old_id');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, false);
			}
		else 
		$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}		


	function getFirmOfName($letter, $city)
		{
		$query = 'SELECT  *	FROM `gd_firm` WHERE firm_name LIKE \''.trim($letter).'\' and city_id = \''.$city.'\' ';
		$ret_arr  = array('firm_id', 'firm_name', 'firm_nameTranslit', 'firm_rank', 'firm_status', 'firm_views', 'firm_logo', 'firm_www' , 'firm_info', 'firm_creationDate' , 'firm_modifyDate');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, false);
			}
		else 
		$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}	
	function getFirmsOfTransname($letter)
		{
		$query = 'SELECT  *	FROM `ga_firm` WHERE firm_nameTranslit LIKE \''.trim($letter).'\'';
		$ret_arr  = array('firm_id', 'firm_name', 'firm_nameTranslit', 'firm_rank', 'firm_status', 'firm_comments', 'firm_views', 'firm_logo', 'firm_www' , 'firm_info', 'firm_creationDate' , 'firm_modifyDate', 'firm_price' );
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, false);
			}
		else 
		$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}
	function getFirmsOfSearchStr($str, $city)
		{
		$query = 'SELECT  *	FROM `ga_firm` WHERE firm_name LIKE \''.trim($str).'%\' AND firm_status=1 AND city_id= \''.$city.'\' ORDER BY `firm_name`';
		$ret_arr  = array('firm_id', 'firm_name', 'firm_nameTranslit', 'firm_rank', 'firm_status', 'firm_info', 'firm_views', 'firm_logo', 'firm_www', 'firm_creationDate' , 'firm_modifyDate', 'firm_price' );
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
	function getFirmsOfSearchStrExt($str, $city)
		{
		$query = 'SELECT  *	FROM `gd_firm` WHERE firm_name LIKE \'%'.trim($str).'%\' AND firm_status=1 AND city_id= \''.$city.'\' ORDER BY `firm_name`';
		$ret_arr  = array('firm_id', 'firm_name', 'firm_nameTranslit', 'firm_rank', 'firm_info', 'firm_status', 'firm_views', 'firm_logo', 'firm_www', 'firm_creationDate' , 'firm_modifyDate');
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
	function getConstrOfSearchStrExt($str, $city)
		{
		$query = 'SELECT *, gd_city.city_id AS cityId FROM gd_city, gd_object					
					WHERE gd_object.city_id = gd_city.city_id	
					AND obj_name LIKE \'%'.trim($str).'%\' 
					ORDER BY `obj_name`';
		$ret_arr  = array(	'obj_id', 
							'cityId', 
							'city_name', 
							'obj_rank', 
							'obj_hidden', 
							'obj_name', 
							'obj_nameTranslit', 
							'obj_www', 
							'obj_projDoc', 
							'obj_info', 
							'obj_firmZakaz', 
							'obj_firmPodr', 
							'obj_state', 
							'obj_district', 
							'obj_dateStart', 
							'obj_dateEnd', 
							'obj_monStart', 
							'obj_monEnd', 
							'obj_lastCapture', 
							'obj_adrString', 
							'obj_geoX', 'obj_geoY', 
							'obj_positionStatus', 
							'obj_pointCnt', 
							'obj_updDate', 
							'obj_viewCount', 
							'old_id', 
							'old_alias', 
							'obj_material');
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
	}
function sortFirmNameDesc($a, $b) 
	{	
//		return -1 * strnatcmp($a['firm_name'], $b['firm_name']);
		return($a['firm_name'] > $b['firm_name']) ? -1 : 1;
	}
	
function sortFirmNameAsc($a, $b) 
	{	
//	global $ROUT;
//	$ROUT->strtoupper_ru()
//		return strnatcasecmp(trim($a['firm_name']), trim($b['firm_name']));
		return strcasecmp (trim($a['firm_name']), trim($b['firm_name']));
//		return($ROUT->strtoupper_ru($a['firm_name']) > $ROUT->strtoupper_ru($b['firm_name'])) ? 1 : -1;
	}
function sortObjCompletedAsc($a, $b) 
	{	
		return strnatcmp($a['foto_date'], $b['foto_date']);
	}
function sortObjCompletedDesc($a, $b) 
	{	
		return -1 * strnatcmp($a['foto_date'], $b['foto_date']);
	}
	
function sortObjLastObjAsc($a, $b) 
	{	
		return strnatcmp($a['foto_date'], $b['foto_date']);
	}
function sortObjLastObjDesc($a, $b) 
	{	
		return -1 * strnatcmp($a['foto_date'], $b['foto_date']);
	}
	
function sortObjDateFotoAsc($a, $b) 
	{	
		return strnatcmp($a['foto_date'], $b['foto_date']);
	}
function sortObjDateFotoDesc($a, $b) 
	{	
		return -1 * strnatcmp($a['foto_date'], $b['foto_date']);
	}
	
	
function sortObjNameDesc($a, $b) 
	{	
		return -1 * strnatcmp($a['obj_name'], $b['obj_name']);
	}
	
function sortObjNameAsc($a, $b) 
	{	
		return strnatcmp($a['obj_name'], $b['obj_name']);
	}
	
	
function sortOrgNameDesc($a, $b) 
	{
	if((strstr($a['firm_name'], '№')) && (strstr($b['firm_name'], '№')))
		{
		$arrA = explode('№', $a['firm_name']);
		$arrB = explode('№', $b['firm_name']);
		if($ret = strnatcmp($arrA[1], $arrB[1]))
			return -1 * $ret;
		else
			return -1 * strnatcmp($a['firm_name'], $b['firm_name']);
		}
	elseif((strstr($a['firm_name'], '№')) && (!strstr($b['firm_name'], '№')))
		{
		return 1;
		}
	elseif((!strstr($a['firm_name'], '№')) && (strstr($b['firm_name'], '№')))
		{
		return -1;
		}
	else		
		return -1 * strnatcmp($a['firm_name'], $b['firm_name']);
	}
function sortOrgNameAsc($a, $b) 
	{
	if((strstr($a['firm_name'], '№')) && (strstr($b['firm_name'], '№')))
		{
		$arrA = explode('№', $a['firm_name']);
		$arrB = explode('№', $b['firm_name']);
		if($ret = strnatcmp($arrA[1], $arrB[1]))
			return $ret;
		else
			return strnatcmp($a['firm_name'], $b['firm_name']);
		}
	elseif((strstr($a['firm_name'], '№')) && (!strstr($b['firm_name'], '№')))
		{
		return -1;
		}
	elseif((!strstr($a['firm_name'], '№')) && (strstr($b['firm_name'], '№')))
		{
		return 1;
		}
	else		
		return strnatcmp($a['firm_name'], $b['firm_name']);
		
	}	
function sortOrgImages($a, $b) 
	{
	if($a['file'] == $b['file'])
		{
		return 1;				
		}
	else
		return ($a['file'] > $b['file']) ? 1 : -1;
	}	
function sortFastSearchResults($a, $b) 
	{
	if($a['type'] == $b['type'])
		{		
		if($a['typeName'] == $b['typeName'])
			{		
			if((strstr($a['objName'], '№')) && (strstr($b['objName'], '№')))
				{
				$arrA = explode('№', $a['objName']);
				$arrB = explode('№', $b['objName']);
				if($ret = strnatcmp($arrA[1], $arrB[1]))
					return 1 * $ret;
				else
					return 1 * strnatcmp($a['objName'], $b['objName']);
				}
			elseif((strstr($a['objName'], '№')) && (!strstr($b['objName'], '№')))
				{
				return -1;
				}
			elseif((!strstr($a['objName'], '№')) && (strstr($b['objName'], '№')))
				{
				return 1;
				}
			else		
				return 1 * strnatcmp($a['objName'], $b['objName']);
			}
		else
			return ($a['typeName'] > $b['typeName']) ? 1 : -1;
			
		}
	else
		return ($a['type'] > $b['type']) ? 1 : -1;
	}	
?>