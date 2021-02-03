<SCRIPT src="/includes/jquery/jquery.js" type=text/javascript></SCRIPT>
<script src="/includes/jquery/jquery.autocomplete.js" language="JavaScript"></script>
<SCRIPT src="/includes/JS/scriptGlobalMapYM.js" type=text/javascript></SCRIPT>
{*<script type="text/javascript" src="/includes/jwplayer/jwplayer.js"></script>*}
<script type="text/javascript" src="/includes/jwplayer/swfobject.js"></script>
{*<script type="text/javascript" src="/includes/jwplayer/jwplayer.js"></script>*}
{if $client.isMng}
<SCRIPT src="/includes/jquery/fileuploader.js" type="text/javascript"></script>
<link  rel="stylesheet" type="text/css" href="/src/design/fileuploader.css" />
{literal}
<SCRIPT type=text/javascript>
//var coord; //=$document.getElementById("coord").value;
</SCRIPT>
{/literal}
<SCRIPT src="/includes/JS/scriptGlobalMapYM_mng.js" type=text/javascript></SCRIPT>
{*<SCRIPT src="/includes/JS/jquery/ajaxfileupload.js" type=text/javascript></SCRIPT>*}
{/if}
<link  rel="stylesheet" type="text/css" href="/src/design/mapGlobal.css" />
<link  rel="stylesheet" type="text/css" href="/src/design/autoComlete.css" />

{**************************************стили**************************************************}
{literal}
	<style type="text/css">
	.videoFrame {
/*		width: 	500px;
		height: 400px;*/
		width: 	480px;
		height: 270px;
        }

	</style>
{/literal}
{***************************************Инициализация скриптов для формы поиска******************************************}
<script type="text/javascript">
{literal}
{/literal}

var strTplSpecNoFoto = "<div style=\"\"><strong>$[name]</strong></div>" + 
	"<div class='about'>$[about]</div>"{if $client.isMng}+
	"<div id='mngCnt'><span id='edt_$[obj_id]' class='edtLink'  onClick = 'showEdtBox(this, \"{$mngAction.editObj}\", 0);'> Изменить </span><span id='del_$[obj_id]' class='delLink'  onClick = 'delObj(this);'> Удалить </span>{*<span id='mov_$[obj_id]' class='edtLink'  onClick = 'delObj(this);'> Переместить </span>*}</div>"
	{/if};
var strTplSpecFoto = "<div style=\"\"><strong>$[name]</strong></div>" + 
	"<div class='about'>$[about]</div>" + 
	"<div><a href=\"$[foto]\" onclick=\"return GB_showImage('$[name]', this.href);\">" + 
	"<img src=\"$[fotoSmall]\" border = 0></a></div>"{if $client.isMng}+
	"<div id='mngCnt'><span id='edt_$[obj_id]' class='edtLink'  onClick = 'showEdtBox(this, \"{$mngAction.editObj}\", 0);'> Изменить </span><span id='del_$[obj_id]' class='delLink'  onClick = 'delObj(this);'> Удалить </span>{*<span id='mov_$[obj_id]' class='edtLink'  onClick = 'delObj(this);'> Переместить </span>*}</div>"
	{/if};
var strTplCamera = "<div class=\"videoFrame1\"><div style=\"\"><strong>$[name]</strong>&nbsp;<img src='/src/design/main/blueBars.gif' border=0 id='camWait_$[obj_id]'></div>" + 	
	"<div><img class='camImg' title='Смотреть в большем разрешении' src=\"$[foto]"+ "&sz=2\" border = 0 id='camImg_$[obj_id]' onLoad=\"updateCam('$[obj_id]');\"  {*onClick = 'showCamBox(\"$[obj_id]\", \"$[name]\", \"{$mngAction.camFull}\");*}'></div>" + 
	"<div class='about'>$[about]</div>"+
	"<div id='linkBtn' class='showCamLink'><span id='lnkBtn_$[obj_id]' onClick = 'showCamLink(\"lnkField\");'>Ссылка на эту камеру</span>&nbsp;&nbsp;<input id='lnkField' style='display:none;'  readonly='readonly' value='{$linkForCam}$[obj_id]'></div>"{if $client.isMng}+
	"<div id='mngCnt'><span id='edt_$[obj_id]' class='edtLink'  onClick = 'showEdtBox(this, \"{$mngAction.editObj}\", 1);'> Изменить </span><span id='del_$[obj_id]' class='delLink'  onClick = 'delObj(this);'> Удалить </span>{*<span id='mov_$[obj_id]' class='edtLink'  onClick = 'delObj(this);'> Переместить </span>*}</div>"
	{/if}+"</div>";
