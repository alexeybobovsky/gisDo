<link 	rel="stylesheet" href="/src/design/chosen/chosen.css" type="text/css" />	
<link 	rel="stylesheet" href="/src/design/beautyForms.css" type="text/css" />
<link 	rel="stylesheet" href="/src/design/autoComlete.css" type="text/css" />
<link  	rel="stylesheet" href="/src/design/fileuploader.css" type="text/css"/>

<script type="text/javascript" src="/includes/jquery/jquery.js"></script>
<script type="text/javascript" src="/includes/chosen/chosen.jquery.js"></script>	
<script type="text/javascript" src="/includes/slidinglabels/slidinglabels.js"></script>
<script type="text/javascript" src="/includes/jquery/jquery.autocomplete.js"></script>
<SCRIPT type="text/javascript" src="/includes/jquery/fileuploader.js" ></script>
{*<SCRIPT type="text/javascript" src="/includes/jquery/jquery.maskedinput.js" ></script>*}
<SCRIPT type="text/javascript" src="/includes/JS/fs/admAction.js" ></script>
<SCRIPT type="text/javascript" src="/includes/FCKeditor/fckeditor.js" ></script>

{if $operation == 'new'}
<form action="{$actionState}" id=stateForm method="post"  class="side-by-side clearfix" enctype="multipart/form-data" style='padding-bottom:0px;'>
<div id="orgStatus" >
    <input type="hidden" id="firmId" 	name="firmId" value='{$obj.firm_id}'>		
    <input type="hidden" id="mainUrl" 	name="mainUrl" value='{$mainUrl}'>		
	<em>Тип объекта</em>        
	<select id="state" name="state" style="width:350px;" tabindex="5" onChange='changeType(this);'>
	  <option value="construction" {if $objType == 'construction'}selected{/if} >Стройка</option> 
	  <option value="firm" {if $objType == 'firm'}selected{/if} >Организация</option> 
	</select>
</div>
</form>
{else}
<form action="{$stateForm.action}" id=stateForm method="post"  class="side-by-side clearfix" enctype="multipart/form-data" style='padding-bottom:0px;'>
<div id="orgStatus" >
     <input type="hidden" id="type" 	name="type" 	value='{$stateForm.type}'>		
     <input type="hidden" id="objId" 	name="objId" 	value='{$stateForm.objId}'>		
	<em>Статус объекта</em>        
	<select id="state" name="state" style="width:350px;" tabindex="5" onChange='confirmState(this);'>
	  <option value="1" {if $stateForm.curState}selected{/if} >Видимый</option> 
	  <option value="2" {if !$stateForm.curState}selected{/if} >Скрытый</option> 
	  <option value="3">Удалить</option> 
	</select>
</div>
</form>

{/if}


<form action="{$action}" method="post" id="info" enctype="multipart/form-data">
  <div id="container">
	 <!--h1>Добавление павильона к рынку <strong>автоград</strong>.</h1-->
        <input type="hidden" id="firmId" 	name="firmId" value='{$obj.main.firm_id}'>		
        <input type="hidden" id="objId" 	name="objId" value='{$obj.main.obj_id}'>		
        <input type="hidden" id="cityId" 	name="cityId" value='{$obj.main.cityId}'>		
        <input type="hidden" id="objType" 	name="objType" value='{$objType}'>		
		
        <input type="hidden" id="orgInfoShort" 	name="orgInfoShort" value="{$obj.main.firm_infoShort}">		
	<h2>Информация об объекте</h2>

