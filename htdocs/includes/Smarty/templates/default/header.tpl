<HTML>
  <HEAD>
    <TITLE>{$menu.lastTitle} | {$header.body.title}{*Город-авто.ком Автоинформационный портал*}</TITLE>
    <META http-equiv=Content-Type content="text/html; charset=windows-1251">
    <LINK href="{$header.body.cssSrc}site.css" rel=stylesheet>
    <LINK href="{$header.body.cssSrc}r-star.css" rel=stylesheet>	 
    <LINK rel='icon' href="{$header.body.imgSrc}favicon.ico" type='image/x-icon'>
    <LINK rel='shortcut icon' href="{$header.body.imgSrc}favicon.ico" type='image/x-icon'>
	<meta name="copyright" content="gorod-avto.com (с)">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta name="robots" content="index, follow" />
	<meta name="description" content="{if $meta.description}{$meta.description}{else}Каталог автофирм г.Иркутска, рейтинги, комментарии и еще много чего интересного.{/if}">
	<meta name="keywords" content="{if $meta.keywords}{$meta.keywords}{else}автофирмы иркутска, автоуслуги, отзывы, рейтинг автофирм, автомобильный иркутск, каталог, информационный портал, барахолка, объявления, продажа, цены иркутска, поиск автомобиля, автомобиль, Иркутск, Рынок автомобилей, все фирмы иркутска, подержанные и новые автомобили, автоцентры, все авто иркутска{/if}">	
{literal}	
	<script>
	function sizeTransform(width)
		{
		if (document.getElementById('firstPage'))
			{
			show_extendedBlock(width);
			}
		return false;		
		}
	</script>
{/literal}	
</HEAD>
<body onLoad='sizeTransform(document.body.clientWidth);'>