var strTplCameraFlash = "<div><div style=\"\"><strong>$[name]</strong>&nbsp;</div>" + 	
	"<div id=\"container_$[obj_id]\" class=\"videoFrame\">Loading the player ...</div> " + 
	"<div class='about'><img src=\"/src/design/main/_.gif\" border = 0 onLoad=\"startFlash('container_$[obj_id]', '$[foto]')\"  >" + 
	"$[about]</div>"{if $client.isMng}+
	"<div id='mngCnt'><span id='edt_$[obj_id]' class='edtLink'  onClick = 'showEdtBox(this, \"{$mngAction.editObj}\", 1);'> Изменить </span><span id='del_$[obj_id]' class='delLink'  onClick = 'delObj(this);'> Удалить </span>{*<span id='mov_$[obj_id]' class='edtLink'  onClick = 'delObj(this);'> Переместить </span>*}</div>"
	{/if}+"</div>";
var templateSpecObj = new YMaps.Template(
'$[name]'
);
/**********************************Стили и шаблоны****************************************************/	
/**********************************шаблоны***********************************************************/	
/**шаблон балуна**/
var tplSpecNoFoto = new YMaps.Template(strTplSpecNoFoto);
var tplSpecFoto = new YMaps.Template(strTplSpecFoto);
var tplCamera = new YMaps.Template(strTplCamera);
var tplCameraFlash = new YMaps.Template(strTplCameraFlash);


var template = new YMaps.Template(
"<div style=\"\"><strong>$[name]</strong></div><div style=\"margin:10px\">$[layersStr]</div><div>Адрес: $[adr|-]</div><div>Телефон: $[phone|-]</div>"
);

/**шаблон подсказки непроверенного объекта**/
var templateHintError = new YMaps.Template(
'<strong>$[name]</strong><br />$[adr]<br />(<font color=red>Возможно, местоположение объекта указано неверно</font>)'
);
/**шаблон подсказки проверенного объекта**/
var templateHint = new YMaps.Template(
'<strong>$[name]</strong><br />$[adr]'
);
/**********************************Стиль метки корректного объекта**************************************/	
var styleNum = new YMaps.Style('plain#nightPoint');
{*if $client.name != 'Explorer'}
{/if*}
styleNum.hasHint = true;
styleNum.hintContentStyle = new YMaps.HintContentStyle(templateHint);	
styleNum.balloonContentStyle = new YMaps.BalloonContentStyle
	(
	template
	);

/**********************************Стиль метки специального объекта с фото**************************************/	
/**********************************Стиль метки неточного объекта**************************************/	

/**********************************Стиль метки неточного объекта**************************************/	
var styleAtt = new YMaps.Style('plain#nightPoint');

{*if $client.name != 'Explorer'}
{/if*}

styleAtt.balloonContentStyle = new YMaps.BalloonContentStyle(template);
styleAtt.hasHint = true;
styleAtt.hintContentStyle = new YMaps.HintContentStyle(templateHintError);
/**********************************Стиль метки неточного объекта**************************************/	


var loadImg = new Image(); 
	loadImg.src = '/src/design/main/blueBars.gif';
var emptyImg = new Image(); 
	emptyImg.src = '/src/design/main/_.gif';

	
var layerClosedImg = new Image(); 
	layerClosedImg.src = '/src/design/tree/treePlus.gif';
var layerOpenedImg = new Image(); 
	layerOpenedImg.src = '/src/design/tree/treeMinus.gif';
var layerLoadingImg = new Image(); 
	layerLoadingImg.src = '/src/design/tree/load.gif';
	
	
var catLvl = 0; 	//Уровень каталога: 0- стартовый; 1 - категория; 2 - фирма
var curFirm = 0;	//выбранная фирма
var point = new Array();
var curLayer;
var curCamLayer = false;
var curCamSrc = '';
var camLayerId = 7;
//var countDo = false;
//var camUpdateIterations = 0;
/*var camUpdateInterval = 10000;*/
{literal}
/*
var camImgPreload = new Image(); 
	camImgPreload.src = emptyImg.src;
	camImgPreload.onLoad = function() {if(document.getElementById('camImg')!='undefined') document.getElementById('camImg').src = camImgPreload.src}; 
*/	
function GetStrPrt(str, del, indx)
	{
	strArr1 = str.split(del);
	var ret = strArr1[indx];
//	alert(strArr1[0]);
	return ret;
	}
function showProperties(obj, objName) 
{
  var result = "The properties for the " + objName + " object:" + "\n";
  
  for (var i in obj) {result += i + " = " + obj[i] + "\n";}
  
  return result;
}

