<?
//print_r($_POST);
/*
if($USER->id>1)
	Error_Reporting(0);	
	*/
if(trim($_POST['type'])) //подгрузка HTML кода посредством АЯКС
//if((trim($_POST['type']))||(trim($_GET['type']))) //подгрузка HTML кода посредством АЯКС
	{
//					$charset = ($CONST['dinamicUTF8Convert'])?'windows-1251':'UTF-8';
//				header('Content-type: text/html; charset='.$charset);

	$type = trim($_POST['type']);
/*	$type = trim($_GET['type']);*/
	switch ($type)
		{
		case 'navForestSingle': /*2018_04_19 получить трек по леснику  - по адресу и времени*/
			{
			chdir('..//');
			
			$context = stream_context_create(array(
				'http' => array(
						'header' => implode("\r\n", array(
							"dataType: json"
						))
			)));			
//			print_r($_POST);
//			$JSStr = $_POST;
//			$JSStr = '';
//http://91.229.154.8/les_json/les_data.php?id=868204003130886&start_timestamp=1520697894&finish_timestamp=1520755494
			$path = 'http://91.229.154.8/les_json/les_data.php?id='.trim($_POST['obj']).'&start_timestamp='.trim($_POST['date'][0]).'&finish_timestamp='.trim($_POST['date'][1]).'';
			$JSStr = file_get_contents($path);
/*			$obj = json_decode(file_get_contents($path));
			echo json_last_error_msg ();
			print_r($obj);*/
			echo $JSStr;
			} break;		
		case 'navForest': /*2018_03_25 получить данные о лесниках */
			{
			chdir('..//');
			$context = stream_context_create(array(
				'http' => array(
						/*'method'=>"GET",
						'content' => $reqdata = http_build_query(array(
						)),*/
						'header' => implode("\r\n", array(
							"dataType: json"
								/*"Content-Length: " . strlen($reqdata),
								"User-Agent: SyberiaGisBot/0.1",
								"Connection: Close",
								""*/
						))
			)));			

			$JSStr = '';
//			$JSStr = file_get_contents('http://91.229.154.8/les_json/obj_les.php', false, $context);
			$JSStr = file_get_contents('http://91.229.154.8/les_json/obj_les.php');
			echo $JSStr;
			} break;
		case 'getPKK': /*2017_02_09 получить объекты слоёв*/
			{
			ini_set('memory_limit', '256M');
			chdir('..//');
			require_once('../classes/config.inc.php');
			require_once("../classes/MySQLi_class.php");
			require_once("../classes/GetContent_class.php");
			require_once("../classes/gis/manage_class.php");	
			require_once("../classes/User_class.php");
			require_once("../classes/ACL_class.php");
			require_once("../classes/Rout_class.php");
			require_once("../classes/gis/manage_class.php");
			require_once("../classes/gis/pkkSprav.php");
			
			$CNT = 		new GetContent;
			$ROUT = new Routine;
			$CONST = $CNT->GetAllConfig();
			$MNG = new Manage;	
			$valueDelim = '::';
			$paramDelim = '##';
			$objDelim = '||';
			$JSStr = 	'';
			$ctx = stream_context_create(array(
				'http' => array(        'timeout' => 1        )
					)
					);
//			$isMng = ($_POST['startStr'] == '*69F727D4F74061CDEB44032B0A7FBE5EE6453E76') ? 1 : 0;					
			$latM = number_format($_POST['lat'], 6, ',', '');
			$lngM = number_format($_POST['lng'], 6, ',', '');
			$url1 = 'http://pkk5.rosreestr.ru/api/features/1?text='.$latM.'%20'.$lngM.'&tolerance=4&limit=11';
			$obj1 = json_decode(file_get_contents($url1, 0, $ctx)); 
//			var_dump($obj1->features);
			if(is_array($obj1->features))
				{
				foreach ($obj1->features as $feature) {
					$url2 = 'http://pkk5.rosreestr.ru/api/features/1/'.$feature->attrs->id;
					$obj2 = json_decode(file_get_contents($url2, 0, $ctx)); 
					$JSStr .= 	'Кадастровый номер'.$valueDelim.$obj2->feature->attrs->cn.$paramDelim.
								'Адрес'.$valueDelim.$obj2->feature->attrs->address.$paramDelim.
								'Кадастровый округ'.$valueDelim.$obj2->feature->attrs->okrug.$paramDelim.
								'Кадастровый район'.$valueDelim.$obj2->feature->attrs->rayon.$paramDelim.
								'Кадастровый квартал'.$valueDelim.$obj2->feature->attrs->kvartal.$paramDelim;
								
					$JSStr .= 	($obj2->feature->attrs->adate)	? 'Дата обновления границ'.$valueDelim.$ROUT->GetRusDataStr($obj2->feature->attrs->adate, 1).$paramDelim : '';
					$JSStr .= 	$areaArr[$obj2->feature->attrs->area_type].$valueDelim.$obj2->feature->attrs->area_value.' '.$unitArr[$obj2->feature->attrs->area_unit].$paramDelim.
							'Кадастровая стоимость'.$valueDelim.number_format($obj2->feature->attrs->cad_cost, 2, '.', ' ').' '.$unitArr[$obj2->feature->attrs->cad_unit].$paramDelim;
					$JSStr .= 	($obj2->feature->attrs->date_cost)?'Дата внесения кадастровой стоимости'.$valueDelim.$ROUT->GetRusDataStr($obj2->feature->attrs->date_cost, 1).$paramDelim : '';
					if($obj2->feature->attrs->cad_eng_data)			
						{
						$JSStr .= 	'Дата обновления атрибутов'.$valueDelim.$ROUT->GetRusDataStr($obj2->feature->attrs->cad_eng_data->actual_date, 1).$paramDelim;
						$JSStr .= (isset($obj2->feature->attrs->cad_eng_data->co_name)) ?
							 'Кадастровый инженер (организация)'.$valueDelim.$obj2->feature->attrs->cad_eng_data->co_name.$paramDelim : 
							 'Кадастровый инженер '.$valueDelim.$obj2->feature->attrs->cad_eng_data->ci_surname.' '.$obj2->feature->attrs->cad_eng_data->ci_first.' '.$obj2->feature->attrs->cad_eng_data->ci_patronymic.
								' (№ свидетельства '.$obj2->feature->attrs->cad_eng_data->ci_n_certificate.')'.$paramDelim;
						}
					if(($obj2->feature->attrs->util_code != '')||($obj2->feature->attrs->util_by_doc != ''))
						{
						$JSStr .= 'Разрешенное использование'.$valueDelim;
						$JSStr .= ($obj2->feature->attrs->util_code != '') ? $areaUtilArray[$obj2->feature->attrs->util_code] : $obj2->feature->attrs->util_by_doc;
						$JSStr .= (($obj2->feature->attrs->util_code != '')&&($obj2->feature->attrs->util_by_doc != '')) ? ' ('.$obj2->feature->attrs->util_by_doc.')':'';
						$JSStr .= $paramDelim;
									'';
						}
					$JSStr .= ($JSStr) ? $objDelim :'';
					}
				$JSStr .= (!$JSStr) ? '0' : '';
				
				}
			else
				$JSStr .= '0';
/*			$JSStr  .=$_POST['lat'].'  -  '.$_POST['lng'];                                    */
			//var_dump($obj2);
//			var_dump($JSStr);
			echo $JSStr;
			} break;				
		case 'ULObjectGeo': /*2017_10_15 получить геометрию объекта */
			{
			chdir('..//');
			require_once('../classes/config.inc.php');
			require_once("../classes/MySQLi_class.php");
			require_once("../classes/GetContent_class.php");
			require_once("../classes/gis/manage_class.php");	
			require_once("../classes/User_class.php");
			require_once("../classes/ACL_class.php");
			require_once("../classes/Rout_class.php");
			require_once("../classes/gis/manage_class.php");
//			ini_set('max_input_vars', '5000');
			$JSStr = '';
			$layerDelim = '~~';
			$paramDelim = '##';
			$objStart = '<<obj>>';
			$BoundsStart = '<<bounds>>';
			$objDelim = '||';
			$geoDelim = '^^';
			$paramDelimObj = '%%';
			$paramDelimGeo = '$$';
			$holeDelimGeo = '**';
			$featureDelimGeo = '++';
			
			$CNT = 		new GetContent;
			$ROUT = new Routine;
			$CONST = $CNT->GetAllConfig();
			$MNG = new Manage;
//			print_r($_POST);
			if(is_array($_POST['oId'])){
				$cObj = 0;
				$JSStr = '<mlt>';
//				$JSStr .= '__array: '.print_r($_POST['oId']);
				$objGeo =  $MNG->getGeoOfObjectArr($_POST['oId']);
				foreach ($objGeo as $obj) {
					$JSStr .= (($cObj != $obj['o_id']) && ($cObj )) ? $objDelim : '';
					$JSStr .= 	$obj['c_lat'].$paramDelim.				//0
								$obj['c_lng'].$paramDelim.				//1
								$obj['hole_id'].$paramDelim.			//2
								$obj['feature_id'].$paramDelim.			//3
								$obj['o_id'].$paramDelim.$layerDelim;			//4
					$cObj =  $obj['o_id'];
				}
			}
			else{
				
				$objGeo =  $MNG->getGeoOfObject($_POST['oId']);
				foreach ($objGeo as $obj) {
					$JSStr .= 	$obj['c_lat'].$paramDelim.				//0
								$obj['c_lng'].$paramDelim.				//1
								$obj['hole_id'].$paramDelim.			//2
								$obj['feature_id'].$paramDelim.$layerDelim;			//3
								
					}
			}
			echo $JSStr;
			} break;
		case 'ULObjects': /*2017_02_09 получить объекты слоёв*/
			{
			ini_set('memory_limit', '512M');
			chdir('..//');
			require_once('../classes/config.inc.php');
			require_once("../classes/MySQLi_class.php");
			require_once("../classes/GetContent_class.php");
			require_once("../classes/gis/manage_class.php");	
			require_once("../classes/User_class.php");
			require_once("../classes/ACL_class.php");
			require_once("../classes/Rout_class.php");
			require_once("../classes/gis/manage_class.php");
			
			$CNT = 		new GetContent;
			$ROUT = new Routine;
			$CONST = $CNT->GetAllConfig();
			$MNG = new Manage;	
			$latMax = $latMin = $lngMax = $lngMin = 0;
			
			$isMng = ($_POST['startStr'] == '*69F727D4F74061CDEB44032B0A7FBE5EE6453E76') ? 1 : 0;					
			
			$JSStr = '';
			$layerDelim = '~~';
			$paramDelim = '##';
			$objStart = '<<obj>>';
			$BoundsStart = '<<bounds>>';
			$objDelim = '||';
			$geoDelim = '^^';
			$paramDelimObj = '%%';
			$paramDelimGeo = '$$';
			$holeDelimGeo = '**';
			$featureDelimGeo = '++';
			$layerList = $MNG->getAllLayers($isMng);
			$objList = $MNG->getAllObjStart();
//			$bounds = $MNG->getObjBounds();
//			$obj2Layer = $MNG->getObj2Layers();
/*			print_r($layerList);
			print_r($obj2Layer);
			print_r($objList);*/
			foreach ($layerList as $layer) {
				$JSStr .= 	$layer['l_id'].$paramDelim.							//0
//					 str_replace('&quot;', '"', $layer['l_name']).$paramDelim.	//1
						$layer['l_name'].$paramDelim.							//1
						$layer['l_info'].$paramDelim.							//2
						$layer['l_public'].$paramDelim.							//3
						$layer['l_system'].$paramDelim.							//4
						$layer['l_parId'].$paramDelim.							//5
						$layer['l_childCnt'].$paramDelim.						//6
						$layer['l_objCnt'].$paramDelim.							//7	
						$layer['l_parStr'].$paramDelim;							//8
				$JSStr .= $layerDelim;
			}
			$JSStr .= $objStart;
			usort($objList, 'sortObjNameAsc');
//			print_r($objList);
			foreach ($objList as $obj) {
				$polyType = 0;
//				$MNG->addObj2Layer($obj['l_id'], $obj['o_id']);
				if((!$obj['o_name'])||(strlen($obj['o_name'])<3))
					$obj['o_name'] = strip_tags(substr($obj['o_info'], strpos($obj['o_info'], '<h2>'), strpos($obj['o_info'], '</h2>')));
				$JSStr 			.= 	$obj['o_id'].$paramDelim.			//0
									$obj['o_name'].$paramDelim.  		
//									str_replace('&quot;', '"', $obj['o_name']).$paramDelim.//1
									$obj['o_type'].$paramDelim.  		//2
									$obj['o_info'].$paramDelim.  		//3
									$obj['o_specParam'].$paramDelim.	//4
									$obj['t_id'].$paramDelim.			//5
//									$obj['o2l_str'].$paramDelim.  		//6
									$obj['o_lStr'].$paramDelim.  		//6
									$obj['o_lParentStr'].$paramDelim;  	//7
						if(is_array($obj['geo'])){						//8
							$hole = $feature = $polyType =  0;
							foreach ($obj['geo']  as $geo) {
								
								if($geo['hole_id']!=$hole){
									$hole = $geo['hole_id'];
									$JSStr .= $holeDelimGeo;
								}
								if($geo['feature_id']!=$feature){
									$feature = $geo['feature_id'];
									$JSStr .= $featureDelimGeo;
								}
/*								$JSStr .= 	$geo['c_id'].$paramDelimGeo.		//0
											$geo['c_lng'].$paramDelimGeo.       //2
											$geo['c_lat'].$paramDelimGeo.       //1
											$geo['o_id'].$geoDelim;            	//3*/
											
								$JSStr .= 	$geo['c_lng'].$paramDelimGeo.       //1
											$geo['c_lat'].$geoDelim;            //0
							/*	if(($geo['c_lat'] > $latMax) && ($geo['c_lat'] < 180 ))
									$latMax = floatval ($geo['c_lat']);
								if(($geo['c_lat'] < $latMin) && ($geo['c_lat'] > -180 ))
									$latMin = floatval ($geo['c_lat']);
								if(($geo['c_lng'] > $lngMax) && ($geo['c_lng'] < 90 ))
									$lngMax = floatval ($geo['c_lng']);
								if(($geo['c_lng'] < $lngMin) && ($geo['c_lng'] > -90 ))
									$lngMin = floatval ($geo['c_lng']);*/
							}
							if(($feature>0)&&($hole>0))
								$polyType = 3;
							elseif(($feature>0)&&($hole==0))
								$polyType = 2;
							elseif(($feature==0)&&($hole>0))
								$polyType = 1;
//							echo 'feature = '.$feature.'; hole = '.$hole.'; polyType = '.$polyType;
							$JSStr .= 	$paramDelim.$polyType;				//9
						}
						elseif($obj['geo']=='remote'){
							$JSStr .= 	'remote';							//8
						}
				$JSStr .= $objDelim;                                    
/*				$boundsObj = $MNG->getObjBounds($obj['o_id']);*/
				if($obj['o_latMin']){
					$bounds['minLat'] = (($obj['o_latMin']<$bounds['minLat'])||(!isset($bounds['minLat'])))?$obj['o_latMin']:$bounds['minLat'];
					$bounds['maxLng'] = (($obj['o_lngMax']>$bounds['maxLng'])||(!isset($bounds['maxLng'])))?$obj['o_lngMax']:$bounds['maxLng'];
					$bounds['maxLat'] = (($obj['o_latMax']>$bounds['maxLat'])||(!isset($bounds['maxLat'])))?$obj['o_latMax']:$bounds['maxLat'];
					$bounds['minLng'] = (($obj['o_lngMin']<$bounds['minLng'])||(!isset($bounds['minLng'])))?$obj['o_lngMin']:$bounds['minLng'];
					}
				}
			$JSStr .= $BoundsStart.$bounds['minLat'].$paramDelim.$bounds['maxLng'].$paramDelim.$bounds['maxLat'].$paramDelim.$bounds['minLng'];                                    
//			$JSStr .= $BoundsStart.$latMin.$paramDelim.$lngMax.$paramDelim.$latMax.$paramDelim.$lngMin;                                    
			echo $JSStr;
			} break;	
		case 'panDemoPoints': 			
			{
			chdir('..//');
			require_once('../classes/config.inc.php');
			require_once("../classes/MySQL_class.php");
			require_once("../classes/GetContent_class.php");
			require_once("../classes/fs/GetOrg_class.php");	
			require_once("../classes/User_class.php");
			require_once("../classes/ACL_class.php");
			require_once("../classes/Rout_class.php");
			
			$JSStr = '';
			$stringDelim = '~~';
			$paramDelim = '##';
			$ROUT = new Routine;
			$getOrg = new GetOrganization;
			$CNT = 		new GetContent;
			$ROUT = new Routine;
			$CONST = $CNT->GetAllConfig();
			$fp = fopen('panTest.txt', "r+");
			$list =  file ('panTest.txt');
			for($i=0; $i<count($list); $i++)
				{
				$pointArr = explode(';', $list[$i]);				
				
				$JSStr .= ($i) ? $stringDelim : '';
				$JSStr .= $pointArr[0].$paramDelim.intval($pointArr[1]).$paramDelim.intval($pointArr[2]);				
				}
			echo $JSStr;
			} break;	
		case 'filteredApList': /*25_02_2015 получить квартиры по фильтру*/
			{
			chdir('..//');
			require_once('../classes/config.inc.php');
			require_once("../classes/MySQL_class.php");
			require_once("../classes/GetContent_class.php");
			require_once("../classes/fs/GetOrg_class.php");	
			require_once("../classes/User_class.php");
			require_once("../classes/ACL_class.php");
			require_once("../classes/Rout_class.php");
			require_once("../classes/fs/apartment_class.php");	
			
			$ROUT = new Routine;
			$getOrg = new GetOrganization;
			$CNT = 		new GetContent;
			$CONST = $CNT->GetAllConfig();
			session_start();
			
			$Apartments = new Apartments;
			$limit = ($_POST['useLimit']) ? 300 :0;
//			print_r($_POST['filter']);
			
			$JSStr = '';
			$stringDelim = '~~';
			$paramDelim = '##';
			$layerDelim = '%%';
			$parentOptDelim = '``';

			$apList =  $Apartments->getApListByFilter($_POST['filter']);
			$title =  $Apartments->getApFilterTitle($_POST['filter']);
			$count = 0;
//			print_r($apList);
			$objListTmp =  array();
			$objListTmpCnt = array();
			$objList ='';
			if($apList)
				{
				$apListCnt = (($limit)&&($limit<sizeof($apList))) ? $limit : sizeof($apList);
				for($i=0; $i< sizeof($apList); $i++)
					{
					$count ++;
					if($i<$apListCnt)
						{
						if(!in_array($apList[$i]['obj_id'], $objListTmp))
							{
							$objListTmp[] = $apList[$i]['obj_id'];							
							$objListTmpCnt[$apList[$i]['obj_id']]['name'] = $apList[$i]['obj_name'];
							$objListTmpCnt[$apList[$i]['obj_id']]['id'] = 	$apList[$i]['obj_id'];
							$objListTmpCnt[$apList[$i]['obj_id']]['cnt'] = 1;
							}
						else
							$objListTmpCnt[$apList[$i]['obj_id']]['cnt'] ++;						
						$JSStr .= 	$apList[$i]['ap_id'].$paramDelim.   		//0
									$apList[$i]['ap_roomNum'].$paramDelim.   	//1
									$apList[$i]['ap_area'].$paramDelim.   		//2
									$apList[$i]['ap_floor'].$paramDelim.   		//3
									$apList[$i]['ap_price'].$paramDelim.   		//4
									$apList[$i]['ap_sold'].$paramDelim.   		//5					
									$apList[$i]['obj_district'].$paramDelim.   	//6					
									$apList[$i]['district'].$paramDelim.   		//7					
									$apList[$i]['obj_id'].$paramDelim.   		//8					
									$apList[$i]['obj_name'].$paramDelim.   		//9					
									$apList[$i]['finish'].$paramDelim.   		//10					
									$apList[$i]['state'].$paramDelim.   		//11					
									$apList[$i]['img'][0]['src'].$paramDelim.   //12					
									$apList[$i]['cmp'].$paramDelim.   			//13					
									$apList[$i]['days'].$paramDelim.   			//14					
									$apList[$i]['weeks'].$paramDelim.   		//15					
									$apList[$i]['weeksClass'].$paramDelim.   	//16					
									$apList[$i]['ap_blockSection'].$paramDelim;	//17
									
						$JSStr .= 	$stringDelim;
						}
					}
				for($i=0; $i<sizeof($objListTmp); $i++)
					{
					$objList .=$objListTmpCnt[$objListTmp[$i]]['id'].$paramDelim.
								$objListTmpCnt[$objListTmp[$i]]['name'].$paramDelim.
								$objListTmpCnt[$objListTmp[$i]]['cnt'].$stringDelim;
					
					}
				
				}
			$countStr = ($count) ? $count.' '.$ROUT->getCorrectDeclensionRu($count, array('квартира', 'квартиры', 'квартир')) : 'нет объектов';
			$titleStr = $title.$layerDelim.$count.$layerDelim.$countStr.$parentOptDelim;
			echo $titleStr.$JSStr.$parentOptDelim.$objList;
			} break;		
		case 'getApCmpStr': /*19_09_2014 получить урл сравнения*/
			{
			chdir('..//');
			require_once('../classes/config.inc.php');
			require_once("../classes/MySQL_class.php");
			require_once("../classes/GetContent_class.php");
			require_once("../classes/fs/GetOrg_class.php");	
			require_once("../classes/User_class.php");
			require_once("../classes/ACL_class.php");
			require_once("../classes/Rout_class.php");
			require_once("../classes/fs/apartment_class.php");	
			
			$ROUT = new Routine;
			$getOrg = new GetOrganization;
			$CNT = 		new GetContent;
			$ROUT = new Routine;
			$CONST = $CNT->GetAllConfig();
			session_start();
//			print_r($_SESSION['apCmp'], $JSStr);
			$cmpArr = $_SESSION['apCmp'];
			sort($cmpArr);
			if($tmpCnt = count($cmpArr))
				{
				$JSStr .= '/list/apartment/compare/';
				for($i=0; $i<$tmpCnt; $i++)
					{
					$JSStr .= ($i) ? '_' : '';
					$JSStr .= $cmpArr[$i];				
					}
				}
			else
				$JSStr = '';
			echo $JSStr;
			} break;		
		case 'floorApartment': /*19_09_2014 получить этаж*/
			{
			if($objId = 	intval($_POST['objId']))
				{
				chdir('..//');
				require_once('../classes/config.inc.php');
				require_once("../classes/MySQL_class.php");
				require_once("../classes/GetContent_class.php");
				require_once("../classes/fs/GetOrg_class.php");	
				require_once("../classes/User_class.php");
				require_once("../classes/ACL_class.php");
				require_once("../classes/Rout_class.php");
				require_once("../classes/fs/apartment_class.php");	
				
				$ROUT = new Routine;
				$getOrg = new GetOrganization;
				$CNT = 		new GetContent;
				$ROUT = new Routine;
				$CONST = $CNT->GetAllConfig();
				$Apartments = new Apartments;
				$floor = intval($_POST['floor']);
				$JSStr = '';
				$stringDelim = '~~';
				$paramDelim = '##';

				$apList =  $Apartments->getApartmentsOfFloor($objId, $floor);
				for($i=0; $i<sizeof($apList); $i++)
					{
					
					$JSStr .= 	$apList[$i]['ap_id'].$paramDelim.   		//0
								$apList[$i]['ap_roomNum'].$paramDelim.   	//1
								$apList[$i]['ap_area'].$paramDelim.   		//2
								$apList[$i]['ap_floor'].$paramDelim.   		//3
								$apList[$i]['ap_price'].$paramDelim.   		//4
								$apList[$i]['ap_sold'].$paramDelim;   		//5					
					$JSStr .= 	$stringDelim;
					}
				echo $JSStr;
				}
			else
				echo '0';			
			} break;		
		case 'singleApartment': /*26_08_2014 получить квартиру*/
			{
			if($objId = 	intval($_POST['objId']))
				{
				chdir('..//');
				require_once('../classes/config.inc.php');
				require_once("../classes/MySQL_class.php");
				require_once("../classes/GetContent_class.php");
				require_once("../classes/fs/GetOrg_class.php");	
				require_once("../classes/User_class.php");
				require_once("../classes/ACL_class.php");
				require_once("../classes/Rout_class.php");
				require_once("../classes/fs/apartment_class.php");	
				
				$ROUT = new Routine;
				$getOrg = new GetOrganization;
				$CNT = 		new GetContent;
				$ROUT = new Routine;
				$CONST = $CNT->GetAllConfig();
				session_start();
				$Apartments = new Apartments;
				$finishVal = array('0' => '','1' => 'Черновая', '2' => 'Получистовая', '3' => 'Чистовая');
				$JSStr = '';
				$stringDelim = '~~';
				$paramDelim = '##';

				$apItem =  $Apartments->getCurApartment($objId);
				$Apartments->incApViews(intval($apItem['ap_viewCnt']), $apItem['ap_id']);									
				
//				print_r($apItem);
				$modDateArr = $ROUT->GetRusData(strtotime($apItem['ap_dateModify']));
				$modDate = $modDateArr['date'].' '.$modDateArr['month'];
				$modDate .= (date("Y",time()) != $modDateArr['year'])?' '.$modDateArr['year'].'':'';
					
				$JSStr .= 	$apItem['ap_id'].$paramDelim.   		//0
							$apItem['ap_objId'].$paramDelim.   		//1
							$apItem['firmId'].$paramDelim.   		//2
							$apItem['firm_name'].$paramDelim.   	//3
							$apItem['obj_name'].$paramDelim.   		//4
							$apItem['ap_roomNum'].$paramDelim.   	//5
							$apItem['ap_area'].$paramDelim.   		//6
							$apItem['ap_floor'].$paramDelim.   		//7
							$finishVal[$apItem['ap_finish']].$paramDelim.   	//8
							$apItem['ap_price'].$paramDelim.   		//9
							$apItem['ap_info'].$paramDelim.   		//10
							$apItem['ap_sold'].$paramDelim.   		//11
							$apItem['ap_blockSection'].$paramDelim.	//12
							$modDate.$paramDelim.   				//13
							$apItem['obj_sales'].$paramDelim;   	//14
							
				for($i=0; $i<sizeof($apItem['img']); $i++) //15, 16
					{
					if (!$i)
						$curType = $apItem['img'][$i]['type'];
					elseif($curType != $apItem['img'][$i]['type'])
						{
						$curType = $apItem['img'][$i]['type'];
						$JSStr .= 	$paramDelim;
						}
					$JSStr .= 	$apItem['img'][$i]['src'].$stringDelim;
					}
				$JSStr .= 	$paramDelim.$apItem['cityId'];   		//17
				$JSStr .= 	$paramDelim;   							//18
				for($i=0; $i<count($_SESSION['apCmp']); $i++)
					$JSStr .= $_SESSION['apCmp'][$i].$stringDelim;
				
//				$JSStr .= 	$paramDelim.print_r($_SESSION['apCmp'], true);   		
				echo $JSStr;
				}
			else
				echo '0';			
			} break;		
		case 'filter': /*03_04_2014 изменение фильтра*/
			{
			session_start();
			unset($_SESSION['filter']);
			$_SESSION['filter'] = $_POST['filter'];
//			print_r($_SESSION['filter']);
			} break;
		case 'jsonTest': /*14_06_2013 оценка*/
			
			{
//			echo '{"name":"Петя","img":"/src/upload","arr":"zxzxc"}';
//			echo '{"name":"Петя","img":"/src/upload","arr":"zxzxc"}';
			echo '{"name":"Петя","img":"/src/upload","arr":["12":"asdasd","25":"qweqe","жопа":"21"]}';
			}
		break;
		case 'list_SRVC': /*14_06_2013 оценка*/
			{
			if(($objType = 	trim($_POST['objType'])))
				{
				chdir('..//');
				require_once('../classes/config.inc.php');
				require_once("../classes/MySQL_class.php");
				require_once("../classes/GetContent_class.php");
				require_once("../classes/fs/GetOrg_class.php");	
				require_once("../classes/User_class.php");
				require_once("../classes/ACL_class.php");
				require_once("../classes/Rout_class.php");
				$ROUT = new Routine;
				$getOrg = new GetOrganization;
				$CNT = 		new GetContent;
				$ROUT = new Routine;
				$CONST = $CNT->GetAllConfig();
				$JSStr = '';
				$stringDelim = '~~';
				$paramDelim = '##';
				if($objType == 'firm')
					{
					$objList = $getOrg->getAllFirm(1, 1, 0);
					for($i=0; $i<sizeof($objList); $i++)
						{
						$JSStr .= ($i)?$stringDelim:'';
						
						$JSStr .= 			$objList[$i]['firm_id'].
								$paramDelim.$objList[$i]['firm_name'];	
						}
					}
				elseif($objType == 'construction')
					{
					$objList = $getOrg->getObjectAll(1);
					for($i=0; $i<sizeof($objList); $i++)
						{
						$JSStr .= ($i)?$stringDelim:'';
						
						$JSStr .= 			$objList[$i]['obj_id'].
								$paramDelim.$objList[$i]['obj_name'];	
						}
					}
				$charset = ($CONST['dinamicUTF8Convert'])?'windows-1251':'UTF-8';
				header('Content-type: text/html; charset='.$charset);
				echo $JSStr;					
				}
			else
				echo '0';
			}
		break;	
		case 'rate': /*14_06_2013 оценка*/
			{
			$JSStr = '';
			$messDeim = '~a~l~e~r~t~';
			$messTypeDeim = '~t~y~p~e~';
			$stringDelim = '~~';
			$paramDelim = '##';
			$mesStr = '';
			$mess = '';
			$rateTimeLimit = 30;
			session_start();
			if(isset($_SESSION['rateLastTime']) && (($delta = time() - intval($_SESSION['rateLastTime'])) < $rateTimeLimit))
				{
				$mess = 'error'.$messTypeDeim.'На ресурсе установлено ограничение на частоту добавления оценок: не более 1 оценки за '.$rateTimeLimit.' 
секунд. Вы можете повторить попытку отправки через '.($rateTimeLimit - $delta).' сек.';
				}
			else
				{
				chdir('..//');
				require_once('../classes/config.inc.php');			
				require_once("../classes/MySQL_class.php");
				require_once("../classes/GetContent_class.php");
				require_once("../classes/gd/message_class.php");	
				require_once("../classes/Rout_class.php");
				$ROUT = new Routine;
				$CNT = new GetContent;
				$CONST = $CNT->GetAllConfig();	
				require_once("../classes/gd/SetOrg_class.php");	
				$setOrg = new setOrganization;			
				$curRate = $_POST['curRate'];
				$value = 	intval($_POST['rate']);				
				$auth = 	(intval($_POST['auth']) == $CONST['userIdAnonim']) ? 0 : intval($_POST['auth']);
				$orgId = 	intval($_POST['orgId']);
				$objType = 	trim($_POST['objType']);
				
				$res = $setOrg->updRate($orgId, $objType, $auth, $value, $curRate);
				if($res['error'])
					{
					$mess = 'error'.$messTypeDeim.$res['errorMsg'].' Возникла непредвиденная ошибка в процессе добавления оценки. Попробуйте ещё раз либо обратитесь к администрации ресурса.';
					}
				else
					{
					require_once("../classes/gd/GetOrg_class.php");	
					$getOrg = new GetOrganization;
					$rate =  	$getOrg->getRating($orgId, $objType); 
					$resFrm = 	$setOrg->updFirmRateTotal($orgId, $rate['value']);								
					$mess = 'info'.$messTypeDeim.'Ваша оценка успешно сохранена. Спасибо за участие!';
					$mesStr .= $rate['value'].$paramDelim.$ROUT->getFilledStars($rate['value']).$paramDelim.$rate['num'].$paramDelim;
					}				
				}
			echo $mess.$messDeim.$mesStr;
			} break;
		case 'message': /*15_02_2012 отправка отзыва/сообщения*/
			{
			$JSStr = '';
			$messDeim = '~a~l~e~r~t~';
			$messTypeDeim = '~t~y~p~e~';
			$stringDelim = '~~';
			$paramDelim = '##';
			$mesStr = '';
			$mess = '';
			$messTimeLimit = 30;
			session_start();
			if(isset($_SESSION['messageLastTime']) && (($delta = time() - intval($_SESSION['messageLastTime'])) < $messTimeLimit))
				{
				$mess = 'error'.$messTypeDeim.'На ресурсе установлено ограничение на частоту добавления отзывов: не более 1 сообщения за '.$messTimeLimit.' 
секунд. Вы можете повторить попытку отправки через '.($messTimeLimit - $delta).' сек.';
				}
			else
				{
				chdir('..//');
				require_once('../classes/config.inc.php');			
				require_once("../classes/MySQL_class.php");
				require_once("../classes/GetContent_class.php");
				require_once("../classes/fs/message_class.php");	
				require_once("../classes/Rout_class.php");
				require_once("../classes/User_class.php");
				$ROUT = new Routine;
				$CNT = new GetContent;
				$CONST = $CNT->GetAllConfig();						
				$mes = new messageBase;			
				$USER_TMP1 = new CurrentUser ($_SERVER[REMOTE_ADDR], 1);
				$auth = 	(intval($_POST['auth']) == $CONST['userIdAnonim']) ? 0 : intval($_POST['auth']);
				$isMng = $USER_TMP1->userInGroup($auth , $CONST['groupIdAdmins']);					
				
				$alowedTags = '<div><i><b><u><strike><br><ul><ol><li>';
//				$alowedTags .= ($isMng) ? '<a><img>' : '';
				$alowedTags .= '<a><img>';
				$value = strip_tags($_POST['body'], $alowedTags);
//				echo $value;
				$valuePref= '';
				$value = (get_magic_quotes_gpc())?stripslashes(trim($value)):trim($value);	
				$value = mysql_escape_string($valuePref.$value);
				$subject = htmlspecialchars(trim($_POST['subject']),ENT_QUOTES);
				$authName = ($auth)?'':trim($_POST['authName']);
				$objId = 	intval($_POST['objId']);
				$objType = 	trim($_POST['objType']);
				$parId = 	intval($_POST['parId']);
				$hidden = ($subject == 'f')? 1 : 0;
				$res = $mes->add($objType, $objId, $parId, $auth, $authName, $subject, $value, $hidden);
				if($res['error'])
					{
					$mess = 'error'.$messTypeDeim.'Возникла непредвиденная ошибка в процессе добавления отзыва. Попробуйте ещё раз либо обратитесь к администрации ресурса.';
					}
				else
					{
					
					$_SESSION['messageLastTime'] = time();					
					if($subject == 'e')
						{
						require_once("../classes/User_class.php");
						$USER_TMP = new CurrentUser ($_SERVER[REMOTE_ADDR], 1);
						require_once("../classes/gd/GetOrg_class.php");	
						$getOrg = new GetOrganization;
						$org = $getOrg->getCurFirm($orgId);
						$curMembers = $USER_TMP->GetGroupUsers($CONST['groupIdAdmins']);					
						$subj = 'ошибка в описании компании';
						$senderName = ($authName)?$authName:$USER_TMP->getUserParam('user_id', $auth, 'user_name');
						$urlEvent = 'catalog/'.urlencode($org['firm_name']);
//						print_r($curMembers);
/*						echo $subj.'<br>'.$senderName.'<br>'.$subj.'<br>'.$urlEvent;//.'<br>'.$subj.'<br>'.*/
						require_once("../classes/Mail_class.php");	
						$MAIL = new SendMail;	
						for($i=0; $i<sizeof($curMembers); $i++)
							{
							$success = $MAIL->sendNotifyNewMessageAdminError($curMembers[$i]['user_name'], $curMembers[$i]['user_email'], $senderName, $org['firm_name'], $value, $subj, $urlEvent);					
							}
						$mess = 'info'.$messTypeDeim.'Ваше сообщение успешно отправлено администрации ресурса. В ближайшее время мы проверим новые данные и внесем корректировки. Спасибо за информацию.';						
						}
					elseif($subject == 'c')
						{
						if($objType=='constr')
							{
//							$mess = print_r($_POST, true);
							require_once("../classes/fs/SetOrg_class.php");	
							/*require_once("../classes/fs/GetOrg_class.php");	
							$getOrg = new GetOrganization;*/
							$setOrg = new setOrganization;			
							$comNum = $mes->getCommentsOfObjSmart($objType, $objId, 0, 1, 'c', 0, 1);
							$resFrm = $setOrg->updConstrCommentNum($objId, $comNum);		

							$comm = $mes->getCurCommentOfConstr($res['last_id']);
							}
						$mesStr .= $comm['comm_id'].$paramDelim;					//0
						$mesStr .= $comm['comm_body'].$paramDelim;					//1
						$mesStr .= $comm['displayName'].$paramDelim;				//2
						$mesStr .= $comm['comm_hidden'].$paramDelim;				//3
						$mesStr .= $comm['comm_date_ru'].$paramDelim;				//4
						$mesStr .= $comm['up_name'].$paramDelim;					//5
						$mesStr .= $comm['fullName'].$paramDelim;					//6
						$mesStr .= $comm['comm_lvl'].$paramDelim;					//7
						$mesStr .= $comm['comm_parId'].$paramDelim;					//8
						}					
//					$ret = 0;					
					}
				}
			echo $mess.$messDeim.$mesStr;
			} break;
		case 'fotoSet': /*06_12_2013 вытаскивает  объекты для карты, которые принадлежат слою в городе*/
			{
				if(($objId = 	intval($_POST['objId'])) &&($setNum = 	intval($_POST['setNum'])))
					{
					chdir('..//');
					require_once('../classes/config.inc.php');
					require_once("../classes/MySQL_class.php");
					require_once("../classes/GetContent_class.php");
					require_once("../classes/fs/GetOrg_class.php");	
					require_once("../classes/User_class.php");
					require_once("../classes/ACL_class.php");
					require_once("../classes/Rout_class.php");
					$ROUT = new Routine;
					$getOrg = new GetOrganization;
					$CNT = 		new GetContent;
					$ROUT = new Routine;
					$CONST = $CNT->GetAllConfig();
					$JSStr = '';
					$stringDelim = '~~';
					$paramDelim = '##';

					$fotoList =  $getOrg->getFotoOfSet($objId, $setNum);
					for($i=0; $i<sizeof($fotoList); $i++)
						{
						$JSStr .= ($i)?$stringDelim:'';
						
						$JSStr .= 			$fotoList[$i]['foto_id'].
								$paramDelim.$fotoList[$i]['foto_position'].
								$paramDelim.str_replace('size', '150', $fotoList[$i]['foto_src']).
								$paramDelim.$ROUT->getStrPrt($fotoList[$i]['foto_src'], 'size/', 1);
;	
						}
					echo $JSStr;
					}
				else
					echo '0';
			}
		break;			
		case 'getNewObj': /*22_11_2012 вытаскивает  объекты для карты, которые принадлежат слою в городе*/
			{
				chdir('..//');
				require_once('../classes/config.inc.php');
				require_once("../classes/MySQL_class.php");
				require_once("../classes/GetContent_class.php");
				require_once("../classes/fs/GetOrg_class.php");	
				require_once("../classes/User_class.php");
				require_once("../classes/ACL_class.php");
//				require_once("../classes/Rout_class.php");
				$getOrg = new GetOrganization;
				$CNT = 		new GetContent;
//				$ROUT = new Routine;
				$CONST = $CNT->GetAllConfig();
				session_start();
				if($_SESSION['newObj']['id'])
					echo $_SESSION['newObj']['type'].'_'.intval($_SESSION['newObj']['id']).'_'; // $org['firm_info'];
				else 
					echo 0;
			}
		break;			
		case 'orgInfo': /*22_11_2012 вытаскивает  объекты для карты, которые принадлежат слою в городе*/
			{
//			print_r($_POST);
			if(($orgId = intval($_POST['orgId']))&&($objType = trim($_POST['objType'])))
				{
				chdir('..//');
				require_once('../classes/config.inc.php');
				require_once("../classes/MySQL_class.php");
				require_once("../classes/GetContent_class.php");
				require_once("../classes/fs/GetOrg_class.php");	
				require_once("../classes/fs/apartment_class.php");	
				$Apartments = new Apartments;
				$getOrg = new GetOrganization;
				$CNT = 		new GetContent;
//				$ROUT = new Routine;
				$CONST = $CNT->GetAllConfig();
				if ($objType == 'construction')
					{
					$org = $getOrg->getObjectById($orgId);
					$info = $org['obj_info'];
					}
				elseif($objType == 'firm')
					{
					$org = $getOrg->getCurFirm($orgId);
					$info = $org['firm_info'];
					}
				elseif($objType == 'apartment')
					{
					$org =  $Apartments->getCurApartment($orgId);
					$info = $org['ap_info'];
					}
					
				echo $info; // $org['firm_info'];
				}
			}
		break;			
		case 'mapObjects': /*29_11_2013 вытаскивает все объект организации для карты*/
			{
//			print_r($_POST);
			if($objType = trim($_POST['objType']))
				{
				chdir('..//');
				require_once('../classes/config.inc.php');			
				require_once("../classes/MySQL_class.php");
				require_once("../classes/GetContent_class.php");
				require_once("../classes/fs/GetOrg_class.php");	
				require_once("../classes/Rout_class.php");
				require_once("../classes/TimeMesure_class.php");	
				$getOrg = new GetOrganization;
				$CNT = 		new GetContent;
				$ROUT = new Routine;
				$CONST = $CNT->GetAllConfig();
				$cityId = 	intval($_POST['city']);
				$state = 	intval($_POST['state']);
				$JSStr = '';
				$stringDelim = '~~';
				$paramDelim = '##';
				$layerDelim = '%%';
				$layerParamDelim = '$$';
				$imgDelim = '@@';
				$imgParamDelim = '^^';
				$parentOptDelim = '``';
				
//				$TM = new TimeMesure ('log_GetMapObjects.txt');			
				
				$objStateReplace = array(1 => 'В процессе', 2 => 'Готова', 3 => 'В планах', 4 => 'Заморожена');
				$tr=array('~' => '', '
' => '<br />', ' 
' => '<br />');
					
				$count = 0;
				
				if($objType == 'firm')
					{
					$objList = $getOrg->getFirmListByFilter(array( 'city' => $cityId));
					for($k=0; $k<sizeof($objList); $k++)
						{
						if(($objList[$k]['firm_geoX'])&&($objList[$k]['firm_geoY']))
							{
							$logoArr = explode('size', $objList[$k]['firm_logo']);
							$obj['obj'] = $objList[$k];
							$obj['type'] = $objType;
							$obj['location'] = $objList[$k]['firm_adrString'];
							$obj['phone'] = 	$ROUT->makeCityPhone($objList[$k]['firm_phone'], 0);
							$obj['x'] =  $objList[$k]['firm_geoX'];
							$obj['y'] =  $objList[$k]['firm_geoY'];
							$obj['firm_nameTranslit'] =  $objList[$k]['firm_nameTranslit'];
							$obj['firm_name'] =  $objList[$k]['firm_name'];
							$obj['firm_id'] =  $objList[$k]['firm_id'];
							$obj['firm_rank'] =  $objList[$k]['firm_rank'];
							$obj['img']['path'] =  $logoArr[0];
							$obj['img']['file'] =  $logoArr[1];
							$obj['firm_logo'] 	=  str_replace('size', '90', $objList[$k]['firm_logo']);
		//					$obj['firm_info'] =  (trim(objList[$k]['firm_info']))?$ROUT->getSmartCutedString(strip_tags(trim(objList[$k]['firm_info'])), 300):'';
							$obj['firm_info'] =  trim($objList[$k]['firm_info']);
							$obj['number'] = $count+1;
							if($objList[$k]['firm_logo'])							
								$imgStr = $obj['img']['path'].$imgParamDelim.$obj['img']['file'].$imgDelim;
							else
								$imgStr = ''.$imgParamDelim.''.$imgDelim;							
							$JSStr .= 	
										$obj['type'].$paramDelim.
										$obj['firm_id'].$paramDelim.
										$obj['firm_name'].$paramDelim.
										$obj['firm_nameTranslit'].$paramDelim.
										$obj['number'].$paramDelim.
										$obj['firm_rank'].$paramDelim.
										$obj['firm_logo'].$paramDelim.
										$obj['firm_info'].$paramDelim.
										$obj['x'].$paramDelim.
										$obj['y'].$paramDelim.
										$obj['location'].$paramDelim.
										$obj['phone'].$paramDelim.
										$imgStr.$paramDelim.$stringDelim;
							$count ++;
							}												
						$title = 'Застройщики Иркутска на карте';
//						$count = 1;
						$titleStr = '0'.$layerDelim.$title.$layerDelim.$count.$parentOptDelim;
						}
					$charset = ($CONST['dinamicUTF8Convert'])?'windows-1251':'UTF-8';
					header('Content-type: text/html; charset='.$charset);
					echo $titleStr.$JSStr;
					}
				
				elseif($objType == 'construction')
					{					
					if($_POST['filter']['spec']!='')
						{
						if($_POST['filter']['spec']=='lastFoto')
							{
							$dateLimit = date('Y-m-d', (time()-(3600*24*30)));
							$objRet = $getOrg->getConstrListLastFotoDate($cityId, $dateLimit, 0);							
							$objList = $objRet['list'];														
							//$title = 'Обновившиеся новостройки за 30 дней';
							$specCount = sizeof($objList);;							
							}
						elseif($_POST['filter']['spec']=='lastObj')
							{
							$dateStart = date('Y-m-d', (time()-(3600*24*180)));
							$objRet = 	$getOrg->getConstrListByMonitoringStart($cityId, $dateStart, 0);
							$objList = $objRet['list'];	
							$specCount = sizeof($objList);

							//$title = 'Новые стройки за полгода';
							}
						elseif($_POST['filter']['spec']=='completed')
							{
							$dateStart = date('Y-m-d', (time()-(3600*24*180)));
							$objRet = 	$getOrg->getConstrListReady($cityId, $dateStart, 0);
							$objList = $objRet['list'];	
							$specCount = sizeof($objList);
							//$title = 'Завершенные стройки за полгода';
							}
						elseif($_POST['filter']['spec']=='all')
							{
							
							$objList = 	$getOrg->getConstrListAllMonitoring($cityId, 0);
							$objCount = 	sizeof($objList);	
							//$title = 'Все новостройки от начала проекта';
							}
//						$specCount = 1;							
						}
					else
						{
						if(($_POST['filter']['dateStart'])||($_POST['filter']['dateEnd']))
							{
							$intervalArray = $getOrg->getDateIntervalsConstr();
							$_POST['filter']['dateStart'] = ($_POST['filter']['dateStart']) ? str_replace('.', '_', $_POST['filter']['dateStart']) : $intervalArray['monStartBegin'];
							$_POST['filter']['dateEnd'] = ($_POST['filter']['dateEnd']) ? str_replace('.', '_', $_POST['filter']['dateEnd']) : $intervalArray['monEndEnd'];
							}					
						$_POST['filter']['city'] = $cityId;
						$objList = $getOrg->getConstrListByFilter($_POST['filter']);
						}
//					$TM->TimeCalc('Get objList...');
					$title = 	$getOrg->getConstrFilterTitle($_POST['filter']).' на карте';	
					if($objList)
						{
						$count = 0;
//						print_r($objList);
						for($k=0; $k<sizeof($objList); $k++)
							{
							$objId = $objList[$k]['obj_id'];
							$objSingle = 	$objList[$k];

							$objProp = 		$getOrg->getObjectProperties($objId, 0);
//							$TM->TimeCalc('.........Properties '.$objId);
							
							$objFoto = 		$getOrg->getFotoOfSet($objId,  $objSingle['obj_lastCapture']);
//							$TM->TimeCalc('.........Foto '.$objId);
							if($objFoto)
								{
								$obj['fotoLastDate'] = $objFoto[0]['foto_date'];
								$fotoS = '';
								$fotoC = 0;
								for($i = 0; $i< sizeof($objFoto); $i++)
									{
		//								$fotoS .= ($fotoC)? $imgParamDelim: '';
										$fotoS .= $objFoto[$i]['foto_src'].$imgParamDelim;
										$fotoC ++;
									}
								}
							if($objProp)
								{
								$renderS = $infoS = $shemaS = '';
								$renderC = $infoC = $shemaC = 0;
								for($i = 0; $i< sizeof($objProp); $i++)
									{
									if($objProp[$i]['property_name'] == 'fotoRender')
										{								
			//							$renderS .= ($renderC)? $imgParamDelim: '';
										$renderS .= $objProp[$i]['prop_value'].$imgParamDelim;
										$renderC ++;
										}
									if($objProp[$i]['property_name'] == 'fotoScheme')
										{								
				//						$shemaS .= ($shemaC)? $imgParamDelim: '';
										$shemaS .= $objProp[$i]['prop_value'].$imgParamDelim;
										$shemaC ++;
										}
									if($objProp[$i]['property_name'] == 'fotoInfo')
										{								
		/*								$infoS .= ($infoC)? $imgParamDelim: '';
										$infoS .= $objProp[$i]['prop_value'];*/
										$infoS .= $objProp[$i]['prop_value'].$imgParamDelim;
										$infoC ++;
										}
									}
								}
							$lastDateArr =  $ROUT->GetRusData(strtotime($obj['fotoLastDate']));
							$obj['fotoLastDate'] = $lastDateArr['date'].' '.$lastDateArr['month'];
							$obj['fotoLastDate'] .= (date("Y",time()) != $lastDateArr['year'])?' '.$lastDateArr['year'].' года':'';
							if($objSingle['obj_monStart'])
								{
								$dateTmpArr = explode('_', $objSingle['obj_monStart']);
								$obj['monitoringStart'] =  $dateTmpArr[1].' квартал '.$dateTmpArr[0].' года';
								}
							else
								$obj['monitoringStart'] = '';
							if($objSingle['obj_monEnd'])
								{
								$dateTmpArr = explode('_', $objSingle['obj_monEnd']);
								$obj['monitoringEnd'] =  $dateTmpArr[1].' квартал '.$dateTmpArr[0].' года';
								}
							else
								$obj['monitoringEnd'] = '';	
							
							
							if ($objSingle['obj_dateStart']) 
								{
								$dateTmpArr = explode('_', $objSingle['obj_dateStart']);
								$obj['obj_dateStart'] = $dateTmpArr[1].' квартал '.$dateTmpArr[0].' года';
								}
							if ($objSingle['obj_dateEnd']) 
								{
								$dateTmpArr = explode('_', $objSingle['obj_dateEnd']);
								$obj['obj_dateEnd'] = $dateTmpArr[1].' квартал '.$dateTmpArr[0].' года';
								}
							$obj['obj'] = $objSingle;
							$obj['type'] = $objType;
							$obj['location'] = $objSingle['obj_adrString'];
							$obj['x'] =  $objSingle['obj_geoX'];
							$obj['y'] =  $objSingle['obj_geoY'];
							$obj['nameTranslit'] =  $objSingle['obj_nameTranslit'];
							$obj['name'] =  $objSingle['obj_name'];
							$obj['id'] =  $objSingle['obj_id'];
							$obj['stateId'] =  $objSingle['obj_state'];
							$obj['state'] =  $objStateReplace[$objSingle['obj_state']];
							$obj['rank'] =  $objSingle['obj_rank'];
							$obj['materialId'] =  $objSingle['obj_material'];
							$obj['material'] =  $getOrg->getMaterialById($objSingle['obj_material']);
							$obj['info'] =  addslashes (strtr(trim($objSingle['obj_info']), $tr));
							$obj['number'] = $count+1;
							
							if($CONST['dinamicUTF8Convert'] >0 )
								{
								$obj['state'] = iconv("UTF-8", "windows-1251", $obj['state']);
								$obj['monitoringStart'] = iconv("UTF-8", "windows-1251", $obj['monitoringStart']);
								$obj['monitoringEnd'] = iconv("UTF-8", "windows-1251", $obj['monitoringEnd']);
								$obj['obj_dateStart'] = iconv("UTF-8", "windows-1251", $obj['obj_dateStart']);
								$obj['obj_dateEnd'] = iconv("UTF-8", "windows-1251", $obj['obj_dateEnd']);
								$obj['fotoLastDate'] = iconv("UTF-8", "windows-1251", $obj['fotoLastDate']);
								}

							$JSStr .= ''.$objType.											//0
										$paramDelim.$obj['number'].							//1
										$paramDelim.$obj['id'].								//2
										$paramDelim.$obj['location'].						//3
										$paramDelim.$obj['x'].								//4
										$paramDelim.$obj['y'].								//5
										$paramDelim.$obj['name'].							//6
										$paramDelim.$obj['nameTranslit'].					//7
										$paramDelim.$obj['rank'].							//8
										$paramDelim.$obj['stateId'].						//9
										$paramDelim.$obj['state'].							//10
										$paramDelim.$obj['monitoringStart'].				//11
										$paramDelim.$obj['monitoringEnd'].					//12
										$paramDelim.$obj['obj_dateStart'].					//13
										$paramDelim.$obj['info'].							//14
										$paramDelim.$obj['obj_dateEnd'].					//15
										$paramDelim.$obj['fotoLastDate'].					//16
										$paramDelim.$obj['materialId'].						//17
										$paramDelim.$obj['material'];						//18
							$JSStr .= ($renderC) ? $paramDelim.$renderS : $paramDelim.'';	//19					
							$JSStr .= ($shemaC) ? $paramDelim.$shemaS : $paramDelim.'';		//20
							$JSStr .= ($infoC) ? $paramDelim.$infoS : $paramDelim.'';		//21
							$JSStr .= ($fotoC) ? $paramDelim.$fotoS : $paramDelim.'';		//22
							$JSStr .= $stringDelim;				
							$count++;
							}
//						$TM->TimeCalc('Out JSON...');
						if($specCount)
//							$count = 0;
							$count = $specCount;
						$charset = ($CONST['dinamicUTF8Convert'])?'windows-1251':'UTF-8';
						$title = ($CONST['dinamicUTF8Convert'])?iconv("UTF-8", "windows-1251", $title):$title;
						$titleStr = '0'.$layerDelim.$title.$layerDelim.$count.$parentOptDelim;
						header('Content-type: text/html; charset='.$charset);
						echo $titleStr.$JSStr;
						
						}
					else
						{
						$charset = ($CONST['dinamicUTF8Convert'])?'windows-1251':'UTF-8';
						$title = ($CONST['dinamicUTF8Convert'])?iconv("UTF-8", "windows-1251", $title):$title;
						$titleStr = '0'.$layerDelim.$title.$layerDelim.'0'.$parentOptDelim;
						header('Content-type: text/html; charset='.$charset);
						echo $titleStr.$stringDelim;
						}
					}
				}
			}
		break;	
		case 'mapSingleObjSimple': /*10_12_2012 вытаскивает одиночный  объект для карты*/
			{
//			print_r($_POST);
			if(($objId = intval($_POST['object']))&&($objType = trim($_POST['objType'])))
				{
				chdir('..//');
				require_once('../classes/config.inc.php');
				require_once("../classes/MySQL_class.php");
				require_once("../classes/GetContent_class.php");
				require_once("../classes/fs/GetOrg_class.php");	
				require_once("../classes/User_class.php");
				require_once("../classes/ACL_class.php");
				require_once("../classes/Rout_class.php");
				$ROUT = new Routine;
				$getOrg = new GetOrganization;
				$CNT = 		new GetContent;
				$ROUT = new Routine;
				$CONST = $CNT->GetAllConfig();
				$paramDelim = '##';
				$JSStr = '';
				if($objType == 'firm')
					{
					$objSingle = $getOrg->getCurFirm($objId);
					$obj['type'] = $objType;
					$obj['location'] = $objSingle['firm_adrString'];
					$obj['x'] =  $objSingle['firm_geoX'];
					$obj['y'] =  $objSingle['firm_geoY'];
					$obj['name'] =  $objSingle['firm_name'];
					$obj['id'] =  $objSingle['firm_id'];					
					}
				elseif($objType == 'construction')
					{
					$objSingle = 	$getOrg->getObjectById($objId);
					$obj['type'] = $objType;
					$obj['location'] = $objSingle['obj_adrString'];
					$obj['x'] =  $objSingle['obj_geoX'];
					$obj['y'] =  $objSingle['obj_geoY'];
					$obj['name'] =  $objSingle['obj_name'];
					$obj['id'] =  $objSingle['obj_id'];										
					}
				$JSStr .= 	$obj['type'].$paramDelim.
							$obj['id'].$paramDelim.
							$obj['name'].$paramDelim.
							$obj['x'].$paramDelim.
							$obj['y'].$paramDelim.
							$obj['location'];
				echo $JSStr;
				}
			}
		break;	
		case 'mapSingleObj': /*10_12_2012 вытаскивает одиночный  объект для карты*/
			{
//			print_r($_POST);
			if(($objId = intval($_POST['object']))&&($objType = trim($_POST['objType'])))
				{
				chdir('..//');
				require_once('../classes/config.inc.php');
				require_once("../classes/MySQL_class.php");
				require_once("../classes/GetContent_class.php");
				require_once("../classes/fs/GetOrg_class.php");	
				require_once("../classes/User_class.php");
				require_once("../classes/ACL_class.php");
				require_once("../classes/Rout_class.php");
				$ROUT = new Routine;
				$getOrg = new GetOrganization;
				$CNT = 		new GetContent;
				$ROUT = new Routine;
				$CONST = $CNT->GetAllConfig();
//				print_r($CONST);
				$JSStr = '';
				$stringDelim = '~~';
				$paramDelim = '##';
				$layerDelim = '%%';
				$layerParamDelim = '$$';
				$imgDelim = '@@';
				$imgParamDelim = '^^';
				$parentOptDelim = '``';
//				print_r($layer);
				$objStateReplace = array(1 => 'В процессе', 2 => 'Готова', 3 => 'В планах', 4 => 'Заморожена');
				$tr=array('~' => '', '
' => '<br />', ' 
' => '<br />');
				
				if($objType == 'firm')
					{
					$objSingle = $getOrg->getCurFirm($objId);
					$logoArr = explode('size', $objSingle['firm_logo']);
					$obj['obj'] = $objSingle;
					$obj['type'] = $objType;
					$obj['location'] = $objSingle['firm_adrString'];
					$obj['phone'] = 	$ROUT->makeCityPhone($objSingle['firm_phone'], 0);
					$obj['x'] =  $objSingle['firm_geoX'];
					$obj['y'] =  $objSingle['firm_geoY'];
					$obj['firm_nameTranslit'] =  $objSingle['firm_nameTranslit'];
					$obj['firm_name'] =  $objSingle['firm_name'];
					$obj['firm_id'] =  $objSingle['firm_id'];
					$obj['firm_rank'] =  $objSingle['firm_rank'];
					$obj['img']['path'] =  $logoArr[0];
					$obj['img']['file'] =  $logoArr[1];
					$obj['firm_logo'] 	=  str_replace('size', '90', $objSingle['firm_logo']);
//					$obj['firm_info'] =  (trim($objSingle['firm_info']))?$ROUT->getSmartCutedString(strip_tags(trim($objSingle['firm_info'])), 300):'';
					$obj['firm_info'] =  trim($objSingle['firm_info']);
					$obj['number'] = 0;
					$imgStr = $obj['img']['path'].$imgParamDelim.$obj['img']['file'].$imgDelim;
					$title = $obj['firm_name'].' на карте';
					$count = 1;
					$titleStr = $obj['firm_id'].$layerDelim.$title.$layerDelim.$count.$parentOptDelim;

					$JSStr .= 	$obj['type'].$paramDelim.
								$obj['firm_id'].$paramDelim.
								$obj['firm_name'].$paramDelim.
								$obj['firm_nameTranslit'].$paramDelim.
								$obj['number'].$paramDelim.
								$obj['firm_rank'].$paramDelim.
								$obj['firm_logo'].$paramDelim.
								$obj['firm_info'].$paramDelim.
								$obj['x'].$paramDelim.
								$obj['y'].$paramDelim.
								$obj['location'].$paramDelim.
								$obj['phone'].$paramDelim.
								$imgStr.$paramDelim.$stringDelim;
					
					}
				elseif($objType == 'construction')
					{
//					header('Content-type: text/html; charset=windows-1251');

					$objSingle = 	$getOrg->getObjectById($objId);
					$objProp = 		$getOrg->getObjectProperties($objId, 0);
//							$TM->TimeCalc('.........Properties '.$objId);
					
					$objFoto = 		$getOrg->getFotoOfSet($objId,  $objSingle['obj_lastCapture']);
//							$TM->TimeCalc('.........Foto '.$objId);
					if($objFoto)
						{
						$obj['fotoLastDate'] = $objFoto[0]['foto_date'];
						$fotoS = '';
						$fotoC = 0;
						for($i = 0; $i< sizeof($objFoto); $i++)
							{
//								$fotoS .= ($fotoC)? $imgParamDelim: '';
								$fotoS .= $objFoto[$i]['foto_src'].$imgParamDelim;
								$fotoC ++;
							}
						}
					if($objProp)
						{
						$renderS = $infoS = $shemaS = '';
						$renderC = $infoC = $shemaC = 0;
						for($i = 0; $i< sizeof($objProp); $i++)
							{
							if($objProp[$i]['property_name'] == 'fotoRender')
								{								
	//							$renderS .= ($renderC)? $imgParamDelim: '';
								$renderS .= $objProp[$i]['prop_value'].$imgParamDelim;
								$renderC ++;
								}
							if($objProp[$i]['property_name'] == 'fotoScheme')
								{								
		//						$shemaS .= ($shemaC)? $imgParamDelim: '';
								$shemaS .= $objProp[$i]['prop_value'].$imgParamDelim;
								$shemaC ++;
								}
							if($objProp[$i]['property_name'] == 'fotoInfo')
								{								
/*								$infoS .= ($infoC)? $imgParamDelim: '';
								$infoS .= $objProp[$i]['prop_value'];*/
								$infoS .= $objProp[$i]['prop_value'].$imgParamDelim;
								$infoC ++;
								}
							}
						}
					$lastDateArr =  $ROUT->GetRusData(strtotime($obj['fotoLastDate']));
					$obj['fotoLastDate'] = $lastDateArr['date'].' '.$lastDateArr['month'];
					$obj['fotoLastDate'] .= (date("Y",time()) != $lastDateArr['year'])?' '.$lastDateArr['year'].' года':'';
					if($objSingle['obj_monStart'])
						{
						$dateTmpArr = explode('_', $objSingle['obj_monStart']);
						$obj['monitoringStart'] =  $dateTmpArr[1].' квартал '.$dateTmpArr[0].' года';
						}
					else
						$obj['monitoringStart'] = '';
					if($objSingle['obj_monEnd'])
						{
						$dateTmpArr = explode('_', $objSingle['obj_monEnd']);
						$obj['monitoringEnd'] =  $dateTmpArr[1].' квартал '.$dateTmpArr[0].' года';
						}
					else
						$obj['monitoringEnd'] = '';	
					
					
					if ($objSingle['obj_dateStart']) 
						{
						$dateTmpArr = explode('_', $objSingle['obj_dateStart']);
						$obj['obj_dateStart'] = $dateTmpArr[1].' квартал '.$dateTmpArr[0].' года';
						}
					if ($objSingle['obj_dateEnd']) 
						{
						$dateTmpArr = explode('_', $objSingle['obj_dateEnd']);
						$obj['obj_dateEnd'] = $dateTmpArr[1].' квартал '.$dateTmpArr[0].' года';
						}
					$obj['obj'] = $objSingle;
					$obj['type'] = $objType;
					$obj['location'] = $objSingle['obj_adrString'];
					$obj['x'] =  $objSingle['obj_geoX'];
					$obj['y'] =  $objSingle['obj_geoY'];
					$obj['nameTranslit'] =  $objSingle['obj_nameTranslit'];
					$obj['name'] =  $objSingle['obj_name'];
					$obj['id'] =  $objSingle['obj_id'];
					$obj['stateId'] =  $objSingle['obj_state'];
					$obj['state'] =  $objStateReplace[$objSingle['obj_state']];
					$obj['rank'] =  $objSingle['obj_rank'];
					$obj['materialId'] =  $objSingle['obj_material'];
					$obj['material'] =  $getOrg->getMaterialById($objSingle['obj_material']);
					$obj['info'] =  addslashes (strtr(trim($objSingle['obj_info']), $tr));
					$obj['number'] = 0;
					if($CONST['dinamicUTF8Convert'] >0 )
						{
						$obj['state'] = iconv("UTF-8", "windows-1251", $obj['state']);
						$obj['monitoringStart'] = iconv("UTF-8", "windows-1251", $obj['monitoringStart']);
						$obj['monitoringEnd'] = iconv("UTF-8", "windows-1251", $obj['monitoringEnd']);
						$obj['obj_dateStart'] = iconv("UTF-8", "windows-1251", $obj['obj_dateStart']);
						$obj['obj_dateEnd'] = iconv("UTF-8", "windows-1251", $obj['obj_dateEnd']);
						$obj['fotoLastDate'] = iconv("UTF-8", "windows-1251", $obj['fotoLastDate']);
						}
					$title = $obj['name'].' на карте';
					$JSStr .= ''.$objType.											//0
								$paramDelim.$obj['number'].							//1
								$paramDelim.$obj['id'].								//2
								$paramDelim.$obj['location'].						//3
								$paramDelim.$obj['x'].								//4
								$paramDelim.$obj['y'].								//5
								$paramDelim.$obj['name'].							//6
								$paramDelim.$obj['nameTranslit'].					//7
								$paramDelim.$obj['rank'].							//8
								$paramDelim.$obj['stateId'].						//9
								$paramDelim.$obj['state'].							//10
								$paramDelim.$obj['monitoringStart'].				//11
								$paramDelim.$obj['monitoringEnd'].					//12
								$paramDelim.$obj['obj_dateStart'].					//13
								$paramDelim.$obj['info'].							//14
								$paramDelim.$obj['obj_dateEnd'].					//15
								$paramDelim.$obj['fotoLastDate'].					//16
								$paramDelim.$obj['materialId'].						//17
								$paramDelim.$obj['material'];						//18
					$JSStr .= ($renderC) ? $paramDelim.$renderS : $paramDelim.'';	//19					
					$JSStr .= ($shemaC) ? $paramDelim.$shemaS : $paramDelim.'';		//20
					$JSStr .= ($infoC) ? $paramDelim.$infoS : $paramDelim.'';		//21
					$JSStr .= ($fotoC) ? $paramDelim.$fotoS : $paramDelim.'';		//22
					$JSStr .= $stringDelim;	
					$count = 1;
					$titleStr = $objSingle['obj_id'].$layerDelim.$title.$layerDelim.$count.$parentOptDelim;

					}
/*				$layerStr = '';
				$imgStr = '';*/
				$charset = ($CONST['dinamicUTF8Convert'])?'windows-1251':'UTF-8';
				header('Content-type: text/html; charset='.$charset);
				echo $titleStr.$JSStr;
				}
			}
		break;	
		case 'email': /*21_05_2008 список улиц начинающихся с...*/
			{
			if(($_SERVER['HTTP_REFERER'] == 'http://'.$_SERVER['SERVER_NAME'].'/registration')&&(trim($_POST['email'])))
				{
				chdir('..//');
//				$login = iconv("UTF-8","windows-1251",trim($_POST['login']));
				require_once('../classes/config.inc.php');			
				require_once("../classes/MySQL_class.php");
				require_once("../classes/User_class.php");
//				require_once("../../classes/ga/TPL_Obj_class.php");	
				$usr = new CurrentUser ($_SERVER[REMOTE_ADDR], 0);
				if(!preg_match("/^([a-zA-Z0-9\.\-_])+@([a-zA-Z0-9\.\-_])+(\.([a-zA-Z0-9])+)+$/", trim($_POST['email'])))
					{
					$res = 0;
					}		
				elseif($usr->getUserParam('user_email', trim($_POST['email']), 'user_id'))
					{
					$res = 2;
					}
				else
					$res = 1;
				echo $res;
				}
			else
				{
				echo -1;
				}
			}
		break;		
		case 'login': /*21_05_2008 список улиц начинающихся с...*/
			{
			if(($_SERVER['HTTP_REFERER'] == 'http://'.$_SERVER['SERVER_NAME'].'/registration')&&(strlen(trim($_POST['login']))>2))
				{
				chdir('..//');
//				$login = iconv("UTF-8","windows-1251",trim($_POST['login']));
				$login = trim($_POST['login']);
				require_once('../classes/config.inc.php');			
				require_once("../classes/MySQL_class.php");
				require_once("../classes/User_class.php");
//				require_once("../../classes/ga/TPL_Obj_class.php");	
				$usr = new CurrentUser ($_SERVER[REMOTE_ADDR], 0);
				if(!$usr->getUserParam('user_name', $login, 'user_id'))
					$res = 1;
				else
					$res = 0;
				echo $res;
				}
			else
				{
				echo -1;
				}
			}
		break;		
		case 'usedAvtoSelect': /**14_05_2012  */
			{
			} break;
		}
	}
elseif((isset($_GET['q']))&&(isset($_GET['type']))) //Подгрузка списков для автоподстановки
	{
//	print_r($_GET);
	$type = trim($_GET['type']);
	$qStr = trim($_GET['q']);
	switch ($type)
		{
		case 'fastSearch': /*2013_09_19 поиск в текстовом индексе*/
			{	
			chdir('..//');
//			$qStr = iconv("UTF-8","windows-1251",trim($qStr));
//			$qStr = iconv("windows-1251","UTF-8",trim($qStr));
			require_once('../classes/config.inc.php');			
			require_once("../classes/MySQL_class.php");
			require_once("../classes/GetContent_class.php");
			require_once("../classes/fs/GetOrg_class.php");	
			require_once("../classes/Rout_class.php");
			require_once("../classes/TPL_class.php");
			require_once("../classes/gd/news_class.php");			
			$ROUT = new Routine;
			$getOrg = new GetOrganization;
			$CNT = 		new GetContent;
			$CONST = $CNT->GetAllConfig();
			$NEWS = new news;
			$table = '';
			$stringOriginal = trim($qStr);
			$objType = array(0 => 'firmName', 1 => 'street', 2 => 'phone', 3 => 'firmInfo', 4 => 'firmWWW', 
								5 => 'constrName', 6 => 'constrInfo', 7 => 'constrSales', 8 => 'constrAdr', 9 => 'constrWWW', 
								10 => 'catDocs', 11 => 'docName', 12 => 'docBody', 13 => 'catNews', 14 => 'newsName', 15 => 'newsBody');
			$exluded = array(' ', 'quot', 'www', 'nbsp', '!','@','#','$','%','^','&','*','(',')','-','_','=','`','~',':',';','\'','"','\\','/','|','?','.',',','<','>', '№','%', '«', '»'); 
			$string = str_replace($exluded, '', mb_strtolower(trim($qStr), 'UTF-8'));
//			echo $string = $ROUT->strtolower_ru(trim($qStr));
			$curCity = $CONST['curCity'];
//			print_r($_GET);
			$geoStr = 'микрорайон_переулок_улица_проезд_проспект_бульвар_площадь';	
//			$geoArr = array('микрорайон', 'переулок', 'улица', 'проезд', 'проспект', 'бульвар', 'площадь');	
			$list = $getOrg->getStrFromIndex($string);
			$firmsToShow = array();
			$newsToShow = array();
			$objectsToShow = array();
//			print_r($list);
			$outList = array();
			$count = 0;
			$cutSymNumName = 50;
			$cutSymNumInfo = 25;
			$cutSymNumNews = 60;
			for($i=0; $i<sizeof($list); $i++)
				{
				if($list[$i]['obj_type']<5)
					{
					$outlistTmp = array();
					$strAdrArr = $getOrg->getCurFirm($list[$i]['obj_id']);
					$outlistTmp['objId'] 		= $list[$i]['obj_id'];	
					$outlistTmp['type'] 		= $list[$i]['obj_type'];	
					$outlistTmp['typeName'] 	= $objType[$list[$i]['obj_type']];	
					$outlistTmp['objName'] 		= $ROUT->getCuttedStringSmart($strAdrArr['firm_name'], $string, $cutSymNumName);	
					$outlistTmp['link'] 		= '/list/firm/'.$strAdrArr['firm_id'];						
					$outlistTmp['value'] 		= '';						
					}
				elseif(($list[$i]['obj_type']<10)/*&&($list[$i]['obj_type']=>5)*/)
					{
					$outlistTmp = array();
					$strAdrArr = $getOrg->getObjectById($list[$i]['obj_id']);
					
					$outlistTmp['objId'] 		= $list[$i]['obj_id'];	
					$outlistTmp['type'] 		= $list[$i]['obj_type'];	
					$outlistTmp['typeName'] 	= $objType[$list[$i]['obj_type']];	
					$outlistTmp['objName'] 		= $strAdrArr['obj_name'];	
					$outlistTmp['link'] 		= '/list/construction/'.$strAdrArr['obj_id'];											
					$outlistTmp['value'] 		= '';						
					}
				switch ($list[$i]['obj_type'])
					{
					case '0': /*название фирмы*/
						{
						if(($outlistTmp['objName'])&&(!in_array($outlistTmp['objId'], $firmsToShow)))
							{							
							$outlist[$count] = $outlistTmp;
							$outlist[$count]['value'] 		= '<strong>'.$outlistTmp['objName'].'</strong>'; //$strAdrArr['firm_name'];
							$firmsToShow[] = $outlistTmp['objId'];
							$count ++;
							}						
						} break;
					case '1': /*адрес фирмы*/
						{
						if(($outlistTmp['objName'])&&(!in_array($outlistTmp['objId'], $firmsToShow)))
							{							
							$outlist[$count] = $outlistTmp;
							$outlist[$count]['value'] 		= '<strong>'.$outlistTmp['objName'].'</strong>:          '.$strAdrArr['firm_adrString'];
							$firmsToShow[] = $outlistTmp['objId'];
							$count ++;
							}						
						} break;
					case '2': /*Телефон*/
						{
						if(($outlistTmp['objName'])&&(!in_array($outlistTmp['objId'], $firmsToShow)))
							{							
							$outlist[$count] = $outlistTmp;
							$outlist[$count]['value'] 		= '<strong>'.$outlistTmp['objName'].'</strong>:          '.$strAdrArr['firm_phone'];
							$firmsToShow[] = $outlistTmp['objId'];
							$count ++;
							}						
						} break;
					case '3': /*Информация о фирме*/
						{
						if(($outlistTmp['objName'])&&(!in_array($outlistTmp['objId'], $firmsToShow)))
							{							
							$outlist[$count] = $outlistTmp;
							$outlist[$count]['value'] 		= '<strong>'.$outlistTmp['objName'].'</strong>:          '.$ROUT->getCuttedStringSmart($strAdrArr['firm_info'], $string, $cutSymNumInfo);
							$firmsToShow[] = $outlistTmp['objId'];
							$count ++;
							}												
						} break;
					case '4': /*сайт фирмы*/
						{
						if(($outlistTmp['objName'])&&(!in_array($outlistTmp['objId'], $firmsToShow)))
							{							
							$outlist[$count] = $outlistTmp;
							$outlist[$count]['value'] 		= '<strong>'.$outlistTmp['objName'].'</strong>:          '.$strAdrArr['firm_www'];
							$firmsToShow[] = $outlistTmp['objId'];
							$count ++;
							}																		
						} break;
					case '5': /*название стройки*/
						{
						if(($outlistTmp['objName'])&&(!in_array($outlistTmp['objId'], $objectsToShow)))
							{							
							$outlist[$count] = $outlistTmp;
							$outlist[$count]['value'] 		= '<strong>'.$outlistTmp['objName'].'</strong>'; //$strAdrArr['firm_name'];
							$objectsToShow[] = $outlistTmp['objId'];
							$count ++;
							}						
						} break;
					case '6': /*информация о стройке*/
						{
						if(($outlistTmp['objName'])&&(!in_array($outlistTmp['objId'], $objectsToShow)))
							{							
							$outlist[$count] = $outlistTmp;
							$outlist[$count]['value'] 		= '<strong>'.$outlistTmp['objName'].'</strong>:          '.$ROUT->getCuttedStringSmart($strAdrArr['obj_info'], $string, $cutSymNumInfo); 
							$objectsToShow[] = $outlistTmp['objId'];
							$count ++;
							}						
						} break;
					case '7': /*отдел продаж*/
						{
						if(($outlistTmp['objName'])&&(!in_array($outlistTmp['objId'], $objectsToShow)))
							{							
							$outlist[$count] = $outlistTmp;
							$outlist[$count]['value'] 		= '<strong>'.$outlistTmp['objName'].'</strong>:          '.$ROUT->getCuttedStringSmart($strAdrArr['obj_sales'], $string, $cutSymNumInfo); 
							$objectsToShow[] = $outlistTmp['objId'];
							$count ++;
							}						
						} break;
					case '8': /*адрес стройки*/
						{
						if(($outlistTmp['objName'])&&(!in_array($outlistTmp['objId'], $objectsToShow)))
							{							
							$outlist[$count] = $outlistTmp;
							$outlist[$count]['value'] 		= '<strong>'.$outlistTmp['objName'].'</strong>:          '.$strAdrArr['obj_adrString']; 
							$objectsToShow[] = $outlistTmp['objId'];
							$count ++;
							}						
						} break;
					case '9': /*сайт стройки*/
						{
						if(($outlistTmp['objName'])&&(!in_array($outlistTmp['objId'], $objectsToShow)))
							{							
							$outlist[$count] = $outlistTmp;
							$outlist[$count]['value'] 		= '<strong>'.$outlistTmp['objName'].'</strong>:          '.$strAdrArr['obj_www']; 
							$objectsToShow[] = $outlistTmp['objId'];
							$count ++;
							}						
						} break;
					case '10': /*категория статей*/
						{
						} 
					case '13': /*категория новостей*/
						{
						$strAdrArr = $NEWS->getCurTagSimple($list[$i]['obj_id']);
						if(($strAdrArr['cat_name'])&&(!in_array($strAdrArr['cat_id'], $newsToShow)))
							{							
							$outlist[$count]['objId'] 		= $list[$i]['obj_id'];	
							$outlist[$count]['type'] 		= $list[$i]['obj_type'];	
							$outlist[$count]['typeName'] 	= $objType[$list[$i]['obj_type']];	
							$outlist[$count]['objName'] 	= $strAdrArr['cat_name'];	
							$outlist[$count]['value'] 		= '<strong>'.$strAdrArr['cat_name'].'</strong>';
							$linkPref = ($list[$i]['obj_type'] == 1) ? '/news': '/doc' ;
							$outlist[$count]['link'] 		= $linkPref.'/key/'.$strAdrArr['cat_name'];	
							
							$newsToShow[] = $strAdrArr['cat_id'];
							$count ++;
							}
						} break;
					case '11': /*категория статей*/
						{
						} 
					case '14': /*название новости/статьи*/
						{
						$strAdrArr = $NEWS->getCurNewsSimple($list[$i]['obj_id']);
						if(($strAdrArr['news_name'])&&(!in_array($strAdrArr['news_id'], $newsToShow)))
							{
							$outlist[$count]['type'] 		= $list[$i]['obj_type'];	
							$outlist[$count]['objId'] 		= $list[$i]['obj_id'];	
							$outlist[$count]['objName'] 	= $strAdrArr['news_name']; 
							$outlist[$count]['value'] 		= $ROUT->getCuttedStringSmart($strAdrArr['news_name'], $string, $cutSymNumNews);
//							$outlist[$count]['typeName'] 	=  ($strAdrArr['news_parId']==1) ? 'newsName' : 'docName';
							$outlist[$count]['typeName'] 	=   $objType[$list[$i]['obj_type']];	

							$linkPref = ($strAdrArr['news_parId']==1) ? '/news/' : '/doc/';
							$outlist[$count]['link'] 		= $linkPref.date('Y/m/d/', strtotime($strAdrArr['news_date'])).$strAdrArr['news_nameTranslit'];

							$newsToShow[] = $strAdrArr['news_id'];
							$count ++;
							}
						} break;
					case '12': /*категория статей*/
						{
						} 
					case '15': /*текст новости/статьи*/
						{
						$strAdrArr = $NEWS->getCurNewsSimple($list[$i]['obj_id']);
						if(($strAdrArr['news_name'])&&(!in_array($strAdrArr['news_id'], $newsToShow)))
							{
							$outlist[$count]['type'] 		= $list[$i]['obj_type'];	
							$outlist[$count]['objId'] 		= $list[$i]['obj_id'];	
							$outlist[$count]['objName'] 	= $strAdrArr['news_name']; 
							$outlist[$count]['value'] 		= $ROUT->getCuttedStringSmart($strAdrArr['news_body'], $string, $cutSymNumNews);;
//							$outlist[$count]['typeName'] 	=  ($strAdrArr['news_parId']==1) ? 'newsBody' : 'docBody';
							$outlist[$count]['typeName'] 	=   $objType[$list[$i]['obj_type']];	
							$linkPref = ($strAdrArr['news_parId']==1) ? '/news/' : '/doc/';
							$outlist[$count]['link'] 		= $linkPref.date('Y/m/d/', strtotime($strAdrArr['news_date'])).$strAdrArr['news_nameTranslit'];

							$newsToShow[] = $strAdrArr['news_id'];
							$count ++;
							}
						} break;
					}	
				}
//			print_r($outlist);
			if($count)
				{
				usort($outlist, 'sortFastSearchResults'); 
				for($k=0; $k<sizeof($outlist); $k++)
					{
					$table .= $outlist[$k]['typeName'].'**'.addslashes($outlist[$k]['objName']);
					$table .= '**'.$stringOriginal.'**'.$outlist[$k]['value'].'**'.$outlist[$k]['link'];
					$table .= '##';	
					}
				}
			echo $table;
			}
		break;		
		case 'mapGlobalSearch': /*2012_12_17 поиск в картах по названию фирм. категориям, адресу, телефону*/
			{	
			chdir('..//');
//			$qStr = iconv("UTF-8","windows-1251",trim($qStr));
//			$qStr = iconv("windows-1251","UTF-8",trim($qStr));
			require_once('../classes/config.inc.php');			
			require_once("../classes/MySQL_class.php");
			require_once("../classes/GetContent_class.php");
			require_once("../classes/gd/GetOrg_class.php");	
			require_once("../classes/Rout_class.php");
			$ROUT = new Routine;
			$getOrg = new GetOrganization;
			$CNT = 		new GetContent;
			$CONST = $CNT->GetAllConfig();
//			$string = trim($qStr);
			$string = mb_strtolower(trim($qStr), 'UTF-8');
//			echo $string = $ROUT->strtolower_ru(trim($qStr));
			$curCity = $CONST['curCity'];
//			print_r($_GET);
			$geoStr = 'микрорайон_переулок_улица_проезд_проспект_бульвар_площадь';	
//			$geoArr = array('микрорайон', 'переулок', 'улица', 'проезд', 'проспект', 'бульвар', 'площадь');	

			$listLayer = 	$getOrg->getLayersOfSearchStr($string);
			$listOrg = 		$getOrg->getFirmsOfSearchStrExt($string, $curCity);			
			$listStreets = 		$getOrg->getStreetsOfSearchStr($string, $curCity);
			if(preg_match("/^[0-9\s-]+$/", $string) )
				{
///				echo 'numeric';
				$listPhones = 		$getOrg->getPhonesOfSearchStr(preg_replace('/\D*/', '', $string), $curCity);
				}
			else
				{
//				echo 'Not numeric';				
				}
//			print_r($listLayer);
//			print_r($listOrg);
//			print_r($listStreets);
//			print_r($listPhones);
			$table = '';
			if($listLayer)
				{
				for($i=0; $i<count($listLayer); $i++)
					{
					$table .= 'layer'.'**'.$listLayer[$i]['layer_name'].'**'.$string.'**'.$listLayer[$i]['layer_id'];
					$table .= '##';
					}
				}
			if($listOrg)
				{			
				for($i=0; $i<count($listOrg); $i++)
					{
					$table .= 'org'.'**<strong>'.$listOrg[$i]['firm_name'].'</strong>**'.$string.'**'.$listOrg[$i]['firm_id'];
					$table .= '##';
					}
				}
			if($listStreets)
				{		
				for($i=0; $i<count($listStreets); $i++)
					{					
					$strArr = explode(' ', $listStreets[$i]['prop_value']);					
					$skip = $hold =  0;
					for($k=0; $k<count($strArr); $k++)
						{
						$finded = mb_strtolower(trim($strArr[$k]), 'UTF-8');
//						echo $finded = strtolower(trim($strArr[$k]));
//						echo $finded = $ROUT->strtolower_ru(trim($strArr[$k]));
						if((stripos($geoStr, $finded) === false) && (stripos($finded, $string) !== false))
							$hold ++;
//						elseif((stripos($geoStr, $finded)!==false)
/*						if(stripos($finded, $string)===false)
							echo $finded.'   -    '.$string.'; '; */
						}
//					$hold = 1;
					if($hold)
						{
						$buildNumber = $getOrg->getObjectPropertiesSingle($listStreets[$i]['obj_id'], 3);
						$outStr = '<strong>'.$listStreets[$i]['firm_name'].'</strong>:   '.$listStreets[$i]['prop_value'].', '.$buildNumber;
						$table .= 'street'.'**'.$outStr.'**'.$string.'**'.$listStreets[$i]['prop_value'].'**'.$listStreets[$i]['obj_id'];
						$table .= '##';
						}
					}
				}
			if($listPhones)
				{				
				for($i=0; $i<count($listPhones); $i++)
					{
//					$outStr = '<strong>'.$listPhones[$i]['firm_name'].'</strong>:   '.$ROUT->makeCityPhone($listPhones[$i]['prop_value'], 0);
					$outStr = '<strong>'.$listPhones[$i]['firm_name'].'</strong>:   '.$listPhones[$i]['prop_value'];
					$table .= 'phone'.'**'.$outStr.'**'.$string.'**'.$listPhones[$i]['prop_value'].'**'.$listPhones[$i]['obj_id'];
					$table .= '##';
					}
				}
			echo $table;
			}
		break;		
		case 'companyNameExt': /*2012_11_06 список фирм в названии которых фигурирует...*/
			{	
			chdir('..//');
//			$string = iconv("UTF-8","windows-1251",trim($qStr));
			$string = trim($qStr);
			require_once('../classes/config.inc.php');			
			require_once("../classes/MySQL_class.php");
			require_once("../classes/GetContent_class.php");
			require_once("../classes/fs/GetOrg_class.php");	
			require_once("../classes/Rout_class.php");
			$ROUT = new Routine;
			$getOrg = new GetOrganization;
			$CNT = 		new GetContent;
			$CONST = $CNT->GetAllConfig();
			$curCity = $CONST['curCity'];
//			print_r($_GET);
			$strList = $getOrg->getFirmsOfSearchStrExt($string, $curCity);
//			print_r($strList);
			if($strList)
				{
				for($i=0; $i<count($strList); $i++)
					{
					$shortInfo = (trim($strList[$i]['firm_info']))?$ROUT->getSmartCutedString(strip_tags(trim($strList[$i]['firm_info'])), 300):'';
					$table = $strList[$i]['firm_name'].'**'.$string.'**'.$strList[$i]['firm_id'].
								'**'.$strList[$i]['firm_nameTranslit'].
								'**'.$strList[$i]['firm_www'].
								'**'.$shortInfo;
//					echo ($CONST['dinamicUTF8Convert'])?iconv("UTF-8", "windows-1251", $table):$table;
//					echo iconv("windows-1251", "UTF-8", $table);
//					echo ($CONST['dinamicUTF8Convert'])?iconv("windows-1251", "UTF-8", $table):$table;
					echo $table;
					echo '##';
					}
				} 
			}
		break;		
		case 'panPointName': /*2015_11_09 список объектов в панорамах и строек в названии которых фигурирует...*/
			{	
			chdir('..//');
//			$string = iconv("UTF-8","windows-1251",trim($qStr));
			$string = trim($qStr);
			require_once('../classes/config.inc.php');			
			require_once("../classes/MySQL_class.php");
			require_once("../classes/GetContent_class.php");
			require_once("../classes/fs/GetOrg_class.php");	
			require_once("../classes/Rout_class.php");
			require_once("../classes/fs/pan_class.php");	
			$getPan = new Panorama;
			$ROUT = new Routine;
			$getOrg = new GetOrganization;
			$CNT = 		new GetContent;
			$CONST = $CNT->GetAllConfig();
			$curCity = $CONST['curCity'];
//			print_r($_GET);
			$strListPan = $getPan->getPointsOfSearchStrExt($string);
			$strList = $getOrg->getConstrOfSearchStrExt($string, $curCity);
//			print_r($strList);
			$usedConstr = array();
			if($strListPan)
				{
				for($i=0; $i<count($strListPan); $i++)
					{
					$table = $strListPan[$i]['po_name'].'**'
							.$string.'**'
							.$strListPan[$i]['po_id'].'**'
							.'panPoint'.'**'
							.$strListPan[$i]['po_geoX'].'**'
							.$strListPan[$i]['po_geoY'];
					echo $table;
					echo '##';
					if($strListPan[$i]['constr_id'])
						$usedConstr[] = $strListPan[$i]['constr_id'];
					}
				} 
			if($strList)
				{
				for($i=0; $i<count($strList); $i++)
					{
					if(!in_array($strList[$i]['obj_id'], $usedConstr))
						{
						$table = $strList[$i]['obj_name'].'**'
								.$string.'**'
								.$strList[$i]['obj_id'].'**'
								.'constr'.'**'
								.$strList[$i]['obj_geoX'].'**'
								.$strList[$i]['obj_geoY'];
						echo $table;
						echo '##';
						}
					}
				} 
			}
		break;			
		case 'constrName': /*2014_08_08 список строек в названии которых фигурирует...*/
			{	
			chdir('..//');
//			$string = iconv("UTF-8","windows-1251",trim($qStr));
			$string = trim($qStr);
			require_once('../classes/config.inc.php');			
			require_once("../classes/MySQL_class.php");
			require_once("../classes/GetContent_class.php");
			require_once("../classes/fs/GetOrg_class.php");	
			require_once("../classes/Rout_class.php");
			$ROUT = new Routine;
			$getOrg = new GetOrganization;
			$CNT = 		new GetContent;
			$CONST = $CNT->GetAllConfig();
			$curCity = $CONST['curCity'];
//			print_r($_GET);
			$strList = $getOrg->getConstrOfSearchStrExt($string, $curCity);
//			print_r($strList);
			if($strList)
				{
				for($i=0; $i<count($strList); $i++)
					{
					$table = $strList[$i]['obj_name'].'**'.$string.'**'.$strList[$i]['obj_id'].
								'**'.$strList[$i]['obj_nameTranslit'].
								'**'.$strList[$i]['obj_www'].
								'**'.$shortInfo;
					echo $table;
					echo '##';
					}
				} 
			}
		break;		
		default: {}
		}
	}
elseif($imgType = trim($_GET['imgType']))	
	{
	switch ($imgType)
		{
		case 'cam': /*15_02_2012 рисуем картинку с камеры*/
			{
			} break;
		}
	}
function sortObjNameAsc($a, $b) 
	{	
//		$aa = trim(htmlspecialchars_decode($a['o_name'], ENT_QUOTES));
		$aa = str_replace(array("'",'"'),'',trim(htmlspecialchars_decode($a['o_name'], ENT_QUOTES)));
		$bb = str_replace(array("'",'"'),'',trim(htmlspecialchars_decode($b['o_name'], ENT_QUOTES)));
//		$bb = trim(htmlspecialchars_decode($b['o_name'], ENT_QUOTES));
/*		echo $aa.' = ';
		echo $bb; 
		echo '
';	*/	
		return strnatcmp($aa, $bb);
	}	
?>	