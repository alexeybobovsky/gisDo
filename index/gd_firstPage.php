<?
//echo __FILE__	;
//print_r($allMenu);
//echo $uri;
$realPath = $ROUT->GetStartedUrlLvl($allMenu['curLabel']['link'], $allMenu['activeLink'], $uri);
$curURL = $realPath['url'];
$curURLLvl = $realPath['lvl'];
//print_r($realPath);
//echo '1: '.$realPath.' - '.$allMenu['curNodeId'];
$isMng = false;
if($allMenu['curNodeId']){
	$isMng = ($ACL->GetClosedParentRight($allMenu['curNodeId'])>1)?true:false;	
}
if((!trim($post[$curURLLvl])))
	$act = $allMenu['curNodeName'];
else
	$act = trim($post[$curURLLvl]);
//print_r($allMenu);	
//	echo $act;	
$error = 0;
$menuActive = '';
$feedFile = '../htdocs/realty.xml';
//$feedFile = '../realty.xml';

switch ($act)
	{	
	case 'kaznaXML': 
		{
		} 
	break;	
	case '404': 
		{
		if(isset($_SESSION['MESSAGE_404']))
			{
/*			$mess =  $_SESSION['MESSAGE_404'];
			$SMRT['modules'][] = array('name' => 'MESS', 'body' => $_SESSION['MESSAGE_404']);
			$title = $mess->Header;*/
			$mess =  $_SESSION['MESSAGE_404'];
			$SMRT['modules'][] = array('name' => 'MESS', 'body' => $_SESSION['MESSAGE_404']);
			$title = $_SESSION['MESSAGE_404']->Header;
			unset($_SESSION['MESSAGE_404']);			
			}
		else
			{
			$title = 'Ошибка';
			$SMRT['modules'][] = array('name' => 'MESS', 'body' => new Message('Error', 'Страницы не найдено', 'Этой страницы не существует. Нам очень жаль. <br />Возможно, мы просто не успели её нарисовать. Но мы будем стараться, чтобы в следующий раз всё было на месте.', $NAV->GetPrewURI()));			
			}
		$SMRT['modules'][] =  array('name' => 'menuItems', 'body' => array('startLink' => 'list', 'curentItem' => 'none'));
		$SMRT['modules'][] =  array('name' => 'title', 	'body' => $title);		
		$templates = array();
		$templates[] = $tplDir.'headerSimple.tpl';
		$templates[] = $tplDir.'Message.tpl';				
		$templates[] = $tplDir.'footer.tpl';				
//		$templates[] = $tplDir.'footerSimple.tpl';				
		} break;
	case 'nav':  //Режим навигатора - слежение за автотранспортом
		{
//			echo 'nav';
		}
	case 'main': 
		{
//		print_r($_SESSION['filter']);
//		$title = 'Мониторинг новостроек Иркутска';	
		require_once("../classes/gis/manage_class.php");	
		$MNG = new Manage;			
		$mngAct = array(
				'ao' => '/manage/set/objAdd',
				'al' => '/manage/set/layerAdd',
				'uf' => '/manage/set/fileUpload',

				);
		$title = 'ГИС - "Сделай сам" ';	
		$metaDescription = 'На сайте '.$siteName.' вы можете увидеть все';			
//		print_r($MNG->getLayersOfParent());
		$SMRT['modules'][] =  array('name' => 'mapType', 'body' => $act);
		$SMRT['modules'][] =  array('name' => 'layerList', 'body' => $MNG->getAllLayers($isMng));
		$SMRT['modules'][] =  array('name' => 'menuItems', 'body' => array('startLink' => 'list', 'curentItem' => 'none'));
		$SMRT['modules'][] =  array('name' => 'title', 	'body' => $title);		
		$SMRT['modules'][] =  array('name' => 'links', 'body' => array('start' => 'http://'.$_SERVER['SERVER_NAME'].''));		
		$templates = array();
/*		echo 'new template';*/
		$templates[] = $tplDir.'header.tpl';
/*		$templates[] = $tplDir.'mainPage.tpl';
		$templates[] = $tplDir.'rightColumn.tpl';*/
		}
	break;	
	case 'popular': 
		{
		}
	break;	
	case 'siteMap': 
		{
		$xmlDo = (trim($post[$curURLLvl+1])=='xml')?1:0;
		$title = 'Карта сайта';	
		$list = array();
		$cityId = $USER->curCity['id'];

		require_once("../classes/gd/news_class.php");			
		$NEWS = new news;

		require_once("../classes/fs/GetOrg_class.php");	
		$getOrg = new GetOrganization;

		require_once("../classes/fs/apartment_class.php");	
		$Apartments = new Apartments;
		
		$list[] = array('lvl' => 0, 'name' => 'Жилой комплекс "Онегин"', 'link' => '/popular/onegin');		
		$list[] = array('lvl' => 0, 'name' => 'Микрорайон "СОЮЗ"', 'link' => '/popular/soyuz');		
		$list[] = array('lvl' => 0, 'name' => 'Жилой район "Эволюция"', 'link' => '/popular/evolution');		
		$list[] = array('lvl' => 0, 'name' => 'Жилой комплекс "Стрижи"', 'link' => '/popular/strizhi');		
		$list[] = array('lvl' => 0, 'name' => 'Жилой квартал "Новый"', 'link' => '/popular/noviy');		
		$list[] = array('lvl' => 0, 'name' => 'Жилой комплекс "Нижняя Лисиха 3"', 'link' => '/popular/nl3');		
		$list[] = array('lvl' => 0, 'name' => 'Жилой комплекс "Ангарские паруса"', 'link' => '/popular/anpar');		
		
		
		$list[] = array('lvl' => 0, 'name' => 'Обновившиеся новостройки Иркутска за 30 дней', 		'linkMap' => '/map/construction/filter_spec~lastFoto', 	'linkList' => '/list/construction/filter_spec~lastFoto');
		$list[] = array('lvl' => 0, 'name' => 'Новые стройки Иркутска за 6 месяцев', 				'linkMap' => '/map/construction/filter_spec~lastObj', 	'linkList' => '/list/construction/filter_spec~lastObj');
		$list[] = array('lvl' => 0, 'name' => 'Завершенные стройки Иркутска за 6 месяцев', 			'linkMap' => '/map/construction/filter_spec~completed', 'linkList' => '/list/construction/filter_spec~completed');


		$list[] = array('lvl' => 0, 'name' => 'Новостройки в Октябрьском районе Иркутска', 		'linkMap' => '/map/construction/filter_district~2', 'linkList' => '/list/construction/filter_district~2');
		$list[] = array('lvl' => 0, 'name' => 'Новостройки в Свердловском районе Иркутска', 		'linkMap' => '/map/construction/filter_district~3', 'linkList' => '/list/construction/filter_district~3');
		$list[] = array('lvl' => 0, 'name' => 'Новостройки в Правобережном районе Иркутска', 	'linkMap' => '/map/construction/filter_district~1', 'linkList' => '/list/construction/filter_district~1');
		$list[] = array('lvl' => 0, 'name' => 'Новостройки в Ленинском районе Иркутска', 		'linkMap' => '/map/construction/filter_district~4', 'linkList' => '/list/construction/filter_district~4');


		$list[] = array('lvl' => 0, 'name' => 'Строящиеся объекты в Иркутске', 			'linkMap' => '/map/construction/filter_state~1', 'linkList' => '/list/construction/filter_state~1');
		$list[] = array('lvl' => 0, 'name' => 'Готовые новостройки в Иркутске', 		'linkMap' => '/map/construction/filter_state~2', 'linkList' => '/list/construction/filter_state~2');
		$list[] = array('lvl' => 0, 'name' => 'Замороженные новостройки в Иркутске', 	'linkMap' => '/map/construction/filter_state~4', 'linkList' => '/list/construction/filter_state~4');
		$list[] = array('lvl' => 0, 'name' => 'Запланированные новостройки в Иркутске', 'linkMap' => '/map/construction/filter_state~3', 'linkList' => '/list/construction/filter_state~3');



		$list[] = array('lvl' => 0, 'name' => 'Все застройщики Иркутска', 'linkList' => '/list/firm', 'linkMap' => '/map/firm');
		$objList = $getOrg->getFirmListByOrder($cityId, 'Asc');
//		$firmCount = sizeof($objList);
		for($k=0; $k<sizeof($objList); $k++)
			{
			$list[] = array('lvl' => 1, 'name' => $objList[$k]['firm_name'], 'linkMap' => '/map/firm/'.$objList[$k]['firm_id'], 'linkList' => '/list/firm/'.$objList[$k]['firm_id']);
			}
			
		$objList = 	$getOrg->getConstrListAllMonitoring($cityId, 0);
		$list[] = array('lvl' => 0, 'name' => 'Все новостройки Иркутска', 			'linkMap' => '/map/construction/filter_spec~all', 'linkList' => '/list/construction/filter_spec~all');
		for($k=0; $k<sizeof($objList); $k++)
			{
			$list[] = array('lvl' => 1, 'name' => $objList[$k]['obj_name'], 'linkMap' => '/map/construction/'.$objList[$k]['obj_id'], 'linkList' => '/list/construction/'.$objList[$k]['obj_id']);
			}
		
		$list[] = array('lvl' => 0, 'name' => 'Новости', 'link' => '/news/');		
		$objList = 	$NEWS->getNewsList(1);
		for($k=0; $k<sizeof($objList); $k++)
			{
			$link = 		'/news/'.date('Y/m/d/', strtotime($objList[$k]['news_date'])).$objList[$k]['news_nameTranslit'];

			$list[] = array('lvl' => 1, 'name' => $objList[$k]['news_name'], 'link' => $link);
			}

		$list[] = array('lvl' => 0, 'name' => 'Полезная информация', 'link' => '/doc/');		
		$objList = 	$NEWS->getNewsList(2);
		for($k=0; $k<sizeof($objList); $k++)
			{
			$link = 		'/doc/'.date('Y/m/d/', strtotime($objList[$k]['news_date'])).$objList[$k]['news_nameTranslit'];

			$list[] = array('lvl' => 1, 'name' => $objList[$k]['news_name'], 'link' => $link);
			}
		
		$list[] = array('lvl' => 0, 'name' => 'Продажа квартир в новостройках', 'link' => '/list/apartment');		
		$objList = 	$NEWS->getNewsList(2);
		$apartmentList = 	$Apartments->getApListFull();
		for($k=0; $k<sizeof($apartmentList); $k++)
			{
			$link = 		'/list/apartment/'.$apartmentList[$k]['ap_id'];
//			$name = 		$Apartments->getApSingleSiteMap($apartmentList[$k]);
			$list[] = array('lvl' => 1, 'name' => $Apartments->getApSingleSiteMap($apartmentList[$k]), 'link' => $link);
			}
//		print_r($apartmentList);
		if($xmlDo)
			{
			$templates = array();
//			print_r($list);
			$mapFile = '../htdocs/sitemap.xml';
			$fp = fopen($mapFile, "w");		
			$cnt_det = fwrite($fp, '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<url>
<loc>http://www.fotostroek.ru</loc>
<changefreq>weekly</changefreq>
</url>');
			$cnt = 0; 
			for($k=0; $k<sizeof($list); $k++)
				{
				$lnk = ($list[$k]['link'])?$list[$k]['link']:$list[$k]['linkList'];
				$cnt_det = fwrite($fp, '
<url>
<loc>http://www.fotostroek.ru'.$lnk.'</loc>
<changefreq>weekly</changefreq>
</url>');		
				$cnt++;
				if($list[$k]['linkMap'])
					{
				$cnt_det = fwrite($fp, '
<url>
<loc>http://www.fotostroek.ru'.$list[$k]['linkMap'].'</loc>
<changefreq>weekly</changefreq>
</url>');		
					$cnt++;
					}
					
				}
			$cnt_det = fwrite($fp, '
</urlset>');
			echo $cnt.' lines added'; 
			}
		else
			{
			$SMRT['modules'][] =  array('name' => 'list', 'body' => $list);
			$SMRT['modules'][] =  array('name' => 'menuItems', 'body' => array('startLink' => 'list', 'curentItem' => 'none'));
			$SMRT['modules'][] =  array('name' => 'title', 	'body' => $title);		
			$SMRT['modules'][] =  array('name' => 'links', 'body' => array('start' => 'http://'.$_SERVER['SERVER_NAME'].''));		
			$templates = array();
			$templates[] = $tplDir.'header.tpl';
			$templates[] = $tplDir.'siteMap.tpl';
			$templates[] = $tplDir.'rightColumn.tpl';
			}
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
	$_SESSION['MESSAGE'] = $MESS;
	header('Location: /');	
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
?>