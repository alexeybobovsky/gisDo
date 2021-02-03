<?php
//require_once("main.inc.php");
class Apartments
	{
	var $last_query;
	var $child = array();
	var $idInUse = array();
	var $childNum;
	var $childLevel;
	var $rekCount;
/******************TEMPLATE***********************************************************************/	
/******************GETTERS***********************************************************************/	
	function getConstrName($objName) /*2016_02_20 генерация заголовка квартиры*/
		{
		$obj_nameLower = mb_strtolower(trim($objName), 'UTF-8');
		if(strpos($obj_nameLower, 'жк')!==false)
			{
			if($pos =  strpos($objName, ','))
				$objName = substr($objName, 0, $pos);
			if($pos =  strpos($objName, '('))
				$objName = substr($objName, 0, $pos);
			}
		elseif(strpos($obj_nameLower, 'ул. ')!==false)
			{
			if($pos =  strpos($objName, '('))
				$objName = substr($$objName, 0, $pos);
			}
		return $objName;
		}
	function getApInfoTemplate($obj)  /*2015_08_20 получение списка квартир в стройке, по параметрам*/
		{
		$objStateReplace1 = 	array(1 => 'строящемся доме', 2 => 'новостройке');
		$objStateReplace2 = 	array(1 => 'дом будет построен', 2 => 'дом готов');
		$objStateReplace3 = 	array(1 => 'окончание строительства', 2 => 'дом сдан');
		$distr	= 				array(1 => 'Правобережном', 2 => 'Октябрьском', 3 => 'Свердловском', 4 => 'Ленинском');
		$price1 = 				($obj['ap_price'])?' Стоимость квартиры '.$obj['ap_price'].' тыс. рублей.':' Цена договорная.';
		$price2 = 				($obj['ap_price'])?' за '.$obj['ap_price'].' тыс. рублей.':' по договорной цене.';
		$price3 = 				($obj['ap_price'])?' стоимостью '.$obj['ap_price'].' тыс. рублей':' по договорной цене';
		$dateEnd11 = 			($obj['obj_dateEnd'])?' Окончание строительства - '.$obj['obj_dateEnd'].'.':'';
		$dateEnd12 = 			($obj['obj_dateEnd'])?' Дата окончания строительства - '.$obj['obj_dateEnd'].'.':'';
		$objName =  $this->getConstrName($obj['obj_name']);
		$textArray = array(
			'Продаётся '.$obj['ap_roomNum'].'-комнатная квартира в '.$objStateReplace1[$obj['obj_state']].' 
			в '.$distr[$obj['obj_district']].' районе Иркутска по адресу: '.$obj['obj_adrString'].'.
			Площадь квартиры '.$obj['ap_area'].' кв. м. '.$obj['finish'].' отделка, на '.$obj['ap_floor'].' этаже в '.$objName.'. '
			.$dateEnd11.' Прямая продажа от застройщика.'.$price1, 
			
			'В '.$objStateReplace1[$obj['obj_state']].' '.$objName.' в '.$distr[$obj['obj_district']].
			' районе Иркутска по адресу: '.$obj['obj_adrString'].' продаётся '.$obj['ap_roomNum'].
			'-комнатная квартира, площадью '.$obj['ap_area'].' кв. м. '.$price2.' Квартира расположена на '.
			$obj['ap_floor'].' этаже, отделка - '.$obj['finish'].'. '.$dateEnd11.' Квартира реализуется застройщиком.', 
			
			'Застройщик реализует '.$obj['ap_roomNum'].'-комнатную квартиру в '.$objStateReplace1[$obj['obj_state']].' '.$objName
			.' площадью '.$obj['ap_area'].' кв. м. '.$price2.' Дом расположен в '.$distr[$obj['obj_district']].
			' районе Иркутска по адресу: '.$obj['obj_adrString'].'. '.$obj['ap_floor'].' этаж, '.$obj['finish'].' отделка. '.$dateEnd11,
			
			'Квартира от застройщика! В '.$objStateReplace1[$obj['obj_state']].' '.$objName.' продаётся '.$obj['ap_roomNum'].
			'-комнатная квартира, '.$price3.', площадью '.$obj['ap_area'].' квадр. м. Квартира располагается по адресу: '.$obj['obj_adrString'].
			' в '.$distr[$obj['obj_district']].' районе города Иркутска. Отделка - '.$obj['finish'].', '.$obj['ap_floor'].' этаж. '.$dateEnd12,
			
			'Застройщик продает '.$obj['ap_roomNum'].'-комнатную квартиру  в '.$objStateReplace1[$obj['obj_state']].' '.$objName.' по адресу: '.$obj['obj_adrString'].
			' в '.$distr[$obj['obj_district']].' районе города Иркутска. Квартира площадью '.$obj['ap_area'].' квад. м. расположена на '.
			$obj['ap_floor'].' этаже, отделка - '.$obj['finish'].'.'.$dateEnd12.' '.$price1
			);

		$descrIndex = 	$obj['ap_id'] - floor($obj['ap_id']/5)*5; 
		return $textArray[$descrIndex];		
//		return $textArray[4];		
		}
	function getApListOfObjMore($param)  /*2015_08_20 получение списка квартир в стройке, по параметрам*/
		{
//		$param['price'] = (isset($param['price']))
/*		$qStart = ($param['distr'])? 'SELECT distinct ap_objId, obj_name, ap_blockSection, gd_firm.firm_id, firm_name, ap_roomNum, ap_area, ap_floor,
			ap_finish, ap_price, ap_dateModify, ap_info, ap_sold ':' SELECT * ';*/
		$qStart = ' SELECT * ';
		$query = $qStart.'
					FROM fs_apartment, gd_object, gd_firm
					WHERE gd_firm.firm_id = obj_firmZakaz 				
					AND obj_id = ap_objId
					AND  (ap_sold != 1 OR  ap_sold IS NULL) '; 
		$query .= ($param['include'])?'AND ap_objId = \''.$param['include'].'\' ': '';
		$query .= ($param['exclude'])?'AND ap_objId != \''.$param['exclude'].'\' ': '';
		$query .= ($param['bs'])?'AND 	ap_blockSection = \''.$param['bs'].'\' ': '';
		$query .= ($param['distr'])?'AND obj_district = \''.$param['distr'].'\' ': '';
		$query .= ($param['price'])?'AND ap_price >= \''.($param['price']-20).'\' AND  ap_price <= \''.($param['price']+20).'\'': '';
		$query .= ($param['roomNum'])?'AND 	ap_roomNum = \''.$param['roomNum'].'\' ': '';
//		$query .= ($param['roomNum'])?'	AND ap_objId = \''.intval($objId).'\' AND 	ap_roomNum = \''.$param['roomNum'].'\' ': '';
		$query .=	'ORDER BY ap_area, ap_price';
		$ret_arr  = array(	'ap_id', 
							'obj_name', 
							'ap_objId', 
							'ap_blockSection', 
							'firm_id', 
							'firm_name', 
							'ap_roomNum', 
							'ap_area', 
							'ap_floor', 
							'ap_finish', 
							'ap_price', 
							'ap_dateModify', 
							'ap_info', 
							'ap_sold');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
//			$retTmp = $LNK->GetData($ret_arr, true);
			$ret = $LNK->GetData($ret_arr, true);
			for($i=0; $i<sizeof($ret); $i++)
				{
				$ret[$i]['img'] = $this->getApFileList($ret[$i]['ap_id']);
				}
			
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}
	function getApSingleSiteMap($apSingle) /*2014_04_29 генерация заголовка по фильтру*/
		{
		$title = '';
//		$title = $titleRP =  '';
		$title .=  ($apSingle['ap_roomNum']) ? $apSingle['ap_roomNum'].' комнатная квартира ' : '';
//				$title .=  ' квартира';
		$title .=  (!$title)? 'Квартира ' : '';
		$title .=  ($apSingle['ap_price']) ? 'стоимостью '.(number_format($apSingle['ap_price']/1000, 2, '.', ' ')).' млн. рублей ':' по договорной цене ';
		$title .=  (!$title)? 'Квартира ' : '';
		$title .=  ($apSingle['ap_area']) ? 'площадью '.$apSingle['ap_area'].' кв. м. ':'';
		$title .=  (!$title)? 'Квартира ' : '';
		$title .=  'в '.$apSingle['obj_name'];		
		return $title;
		}
	function _getApSingleSiteMap($apSingle) /*2014_04_29 генерация заголовка по фильтру*/
		{
/*		$title = array('IP' => '', 'RP' => '');
//		$title = $titleRP =  '';
		$title['IP'] .=  ($apSingle['ap_roomNum']) ? $apSingle['ap_roomNum'].' комнатная квартира' : '';
		$title['RP'] .=  ($apSingle['ap_roomNum']) ? $apSingle['ap_roomNum'].' комнатной квартиры' : '';
//				$title .=  ' квартира';
		$title['IP'] .=  (($apSingle['ap_price'])&&(!$title['IP'])) ? 'квартира стоимостью '.$apSingle['ap_price'].' тыс. рублей':' стоимостью '.$apSingle['ap_price'].' тыс. рублей';
		$title['RP'] .=  (($apSingle['ap_price'])&&(!$title['IP'])) ? 'квартиры стоимостью '.$apSingle['ap_price'].' тыс. рублей': '';
		$title['IP'] .=  (($apSingle['ap_area'])&&(!$title['IP'])) ? 'квартира площадью '.$apSingle['ap_area'].' кв. метра': '';
		$title['RP'] .=  (($apSingle['ap_area'])&&(!$title['IP'])) ? 'квартиры площадью '.$apSingle['ap_area'].' кв. метра': '';
		$title['IP'] .=  ($apSingle['obj_name']) ? ' в '.$apSingle['obj_name']: '';
		$title['RP'] .=  ($apSingle['obj_name']) ? ' в '.$apSingle['obj_name']: '';		
		
		return $title;*/
		}
	function getApTitleSmall($ap, $constrName) /*2015_08_20 генерация заголовка-превью квартиры*/
		{
		$title .=  		($ap['ap_roomNum']) ? $ap['ap_roomNum'].' комнатная,' : '';
		$title .=  		($ap['ap_area']) 	? ' площадью <span class="fontSize20">'.$ap['ap_area'].'</span>  метров<sup>2</sup>' : '';
		$title .=  		($ap['ap_floor']) 	? ' на <span class="fontSize20">'.$ap['ap_floor'].'</span> этаже':'';
		$title .=  		($constrName) ? ' в '.$constrName: '';
///		$title .=  		($ap['ap_price']) ? ' стоимостью <span class="fontSize16">'.$ap['ap_price'].'</span> тыс. рублей': ' по договорной цене';
		return $title;		
		}	
	function getApTitle($ap) /*2015_08_20 генерация заголовка квартиры*/
		{
		$title = $titleExt = $titleRP = $titleShort = '';
		$objName = $ap['obj_name'];
		$obj_nameLower = mb_strtolower(trim($ap['obj_name']), 'UTF-8');
		if(strpos($obj_nameLower, 'жк')!==false)
			{
			if($pos =  strpos($objName, ','))
				$objName = substr($objName, 0, $pos);
			if($pos =  strpos($objName, '('))
				$objName = substr($objName, 0, $pos);
			}
		elseif(strpos($obj_nameLower, 'ул. ')!==false)
			{
			if($pos =  strpos($objName, '('))
				$objName = substr($$objName, 0, $pos);
			}		
		$priceStrK = ($ap['ap_price'])?number_format($ap['ap_price'], 0, '.', ' '):'';
		$titleShort .=  		($ap['ap_roomNum']) ? $ap['ap_roomNum'].' комн. ' : '';
		$titleShort .= 			($ap['obj_name']) ? ' в '.$objName: '';
		$titleShort .=  		($ap['ap_price']) ? ' за '.$priceStrK.' тыс. р.' : '';

		$titleUniq .=  		($ap['ap_roomNum']) ? $ap['ap_roomNum'].' комн. квартира' : '';
		$titleUniq .= 		($ap['obj_name']) ? ' в '.$objName: '';
		$titleUniq .=  		($ap['ap_price']) ? ' стоимостью '.$priceStrK.' тыс. р.' : '';
		$titleUniq .=		($ap['ap_id']) ? ' (объявление № '.$ap['ap_id'].')' : '';
		
		$title .=  		($ap['ap_roomNum']) ? $ap['ap_roomNum'].' комнатная квартира' : '';
		$title .=  		($ap['ap_price']) ? ' стоимостью '.$priceStrK.' тыс. рублей': ' площадью '.$ap['ap_area'].' кв. метра';
		$title .=  		($ap['obj_name']) ? ' в '.$ap['obj_name']: '';

		$titleExt .=  		($ap['ap_roomNum']) ? $ap['ap_roomNum'].' комн. квартира' : '';
		$titleExt .=  		($ap['ap_price']) ? ' за '.$priceStrK.' тыс. рублей': ' площадью '.$ap['ap_area'].' кв. метра';
		$titleExt .=  		($ap['ap_floor']) ? ' на '.$ap['ap_floor'].' этаже':'' ;
		$titleExt .=  		($ap['obj_name']) ? ' в '.$ap['obj_name']: '';
		$titleExt .=  		($ap['ap_id'])	? ' (объявление о продаже № '.$ap['ap_id'].')' : '';
		
		$titleRP .=  	($ap['ap_roomNum']) ? $ap['ap_roomNum'].' комнатной квартиры' : '';
		$titleRP .=  	($ap['ap_price']) ? ' стоимостью '.$priceStrK.' тыс. рублей': ' площадью '.$ap['ap_area'].' кв. метра';
		$titleRP .=  	($ap['obj_name']) ? ' в '.$ap['obj_name']: '';
		
		return array('t1' => $title, 't2' => $titleExt, 't3' => $titleRP, 't4' => $titleShort, 't5' => $titleUniq);		
		}
	function getApFilterTitle($filter) /*2014_04_29 генерация заголовка по фильтру*/
		{
		$title = '';
//		print_r($filter);
		
		if($filter['state'] > 0)
			{
			$title .=  ($filter['state']==1) ? 'Строящиеся ' : 'Готовые ';			
			}
		if($filter['room'] > 0)
			{
			if ($filter['room']<4) 
				{
				$title .=  $filter['room'].' - комнатные ';
				}
			else
				$title .=  ($filter['state'] > 0) ? 'многокомнатные ' : ' Многокомнатные ';
				
			$title .=  'квартиры в новостройках';		
			}
		elseif($filter['state'] > 0)
			$title .=  'квартиры в новостройках';		
		else
			$title .=  'Квартиры в новостройках';
		switch($filter['district'])
			{
			case 1 :
				$title .= ' в Правобережном районе';
			break;
			case 2 :
				$title .= ' в Октябрьском районе';
			break;
			case 3 :
				$title .= ' в Свердловском районе';
			break;
			case 4 :
				$title .= ' в Ленинском районе';
			break;
			default : $title .= '';
			}
		$title .=  ' Иркутска';	
		if($filter['areaStart'] > 0)
			$title .=  ' площадью от '.$filter['areaStart'];	
		if($filter['areaEnd'] > 0)
			{
			$title .=  ($filter['areaStart'] > 0) ? ' до' : ' площадью до'; 
			$title .=  ' '.$filter['areaEnd']; 			
			}
		if(($filter['areaStart'] > 0)||($filter['areaEnd'] > 0))
			$title .=  ' кв. метров';		

		if($filter['priceStart'] > 0)
			$title .=  ' стоимостью от '.number_format($filter['priceStart']/1000, 2, '.', ' ');	
		if($filter['priceEnd'] > 0)
			{
			$title .=  ($filter['priceStart'] > 0) ? ' до' : ' стоимостью до'; 
			$title .=  ' '.number_format($filter['priceEnd']/1000, 2, '.', ' '); 			
			}
		if(($filter['priceStart'] > 0)||($filter['priceEnd'] > 0))
			$title .=  ' млн. рублей';			
		return $title;				
		}	
	function getApMainPaige($filter)  /*2014_10_29 получение списка по фильтру*/
		{
		$ret['cnt'] = 	$this->getApListByFilter($filter, 1);
		$ret['price'] = $this->getApListByFilter($filter, 0, 1);
		return($ret);
//		$minPrice = $this->getApMinPriceByFilter($filter, 1);
		}
	function getApListPopular($city, $limit=100)  /*2014_10_29 получение списка по фильтру*/
		{
		$query = 'SELECT *, fs_apartment.firm_id as firmId  FROM fs_apartment, gd_object, gd_firm
					WHERE ap_objId = obj_id 
					AND fs_apartment.firm_id = gd_firm.firm_id 
					AND  (ap_sold != 1 OR  ap_sold IS NULL) 
					AND gd_object.city_id = '.$city.'
					ORDER BY ap_viewCnt DESC, ap_dateModify DESC limit '.$limit;
		$ret_arr  = array(	
							'ap_id', 
							'ap_objId', 
							'firmId', 
							'ap_blockSection', 
							'ap_roomNum', 
							'ap_viewCnt', 
							'ap_area', 
							'ap_floor', 
							'ap_finish', 
							'ap_price', 
							'ap_info', 
							'ap_dateModify', 
							'ap_sold',
							'obj_id', 
							'obj_name', 
							'obj_geoX', 
							'obj_geoY', 
							'obj_state', 
							'obj_district', 
							);
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		$distrReplace = 	array(1 => 'Правобережный', 2 => 'Октябрьский', 3 => 'Свердловский', 4 => 'Ленинский');
		$objStateReplace = 	array(1 => 'В процессе', 2 => 'Готова', 3 => 'В планах', 4 => 'Заморожена');
		$finishReplace = 	array(1 => 'черновая', 2 => 'получистовая', 3 => 'чистовая');
//		echo 'session: '; 
//		print_r($_SESSION['apCmp']);
		if($LNK->GetNumRows())
			{
			$ret = $LNK->GetData($ret_arr, true);
			for($i=0; $i<sizeof($ret); $i++)
				{			
				$ret[$i]['district'] = 	$distrReplace[$ret[$i]['obj_district']];
				$ret[$i]['state'] =	 	$objStateReplace[$ret[$i]['obj_state']];
				$ret[$i]['finish'] =	$finishReplace[$ret[$i]['ap_finish']];
				$ret[$i]['img'] = $this->getApFileList($ret[$i]['ap_id']);
				if($_SESSION['apCmp'])
					$ret[$i]['cmp'] = (in_array($ret[$i]['ap_id'], $_SESSION['apCmp'])) ? 1 : 0;
				}
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}
	function getApListByFilter($filter, $onlyCnt=0, $minPrice=0)  /*2014_10_29 получение списка по фильтру*/
		{
/*		if(!$onlyCnt)
			$onlyCnt = 0;*/
//		print_r($filter);
		$whereMinAdd = '';
		if($onlyCnt)
			$rows = 'COUNT(*)';
		elseif($minPrice)
			{
			$whereMinAdd = ' AND  ap_price >0 ';
			$rows = 'MIN(ap_price) as minPrice';
			}
		else
			$rows = '*, fs_apartment.firm_id as firmId';

		$filterSimple 	= array('roomStart', 'roomEnd', 'areaStart', 'areaEnd', 'priceStart', 'priceEnd', 'finish', 'update');
//		$filterExt 		= array('state', 'district');
		$filterAdd = '';
//		$queryExt = false;
		$filterAdd .= ($filter['roomStart']) ? '		AND  ap_roomNum >=  '.$filter['roomStart'].' ' : '';
		$filterAdd .= ($filter['roomEnd']) ? '		AND  ap_roomNum <=  '.$filter['roomEnd'].' ' : '';
		if($filter['room'])
			$filterAdd .= ($filter['room']==4) ? '		AND  ap_roomNum >=  '.$filter['room'].' ' : '		AND  ap_roomNum =  '.$filter['room'].' ';
		$filterAdd .= ($filter['areaStart'])?'	AND  ap_area >=  '.$filter['areaStart'].' ' : '';
		$filterAdd .= ($filter['areaEnd'])?'	AND  ap_area <=  '.$filter['areaEnd'].' ' : '';
		$filterAdd .= ($filter['finish'])?'		AND  ap_finish =  '.$filter['finish'].' ' : '';
		$filterAdd .= ($filter['update'])?'		AND  ap_dateModify >=  '.$filter['update'].' ' : '';
		$filterAdd .= ($filter['priceStart'])?'	AND  ap_price >=  '.$filter['priceStart'].' ' : '';
		$filterAdd .= ($filter['priceEnd'])?'	AND  ap_price <=  '.$filter['priceEnd'].' ' : '';				
		$filterAdd .= ($filter['state']) ? '	AND  obj_state =  '.$filter['state'].' ' : '';
		$filterAdd .= ($filter['district']) ? '	AND  obj_district =  '.$filter['district'].' ' : '';
/*************************************************************************************************/
		$filterAdd .= ($filter['sold']) ? '		  ' : ' AND  (ap_sold != 1 OR  ap_sold IS NULL) ';
/*************************************************************************************************/
/*		if(($filter['state'])||($filter['district']))
			$queryExt = true;*/
		$query = 'SELECT '.$rows.'  FROM fs_apartment, gd_object, gd_firm
					WHERE ap_objId = obj_id 
					AND fs_apartment.firm_id = gd_firm.firm_id 
					AND gd_object.city_id = '.$filter['city'].'
					'.$filterAdd.$whereMinAdd;
		$ret_arr  = array(	
							'ap_id', 
							'ap_objId', 
							'firmId', 
							'ap_blockSection', 
							'ap_roomNum', 
							'ap_area', 
							'ap_floor', 
							'ap_finish', 
							'ap_price', 
							'ap_info', 
							'ap_dateModify', 
							'ap_sold',
							'obj_id', 
							'obj_name', 
							'obj_geoX', 
							'obj_geoY', 
							'obj_state', 
							'obj_district', 
							);
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		$distrReplace = 	array(1 => 'Правобережный', 2 => 'Октябрьский', 3 => 'Свердловский', 4 => 'Ленинский');
		$objStateReplace = 	array(1 => 'В процессе', 2 => 'Готова', 3 => 'В планах', 4 => 'Заморожена');
		$finishReplace = 	array(1 => 'черновая', 2 => 'получистовая', 3 => 'чистовая');
		$finishReplaceSmall = 	array(1 => 'черн.', 2 => 'п-чист.', 3 => 'чист.');
//		echo 'session: '; 
//		print_r($_SESSION['apCmp']);
		if($LNK->GetNumRows())
			{
			$curDate = new DateTime("now");
			if($onlyCnt)
				$ret = $LNK->GetData('COUNT(*)', false);
			elseif($minPrice)
				$ret = $LNK->GetData('minPrice', false);				
			else
				{
				$ret = $LNK->GetData($ret_arr, true);
				for($i=0; $i<sizeof($ret); $i++)
					{			
					$dateUp = new DateTime($ret[$i]['ap_dateModify']);
					$interval = round(abs($dateUp->format('U') - $curDate->format('U')) / (60*60*24));
					$ret[$i]['days'] 	= 	$interval;
					$ret[$i]['weeks'] 	= 	round($interval/7);
					if($interval < 14)
						$ret[$i]['weeksClass'] 	= 	'week_green';
					elseif($interval < 28)
						$ret[$i]['weeksClass'] 	= 	'week_yellow';
					elseif($interval >= 28)
						$ret[$i]['weeksClass'] 	= 	'week_red';
					$ret[$i]['district'] = 	$distrReplace[$ret[$i]['obj_district']];
					$ret[$i]['state'] =	 	$objStateReplace[$ret[$i]['obj_state']];
					$ret[$i]['finish'] =	$finishReplaceSmall[$ret[$i]['ap_finish']];
					$ret[$i]['finishTitle'] =	$finishReplace[$ret[$i]['ap_finish']];
					$ret[$i]['img'] = $this->getApFileList($ret[$i]['ap_id']);
					if($_SESSION['apCmp'])
						$ret[$i]['cmp'] = (in_array($ret[$i]['ap_id'], $_SESSION['apCmp'])) ? 1 : 0;
					}
				}
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}
	function getApFileList($apId)  /*2014_08_19 получение свойств  квартиры */
		{
		$query = 'SELECT * FROM fs_apFiles
					WHERE ap_id = \''.intval($apId).'\' ORDER BY type, item_id';
		$ret_arr  = array(	'item_id',
							'ap_id', 
							'type', 
							'src');
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
	function getCurApartment($objId)  /*2014_08_26 получение конкретной квартиры*/
		{
		$query = 'SELECT *, fs_apartment.firm_id as firmId, gd_object.city_id AS cityId 
					FROM fs_apartment, gd_firm, gd_object
					WHERE ap_id = \''.intval($objId).'\' 
					AND gd_firm.firm_id = fs_apartment.firm_id 
					AND gd_object.obj_id = ap_objId
					';
/*		$query = 'SELECT *, fs_apartment.firm_id as firmId, gd_object.city_id AS cityId 
					FROM fs_apartment, gd_object
					LEFT JOIN gd_firm ON
						gd_firm.firm_id = firm_id		
					WHERE ap_id = \''.intval($objId).'\' 
					AND gd_object.obj_id = ap_objId
					';*/
		$ret_arr  = array(	'ap_id', 
							'ap_objId', 
							'firmId', 
							'obj_id', 
							'obj_name', 
							'obj_adrString', 
							'obj_state', 
							'obj_district', 
							'obj_dateEnd', 
							'obj_sales', 
							'firm_name', 
							'ap_blockSection', 
							'ap_dateAdd', 
							'ap_dateModify', 
							'firm_name', 
							'ap_viewCnt', 
							'ap_roomNum', 
							'ap_area', 
							'ap_floor', 
							'ap_finish', 
							'ap_price', 
							'ap_info', 
							'ap_sold',
							'cityId');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, false);
			$ret['img'] = $this->getApFileList($objId);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}
	function getApartmentsOfFloor($objId, $floor)  /*2014_08_19 получение списка этажей в стройке*/
		{
		$query = 'SELECT * FROM fs_apartment 
							WHERE ap_objId = \''.intval($objId).'\'
							AND ap_floor = \''.intval($floor).'\' ORDER BY  ap_roomNum, ap_area, ap_price,  ap_sold';
		$ret_arr  = array(	'ap_id', 
							'ap_objId', 
							'firm_id', 
							'ap_blockSection', 
							'ap_dateAdd', 
							'ap_dateModify', 
							'ap_roomNum', 
							'ap_area', 
							'ap_floor', 
							'ap_finish', 
							'ap_price', 
							'ap_info', 
							'ap_sold');
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
/*	function getApParRangeOfObj($objId)  //2015_01_21 получение мин и макс цены
		{
		$query = 'SELECT distinct ap_floor 
					FROM fs_apartment
					WHERE ap_objId = \''.intval($objId).'\' 
					order BY  ap_floor  DESC';
		$ret_arr  = array('ap_floor');
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
		}	*/
	function getFloorListOfObj($objId)  /*2014_08_19 получение списка этажей в стройке*/
		{
		$query = 'SELECT distinct ap_floor 
					FROM fs_apartment
					WHERE ap_objId = \''.intval($objId).'\' 
					order BY  ap_floor  DESC';
		$ret_arr  = array('ap_floor');
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
	function getMaxMinFloorOfObj($objId)  /*2014_08_19 получение списка квартир в стройке*/
		{
		$query = 'SELECT MAX( ap_floor ) AS MaxFloor, MIN( ap_floor ) AS MinFloor
					FROM fs_apartment
					WHERE ap_objId = \''.intval($objId).'\'';
		$ret_arr  = array('MaxFloor', 'MinFloor');
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
	function getApListOfObjByBS($objId)  /*2015_01_12 получение списка квартир в стройке по блок-секциям*/
		{
		$query = 'SELECT * FROM fs_apartment
					WHERE ap_objId = \''.intval($objId).'\' ORDER BY ap_blockSection, ap_floor DESC, ap_roomNum';
		$ret_arr  = array(	'ap_id', 
							'ap_objId', 
							'ap_blockSection', 
							'firm_id', 
							'ap_roomNum', 
							'ap_area', 
							'ap_floor', 
							'ap_finish', 
							'ap_price', 
							'ap_dateModify', 
							'ap_info', 
							'ap_sold');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$retTmp = $LNK->GetData($ret_arr, true);
			$curBS = $retTmp[0]['ap_blockSection'];
			$count = 0;
			$countActive = 0;
//			$maxPrice = $minPrice = $maxArea = $minArea = 0;
			for($i=0; $i<sizeof($retTmp); $i++)
				{
				if(!$retTmp[$i]['ap_sold'])
					{
					$countActive ++;
//				$countActive += ($retTmp[$i]['ap_sold']) ? 0 : 1;
/*				if((!i)||($maxArea))
					{*/
				if(!$maxArea)
					$maxArea = ($retTmp[$i]['ap_area'])?$retTmp[$i]['ap_area']:0; 
				if(!$minArea)
					$minArea = ($retTmp[$i]['ap_area'])?$retTmp[$i]['ap_area']:0;
				if(!$maxPrice)					
					$maxPrice = ($retTmp[$i]['ap_price'])?$retTmp[$i]['ap_price']:0; 
				if(!$minPrice)
					$minPrice = ($retTmp[$i]['ap_price'])?$retTmp[$i]['ap_price']:0;
//					}
				if(($retTmp[$i]['ap_area'])&&($retTmp[$i]['ap_area']  > $maxArea))
					$maxArea = $retTmp[$i]['ap_area'];
				if(($retTmp[$i]['ap_area'])&&($retTmp[$i]['ap_area']  < $minArea))
					$minArea = $retTmp[$i]['ap_area'];
				if(($retTmp[$i]['ap_price'])&&($retTmp[$i]['ap_price']  > $maxPrice))
					$maxPrice = $retTmp[$i]['ap_price'];
				if(($retTmp[$i]['ap_price'])&&($retTmp[$i]['ap_price']  < $minPrice))
					$minPrice = $retTmp[$i]['ap_price'];
					}
				$retTmp[$i]['img'] = $this->getApFileList($retTmp[$i]['ap_id']);
				if($curBS != $retTmp[$i]['ap_blockSection'])
					{
					$curBS = $retTmp[$i]['ap_blockSection'];
					$count ++;
					}
				$list[$count][] = $retTmp[$i];
				}
			$ret = array('list' => $list, 'stat' => array(	'maxArea' => $maxArea, 'minArea' => $minArea, 
															'maxPrice' => $maxPrice, 'minPrice' => $minPrice ), 
											'active' => $countActive);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}
	function getApListOfObj($objId , $onlyCnt=0)  /*2014_08_19 получение списка квартир в стройке для яндекса*/
		{
		$rows = ($onlyCnt)?'COUNT(*)':'*';
		$query = 'SELECT '.$rows.' FROM fs_apartment
					WHERE ap_objId = \''.intval($objId).'\' ORDER BY ap_blockSection, ap_floor DESC, ap_roomNum';
		$ret_arr  = array(	'ap_id', 
							'ap_objId', 
							'ap_blockSection', 
							'firm_id', 
							'ap_roomNum', 
							'ap_area', 
							'ap_floor', 
							'ap_finish', 
							'ap_price', 
							'ap_dateModify', 
							'ap_info', 
							'ap_sold');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			if($onlyCnt)
				$ret = $LNK->GetData('COUNT(*)', false);
			else
				{
				$finishReplace = 	array(1 => 'черновая', 2 => 'получистовая', 3 => 'чистовая');
				$ret = $LNK->GetData($ret_arr, true);
				for($i=0; $i<sizeof($ret); $i++)
					{
					$ret[$i]['finish'] =	$finishReplace[$ret[$i]['ap_finish']];				
					$ret[$i]['img'] = $this->getApFileList($ret[$i]['ap_id']);
					}
				}
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}	
	function getApListOfObjYandex($objId , $onlyCnt=0)  /*2014_08_19 получение списка квартир в стройке*/
		{
		$rows = ($onlyCnt)?'COUNT(*)':'*';
		$query = 'SELECT '.$rows.' FROM fs_apartment, gd_firm, gd_object
					WHERE ap_objId = \''.intval($objId).'\' 
					AND  (ap_sold != 1 OR  ap_sold IS NULL) 
					AND ap_price != 0 
					AND gd_firm.firm_id = fs_apartment.firm_id 
					AND gd_object.obj_id = ap_objId
					ORDER BY ap_blockSection, ap_floor DESC, ap_roomNum';
		$ret_arr  = array(	'ap_id', 
							'ap_objId', 
							'firmId', 
							'obj_id', 
							'obj_name', 
							'obj_adrString', 
							'obj_state', 
							'obj_district', 
							'obj_dateEnd', 
							'obj_sales', 
							'firm_name', 
							'ap_blockSection', 
							'ap_dateAdd', 
							'ap_dateModify', 
							'firm_name', 
							'ap_viewCnt', 
							'ap_roomNum', 
							'ap_area', 
							'ap_floor', 
							'ap_finish', 
							'ap_price', 
							'ap_info', 
							'ap_sold',
							'cityId');
					
/*		$ret_arr  = array(	'ap_id', 
							'ap_objId', 
							'ap_blockSection', 
							'firm_id', 
							'ap_roomNum', 
							'ap_area', 
							'ap_floor', 
							'ap_finish', 
							'ap_price', 
							'ap_dateModify', 
							'ap_info', 
							'ap_sold');*/
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			if($onlyCnt)
				$ret = $LNK->GetData('COUNT(*)', false);
			else
				{
				$finishReplace = 	array(1 => 'черновая', 2 => 'получистовая', 3 => 'чистовая');
				$ret = $LNK->GetData($ret_arr, true);
				for($i=0; $i<sizeof($ret); $i++)
					{
					$ret[$i]['finish'] =	$finishReplace[$ret[$i]['ap_finish']];				
					$ret[$i]['img'] = $this->getApFileList($ret[$i]['ap_id']);
					}
				}
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}	
	function getApListFull()  /*2015_04_14 получение полного списка квартир для карты сайта */
		{
		$query = 'SELECT *  FROM fs_apartment, gd_object
					WHERE ap_objId = obj_id ORDER BY obj_name, ap_roomNum, ap_area, ap_price';
		$ret_arr  = array(	'ap_id', 
							'ap_objId', 
							'obj_name',
							'ap_blockSection', 
							'ap_roomNum', 
							'ap_area', 
							'ap_floor', 
							'ap_finish', 
							'ap_price', 
							'ap_dateModify', 
							'ap_info', 
							'ap_sold');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$finishReplace = 	array(1 => 'черновая', 2 => 'получистовая', 3 => 'чистовая');
			$ret = $LNK->GetData($ret_arr, true);
/*			for($i=0; $i<sizeof($ret); $i++)
				{
				$ret[$i]['finish'] =	$finishReplace[$ret[$i]['ap_finish']];				
				$ret[$i]['img'] = $this->getApFileList($ret[$i]['ap_id']);
				}*/
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}

	function getApConstrYandex($monthNum)  /*2015_08_07 получение полного списка квартир для яндекса */
		{
//		$lastmonth = date("Y-m-d\Th:i:s\+06:00", mktime(0, 0, 0, date("m")-2, date("d"),   date("Y")));

		$limitDate = date("Y-m-d h:i:s", mktime(0, 0, 0, date("m")-$monthNum, date("d"),   date("Y")));
		$query = 'SELECT DISTINCT ap_objId, 
					obj_name, obj_adrString, district_name, obj_state, obj_dateEnd, firm_name, material_value, obj_material,  obj_sales, 
					obj_geoX, obj_geoY
					FROM fs_apartment, gd_object, gd_firm,  fs_materials, fs_district 
					WHERE ap_objId = obj_id 
					AND gd_firm.firm_id = obj_firmZakaz 
					AND fs_materials.material_id = obj_material 
					AND fs_district.district_id = obj_district 
					AND ap_dateModify >= \''.$limitDate.'\'
					AND (ap_price != 0 AND ap_price IS NOT NULL)
					AND  (ap_sold != 1 OR  ap_sold IS NULL) 
					ORDER BY obj_name,  ap_floor, ap_roomNum, ap_area,  ap_price';
		$ret_arr  = array(	'ap_objId', 
							'obj_name',
							'obj_adrString',
							'obj_dateEnd',
							'obj_state',
							'district_name',
							'obj_material',
							'material_value',
							'firm_name',
							'obj_geoX',
							'obj_geoY',
							'obj_sales'	);
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$finishReplace = 	array(1 => 'черновая', 2 => 'получистовая', 3 => 'чистовая');
			$ret = $LNK->GetData($ret_arr, true);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}
	function getApListFullYndex()  /*2015_08_07 получение полного списка квартир для яндекса */
		{
		$query = 'SELECT DISTINCT ap_objId, obj_name, obj_adrString, obj_dateEnd, firm_name,  obj_sales  FROM fs_apartment, gd_object, gd_firm,  fs_materials 
					WHERE ap_objId = obj_id 
					AND gd_firm.firm_id = obj_firmZakaz 
					AND fs_materials.material_id = obj_material 
					ORDER BY obj_name,  ap_floor, ap_roomNum, ap_area,  ap_price';
		$ret_arr  = array(	'ap_id', 
							'ap_objId', 
							'obj_name',
							'obj_adrString',
							'obj_dateEnd',
							'obj_district',
							'obj_state',
							'obj_material',
							'obj_firmZakaz',
							'material_value',
							'firm_name',
							'obj_sales',
							'ap_blockSection', 
							'ap_roomNum', 
							'ap_area', 
							'ap_floor', 
							'ap_finish', 
							'ap_price', 
							'ap_dateModify', 
							'ap_info', 
							'ap_sold');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$finishReplace = 	array(1 => 'черновая', 2 => 'получистовая', 3 => 'чистовая');
			$ret = $LNK->GetData($ret_arr, true);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}


/******************SETTERS***********************************************************************/	

	function incApViews($cnt, $id) /*2015_03_17 */
		{
		$LNK= new DBLink;				
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);	
		$queryInsert = 'UPDATE `fs_apartment` SET ap_viewCnt = \''.($cnt + 1).'\' WHERE ap_id = \''.intval($id).'\'';
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
	function deleteImgSingle($id) /*2014_09_15 удаление картинок*/
		{
		$LNK= new DBLink;	
		$queryDel = 'DELETE from `fs_apFiles` WHERE  item_id = '.$id;	
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);	
		$LNK->Query($queryDel);
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
	function updateObject($param, $id) /*2014_09_02 редактирование одного параметра квартиры*/
		{
		$LNK= new DBLink;	
		$queryUp = 'UPDATE `fs_apartment` SET 
						ap_dateModify = FROM_UNIXTIME( \''.time().'\') ';
		$queryUp .= ($param['blockSection'])?', ap_blockSection = \''.$param['blockSection'].'\' ': '';
		$queryUp .= ($param['constrId'])?', ap_objId = \''.$param['constrId'].'\' ': '';
		$queryUp .= ($param['firmId'])?', 	firm_id = \''.$param['firmId'].'\' ': '';
		$queryUp .= ($param['roomNum'])?', 	ap_roomNum = \''.$param['roomNum'].'\' ': '';
		$queryUp .= ($param['area'])?', 	ap_area = \''.$param['area'].'\' ': '';
		$queryUp .= ($param['floor'])?', 	ap_floor = \''.$param['floor'].'\' ': '';
		$queryUp .= ($param['finish'])?', 	ap_finish = \''.$param['finish'].'\' ': '';
		$queryUp .= (isset($param['price']))?', 	ap_price = \''.$param['price'].'\' ': '';
		$queryUp .= ($param['info'])?', 	ap_info  = \''.$param['info'].'\' ': '';
//		$queryUp .= ($param['ap_viewCnt'])?', 	ap_viewCnt  = ap_viewCnt+1  ': '';
		$queryUp .= (isset($param['sold']))?', 	ap_sold = \''.$param['sold'].'\' ': '';
		$queryUp .= ' WHERE ap_id = '.$id;	
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);	
		$LNK->Query($queryUp);
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
	function editObjectSimpleParam($field, $value, $idStr) /*2014_09_02 редактирование одного параметра квартиры*/
		{
		$LNK= new DBLink;	
		if($field == 'ap_dateModify')
			$qAdd = 'ap_dateModify = FROM_UNIXTIME( \''.time().'\')';
		else
			$qAdd = 'ap_dateModify = FROM_UNIXTIME( \''.time().'\'), '.$field.' = \''.$value.'\'';
		if(strpos($idStr, '~')) //multy
			{
			$idArr = explode('~', $idStr);
			$where = '';
			for($i=0; $i<count($idArr); $i++)
				$where .= ($where) ? ' OR ap_id = '.$idArr[$i].' ': ' ap_id = '.$idArr[$i].'';
			}
		else
			$where = ' ap_id = '.$idStr.' ';
		
		$queryUp = 'UPDATE `fs_apartment` SET '.
						$qAdd.' WHERE '.$where;	
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);	
		$LNK->Query($queryUp);
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
	function editObjectSingleParam($name, $value, $id) /*2014_09_02 редактирование одного параметра квартиры*/
		{
		$LNK= new DBLink;	
		$queryUp = 'UPDATE `fs_apartment` SET 
						ap_dateModify = FROM_UNIXTIME( \''.time().'\'), '.$name.' = \''.$value.'\' WHERE ap_id = '.$id;	
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);	
		$LNK->Query($queryUp);
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
	function addObjectPropertiesImg($objId, $propId, $imgSrc) /*2014_08_18 добавление свойств объекту стройки (картинок)*/
		{
		$LNK= new DBLink;	
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);	
		for($i=0; $i< sizeof($imgSrc); $i++)
			{
			$queryInsert = 'INSERT into `fs_apFiles` SET 
										ap_id = \''.$objId.'\', 
										type = \''.$propId.'\', 
										src = \''.$imgSrc[$i].'\''; 
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
			}
		return $ret;
		}
	function newObject($param) /*2014_08_14 добавление новой квартиры*/
		{
		$LNK= new DBLink;	
		$queryInsert = 'INSERT into `fs_apartment` SET 
									ap_dateAdd  = 	FROM_UNIXTIME( \''.time().'\'), 
									ap_dateModify = FROM_UNIXTIME( \''.time().'\')';
		$queryInsert .= ($param['constrId'])?', ap_objId = \''.$param['constrId'].'\' ': '';
		$queryInsert .= ($param['blockSection'])?', ap_blockSection = \''.$param['blockSection'].'\' ': '';
		$queryInsert .= ($param['firmId'])?', 	firm_id = \''.$param['firmId'].'\' ': '';
		$queryInsert .= ($param['roomNum'])?', 	ap_roomNum = \''.$param['roomNum'].'\' ': '';
		$queryInsert .= ($param['area'])?', 	ap_area = \''.$param['area'].'\' ': '';
		$queryInsert .= ($param['floor'])?', 	ap_floor = \''.$param['floor'].'\' ': '';
		$queryInsert .= ($param['finish'])?', 	ap_finish = \''.$param['finish'].'\' ': '';
		$queryInsert .= ($param['price'])?', 	ap_price = \''.$param['price'].'\' ': '';
		$queryInsert .= ($param['info'])?', 	ap_info  = \''.$param['info'].'\' ': '';
		$queryInsert .= ($param['sold'])?', 	ap_sold = \''.$param['sold'].'\' ': '';
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);	
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


	}
?>