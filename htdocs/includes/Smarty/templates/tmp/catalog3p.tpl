<link 	rel="stylesheet" type="text/css" href="/src/design/fancybox/jquery.fancybox.css?v=2.1.2" media="screen" /><link 	rel="stylesheet" type="text/css" href="/src/design/fancybox/jquery.fancybox-thumbs.css?v=1.0.7" /><link 	rel="stylesheet" type="text/css" href="/includes/jwysiwyg/jquery.wysiwyg.css" /><script type="text/javascript" src="/includes/fancybox/jquery.fancybox.pack.js"></script><script type="text/javascript" src="/includes/fancybox/jquery.fancybox-thumbs.js?v=1.0.7"></script><SCRIPT src="/includes/JS/gd/userMessage.js" type=text/javascript></SCRIPT><script type="text/javascript" src="/includes/jwysiwyg/jquery.wysiwyg.js"></script><script type="text/javascript" src="/includes/jwysiwyg/controls/wysiwyg.link.js"></script><script type="text/javascript" src="/includes/jwysiwyg/plugins/wysiwyg.i18n.js"></script> <script type="text/javascript" src="/includes/jwysiwyg/i18n/lang.ru.js"></script>{literal}<script type="text/javascript">var errorBoxActive = commentBoxActive = false;$(document).ready(function() {$("#catList").css({'display':'none'});	$("#curLayerTtl").click(function(){UI.toggleLayerPad(this)});	$('.imgLink').fancybox({				wrapCSS    : 'fancybox-custom',				closeClick : true,				openEffect : 'none',				helpers : {					title : {						type : 'inside'					},					overlay : {						css : {							'background' : 'rgba(238,238,238,0.85)'						}					},//					buttons	: {},					thumbs : {						width: 50,						height: 50					}				}			})			});</script>			{/literal}<div id = 'mainContent' ><h2><a href='/catalog'>Рубрики организаций</a> \ <span id='curLayerTtl' class = 'scriptLink' title ='Выбрать рубрику' >&#10033;</span></h2><h2>{$title}</h2><div id='orgProfile'>{if $obj.body.firm_www}Веб сайт: <a href='http://{$obj.body.firm_www}'>{$obj.body.firm_www}</a>{/if}{if $orgLayers}<div id='layerList' > Деятельность:{section name=layers loop=$orgLayers}	<span>	<a href='/catalog/{$orgLayers[layers].layerName}'>{$orgLayers[layers].layerName}</a>	</span>{/section}</div>{/if}{if $obj.objCnt > 1}<h3>Филиалы</h3>{/if}{section name=obj loop=$obj.objProp}<div class= 'oficeList' id='nameLayer_{$obj.objProp[obj].firm_id}'  title='{$obj.body.firm_name}'>	<div class='mapLink'><a class='mapLink' href='/map/{$obj.body.firm_name}/{$obj.objProp[obj].objId}' title='{$obj.body.firm_name} на карте Иркутска'>{$obj.objProp[obj].location}</a></div>	<div class='phone'>{$obj.objProp[obj].phone}</div>{if !$orgLayers}<div id='layerList' > Деятельность:{section name=layers loop=$obj.objProp[obj].objLayers}	<span>	<a href='/catalog/{$obj.objProp[obj].objLayers[layers].layerName}'>{$obj.objProp[obj].objLayers[layers].layerName}</a>	</span>{/section}</div>{/if}{if $obj.objProp[obj].img}		<div class='imgPrew'>	{section name=img loop=$obj.objProp[obj].img}	<a  class='imgLink' href='{$obj.objProp[obj].img[img].path}1024/{$obj.objProp[obj].img[img].file}' 		rel="gallery_{$obj.objProp[obj].objId}" title = "{$obj.objProp[obj].img[img].about}" target="_blank">	<img src='{$obj.objProp[obj].img[img].path}90/{$obj.objProp[obj].img[img].file}'></a>	{/section}	</div>{/if}</div>{/section}</div>	<DIV class='messageBox'>	{if !$header.userName}		Ваше имя <INPUT  name='senderName'    id='senderName'  		 type='input'  value='Гость'>	{else}		<INPUT  name='senderName'    id='senderName'  		 type='hidden'  value=''>	{/if}		<div class='form'>			<span class='title scriptLink' id='commentToggle' onclick='toggleCommentBox(this)'>Оставить отзыв</span>			<textarea id="commentBox" name="commentBox"  rows="5" cols="80" style='display:none' onChange='if (this.value != "") $("#submitCo").show(); else $("#submitCo").hide();'></textarea>		</div>		<div class='form'>			<span class='scriptLink submit' id='submitCo' onclick='sendMessage()' style='display:none' >Отправить</span>		</div>		<div class='form'>			<span class='title scriptLink' id='errorToggle' onclick='toggleCommentBox(this)'>Сообщить о неточности/дополнить информацию</span>			<textarea id="errorBox" name="errorBox"  rows="5" cols="80" style='display:none' onChange='if (this.value != "") $("#submitEr").show(); else $("#submitEr").hide();'></textarea>		</div>		<div class='form'>			<span class='scriptLink submit' id='submitEr' onclick='sendMessage()' style='display:none' >Отправить</span>		</div>				<INPUT  name='sender'    id='sender'  		 type='hidden'   		  		value='{$header.userId}'>		<INPUT  name='objType'    id='objType'  		 type='hidden'   		  	value='org'>		<INPUT  name='parId'    id='parId'  		 type='hidden'   		  		value='0'>		<INPUT  name='FIRMID'    id='FIRMID'  		 type='hidden'   		  		value='{$obj.body.firm_id}'>		<!--INPUT  name='_REFERRER' id='_REFERRER'  		 type='hidden'   		  		value='{$menu.queryString}'-->	</DIV>					</div><div id='catList'>{section name=lay loop=$layers}{if !$layers[lay].lvl}<ul class=contaner {* id='layer_{$layers[lay].item.layer_id}' *} ><li class=parent id='nameLayer_{$layers[lay].item.layer_id}' title='{$layers[lay].item.layer_title}'>	{$layers[lay].item.layer_name}</li>{elseif $layers[lay].lvl}<li class=child id='nameLayer_{$layers[lay].item.layer_id}'  title='{$layers[lay].item.layer_title}'>	{if $layers[lay].item.layer_id != $curLayer}	<a href='/catalog/{$layers[lay].item.layer_name}'>{$layers[lay].item.layer_name}</a> {if $layers[lay].item.objCnt}({$layers[lay].item.objCnt}){/if}	{else}	{$layers[lay].item.layer_name} {if $layers[lay].item.objCnt}({$layers[lay].item.objCnt}){/if}	{/if}</li>{/if}{if !$layers[$smarty.section.lay.index_next].lvl || $smarty.section.lay.last}</ul>{/if}{/section}</div>