{if $objType == 'firm'}
	<input type="hidden" id="CMP_firmName" 	name="CMP_firmName" value="{$obj.main.firm_name}">		
	<input type="hidden" id="CMP_firmId" 	name="CMP_firmId" value="{$obj.main.firm_id}">		
	<input type="hidden" id="CMP_firmWWW" 	name="CMP_firmWWW" value="{$obj.main.firm_www}">		
	<input type="hidden" id="CMP_adrAdd" 	name="CMP_adrAdd" value="{$obj.main.firm_adrString}">		
	<input type="hidden" id="CMP_phone" 	name="CMP_phone" value="{$obj.main.firm_phone}">		
	<input type="hidden" id="logo" 			name="logo" 	value="{$obj.main.firm_logo}">		
	
    <div id="firmName-wrap" class="slider">
        <label for="VAL_firmName">Название организации</label>
        <input type="text" id="VAL_firmName" name="VAL_firmName" value={if $obj.main.firm_name}'{$obj.main.firm_name}'{else}''{/if}>
    </div><!--/#name-wrap-->
    <div id="firmWWW-wrap" class="slider" {*style='display:none;'*} style = 'float: left;'>
        <label for="VAL_firmWWW">Веб страница http://</label>
        <input type="text" id="VAL_firmWWW" name="VAL_firmWWW" value={if $obj.main.firm_www}'{$obj.main.firm_www}'{else}''{/if}>
    </div><!--/#name-wrap--><span style = 'margin-left: 2px; padding: 0px;'><small >example.com (не указывать протокол)</small></span>
	<div style = 'height:0px;'>&nbsp;</div>
	<div class="slider">
	        <em>Описание организации</em>        
	</div>
	<div >
	<div id="firmInfoDefault" onClick='editInfo();' title='Изменить информацию'>{if $obj.main.obj_infoShort}{$obj.main.obj_infoShort}{else}Добавить информацию{/if}</div>
    <div id="objInfo" >
		<div id="FCKeditor" style="display: none">
			<input type="hidden" id="infoUpdt" 	name="infoUpdt" value="0">		
			<textarea id="firmInfo" name="firmInfo" cols="80" rows="20"></textarea>
		</div>
    </div><!--/#name-wrap-->
	</div>
	<div style = 'height:0px;'>&nbsp;</div>
	<div class="slider">
	<em>Контактная информация:</em> </br> {*<strong>{$objProp.street.value} {$objProp.building.value}</strong>*}
	</div>
	<div class="slider">
	<em>Адрес:</em> </br> <strong>{$obj.main.firm_adrString}</strong>
	</div>
	<div style = 'height:5px;'>&nbsp;</div>
    <div id="phone1-wrap" class="slider" style = 'float: left;'>
        <label for="VAL_phone1">Телефон</label>
        <input type="text" id="VAL_phone" name="VAL_phone" value='{$obj.main.firm_phone}' >
    </div><!--/#name-wrap--><span style = 'margin-left: 2px; padding: 0px;'><small >{*cлитно и не указывать код! </br> *}&nbsp; ХХХХХХ или 89ХХХХХХХХХ</br>&nbsp; ХХХХХХ_YYYY для добавочных</small></span>
	<div style = 'height:0px; width:0px;{* border: #aaa 1px solid;*}'>&nbsp;</div>
	{if $obj.main.firm_logo}
	<div class='uploadedFiles'>
	<em>Загруженные файлы</em>  
		<div  class='fileGroup'><p>Логотип организации</p>
			<div class=imgPad>
			<div>
			<img src='{$obj.main.firm_logo|replace:"size":"200"}' border=0> 
			</div>
			<div><input type="checkbox" id="delLogo" name="delLogo" style="float:left;" value=''>  
			<label for="delLogo"  style='float:none;'>Удалить</label></div>
			</div>
		</div >
	</div>
	{/if}
	
	<!--div style = 'height:0px;'>&nbsp;</div-->
	
	
 <div class="side-by-side clearfix">
<div>
<div id=''></div>
	<div class='slider-input'>
		<div id="file_firmLogo">	<noscript><p>Please enable JavaScript to use file uploader.</p></noscript> </div>
	</div>
	<div id='imgPrew_firmLogo'></div>

</div>
	 	  
