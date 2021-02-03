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
<SCRIPT type="text/javascript" src="/includes/JS/gd/admAction.js" ></script>
<SCRIPT type="text/javascript" src="/includes/FCKeditor/fckeditor.js" ></script>


<form action="{$actionState}" id=stateForm method="post"  class="side-by-side clearfix" enctype="multipart/form-data" style='padding-bottom:0px;'>
<div id="orgStatus" >
     <input type="hidden" id="firmId" 	name="firmId" value='{$objMain.firm_id}'>		
	<em>Состояние организации</em>        
	<select id="state" name="state" style="width:350px;" tabindex="5" onChange='confirmState(this);'>
	  <option value="1" {if $objMain.firm_status}selected{/if} >Видимая</option> 
	  <option value="2" {if !$objMain.firm_status}selected{/if} >Скрытая</option> 
	  <option value="3">Удалить</option> 
	</select>
</div>
</form>

<form action="{$action}" method="post" id="info" enctype="multipart/form-data">
  <div id="container">
	 <!--h1>Добавление павильона к рынку <strong>автоград</strong>.</h1-->
        <input type="hidden" id="firmId" 	name="firmId" value='{$objMain.firm_id}'>		
        <input type="hidden" id="objId" 	name="objId" value='{$objMain.obj_id}'>		
        <input type="hidden" id="cityId" 	name="cityId" value='{$objMain.cityId}'>		
		
        <input type="hidden" id="orgInfoShort" 	name="orgInfoShort" value="{$objMain.firm_infoShort}">		
        <input type="hidden" id="CMP#firmName" 	name="CMP#firmName" value="{$objMain.firm_name}">		
        <input type="hidden" id="CMP#firmId" 	name="CMP#firmId" value="{$objMain.firm_id}">		
        <input type="hidden" id="CMP#firmWWW" 	name="CMP#firmWWW" value="{$objMain.firm_www}">		
        <input type="hidden" id="CMP#adrAdd" 	name="CMP#adrAdd" value="{$objProp.adrAdd.value}">		
        <input type="hidden" id="CMP#phone1" 	name="CMP#phone1" value="{$objProp.phone1.value}">		
        <input type="hidden" id="CMP#phone2" 	name="CMP#phone2" value="{$objProp.phone2.value}">		
	<h2>Информация об объекте</h2>

    <div id="firmName-wrap" class="slider">
        <label for="firmName">Название организации</label>
        <input type="text" id="firmName" name="firmName" value={if $objMain.firm_name}'{$objMain.firm_name}'{else}''{/if}>
    </div><!--/#name-wrap-->
    <div id="firmWWW-wrap" class="slider" {*style='display:none;'*} style = 'float: left;'>
        <label for="firmWWW">Веб страница</label>
        <input type="text" id="firmWWW" name="firmWWW" value={if $objMain.firm_www}'{$objMain.firm_www}'{else}''{/if}>
    </div><!--/#name-wrap--><span style = 'margin-left: 2px; padding: 0px;'><small >example.com (не указывать протокол)</small></span>
	<div style = 'height:0px;'>&nbsp;</div>
	<div class="slider">
	        <em>Информационный блок</em>        
	</div>
	<div >
	<div id="firmInfoDefault" onClick='editInfo();' title='Изменить информацию'>{if $objMain.firm_infoShort}{$objMain.firm_infoShort}{else}Добавить информацию{/if}</div>
    <div id="firmInfo" >
		<div id="FCKeditor" style="display: none">
			<input type="hidden" id="infoUpdt" 	name="infoUpdt" value="0">		
			<textarea id="firmInfo" name="firmInfo" cols="80" rows="20"></textarea>
		</div>
    </div><!--/#name-wrap-->
	</div>
	<div style = 'height:0px;'>&nbsp;</div>
	<div class="slider">
	<em>Адрес:</em> </br> <strong>{$objProp.street.value} {$objProp.building.value}</strong>
	</div>
	<div style = 'height:0px;'>&nbsp;</div>
    <div id="adrAdd-wrap" class="slider" style = 'float: left;'>
        <label for="adrAdd">Дополнение к адреcу{* (пав., оф. и т.д.)*}</label>
        <input type="text" id="adrAdd" name="adrAdd" value="{$objProp.adrAdd.value}">
    </div><!--/#name-wrap--><span style = 'margin-left: 2px; padding: 0px;'><small >офис ХХ / павильон ХХ / квартира ХХ</small></span>
	<div style = 'height:0px;'>&nbsp;</div>
    <div id="phone1-wrap" class="slider" style = 'float: left;'>
        <label for="phone1">Телефон 1</label>
        <input type="text" id="phone1" name="phone1" value='{$objProp.phone1.value}' >
    </div><!--/#name-wrap--><span style = 'margin-left: 2px; padding: 0px;'><small >{*cлитно и не указывать код! </br> *}&nbsp; ХХХХХХ или 89ХХХХХХХХХ</br>&nbsp; ХХХХХХ_YYYY для добавочных</small></span>
	<div style = 'height:0px; width:0px;{* border: #aaa 1px solid;*}'>&nbsp;</div>
	
    <div id="phone2-wrap" class="slider" style = 'float: left;'>
        <label for="phone2">Телефон 2</label>
        <input type="text" id="phone2" name="phone2" value='{$objProp.phone2.value}' >
    </div><!--/#name-wrap--><span style = 'margin-left: 2px; padding: 0px;'><small >{*cлитно и не указывать код! </br> *}&nbsp; ХХХХХХ или 89ХХХХХХХХХ</br>&nbsp; ХХХХХХ_YYYY для добавочных</small></span>
	<!--div style = 'height:0px;'>&nbsp;</div-->
	
	
    <div class="side-by-side clearfix">
		<div>
        <em>Деятельность</em>        
        <select data-placeholder="Выбор вида деятельности" class="chzn-select" id="layer[]" name="layer[]" multiple style="width:350px;" tabindex="4">
          <option value=""></option> 
			{section  name=lrs loop=$layers}
				{if $layers[lrs].lvl == 0}
			    <optgroup label="{$layers[lrs].item.layer_name}">
				{else}
		          <option value="{$layers[lrs].item.layer_id}" {if $layers[lrs].item.selected} selected {/if}>{$layers[lrs].item.layer_name}</option>				
				{if $layers[$smarty.section.lrs.index_next].item.layer_parId != $layers[lrs].item.layer_parId || $smarty.section.lrs.last}
				</optgroup>
				{/if}
				{/if}
			{/section}
		</select>
      </div>
	{if $objProp.img}
	<div >
	<em>Картинки</em>      
		{section  name=img loop=$objProp.img}
		{if $objProp.img[img].file}
		<div class=imgPad style='margin-bottom:5px; padding:5px; border: 1px solid #d0d0d0'>
		<div>
        <input type="text" id="imgAbout~{$objProp.img[img].file}" name="imgAbout~{$objProp.img[img].file}" value='{$objProp.img[img].about}' style='margin-bottom:5px;'></br>
        <input type="hidden" id="CMP#imgAbout~{$objProp.img[img].file}" name="CMP#imgAbout~{$objProp.img[img].file}" value='{$objProp.img[img].about}' style='margin-bottom:5px;'></br>
		<img src='{$objProp.img[img].path}90/{$objProp.img[img].file}' border=0> 
		</div>
        <div><input type="checkbox" id="delImg~{$objProp.img[img].file}" name="delImg~{$objProp.img[img].file}" style="float:left;" value='1'>  
		<label for="delImg~{$objProp.img[img].file}"  style='float:none;'>Удалить картинку</label></div>
		</div>
		{/if}
		{/section}	
	</div>
	{/if}
<div>
<div id=''></div>
<div class='slider-input'><div id="fileIcon">	<noscript><p>Please enable JavaScript to use file uploader.</p></noscript> </div></div>
<div id='imgPrew'></div>

</div>
	 
	 
   
	<div><input type="submit" id="btn" name="btn" value="Сохранить"></div>
 
</div>
</form>

 <script type="text/javascript">
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