/*********************************autocomplete functions*********************************************/
function formatStreet(row, i, num) 
	{
	document.getElementById('searchLayersSelected').value = '';
	document.getElementById('searchNameSelected').value = '';
	var result;
	var string = row[0].toLowerCase();
	var searched = row[1].toLowerCase();	
/*	var street = document.getElementById('STREET');
	street.value = row[2];*/
	var start = string.indexOf(searched);
	var end = start + searched.length;
	result = string.substring(0,   start) + '<span class="ac_searched">' +  searched + '</span>'  + string.substring(end);				
	return result;
	}
function selectName(str) 
	{	
	if(document.getElementById('searchActive').value == 'searchLayers')
		{
		document.getElementById('searchLayersSelected').value = (str.extra[1]>0) ? str.extra[1] : 0 ;
		}
	else if(document.getElementById('searchActive').value == 'searchName')
		{
//		alert (str.extra[0] + ' - ' + str.extra[1] + ' - ' + str.extra[2]);
		document.getElementById('searchNameSelected').value = (str.extra[1]>0) ? str.extra[1] : 0;
		document.getElementById('searchNameTranslit').value = (str.extra[2]!='') ? str.extra[2] : '';		
		}
	}	
$(document).ready(function(){
  $("#layer").autocomplete('/spddl/',
    {
    minChars:3,
	lineSeparator:"##",
	cellSeparator:"**",
	maxItemsToShow:30,
	formatItem:formatStreet,
	onItemSelect:selectName,
	extraParams:{type:"layer"}
//	cacheLength:0,
//    autoFill:false
    }
  );
});
$(document).ready(function(){
  $("#ac_name").autocomplete('/spddl/',
    {
    minChars:1,
	lineSeparator:"##",
	cellSeparator:"**",
	maxItemsToShow:20,
	formatItem:formatStreet,
	onItemSelect:selectName,
	extraParams:{type:"companyNameExt"}
//	cacheLength:0,
//    autoFill:false
    }
  );
});
/*********************************END OF autocomplete functions*********************************************/
//alert(showProperties(window.parent.parent, 'Parent'));
{/literal}
</script>
<div id="YMapsID" ></div>

<div id="layerTree" >
{if $specLayers}
<!--div class='returnToLayers' >Специальные слои</div-->
{section name=lay loop=$specLayers}
<div class=layer_upper id='sLayer_{$specLayers[lay].mo_id}' title='{$specLayers[lay].mo_name}' onClick='clickSLayer(this);'>
<span>
{$specLayers[lay].mo_name}</span>
</div>
{/section}
{/if}
{if $client.isMng}
{*<div class=title ><span onClick='return GB_showFullScreen("Плэйер", "/test/mplr/");	'>Плеер</span></div>*}
<div class=title ><span onClick='toggleElementSimple("addSpecLayerCont")'>Новый объект</span></div>
<div id='addSpecLayerCont' style="border:1px solid blue; display:none">
<table class="content list-row-2" border="0" cellpadding="2" cellspacing="2" width="100%">
	<tbody>
	  <tr  class='elAll'>
<td align=right>
<span>Слой </span></td>
<td>
<select name="layerSelEl" onChange='selectOMType(this);' class='inputType_txt' id="layerSelEl" >
{section name=lay loop=$specLayers}
								<option value="{$specLayers[lay].mo_id}">{$specLayers[lay].mo_name}</option>
{/section}
								<option value="new">Создать новый слой</option>
								</select>
</td>								
</tr>
<tr  class='elAll'>
	<td align=right>
	<span>Заголовок</span></td>
	<td>
	<input name="layerTitleEl" onChange='' class='inputType_txt' id="layerTitleEl" type=text>
	</td>								
</tr>
<tr  class='elObj'>
	<td align=right>
	<span>Позиция </span></td>
	<td>
	<input type="hidden" id="coord" name="coord" value="" />
	<input name="layerPositionEl" onClick='pickYMPoint();' class='inputType_txt' id="layerPositionEl" type=button value='Pick!'>
	</td>								
</tr>
<tr  class='elAll'><td align=right>
	<span><input type='radio' name = 'fileUpload' id = 'fileUploadIcon'  value = 'icon' onChange='setFileUploadParam(this.value)' checked><label for= 'fileUploadIcon'>Иконка</label>
	<input type='radio' name = 'fileUpload' id = 'fileUploadFoto'  value = 'foto' onChange='setFileUploadParam(this.value)' ><label for= 'fileUploadFoto'>Фото</label>
	</span></td><td>
