﻿<?
//echo __FILE__	;
$realPath = $ROUT->GetStartedUrlLvl($allMenu['curLabel']['link'], $allMenu['activeLink'], $uri);
$curURL = $realPath['url'];
$curURLLvl = $realPath['lvl'];
//echo $post[$curURLLvl];
if($fuckedSymbolPosition = strpos($post[$curURLLvl], '?'))	//неверная обрезка строки запроса URL -  оставляет в параметрах знак "?" и все что за ним
	$post[$curURLLvl] = substr($post[$curURLLvl], 0, $fuckedSymbolPosition);		
if((!trim($post[$curURLLvl])))
	$act = $allMenu['curNodeName'];
else
	$act = trim($post[$curURLLvl]);
$isMng = ($ACL->GetClosedParentRight($allMenu['curNodeId'])>1)?true:false;	

//print_r($allMenu);
//echo $fuckedSymbolPosition.' - '.$act;	
$error = 0;
$menuActive = '';
$feedFile = '../htdocs/realty.xml';
//$feedFile = '../realty.xml';

switch ($act)
	{	
//	case 'fap1;lk23':
	case 'fap':
		{
		Error_Reporting(E_ALL & ~E_NOTICE);
		echo 'fap
';
		require_once("../classes/gis/manage_class.php");	
		$MNG = new Manage;			
		$file = '../htdocs/parse/fap_add_2.csv';
//		$file = '../htdocs/parse/bsList.txt';
		$list =  file ($file);
		$count = $added = 0; $limit = 5;		
		$nameShortArr = array("Фельдшерско-акушерский пункт" => "ФАП", "Фельдшерский пункт" => "ФП");
		$depArr = array("Органы исполнительной власти в области здравоохранения субъектов Российской Федерации" => "Область", 
						"Министерство здравоохранения Российской Федерации" => "Минздрав РФ");
		$bsName = array();
		$bsList = array();
		foreach ($list as $line) {
			$lStrArr = explode(';', $line);
			$adrStr = 'Российская федерация, Иркутская область, '.$lStrArr[1].', '.$lStrArr[2]; //.' '.$lStrArr[6].' '.$lStrArr[7].'';
//			$adrStrFull = 'Российская федерация, Иркутская область, '.$lStrArr[1].', '.$lStrArr[2].' '.$lStrArr[6].' '.$lStrArr[7].'';
			$name = $lStrArr[2].' '.$nameShortArr[trim($lStrArr[8])];
			$info = '';
			$info .= '<p><b>Адрес: </b>';
			$info .= '<p id="location">'.$lStrArr[1].', '.$lStrArr[2].', '.$lStrArr[6].' '.$lStrArr[7];
			$info .= '</p><p><b>Специализация учреждения:</b>';
			$info .= '<p id="orgType">'.$lStrArr[8];
			$info .= '</p><p><b>Уровень учреждения:</b>';
			$info .= '<p id="orgLvl">'.$lStrArr[4];
			$info .= '</p><p><b>Вышестоящее учреждение:</b>';
			$info .= '<p id="orgParent">'.strtr($lStrArr[3], array('""' => '"', '"""' => '"'));
			$info .= '</p><p><b>Ведомственная принадлежность:</b>';
			$info .= '<p id="orgDep">'.$depArr[trim($lStrArr[5])];
			
			if(($count>0)&&($count<100)){
//				echo $name.': '.$info.'</br>';
				if($geo = geocoderOSM($adrStr, 1)){
//					echo 'coord: '.$geo['lat'].' - '.$geo['lon'].'<br><br>';
					$param['oName'] = $name;
					$param['oType'] = 0;
					$param['lStr'] = '_902';
					$param['lParentStr'] = '0_900';
					$param['oAbout'] =  '<h2>'.$name.'</h2>'.$info;
					$param['specParam'] =  '';
					$point[0] = array('lat' =>$geo['lat'], 'lng' => $geo['lon']);
					$newObj = $MNG->newObject($param);
					if($newObj['error'])
						{
						echo '_<error!/>'.$newObj['errorMsg'];
						}	
					else
						{
						print_r($param);						
						$pointsRes = $MNG->newObjectPoints($point, $newObj['last_id']);
						if($pointsRes['error'])
							{
							echo '_<error!/>'.$pointsRes['errorMsg'];
							}
						else
							{
							$added++;
							}
						}
				}
				else{
					echo '[ERROR] geoposition not found! <b>'.$name.'</b><br><br>';
				}
				
//				echo geocoderOSM($adrStr, 1).'</br>';
			}
			$count++;
			}
//		echo $adrStr;
		echo 'Position aded :'.$added;
//		print_r($lStrArr);
//		print_r($bsList);
		$templates = array();
	} break;	
		
	case 'bsqwe98':
		{
		Error_Reporting(E_ALL & ~E_NOTICE);
		echo 'bs
';
		require_once("../classes/gis/manage_class.php");	
		$MNG = new Manage;			
		$file = '../htdocs/parse/bsListAnsiEd.csv';
//		$file = '../htdocs/parse/bsList.txt';
		$list =  file ($file);
		$l1 = $l2 = $l3 = $l4 = '';
		$count = $added = 0; $limit = 10;
		$parent[0] = 1006;
		$parentStrStart = '0_999_1006';
		$trArr = array(" " => "", "°" => "",  "?" => "",  "В" => "", "\"" => "");
		$bsName = array();
		$bsList = array();
		foreach ($list as $line) {
			$count++;
			$lStrArr = explode(';', $line);
//			$coordStrArr = explode('"С/ ',  $lStrArr[5]);
			$coordStrArr = explode('"С ',  trim($lStrArr[5]));			
			if(count($coordStrArr)>1){
//				print_r($coordStrArr);
				$coordCnt = 0;
				$coordPair = array();
				foreach ($coordStrArr as $coordStr) {
	//				echo $coordStr.':		';
					$min = $sec = $grad = 0;
					if(strpos(trim($coordStr), '°')!== false){
						$grad =  	strtr(trim($ROUT->GetStrPrt(trim($coordStr), '°', 0)), $trArr);
						$min =  	intval($ROUT->GetStrPrt(trim($ROUT->GetStrPrt(trim($coordStr), '°', 1)), "'", 0));
						$sec =  	strtr($ROUT->GetStrPrt(trim($ROUT->GetStrPrt(trim($coordStr), '°', 1)), "'", 1), $trArr);
					}
					elseif(strpos(trim($coordStr), '?')!== false){
						$grad =  	strtr(trim($ROUT->GetStrPrt(trim($coordStr), '?', 0)), $trArr);
						$min =  	intval($ROUT->GetStrPrt(trim($ROUT->GetStrPrt(trim($coordStr), '?', 1)), "'", 0));
						$sec =  	strtr($ROUT->GetStrPrt(trim($ROUT->GetStrPrt(trim($coordStr), '?', 1)), "'", 1), $trArr);
					}
					else{
						$grad =  	strtr(trim($ROUT->GetStrPrt(trim($coordStr), ' ', 0)), $trArr);
						$min =  	intval(trim($ROUT->GetStrPrt(trim($coordStr), ' ', 1)));
						$sec =  	strtr(trim($ROUT->GetStrPrt(trim($coordStr), ' ', 2)), $trArr);
					}
					
					if(count($coordStrArr)>0)
						$coordPair[$coordCnt] = $grad +  ($min + $sec/60)/60;
					$coordCnt++;
					}
			$AzArr = explode('/',  trim($lStrArr[6]));
			$azList 	= array();
			$angleList 	= array();
				foreach ($AzArr as $azStr) {
					$az = 0;
					$azStr = trim($azStr);
					if(strpos(trim($azStr), '-')!== false){
						$azInterval = explode('-',  trim($azStr));
						if(($azInterval[0]>270)&&($azInterval[1]<100))
							$angle = abs((360 - $azInterval[0])  + $azInterval[1]); 
						else
							$angle = abs($azInterval[1]  - $azInterval[0]); 
						$az = $azInterval[0];
					} elseif(strpos(trim($azStr), 'круговая')!== false){
						$angle = 360;
						$az = 0;
					} else {
						$k = 0;
						if(($k = strpos(trim($azStr), '°'))||($k = strpos(trim($azStr), '?')))
							$az = substr($azStr, 0, $k);
						else
							$az = strtr($azStr, $trArr);
						$angle = 90;
					}
					$azList[] = $az;
					$angleList[] = $angle;
				}
				if(!in_array(trim($lStrArr[2]), $bsName)){
					$param = array();
//					$obj = array();
					$bsName[] = $lStrArr[2];
//					echo $obj['name'] = $lStrArr[2];
//					$obj['coord'] = array($coordPair[0], $coordPair[1]);
//					$obj['azimuth'] = $azList[0];
//					$obj['angle'] = $angleList[0];
					$info = '';
					$info .= '<p><b>Расположение: </b>';
					$info .= '<p id="location">'.strtr($lStrArr[4], array('""' => '"'));
					$info .= '</p><p><b>Тип БС: </b>';
					$info .= '<p id="type">'.$lStrArr[1];
					if($lStrArr[7]){						
						$info .= '</p><p><b>Арендодатель: </b>';
						$info .= '<p id="firm">'.strtr($lStrArr[7], array('""' => '"', '"""' => '"')).'</p>';
					}
					if($lStrArr[8]){						
						$info .= '</p><p><b>Дата установки: </b>';
						$info .= '<p id="date">'.$lStrArr[8].'</p>';
					}
					if($lStrArr[9]){						
						$info .= '</p><p><b>Примечания: </b>';
						$info .= '<p id="more">'.$lStrArr[9].'</p>';
//					$obj['info'] = '<h2>'.$obj['name'].'</h2>'.$info;
					}
					$param['oName'] = $lStrArr[2];
					$param['oType'] = 5;
					$param['lStr'] = '_901';
					$param['lParentStr'] = '0_900';
					$param['oAbout'] =  '<h2>'.$param['oName'].'</h2>'.$info;
					$param['specParam'] =  $azList[0].'_'.$angleList[0];
					$point[0] = array('lat' =>$coordPair[0], 'lng' => $coordPair[1]);
					$newObj = $MNG->newObject($param);
					if($newObj['error'])
						{
						echo '_<error!/>'.$newObj['errorMsg'];
						}	
					else
						{
						$pointsRes = $MNG->newObjectPoints($point, $newObj['last_id']);
						if($pointsRes['error'])
							{
							echo '_<error!/>'.$pointsRes['errorMsg'];
							}
						else
							{
							$added++;
							}
						}
					
//					$bsList[] = $obj;
					if((trim($lStrArr[3]))&&(!in_array(trim($lStrArr[3]), $bsName))){
						$bsName[] = $lStrArr[3];
						$param['oName'] = $lStrArr[3];
						$param['oAbout'] =  '<h2>'.$param['oName'].'</h2>'.$info;
						$param['specParam'] =  $azList[1].'_'.$angleList[1];
						$newObj = $MNG->newObject($param);
						if($newObj['error'])
							{
							echo '_<error!/>'.$newObj['errorMsg'];
							}	
						else
							{
							$pointsRes = $MNG->newObjectPoints($point, $newObj['last_id']);
							if($pointsRes['error'])
								{
								echo '_<error!/>'.$pointsRes['errorMsg'];
								}
							else
								{
								$added++;
								}
							}
						
/*						
						$obj['name'] = $lStrArr[3];
						$obj['azimuth'] = $azList[1];
						$obj['angle'] = $angleList[1];
						$obj['info'] = '<h2>'.$obj['name'].'</h2>'.$info;
						$bsList[] = $obj;*/
					}
				}
//				echo  $lStrArr[6].'			'.$azList[0].' - <b>'.$angleList[0].'</b>			'.$azList[1].' - <b>'.$angleList[1].'</b><br>';
//				echo /* $lStrArr[5].*/'			'.$coordPair[0].'			'.$coordPair[1].'<br>';
			}
//			echo $count.' - '.count($lStrArr).'</br>';
		}
		echo 'Position aded :'.$added;
//		print_r($lStrArr);
//		print_r($bsList);
/*		
							$point[0] = array('lat' => $coordPair[0], 'lng' => $coordPair[1]);
							$newObj = $MNG->newObject($param);
							if($newObj['error'])
								{
								echo '_<error!/>'.$newObj['errorMsg'];
								}	
							else
								{
								$pointsRes = $MNG->newObjectPoints($point, $newObj['last_id']);
								if($pointsRes['error'])
									{
									echo '_<error!/>'.$pointsRes['errorMsg'];
									}
								else
									{
									$ret = $newObj['last_id'];
									$o2l = $MNG->addObj2Layer($layerList, $newObj['last_id']);
									$added++;
									}
								}
*/		
		
		$templates = array();
	} break;	
//	case 'obj2distrцук': 
	case 'obj2distr': 
		{
		Error_Reporting(E_ALL & ~E_NOTICE);
		echo 'obj2dist
';		require_once("../classes/gis/manage_class.php");	
		$MNG = new Manage;	
//		$lList = $MNG->getObjListOfLayer('997', 1);
		$lList = $MNG->getObjListOfLayer('1007');
//		$oList = $MNG->getObjListOfLayer('1000');
		$oList = $MNG->getObjListOfLayer('902');
		echo 'oList count = '.count($oList); 
//		print_r($lList);
//		$startId = 1100;
//		$find = 0;
		foreach ($lList as $distr) {
			$find = 0;
			$count = 0;
			if(/*(($distr['o_id'] != 4385)&&($distr['o_id'] != 4405)&&($distr['o_id'] != 4384)&&($distr['o_id'] != 4409))&&*/(count($distr['geo']) > 10)){
				$lStrArr = explode('_', $distr['o_lStr']);
				foreach ($oList as $obj) {
					if((count($obj['geo']) == 1)&&($obj['l_id']==0)&& ($obj['o_id']>6147)){
						$size = count($distr['geo']);
						$j = $size - 1;
						$result = 0;
						$res = false;
						for ($i = 0; $i < $size; $i++) {
							if ( 	((($distr['geo'][$i]['c_lat'] < $obj['geo'][0]['c_lat']) && ($distr['geo'][$j]['c_lat'] >= $obj['geo'][0]['c_lat'])) ||
									(($distr['geo'][$j]['c_lat'] < $obj['geo'][0]['c_lat']) && ($distr['geo'][$i]['c_lat'] >= $obj['geo'][0]['c_lat']))) &&
									($distr['geo'][$i]['c_lng'] + ($obj['geo'][0]['c_lat'] - $distr['geo'][$i]['c_lat']) / 
									($distr['geo'][$j]['c_lat'] - $distr['geo'][$i]['c_lat']) * ($distr['geo'][$j]['c_lng'] - $distr['geo'][$i]['c_lng']) < $obj['geo'][0]['c_lng']) ){
									$result++;
									$res = !$res;
									}
							$j = $i;
						}
//						$count++;
//						echo $result.'_';
//						if($result/2 != ceil($result/2) ){
						if($res){
//							if(!$find)
								$MNG->addObj2Layer($lStrArr[2], $obj['o_id']);
								$MNG->incObj2LyerCnt($lStrArr[2]);			
							$find ++;
							echo '<br>'.$result.' : '.$obj['o_name'].'<br>';
						}
					}
				}
				echo '<br>find : '.$find.' ;';
//				echo $count;
			}
			echo $distr['o_id'].': '.$distr['o_name'].'; points num: '.count($distr['geo']).'; <br>';
		}
		$templates = array();
		}break;	
	case 'distr2layersцук': 
		{
		require_once("../classes/gis/manage_class.php");	
		$MNG = new Manage;	
		$lList = $MNG->getObjListOfLayer('997', 1);
//		$lList = $MNG->getObjListOfLayer('1007', 1);
		print_r($lList);
		$startId = 1100;
		foreach ($lList as $layer) {
			$lStrArr = explode('_', $layer['o_lParentStr']);
			$layerParent = $lStrArr[0].'_'.$lStrArr[1].'_'.$lStrArr[2].'_'.$lStrArr[3].'_'.$lStrArr[4].'_'.$lStrArr[5].'_'.$lStrArr[6];
			$layerStr = $layer['o_lStr'].'_1007';
				$MNG->updateObject(array(	0=>array('name' => 'o_lParentStr', 'val' => $layerParent),
											1=>array('name' => 'o_lStr', 'val' => $layerStr)), $layer['o_id']);
//				$MNG->incObj2LyerCnt($startId);
//				$lUp = $MNG->updateLayer(array(0=>array('name' => 'l_childCnt', 'val' => $newChildCnt)), $layer['l_parId']);
		/*	$startId ++;
			$param['lId'] = $startId; 
			$param['lName'] = str_replace(array('ого', 'района', '_Границы'), array('ий', 'район', ''), $layer['o_name']); 
			$param['l_parStr'] = '0_997';
			$param['l_parId'] = '997';
			$param['l_info'] = $param['lName'];
			$nL = $MNG->newLayer($param);
			echo $startId.'</br>';
			if(!$nL['error']){
				$lStrArr = explode('_', $layer['o_lStr']);
				$layerParent = $layer['o_lParentStr'].'_997';
				$layerStr = $lStrArr[0].'_'.$lStrArr[1].'_'.$startId;
				$MNG->updateObject(array(	0=>array('name' => 'o_lParentStr', 'val' => $layerParent), 
											1=>array('name' => 'o_lStr', 'val' => $layerStr)), $layer['o_id']);
				$MNG->incObj2LyerCnt($startId);
			$startId ++;
			}*/
		}
		
		$templates = array();
		}break;
		
	case 'oBoundsцук': 
		{
		require_once("../classes/gis/manage_class.php");	
		$MNG = new Manage;	
		$objList = $MNG->getAllObj();
		foreach ($objList as $obj) {
//			if($obj['o_id']<2000)
			if(($obj['o_id']>=0)/*&&($obj['o_id']<4000)*/)
			{
//				$param['']
				$bounds = $MNG->getObjBounds($obj['o_id']);
				if($bounds){
					$MNG->updateObject(array(
											0=>array(	'name' => 'o_latMax', 
											'val' => $bounds['maxLat']
											),
											1=>array(	'name' => 'o_latMin', 
											'val' => $bounds['minLat']
											),
											2=>array(	'name' => 'o_lngMax', 
											'val' => $bounds['maxLng']
											),
											3=>array(	'name' => 'o_lngMin', 
											'val' => $bounds['minLng']
											)),
										$obj['o_id']);
					echo 'obj '.$obj['o_id'].': '. $bounds['minLat'].'; '. $bounds['maxLat'].'; '. $bounds['minLng'].'; '. $bounds['maxLng'].'; '.'<br>';}
				else 
					echo 'obj '.$obj['o_id'].' : 1 point object;  ';
//				print_r($layerArr);
//				echo 'obj '.$obj['o_id'].': '. $obj['minLat'].'; '. $obj['maxLat'].'; '. $obj['minLng'].'; '. $obj['maxLng'].'; '.'<br>';						
//				$MNG->updateObject(array(0=>array('name' => 'o_lParentStr', 'val' => $layerParent)), $obj['o_id']);
			}
		}
		
		$templates = array();
		}break;	
	case 'hasChildцук': 
		{
		require_once("../classes/gis/manage_class.php");	
		$MNG = new Manage;	
		$lList = $MNG->getAllLayers();
		foreach ($lList as $layer) {
//			if($obj['o_id']<2000)
			if($layer['l_objCnt']>0)
			{	
				$layerSingle = $MNG->getSingleLayer($layer['l_parId']);
				$newChildCnt = $layerSingle['l_childCnt']+1;
					$objUp = $MNG->updateLayer(array(0=>array('name' => 'l_childCnt', 'val' => $newChildCnt)), $layer['l_parId']);
			}
		}
		
		$templates = array();
		}break;
	case 'oCntцук': 
		{
		require_once("../classes/gis/manage_class.php");	
		$MNG = new Manage;	
		$objList = $MNG->getAllObj();
		foreach ($objList as $obj) {
//			if($obj['o_id']<2000)
			if(($obj['o_id']>=0)/*&&($obj['o_id']<4000)*/)
			{
//				$param['']
				$layerParent = '';
				$layerArr1 = explode('_', $obj['o_lStr']);
				$layerArr2 = explode('_', $obj['o_lParentStr']);
				$layerArr = array_merge($layerArr1, $layerArr2); 
				foreach ($layerArr as $layerId)
					{
					if($layerId)	
						{
						$objUp = $MNG->incObj2LyerCnt($layerId);
						}
					}
//				print_r($layerArr);
//				echo 'obj '.$obj['o_id'].': '.$layerParent.'<br>';						
//				$MNG->updateObject(array(0=>array('name' => 'o_lParentStr', 'val' => $layerParent)), $obj['o_id']);
			}
		}
		
		$templates = array();
		}break;
	case 'lstrцук': 
		{
		require_once("../classes/gis/manage_class.php");	
		$MNG = new Manage;	
		$objList = $MNG->getAllObj();
		foreach ($objList as $obj) {
//			if($obj['o_id']<2000)
			if(($obj['o_id']>=2000)&&($obj['o_lParentStr'] == '' ))
			{
//				$param['']
				$layerParent = '';
				$layerArr = explode('_', $obj['o_lStr']);
				foreach ($layerArr as $layerId)
					{
					if($layerId)	
						{
						$layerSingle = $MNG->getSingleLayer($layerId);
//						print_r($layerSingle);
//						echo $layerId.': '.$layerSingle['l_parStr'].'<br>';
						$layerArr2 = explode('_', $layerSingle['l_parStr']);
						foreach ($layerArr2 as $layerId2)
							{
							if(($layerId2) && (strpos($layerParent, '_'.$layerId2)=== false))
								{
								$layerParent .= '_'.$layerId2;
								}
							}
						}
					}
//				print_r($layerArr);
//				echo 'obj '.$obj['o_id'].': '.$layerParent.'<br>';						
				$MNG->updateObject(array(0=>array('name' => 'o_lParentStr', 'val' => $layerParent)), $obj['o_id']);
			}
		}
		
		$templates = array();
		}break;
	case 'kdцук':
		{
		$objSrc = '../htdocs/parse/irk.xml/';
		$dir = opendir($objSrc);
		echo 'kd
';
		require_once("../classes/gis/manage_class.php");	
		$MNG = new Manage;			
		$file = '../htdocs/parse/kd1.txt';
		$list =  file ($file);
		$lvl = array(0=>'', 1=>'  ', 2=>'    ', 3=>'      ', 4=>'        ', 5=>'          ');
		$l1 = $l2 = $l3 = $l4 = '';
		$count = 0; $limit = 10;
		$parent[0] = 1006;
		$parentStrStart = '0_999_1006';
		foreach ($list as $line) {
			if($limit > $count){
			$tmpArr = explode(';', $line);
			if($tmpArr[0]){
				$tmpArr1[0] = str_replace(array(' ', '/','\\'), '', $tmpArr[0]);
				$tmpArr[1] = trim($tmpArr[1]);
//				$tmpArr[1] = str_replace(array('/','\\'), '', $tmpArr[1]);
				$l1_tmp = $tmpArr1[0][0].$tmpArr1[0][1];
				$l2_tmp = $tmpArr1[0][2].$tmpArr1[0][3];
				$l3_tmp = $tmpArr1[0][4].$tmpArr1[0][5].$tmpArr1[0][6];
				if((!$l1)||($l1_tmp!=$l1 )){	
					$curLvl = 0;
					$l1 = $l1_tmp; 
					$l2 = $l3 = $l4 = '';
					$parentStr = $parentStrStart;
					$parent[1] = $parent[2] = $parent[3] = '';
				}
				elseif((!$l2)||($l2_tmp!=$l2)){
					$curLvl = 1;
					$l2 = $l2_tmp;
					$l3 = $l4 = '';
					$parentStr = $parentStrStart.'_'.$parent[1];
					$parent[2] = $parent[3] = '';
				}
				elseif((!$l3)||($l3_tmp!=$l3)){
					$curLvl = 2;
					$l3 = $l3_tmp;
					$l4 = '';
					$parentStr = $parentStrStart.'_'.$parent[1].'_'.$parent[2];
					$parent[3] = '';
				}
				elseif((!$l4)||($l4_tmp!=$l4)){
					$curLvl = 3;
					$l4 = $l4_tmp;
					$parentStr = $parentStrStart.'_'.$parent[1].'_'.$parent[2].'_'.$parent[3];
				}			
				$param['lName'] = ''.$tmpArr[0].' - '.htmlspecialchars(trim($tmpArr[1]), ENT_QUOTES);
				$param['l_parId'] = $parent[$curLvl]; 			  
				$param['l_parStr'] = $parentStr; 			  
				$param['l_childCnt'] = 0;  
				$param['l_objCnt'] = 0;  
				$param['l_info'] = '';  
				$param['l_public'] = 0;  
				$param['l_system'] = 0; 
				
				$newObj = $MNG->newLayer($param);
				if($newObj['error'])
					{
					echo '_<error!/>'.$newObj['errorMsg'];
					}	
				else
					{
					$parent[$curLvl+1] = $newObj['last_id'];
					}
				
				echo $lvl[$curLvl].$tmpArr[0].' - '.$tmpArr[1].' (lvl '.$curLvl.')
';	
/*				echo $tmpArr[0].';'.$tmpArr[1].'
';	*/
				}
//			$count ++;
			}
			}
		$templates = array();
		}break;
	case 'okopfцук':
		{
		$objSrc = '../htdocs/parse/irk.xml/';
		$dir = opendir($objSrc);
		echo 'okopf
';
		require_once("../classes/gis/manage_class.php");	
		$MNG = new Manage;			
		$file = '../htdocs/parse/okopf.txt';
		$list =  file ($file);
		$lvl = array(0=>'', 1=>'  ', 2=>'    ', 3=>'      ', 4=>'        ', 5=>'          ');
		$l1 = $l2 = $l3 = $l4 = '';
		$count = 0; $limit = 10;
		$parent[0] = 1004;
		$parentStrStart = '0_999_1004';
		foreach ($list as $line) {
			if($limit > $count){
			$tmpArr = explode(';', $line);
			if($tmpArr[0]){
				$tmpArr1[0] = str_replace(array(' ', '/','\\'), '', $tmpArr[0]);
				$tmpArr[1] = trim($tmpArr[1]);
//				$tmpArr[1] = str_replace(array('/','\\'), '', $tmpArr[1]);
				$l1_tmp = $tmpArr1[0][0];
				$l2_tmp = $tmpArr1[0][1].$tmpArr1[0][2];
				$l3_tmp = $tmpArr1[0][3].$tmpArr1[0][4];
				if((!$l1)||($l1_tmp!=$l1 )){			
					$curLvl = 0;
					$l1 = $l1_tmp; 
					$l2 = $l3 = $l4 = '';
					$parentStr = $parentStrStart;
					$parent[1] = $parent[2] = $parent[3] = '';
				}
				elseif((!$l2)||($l2_tmp!=$l2)){
					$curLvl = 1;
					$l2 = $l2_tmp;
					$l3 = $l4 = '';
					$parentStr = $parentStrStart.'_'.$parent[1];
					$parent[2] = $parent[3] = '';
				}
				elseif((!$l3)||($l3_tmp!=$l3)){
					$curLvl = 2;
					$l3 = $l3_tmp;
					$l4 = '';
					$parentStr = $parentStrStart.'_'.$parent[1].'_'.$parent[2];
					$parent[3] = '';
				}
				elseif((!$l4)||($l4_tmp!=$l4)){
					$curLvl = 3;
					$l4 = $l4_tmp;
					$parentStr = $parentStrStart.'_'.$parent[1].'_'.$parent[2].'_'.$parent[3];
				}			
				$param['lName'] = $tmpArr[0].' - '.htmlspecialchars(trim($tmpArr[1]), ENT_QUOTES); 
				$param['l_parId'] = $parent[$curLvl]; 			  
				$param['l_parStr'] = $parentStr; 			  
				$param['l_childCnt'] = 0;  
				$param['l_objCnt'] = 0;  
				$param['l_info'] = '';  
				$param['l_public'] = 0;  
				$param['l_system'] = 0; 
				
				$newObj = $MNG->newLayer($param);
				if($newObj['error'])
					{
					echo '_<error!/>'.$newObj['errorMsg'];
					}	
				else
					{
					$parent[$curLvl+1] = $newObj['last_id'];
					}
				
				echo $lvl[$curLvl].$tmpArr[0].' - '.$tmpArr[1].' (lvl '.$curLvl.')
';	
				}
//			$count ++;
			}
			}
		$templates = array();
		}break;
	case 'okfssdfsdf':
		{
		$objSrc = '../htdocs/parse/irk.xml/';
		$dir = opendir($objSrc);
		$subj = array();
		$insType = array();
		$locality = array();
		$region = array();
		$city = array();
		$oktmo = array();
		
		$localityCnt = $regionCnt = $cityCnt = $fullCnt = $insCnt = $noCoord = $added = $sbjCnt = $oktmoCnt = 0;
		require_once("../classes/gis/manage_class.php");	
		$MNG = new Manage;			
		$file = '../htdocs/parse/okfs.txt';
		$list =  file ($file);
		$lvl = array(0=>'', 1=>'  ', 2=>'    ', 3=>'      ', 4=>'        ', 5=>'          ');
		$l1 = $l2 = $l3 = $l4 = '';
		$count = 0; $limit = 100;
		$parent[0] = 1003;
		$parentStrStart = '0_999_1003';
		foreach ($list as $line) {
			if($count < $limit){
				$tmpArr = explode(';', trim($line));
				if($tmpArr[0]){
					$codeStr = $tmpArr[0];
					if(($codeStr=='10')||($codeStr=='20')||($codeStr=='30')){
						$curLvl = 0;
						$parentStr = $parentStrStart;
						$parent[1] = $parent[2] = $parent[3] =  $parent[4] = '';
					}
					else{
						$curLvl = 1;
						$parentStr = $parentStrStart.'_'.$parent[1];
						$parent[2] = $parent[3] =  $parent[4] = '';
					}
				$param['lName'] = $tmpArr[0].' - '.htmlspecialchars($tmpArr[1], ENT_QUOTES); 
				$param['l_parId'] = $parent[$curLvl]; 			  
				$param['l_parStr'] = $parentStr; 			  
				$param['l_childCnt'] = 0;  
				$param['l_objCnt'] = 0;  
				$param['l_info'] = '';  
				$param['l_public'] = 0;  
				$param['l_system'] = 0; 
				
				$newObj = $MNG->newLayer($param);
				if($newObj['error'])
					{
					echo '_<error!/>'.$newObj['errorMsg'];
					}	
				else
					{
					$parent[$curLvl+1] = $newObj['last_id'];
					}
					
				echo $lvl[$curLvl].$tmpArr[0].' - '.$tmpArr[1].'(lvl '.$curLvl.')
';	
			
		}
//		$count++;
		}
		}
		$templates = array();
		}
		break;	
	case 'okvedsdfsdfs':
		{
		$objSrc = '../htdocs/parse/irk.xml/';
		$dir = opendir($objSrc);
		$subj = array();
		$insType = array();
		$locality = array();
		$region = array();
		$city = array();
		$oktmo = array();
		
		$localityCnt = $regionCnt = $cityCnt = $fullCnt = $insCnt = $noCoord = $added = $sbjCnt = $oktmoCnt = 0;
		require_once("../classes/gis/manage_class.php");	
		$MNG = new Manage;			
		$file = '../htdocs/parse/okved.txt';
		$list =  file ($file);
		$lvl = array(0=>'', 1=>'  ', 2=>'    ', 3=>'      ', 4=>'        ', 5=>'          ');
		$l1 = $l2 = $l3 = $l4 = '';
		$count = 0; $limit = 100;
		$parent[0] = 1001;
		$parentStrStart = '0_999_1001';
		foreach ($list as $line) {
			if($count < $limit){
				$tmpArr = explode(';', trim($line));
				if($tmpArr[0]){
					$codeStr = str_replace('.', '', $tmpArr[0]);
					if(strlen($codeStr)<3){
						$curLvl = 0;
						$parentStr = $parentStrStart;
						$parent[1] = $parent[2] = $parent[3] =  $parent[4] = '';
					}
					elseif(strlen($codeStr)<4){
						$curLvl = 1;
						$parentStr = $parentStrStart.'_'.$parent[1];
						$parent[2] = $parent[3] =  $parent[4] = '';
					}
					elseif(strlen($codeStr)<5){
						$curLvl = 2;
						$parentStr = $parentStrStart.'_'.$parent[1].'_'.$parent[2];
						$parent[3] =  $parent[4] = '';
					}
					elseif(strlen($codeStr)<6){
						$curLvl = 3;
						$parentStr = $parentStrStart.'_'.$parent[1].'_'.$parent[2].'_'.$parent[3];
						$parent[4] = '';
					}			
					elseif(strlen($codeStr)<7){
						$curLvl = 4;
						$parentStr = $parentStrStart.'_'.$parent[1].'_'.$parent[2].'_'.$parent[3].'_'.$parent[4];
					}			
				$param['lName'] = $tmpArr[0].' - '.htmlspecialchars($tmpArr[1], ENT_QUOTES); 
				$param['l_parId'] = $parent[$curLvl]; 			  
				$param['l_parStr'] = $parentStr; 			  
				$param['l_childCnt'] = 0;  
				$param['l_objCnt'] = 0;  
				$param['l_info'] = '';  
				$param['l_public'] = 0;  
				$param['l_system'] = 0; 
				
				$newObj = $MNG->newLayer($param);
				if($newObj['error'])
					{
					echo '_<error!/>'.$newObj['errorMsg'];
					}	
				else
					{
					$parent[$curLvl+1] = $newObj['last_id'];
					}
					
				echo $lvl[$curLvl].$tmpArr[0].' - '.$tmpArr[1].'(lvl '.$curLvl.')
';	
			
		}
//		$count++;
		}
		}
		$templates = array();
		}
		break;
	case 'oktmosdfsdfs':
		{
		$objSrc = '../htdocs/parse/irk.xml/';
//		$objSrc = '../htdocs/parse/irk.xml/test/';
//		$fp = fopen($mapFile, "w");		
		$dir = opendir($objSrc);
		$subj = array();
		$insType = array();
		$locality = array();
		$region = array();
		$city = array();
		$oktmo = array();
		
		$localityCnt = $regionCnt = $cityCnt = $fullCnt = $insCnt = $noCoord = $added = $sbjCnt = $oktmoCnt = 0;
		require_once("../classes/gis/manage_class.php");	
		$MNG = new Manage;			
//			echo 'oktmo';
		$file = '../htdocs/parse/oktmo1.csv';
		$file2 = '../htdocs/parse/oktmo2.csv';
		$list =  file ($file);
		$list2 =  file ($file2);
		$lvl = array(0=>'', 1=>'  ', 2=>'    ', 3=>'      ', 4=>'        ', 5=>'          ');
		$l1 = $l2 = $l3 = $l4 = '';
		$lines2 = $tmp= $parent =array();
		foreach ($list2 as $line2) {
			$lineC2 = iconv("windows-1251", "UTF-8", $line2); 
			$tmpArr2 = explode(';', $lineC2);
			if($tmpArr2[0]){
				$tmpArr2[0] = str_replace(' ', '', $tmpArr2[0]);
				$key = substr($tmpArr2[0], 0, 8);
				if($tmpArr2[0][8].$tmpArr2[0][9].$tmpArr2[0][10]!='000'){
					$tmp['code']	= $tmpArr2[0];
					$tmp['name']	= trim($tmpArr2[1]);
					$lines2[$key][]	= $tmp;
				}
/*			else
				echo $tmpArr2[0].'
';*/
			}
			
		}
		$count = 0; $limit = 100;
		$parent[0] = 1005;
		$parentStrStart = '0_999_1002_1005';
		foreach ($list as $line) {
			if($limit > $count){
			$lineC = iconv("windows-1251", "UTF-8", $line); 
			$tmpArr = explode(';', $lineC);
			if($tmpArr[0]){
				$tmpArr[0] = str_replace(array(' ', '/','\\'), '', $tmpArr[0]);
				$tmpArr[1] = str_replace(array('/','\\'), '', $tmpArr[1]);
				$l1_tmp = $tmpArr[0][2];
				$l2_tmp = $tmpArr[0][3].$tmpArr[0][4];
				$l3_tmp = $tmpArr[0][5];
				$l4_tmp = $tmpArr[0][6].$tmpArr[0][7];
				if((!$l1)||($l1_tmp!=$l1 )){			
					$curLvl = 0;
					$l1 = $l1_tmp; 
					$l2 = $l3 = $l4 = '';
					$parentStr = $parentStrStart;
					$parent[1] = $parent[2] = $parent[3] = '';
				}
				elseif((!$l2)||($l2_tmp!=$l2)){
					$curLvl = 1;
					$l2 = $l2_tmp;
					$l3 = $l4 = '';
					$parentStr = $parentStrStart.'_'.$parent[1];
					$parent[2] = $parent[3] = '';
				}
				elseif((!$l3)||($l3_tmp!=$l3)){
					$curLvl = 2;
					$l3 = $l3_tmp;
					$l4 = '';
					$parentStr = $parentStrStart.'_'.$parent[1].'_'.$parent[2];
					$parent[3] = '';
				}
				elseif((!$l4)||($l4_tmp!=$l4)){
					$curLvl = 3;
					$l4 = $l4_tmp;
					$parentStr = $parentStrStart.'_'.$parent[1].'_'.$parent[2].'_'.$parent[3];
				}			
				$param['lName'] = htmlspecialchars($tmpArr[1], ENT_QUOTES).' ('.$tmpArr[0].')'; 
				$param['l_parId'] = $parent[$curLvl]; 			  
				$param['l_parStr'] = $parentStr; 			  
				$param['l_childCnt'] = 0;  
				$param['l_objCnt'] = 0;  
				$param['l_info'] = '';  
				$param['l_public'] = 0;  
				$param['l_system'] = 0; 
				
				$newObj = $MNG->newLayer($param);
				if($newObj['error'])
					{
					echo '_<error!/>'.$newObj['errorMsg'];
					}	
				else
					{
					$parent[$curLvl+1] = $newObj['last_id'];
					}
				
				echo $lvl[$curLvl].$tmpArr[1].' ('.$tmpArr[0].') (lvl '.$curLvl.')
';	
				if(($curLvl == 3)||($curLvl == 1)){					
					if(isset($lines2[$tmpArr[0]])){
						$parentStr = $parentStrStart.'_'.$parent[1].'_'.$parent[2].'_'.$parent[3].'_'.$parent[4];
						foreach ($lines2[$tmpArr[0]] as $item) {
						$param1['lName'] = htmlspecialchars($item['name'], ENT_QUOTES).' ('.$item['code'].')'; 
						$param1['l_parId'] = $parent[$curLvl+1]; 			  
						$param1['l_parStr'] = $parentStr; 			  
						$param1['l_childCnt'] = 0;  
						$param1['l_objCnt'] = 0;  
						$param1['l_info'] = '';  
						$param1['l_public'] = 0;  
						$param1['l_system'] = 0; 
						$newObj1 = $MNG->newLayer($param1);
						if($newObj1['error'])
							{
							echo '_<error!/>'.$newObj1['errorMsg'];
							}	
						else
							{
//							$parent[$curLvl+1] = $newObj1['last_id'];
							}
						
						echo $lvl[$curLvl+1].$item['name'].' ('.$item['code'].') (lvl '.($curLvl+1).')
';
						}
					}
					
				}
		
			}
			}
//		$count++;
		}
		
		$templates = array();
		} 
	break;
	case 'kazgen': 
		{
			echo 'казген!!';
		}break;
	case 'kazgen234': 
		{
		$objSrc = '../htdocs/parse/irk.xml/';
//		$objSrc = '../htdocs/parse/irk.xml/test/';
//		$fp = fopen($mapFile, "w");		
		$dir = opendir($objSrc);
		$subj = array();
		$insType = array();
		$locality = array();
		$region = array();
		$city = array();
		$oktmo = array();
		$okfs = array();
		$okopf = array();
		
		$localityCnt = $regionCnt = $cityCnt = $fullCnt = $insCnt = $noCoord = $added = $sbjCnt = $oktmoCnt = $okfsCnt = $okopfCnt = 0;
		require_once("../classes/gis/manage_class.php");	
		$MNG = new Manage;	
		$koktmo = $MNG->getAllLayersOfParent(1002);
		$kokved = $MNG->getAllLayersOfParent(1001);
		$kokfs = $MNG->getAllLayersOfParent(1003);
		$kokopf = $MNG->getAllLayersOfParent(1004);
		$kokd = $MNG->getAllLayersOfParent(1006);
//		print_r($kokopf);
		while($file = readdir($dir))
			{
			if (($file!=".")&&($file!=".."))
				{
				$fullCnt++;
				/*$srcFileArr = $ROUT->getFileName($delImg[$i]);*/
//				echo $file.'<br>';
				$obj = array();
				$point = array();
//				$content = file($file);
				$data =  simplexml_load_file($objSrc.$file);
				$obj['fullName'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->initiator->fullName) ? $tmp->__toString():'';
				$obj['regNum'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->initiator->regNum) ? $tmp->__toString():'';
				$obj['inn'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->initiator->inn) ? $tmp->__toString():'';
				$obj['kpp'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->initiator->kpp) ? $tmp->__toString():'';
				$obj['chiefPosition'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->other->chief->position) ? $tmp->__toString():'';
				$obj['chiefFirstName'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->other->chief->firstName) ? $tmp->__toString():'';
				$obj['chiefMiddleName'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->other->chief->middleName) ? $tmp->__toString():'';
				$obj['chiefLastName'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->other->chief->lastName) ? $tmp->__toString():'';
				$obj['insTypeCode'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->additional->institutionType->code) ? $tmp->__toString():'';
				$obj['phone'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->additional->phone) ? $tmp->__toString():'';
				$obj['www'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->additional->www) ? $tmp->__toString():'';
				$obj['eMail'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->additional->eMail) ? $tmp->__toString():'';
				$obj['shortName']= ($tmp = $data->children('ns2', 'true')->body->position->children()
									->main->shortName) ? $tmp->__toString():'';
				$obj['oktmoName'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->main->classifier->oktmo->name) ? $tmp->__toString():'';
				$obj['oktmoCode'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->main->classifier->oktmo->code) ? $tmp->__toString():'';
				$obj['okved'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->main->classifier->okved->code) ? $tmp->__toString():'';
				$obj['okopf'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->main->classifier->okopf->code) ? $tmp->__toString():'';
				$obj['okopfName'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->main->classifier->okopf->name) ? $tmp->__toString():'';
				$obj['okfs'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->main->classifier->okfs->code) ? $tmp->__toString():'';
				$obj['okfsName'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->main->classifier->okfs->name) ? $tmp->__toString():'';
				$obj['okpo']	 = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->main->classifier->okpo) ? $tmp->__toString():'';
				$obj['ogrn']	 = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->main->ogrn) ? $tmp->__toString():'';
				$obj['adrSubject'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->main->complexAddress->address->subject->name) ? $tmp->__toString():'';
				$obj['adrSubjectCode'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->main->complexAddress->address->subject->code) ? $tmp->__toString():'';
				$obj['adrRegion'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->main->complexAddress->address->region->name) ? $ROUT->first_letter_up($tmp->__toString(), 'utf-8'):'';
				$obj['adrRegionCode'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->main->complexAddress->address->region->code) ? trim($tmp->__toString()):'';
				$obj['adrLocality'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->main->complexAddress->address->locality->name) ? $tmp->__toString():'';
				$obj['adrLocalityCode'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->main->complexAddress->address->locality->code) ? $tmp->__toString():'';
				$obj['adrCity'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->main->complexAddress->address->city->name) ? $ROUT->first_letter_up($tmp->__toString(), 'utf-8'):'';
				$obj['adrCityCode'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->main->complexAddress->address->city->code) ? $tmp->__toString():'';
				$obj['adrStreet'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->main->complexAddress->address->street->name) ? $tmp->__toString():'';
				$obj['adrBuilding'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->main->complexAddress->address->building) ? $tmp->__toString():'';
				$obj['coordLong'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->main->complexAddress->coordinates->longitude) ? $tmp->__toString():'';
				$obj['coordLat'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->main->complexAddress->coordinates->latitude) ? $tmp->__toString():'';
				$obj['insTypeName'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->additional->institutionType->name) ? $tmp->__toString():'';
				$obj['insTypeCode'] = ($tmp = $data->children('ns2', 'true')->body->position->children()
									->additional->institutionType->code) ? $tmp->__toString():'';
				
				$obj['adrRegion'] = str_replace(" р-н", "", $obj['adrRegion']);					
				$obj['www'] = str_replace("http://", "", $obj['www']);					
				$obj['eMail'] = str_replace("http://", "", $obj['eMail']);					
				
				
				
//				print_r($obj);				
			if($obj['adrSubjectCode'] == '38000000000')						
				{
				$info = '<h2>'.$obj['fullName'].'</h2>';
				$info .= '<p><b>Регистрационный номер в каталоге Казначейста: </b>';
				$info .= ($obj['regNum'])?'<span id="regNum">'.$obj['regNum'].'</span>' : '-';
				$info .= '</p><p><b>ИНН: </b>';
				$info .= ($obj['inn'])?'<span id="inn">'.$obj['inn'].'</span>' : '-';
				$info .= '</p><p><b>КПП: </b>';
				$info .= ($obj['kpp'])?'<span id="kpp">'.$obj['kpp'].'</span>' : '-';
				$info .= '</p><p><b>ОГРН: </b>';
				$info .= ($obj['ogrn'])?'<span id="ogrn">'.$obj['ogrn'].'</span>' : '-';
				$info .= '</p><p><b>ОКПО: </b>';
				$info .= ($obj['okpo'])?'<span id="okpo">'.$obj['okpo'].'</span>' : '-';
				$info .= '</p><p><b>Руководитель: </b>';
				$info .= ($obj['chiefLastName'])?'<span id="chief">'.$obj['chiefLastName']: '';
				$info .= ($obj['chiefFirstName'])?' '.$obj['chiefFirstName'] : '';
				$info .= ($obj['chiefMiddleName'])?' '.$obj['chiefMiddleName'] : '';
				$info .= ($obj['chiefPosition'])?' ('.$obj['chiefPosition'].')': '';
				$info .= '</span>'.'</p><p><b>Телефон: </b>';
				$info .= ($obj['phone'])?'<span id="phone">'.$obj['phone'].'</span>' : '-';
				$info .= '</p><p><b>Электронная почта: </b>';
				$info .= ($obj['eMail'])?'<span id="eMail">'.$obj['eMail'].'</span>' : '-';
				$info .= '</p><p><b>Вебсайт: </b>';
				$info .= ($obj['www'])?'<span id="www">'.$obj['www'].'</span>' : '-';
				$info .= '</p><p><b>Адрес: </b> '.'<span id="adr">'.$obj['adrSubject'].', ';
				$info .= ($obj['adrRegion'])?$obj['adrRegion'].', ' : '';
				$info .= ($obj['adrCity'])?$obj['adrCity'].', ' : '';
				$info .= ($obj['adrLocality'])?$obj['adrLocality'].', ' : '';
				$info .= ($obj['adrStreet'])?$obj['adrStreet'].' ' : '';
				$info .= ($obj['adrBuilding'])?$obj['adrBuilding'].' ' : '';
				$info .= '</span>'.'</p>';
				$param['oName'] = htmlspecialchars($obj['shortName'], ENT_QUOTES);  
				
				$param['oType'] = 0; 
				$param['oSpecParam'] = 'kazna'; 			  
				$param['oAbout'] = $info; 			  
				$param['oTemplate'] = 1;  
				$param['lId'] = 1000;  
	//			print_r($param);

	

//					if(!($fullCnt/400 - floor($fullCnt/400)))
					if(($fullCnt>=3000)&&($fullCnt<4000))
						{
						$layerList = array();
						foreach ($kokopf as $kitem) {
							if(strpos(str_replace(" ", "",  $kitem['l_name']), $obj['okopf'])!==false)
								{
//										echo '<br>okopf: '.$kitem['l_name'].': '.$kitem['l_id'];
										$layerList[] =  $kitem['l_id'];
										break;
								}
							}	
						foreach ($koktmo as $kitem) {
							if(strpos(str_replace(" ", "",  $kitem['l_name']), $obj['oktmoCode'])!==false)
								{
//										echo '<br>oktmo: '.$kitem['l_name'].': '.$kitem['l_id'];
										$layerList[] =  $kitem['l_id'];
										break;
								}
							}	
						foreach ($kokved as $kitem) {
							if(strpos(str_replace(" ", "",  $kitem['l_name']), $obj['okved'])!==false)
								{
										$layerList[] =  $kitem['l_id'];
//										echo '<br>okved: '.$kitem['l_name'].': '.$kitem['l_id'];
										break;
								}
							}	
						foreach ($kokfs as $kitem) {
							if(strpos(str_replace(" ", "",  $kitem['l_name']), $obj['okfs'])!==false)
								{
										$layerList[] =  $kitem['l_id'];
//										echo '<br>okfs: '.$kitem['l_name'].': '.$kitem['l_id'];
										break;
								}
							}	
						foreach ($kokd as $kitem) {
							if(strpos(str_replace(" ", "",  $kitem['l_name']), $obj['insTypeCode'])!==false)
								{
										$layerList[] =  $kitem['l_id'];
//										echo '<br>kokd: '.$kitem['l_name'].': '.$kitem['l_id'];
										break;
								}
							}
						$layerList[] = 1000;
						if(($obj['coordLat'])&&($obj['coordLong']))
							{
							$point[0] = array('lat' => $obj['coordLong'], 'lng' => $obj['coordLat']);
							$newObj = $MNG->newObject($param);
							if($newObj['error'])
								{
								echo '_<error!/>'.$newObj['errorMsg'];
								}	
							else
								{
								$pointsRes = $MNG->newObjectPoints($point, $newObj['last_id']);
								if($pointsRes['error'])
									{
									echo '_<error!/>'.$pointsRes['errorMsg'];
									}
								else
									{
									$ret = $newObj['last_id'];
									$o2l = $MNG->addObj2Layer($layerList, $newObj['last_id']);
									$added++;
									}
								}
							}
						else
							{
							$noCoord++;
							
							}
							
						}
	//				if(!in_array($obj['insTypeCode'], $insType))
/*					if($obj['okopf'])
						{
						$okopfCnt++;
						$okopf[$obj['okopf']]['name'] = $obj['okopfName'];
						$okopf[$obj['okopf']]['code'] = $obj['okopf'];
						$okopf[$obj['okopf']]['cnt'] = ($okopf[$obj['okopf']]['cnt'])?$okopf[$obj['okopf']]['cnt']+1:1;
						}
					if($obj['okfs'])
						{
						$okfsCnt++;
						$okfs[$obj['okfs']]['name'] = $obj['okfsName'];
						$okfs[$obj['okfs']]['code'] = $obj['okfs'];
						$okfs[$obj['okfs']]['cnt'] = ($okfs[$obj['okfs']]['cnt'])?$okfs[$obj['okfs']]['cnt']+1:1;
						}
					if($obj['oktmoCode'])
						{
						$oktmoCnt++;
						$oktmo[$obj['oktmoCode']]['name'] = $obj['oktmoName'];
						$oktmo[$obj['oktmoCode']]['code'] = $obj['oktmoCode'];
						$oktmo[$obj['oktmoCode']]['cnt'] = ($subj[$obj['oktmoCode']]['cnt'])?$subj[$obj['oktmoCode']]['cnt']+1:1;
						}
					if($obj['adrSubject'])
						{
						$sbjCnt++;
						$subj[$obj['adrSubject']]['name'] = $obj['adrSubject'];
						$subj[$obj['adrSubject']]['code'] = $obj['adrSubjectCode'];
						$subj[$obj['adrSubject']]['cnt'] = ($subj[$obj['adrSubject']]['cnt'])?$subj[$obj['adrSubject']]['cnt']+1:1;
						}
					if($obj['insTypeName'])
						{
						$insCnt++;
						$insType[$obj['insTypeCode']]['name'] = $obj['insTypeCode'].';'.$obj['insTypeName'];
						$insType[$obj['insTypeCode']]['cnt'] = ($insType[$obj['insTypeCode']]['cnt'])?$insType[$obj['insTypeCode']]['cnt']+1:1;
						}
					if($obj['adrLocality'])
						{
						$localityCnt++;
						$locality[$obj['adrLocality']]['code'] = $obj['adrLocalityCode'];
						$locality[$obj['adrLocality']]['name'] = $obj['adrLocality'];
						$locality[$obj['adrLocality']]['cnt'] = ($locality[$obj['adrLocality']]['cnt'])?$locality[$obj['adrLocality']]['cnt']+1:1;
						}
						
					if($obj['adrCity'])
						{
						$cityCnt++;
						$city[$obj['adrCity']]['code'] = $obj['adrCityCode'];
						$city[$obj['adrCity']]['name'] = $obj['adrCity'];
						$city[$obj['adrCity']]['cnt'] = ($city[$obj['adrCity']]['cnt'])?$city[$obj['adrCity']]['cnt']+1:1;
						}
						
					if($obj['adrRegion'])
						{
						$regionCnt++;
						$region[$obj['adrRegion']]['name'] = $obj['adrRegion'];
						if(!$region[$obj['adrRegion']]['code'])
							$region[$obj['adrRegion']]['code'] = ($obj['adrRegionCode'])?$obj['adrRegionCode']:'';
						$region[$obj['adrRegion']]['cnt'] = ($region[$obj['adrRegion']]['cnt'])?$region[$obj['adrRegion']]['cnt']+1:1;
						}*/
						

				}
			}				
			}
		echo 'Добавлено в базу объектов - '.$added.'; объектов без координат - '.$noCoord.'<hr> ';
		echo '	Всего файлов с организациями - '.$fullCnt.'; <hr>
				Найдено видов деятельности - '.count($insType).'; <br>
				Организаций с указанной деятельность - '.$insCnt.'; <hr>
				Найдено локаций (хз что это - "locality") - '.count($locality).'; <br>
				Организаций с указанной локацией - '.$localityCnt.'; <hr>
				Найдено городов - '.count($city).'; <br>
				Организаций с указанным городом  - '.$cityCnt.'; <hr>
				Найдено районов  - '.count($region).'; <br>
				Организаций с указанным районом  -  - '.$regionCnt.'; <hr>
				Найдено ОКОПФ  - '.count($okopf).'; <br>
				Организаций с указанным ОКОПФ  -  - '.$okopfCnt.'; <hr>
				Найдено ОКФС  - '.count($okfs).'; <br>
				Организаций с указанным ОКФС  -  - '.$okfsCnt.'; <hr>
				Найдено ОКТМО  - '.count($oktmo).'; <br>
				Организаций с указанным ОКТМО  -  - '.$oktmoCnt.'; <hr>
				Найдено областей  - '.count($subj).'; <br>
				Организаций с указанной областью  -  - '.$sbjCnt;
		$templates = array();