</div>
{elseif $objType == 'construction'}
	<input type="hidden" id="CMP_constrName" 	name="CMP_constrName" 			value="{$obj.main.obj_name}">		
	<input type="hidden" id="CMP_district" 		name="CMP_district" 			value="{$obj.main.obj_district}">		
	<input type="hidden" id="CMP_start" 		name="CMP_start" 				value="{$obj.main.obj_dateStart}">		
	<input type="hidden" id="CMP_end" 			name="CMP_end" 					value="{$obj.main.obj_dateEnd}">		
	<input type="hidden" id="CMP_state" 		name="CMP_state" 				value="{$obj.main.obj_state}">		
	<input type="hidden" id="CMP_zakaz" 		name="CMP_zakaz" 				value="{$obj.main.obj_firmZakaz}">		
	<input type="hidden" id="CMP_podr" 			name="CMP_podr" 				value="{$obj.main.obj_firmPodr}">		
	<input type="hidden" id="CMP_material" 		name="CMP_material" 			value="{$obj.main.obj_material}">		
	<input type="hidden" id="CMP_sales" 		name="CMP_sales" 				value="{$obj.main.obj_sales}">		
	<input type="hidden" id="CMP_objWww" 		name="CMP_objWww" 				value="{$obj.main.obj_www}">		
	<input type="hidden" id="CMP_constrPointCnt" 	name="CMP_constrPointCnt" 	value="{$obj.main.obj_pointCnt}">		
	<input type="hidden" id="projDoc" 			name="projDoc" 				value="{$obj.main.obj_projDoc}">		

<div id="constrName-wrap" class="slider">
	<label for="constrName">Название стройки</label>
	<input type="text" id="VAL_constrName" name="VAL_constrName" value={if $obj.main.obj_name}'{$obj.main.obj_name}'{else}''{/if}>