<div id="fileIcon">	<noscript><p>Please enable JavaScript to use file uploader.</p></noscript> </div>
{literal}
<script> 
var uploader;
$(document).ready(function(){
/*function createUploader()
	{*/ 	uploader = new qq.FileUploader({
		element: document.getElementById('fileIcon'),
		action: '/map/set/upload',
/*		onComplete: function(id, fileName, responseJSON){alert(fileName)},*/
		debug: true,
		params: {
		        element: 'icon'
				}
	/*});*/}) });
function setFileUploadParam(value) /*кнопка создание объекта*/
	{
	uploader.setParams({
	   element: value	});	
	}	
//window.onload = createUploader; </script>{/literal}
</td>
</tr>
<tr  class='elAll'>
	<td align=right>
	<span>Описание </span></td>
	<td>
	<textarea cols='20' rows='2' id='layerAboutEl' dir="ltr" name='layerAboutEl'>
	</textarea> 
	</td>								
</tr>
<tr  class='elAll'>
<td colspan='2' align='right'>
	<input name="layerAdd" onClick='submitCreateForm()' class='inputType_txt' id="layerAdd" type=button value='Создать!' >
</td>
</tr>
</tbody></table>
</div>
{/if}

<div class='returnToLayers' >Автофирмы</div>
{section name=lay loop=$layers}
{if !$layers[lay].lvl}
<div class=layer id='layer_{$layers[lay].item.ot_id}' title='{$layers[lay].item.ot_name}'>
<img src='/src/design/tree/treePlus.gif' border=0 id='imgLayer_{$layers[lay].item.ot_id}'  onClick='toggleLayer(this);'>
<span id='nameLayer_{$layers[lay].item.ot_id}'  onClick='toggleLayer(this);'>{$layers[lay].item.ot_name}</span>
</div><div id='layerContaner_{$layers[lay].item.ot_id}' style="display:none">
{elseif $layers[lay].lvl}
<div class=title id='nameLayer_{$layers[lay].item.ot_id}'  onClick='clickLayer(this, 0);'><span>{$layers[lay].item.ot_name}</span></div>
{/if}
{if !$layers[$smarty.section.lay.index_next].lvl || $smarty.section.lay.last}
</div>
{/if}
{/section}

</div>

<div id="objList" >
<div id='returnToLayers' class='returnToLayers' onClick='togglePad();' title='Перейти к каталогу' ><span>вернуться к каталогу</span></div>
<div><span  id='resultTitle' class='resultTitle'  onClick='renewLayer();' title='Покозать все объекты' ></span>&nbsp;<img id='resultImgLoad' src='/src/design/main/_.gif' border=0></div>
<div><span  id='resultNum' class='resultNum'  ></span></div>
<div id='objContaner'>
empty
</div>
</div>
<div id="mapTools" >
<span id='controls' class='controls'>Искать фирму по 
	<span class='selected' id='searchName' onClick='toggleSearchField(this);'>Названию</span>
	<span class='link' id='searchLayers' onClick='toggleSearchField(this);'>Деятельности</span>
	<span id='inpt'>
	<input  name='ac_name' type='text' id='ac_name' class='ac_name' style='width: 200px;' value=''>
	<input name="layer" id="layer" style="width: 200px; display:none;" >		
	<input type="button" id="searchLayers" value="Искать" onClick="searchFieldSubmit()" />
	</span>
	<span id=resultImgPlace><img id='resultImg' border=0 src='/src/design/main/_.gif'></span>			
		<INPUT  type='hidden' name='selectedLayer' id='selectedLayer' value=''>
		<INPUT  type='hidden' name='searchActive' id='searchActive' value='searchName'>
		<INPUT  type='hidden' name='searchNameSelected' id='searchNameSelected' value=''>
		<INPUT  type='hidden' name='searchNameTranslit' id='searchNameTranslit' value=''>
		<INPUT  type='hidden' name='searchLayersSelected' id='searchLayersSelected' value=''>
</span>	
{*<img src='/src/design/main/logoMiniMap.PNG' border=0>*}
<span id=logo class=logo>
<a href='/' title='На главную страницу'>ГОРОД-АВТО.РФ</a>
</span>
</div>

{if $autoLoad}
<input type=hidden id='autoLoadType' value={$autoLoad.type}>
<input type=hidden id='autoLoadValue' value={$autoLoad.value}>
<input type=hidden id='autoLoadObj' value={$autoLoad.obj}>
{else}
<input type=hidden id='autoLoadType' value=''>
<input type=hidden id='autoLoadValue' value=''>
<input type=hidden id='autoLoadObj' value=''>
{/if}