/*		ksort($subj);
		ksort($insType);
		ksort($city);
		ksort($locality);
		ksort($region);
		ksort($oktmo);
		ksort($okfs);
		ksort($okopf);
//		print_r($insType);
/*		foreach ($insType as $kitem) {
			echo '<br>'.$kitem['name'];
			}	*/
/*		echo '***************************************************
	region:
';						
		print_r($region);
		echo '***************************************************
	city:
';			
		print_r($city);
		echo '***************************************************
	locality:
';						
		print_r($locality);*/
		} break;
	case 'main': 
		{
		}
	break;
	default :
		{
		$error=404;
		}
	};
if($error==404)	
	{
	$messBodyNews=($CONST['debugMode'])?'Запрошенная Вами страница не найдена (from '.__FILE__ .', '. __FUNCTION__ .', '. __LINE__ .')':'Запрошенная Вами страница не найдена';
	$MESS = new Message('Error', 'ERROR 404', $messBodyNews, $NAV->GetPrewURI());											
	}
if(isset($MESS))
	{	
	$templates = array();	
/*	$_SESSION['MESSAGE'] = $MESS;
	header('Location: /');	*/
	}
elseif($REDIRECT)
	{
	header('Location: '.$REDIRECT);	
	}
else
	{
	$SMRT['modules'][] =  array('name' => 'menuActive', 	'body' => ($menuActive) ? $menuActive : $act);		
	
	if(isset($titleForShare))
		$SMRT['modules'][] =  array('name' => 'shareButton', 'body' => array('link' => 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'],
																		'title' => $titleForShare.' на сайте ГОРОД-ДЕТЯМ.РФ'));		
	if(isset($metaDescription))
		{
		$SMRT['modules'][] =  array('name' => 'meta', 'body' => array(	'keywords' => $metaKewords,
																		'description' => $metaDescription));	
		}
	}
function geocoderOSM($locStr, $onlyCoord = 0){
//		$query = $_POST['location'].', '.$_POST['str'];
	$ret = '';
	$URI = 'http://nominatim.openstreetmap.org/search?q='.urlencode($locStr).'&format=xml';
	$context = stream_context_create(array(
		'http' => array(
				'method'=>"GET",
					'content' => $reqdata = http_build_query(array(
				)),
				'header' => implode("\r\n", array(
						"Content-Length: " . strlen($reqdata),
						"User-Agent: SyberiaGisBot/0.1",
						"Connection: Close",
						""
				))
	)));			
	if (false === $response = file_get_contents($URI, false, $context)) 
		{
//		$ret = '<empty>';
//		$ret = '0';
//				return false;
		}
	else	
		{
		$xml = simplexml_load_string($response);
		$coord = array();
		foreach($xml->place->attributes() as $a => $b) {
			$ret .=  $a.'='.$b."##";
			if($a == 'lat')
				$coord['lat'] = $b;
			if($a == 'lon')
				$coord['lon'] = $b;
			}
//		echo 'query='.$query."##";
		}
	if((!$onlyCoord)||(!$ret))
		return $ret;
	else
		return $coord;
}
?>