</div><!--/#name-wrap-->
    <div id="firmWWW-wrap" class="slider" {*style='display:none;'*} style = 'float: left;'>
        <label for="VAL_objWww">Веб страница http://</label>
        <input type="text" id="VAL_objWww" name="VAL_objWww" value={if $obj.main.obj_www}'{$obj.main.obj_www}'{else}''{/if}>
    </div><!--/#name-wrap--><span style = 'margin-left: 2px; padding: 0px;'><small >example.com (не указывать протокол)</small></span>
	<div class="slider">
	<em>Адрес:</em> </br> &nbsp; &nbsp; <strong>{$obj.main.obj_adrString}</strong>
	</div>
	<div style = 'height:5px;'>&nbsp;</div>
	
	<div class="slider">
	        <em>Описание стройки</em>        
	</div>
	<div >
	<div id="firmInfoDefault" onClick='editInfo();' title='Изменить информацию'>{if $obj.main.obj_infoShort}{$obj.main.obj_infoShort}{else}Добавить информацию{/if}</div>
    <div id="objInfo" >
		<div id="FCKeditor" style="display: none">
			<input type="hidden" id="infoUpdt" 	name="infoUpdt" value="0">		
			<textarea id="firmInfo" name="firmInfo" cols="80" rows="20"></textarea>
		</div>
    </div><!--/#name-wrap-->
	</div>

    <div class="side-by-side clearfix">
		<div>
		<em>Район</em>        
		<select data-placeholder="Выбор района стройки" class="chzn-select" id="VAL_district" name="VAL_district" {*multiple *} style="width:350px;" tabindex="4">
			<option value=""></option> 
			{section  name=distr loop=$constr.distr}
			<option value="{$constr.distr[distr].district_id}" {if $constr.distr[distr].district_id == $obj.main.obj_district} selected {/if}>{$constr.distr[distr].district_name}</option>				
			{/section}
		</select>
		</div>
	</div>    
    <div class="side-by-side clearfix">
		<div>
		<em>Дата начала строительства</em>        
		<select data-placeholder="Выбор даты начала строительства" class="chzn-select" id="VAL_start" name="VAL_start" {*multiple *} style="width:350px;" tabindex="4">
			<option value=""></option> 
			{section  name=start loop=$constr.start.list}
			<option value="{$constr.start.list[start].value}" {if $obj.main.obj_dateStart == $constr.start.list[start].value} selected {elseif !$obj.main.obj_dateStart && $constr.start.list[start].value == $constr.start.cur && !$obj.main.obj_id} selected  {elseif !$obj.main.obj_dateStart && $obj.main.obj_id && $constr.start.list[start].value == ''} selected {/if}>{$constr.start.list[start].label}</option>				
			{/section}
		</select>
		</div>
	</div>    
    <div class="side-by-side clearfix">
		<div>
		<em>Дата сдачи</em>        
		<select data-placeholder="Выбор даты окончания строительства" class="chzn-select" id="VAL_end" name="VAL_end" {*multiple *} style="width:350px;" tabindex="4">
			<option value=""></option> 
			{section  name=end loop=$constr.end.list}
			{*<option value="{$constr.end.list[end]}" {if $obj.main.obj_dateEnd == $constr.end.list[end]} selected {elseif !$obj.main.obj_dateEnd && $constr.end.list[end] == $constr.end.cur} selected {/if}>{$constr.end.list[end]}</option>*}				
			<option value="{$constr.end.list[end].value}" {if $obj.main.obj_dateEnd == $constr.end.list[end].value} selected {elseif !$obj.main.obj_dateEnd && $constr.end.list[end].value == $constr.end.cur && !$obj.main.obj_id} selected  {elseif !$obj.main.obj_dateEnd && $obj.main.obj_id && $constr.end.list[end].value == ''} selected {/if}>{$constr.end.list[end].label}</option>				
			{/section}
		</select>
		</div>
	</div>    
    <div class="side-by-side clearfix">
		<div>
		<em>Состояние</em>        
		<select data-placeholder="Выбор состояния стройки" class="chzn-select" id="VAL_state" name="VAL_state" {*multiple *} style="width:350px;" tabindex="4">
			<option value=""></option> 
			<option value="1" {if $obj.main.obj_state == 1} selected {/if}>В процессе</option>				
			<option value="2" {if $obj.main.obj_state == 2} selected {/if}>Готово</option>				
			<option value="3" {if $obj.main.obj_state == 3} selected {/if}>Планируемая стройка</option>				
			<option value="4" {if $obj.main.obj_state == 4} selected {/if}>Заморожено</option>				
		</select>
		</div>
	</div>    
    <div class="side-by-side clearfix">
		<div>
		<em>Заказчик</em>        
		<select data-placeholder="Выбор фирмы заказчика" class="chzn-select" id="VAL_zakaz" name="VAL_zakaz"  style="width:350px;" tabindex="4">
		  <option value=""></option> 
			{section  name=firms loop=$constr.firms}
			<option value="{$constr.firms[firms].firm_id}" {if $constr.firms[firms].firm_id == $obj.main.obj_firmZakaz} selected {/if}>{$constr.firms[firms].firm_name}</option>				
			{/section}
			<option value="-1" >__НЕ УКАЗАНО__</option>				
		</select>
		</div>
	</div>    
	<div class="side-by-side clearfix">
		<div>
		<em>Подрядчик</em>        
		<select data-placeholder="Выбор фирмы подрядчика" class="chzn-select" id="VAL_podr" name="VAL_podr"  style="width:350px;" tabindex="4">
		  <option value=""></option> 
			{section  name=podr loop=$constr.firms}
			<option value="{$constr.firms[podr].firm_id}" {if $constr.firms[podr].firm_id == $obj.main.obj_firmPodr} selected {/if}>{$constr.firms[podr].firm_name}</option>				
			{/section}
			<option value="-1" >__НЕ УКАЗАНО__</option>				
		</select>
		</div>
	</div>	
	<div id="constrPointCnt-wrap" class="slider">
		<label for="constrPointCnt">Отдел продаж</label>
		<input type="text" id="VAL_sales" name="VAL_sales" value={if $obj.main.obj_sales}'{$obj.main.obj_sales}'{else}''{/if}>
	</div><!--/#name-wrap-->
	<div class="side-by-side clearfix">
		<div>
		<em>Материал</em>        
		<select data-placeholder="Выбор материала" class="chzn-select" id="VAL_material" name="VAL_material" style="width:350px;" tabindex="4">
		  <option value=""></option> 
			{section  name=mat loop=$constr.mat}
			<option value="{$constr.mat[mat].material_id}" {if $constr.mat[mat].material_id == $obj.main.obj_material} selected {/if}>{$constr.mat[mat].material_value}</option>				
			{/section}
		</select>
		</div>
	</div>

<div id="constrPointCnt-wrap" class="slider">
	<label for="constrPointCnt">Количество точек съёмки</label>
	<input type="text" id="VAL_constrPointCnt" name="VAL_constrPointCnt" value={if $obj.main.obj_pointCnt}'{$obj.main.obj_pointCnt}'{else}''{/if}>
</div><!--/#name-wrap-->

	{if $obj.prop || $obj.main.obj_projDoc}
	<div class='uploadedFiles'>
	<em>Загруженные файлы</em>  
	{if  $obj.main.obj_projDoc}
			<div  class='fileGroup'><p>Проектная декларация</p>
			<a href='{$obj.main.obj_projDoc}' target = '_blank'>{$obj.main.obj_projDocFile}</a>
			</div>	
        <div><input type="checkbox" id="del~projDoc" name="del~projDoc" style="float:left;" value='1'>  
		<label for="del~projDoc"  style='float:none;'>Удалить</label></div>
	{/if}
		{section  name=prop loop=$obj.prop}
		{if ($obj.prop[prop].property_name == 'fotoInfo' ||  $obj.prop[prop].property_name == 'fotoScheme' ||  $obj.prop[prop].property_name == 'fotoRender') && ( $obj.prop[prop].prop_value )}
		{if $obj.prop[prop].property_name != $obj.prop[$smarty.section.prop.index_prev].property_name || $smarty.section.prop.first}
			<div  class='fileGroup'><p>{$obj.prop[prop].property_description}</p>
		{/if}
		<div class=imgPad>
		<div>
		<img src='{$obj.prop[prop].prop_value|replace:"size":"150"}' border=0> 
		</div>
        <div><input type="checkbox" id="delProp~{$obj.prop[prop].item_id}" name="delProp~{$obj.prop[prop].item_id}" style="float:left;" value='1'>  
		<label for="delProp~{$obj.prop[prop].item_id}"  style='float:none;'>Удалить</label></div>
		</div>
		{if $obj.prop[prop].property_name != $obj.prop[$smarty.section.prop.index_next].property_name || $smarty.section.prop.last}
			</div >
		{/if}
		{/if}
		{/section}	
	</div>
	{/if}




<div class='upload'>
<div id=''></div>
<div class='slider-input'><div id="file_projDoc">	<noscript><p>Please enable JavaScript to use file uploader.</p></noscript> </div></div>
<div id='imgPrew_scheme'></div>

<div id=''></div>
<div class='slider-input'><div id="file_scheme">	<noscript><p>Please enable JavaScript to use file uploader.</p></noscript> </div></div>
<div id='imgPrew_scheme'></div>

<div id=''></div>
<div class='slider-input'><div id="file_infoboards">	<noscript><p>Please enable JavaScript to use file uploader.</p></noscript> </div></div>
<div id='imgPrew_infoboards'></div>

<div id=''></div>
<div class='slider-input'><div id="file_render">	<noscript><p>Please enable JavaScript to use file uploader.</p></noscript> </div></div>
<div id='imgPrew_render'></div>

</div>
{/if}
	<div><input type="submit" id="btn" name="btn" value="Сохранить"></div>
</form>

 <script type="text/javascript">
var fileUploadParam = new Array();	
var uploader = new Array();

fileUploadParam[0]   = new createFileUploadParam('проектную декларацию', 'projDoc');
fileUploadParam[1]   = new createFileUploadParam('логотип организации', 'firmLogo');
fileUploadParam[2]   = new createFileUploadParam('схемы съемок', 'scheme');
fileUploadParam[3]   = new createFileUploadParam('фото информационных досок', 'infoboards');
fileUploadParam[4]   = new createFileUploadParam('рендеры', 'render'); 
{*if $isIE6}
var isIE = 1;
alert(isIE);
{else}
var isIE = 0;
{/if*}
var mark = document.getElementById('curMark');
var model = document.getElementById('curModel');
updateStylesObjEdit();
</script>
