{if $showProperties }start##LAST_LEVEL##
		<table class="content list-row-2" border="0" cellpadding="3" cellspacing="4" width="100%">
			<tbody>
			{assign var="currentGrp" value=0}
			{section name=el loop=$propList}								
			{assign var="currentPPId" value=$propList[el].pp_id}
			{if $propList[el].pp_type == 'group' && $propList[el].pp_parentId == 0}
			{assign var="currentGrp" value=$propList[el].pp_id}
			  <tr>
					<td colspan=3><b>{$propList[el].pp_name}</b></td>
			  </tr>
			{else}
			<tr bgcolor="#ebebeb">
			   <td align="left" valign="top" width="150"><nobr>{$propList[el].pp_name} {if $propList[el].pp_unit}({$propList[el].pp_unit}){/if}</nobr></td>
			   <td valign="top">
						{*<input type="hidden" id="CMP_{$propList[el].pp_id}" name="CMP_{$propList[el].pp_id}" value="{if $propListValues[$currentPPId]}{$propListValues[$currentPPId].pp_value}{/if}">*}
						{if $propList[el].pp_type == 'num' ||  $propList[el].pp_type == 'txt'}
						<input 	type="text" name="VAL_{$propList[el].pp_id}"  
								onChange='checkForChange(this.form);'  onkeyup='checkForChange(this.form)' 
								style="width: 300px;" 
								class='inputType_{$propList[el].pp_type}'
								id="VAL_{$propList[el].pp_id}" 
								value="{if $propListValues[$currentPPId]}{$propListValues[$currentPPId].pp_value}{/if}">
						{elseif $propList[el].pp_type == 'bool'}
						<input type="checkbox" name="VAL_{$propList[el].pp_id}"  onClick='checkForChange(this.form);' id="VAL_{$propList[el].pp_id}" {if $propListValues[$currentPPId].pp_value}checked{/if}>
						{elseif $propList[el].pp_type == 'textarea'}						
						<TEXTAREA 	 name="VAL_{$propList[el].pp_id}"  
								onChange='checkForChange(this.form);'  onkeyup='checkForChange(this.form)' 
								style="width: 300px;" 
								class='inputType_{$propList[el].pp_type}'
								id="VAL_{$propList[el].pp_id}" rows='5'></TEXTAREA>
						{else}
						<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
						<INPUT  onChange='checkForChange(this.form);'  name="VAL_{$propList[el].pp_id}"  type="file"   
						id="VAL_{$propList[el].pp_id}"   style="WIDTH: 300px;" value="">						
						{if $propListValues[$currentPPId]}
						<a href='{$propListValues[$currentPPId].pp_value}' target='_blank' title='Загруженный файл'><img src='/src/design/main/newWindow.png' border=0></a>
						<INPUT  name="DEL_{$propList[el].pp_id}"  onClick='checkForChange(this.form);' type="checkbox" id="DEL_{$propList[el].pp_id}" >
						<label for="DEL_{$propList[el].pp_id}">Удалить</label>
						{/if}
						{/if}
				</td>
			</tr>			
			{/if}
			{if (!$smarty.section.el.last && $propList[$smarty.section.el.index_next].pp_parentId!=$currentGrp) || ($smarty.section.el.last && $currentGrp)}	
			</br>			
			{assign var="currentGrp" value=0}			
			{/if}
			{/section}								
			<tr>
			<td colspan=3><b>&nbsp;</b></td>
			  </tr>
			<tr>
{*			    <td align="center" valign="top"><h3>
					<input style="font-size: 1em; width: 250px" type=submit id='PREVIEW' name="PREVIEW" value="Предварительный просмотр" disabled>
					</h3>
				</td>*}
			    <td align="center" valign="top" colspan='3'><h3>
					<input style="font-size: 1em; width: 250px" type=submit name="SAVE" id='SAVE' value="Сохранить в каталог" disabled>
					</h3>
				</td>
			</tr>
		</TABLE>
{elseif $showNew }
	
	<h3>{$label}<span id='waitImgCont'>	<img id='waitImg_{$curLvl}' border=0 src='/src/design/main/_.gif'></span></h3><h2>
	<div>
		<input 	type="text" name="productTypeNew_{$curLvl}"  								
								style="font-size: 1em; width: 400px" 
								id="productTypeNew_{$curLvl}" 
								onkeyup='if(this.value != "") document.getElementById("add_{$curLvl}").disabled=false; else document.getElementById("add_{$curLvl}").disabled=true; '  
								value="" >
		<input style="font-size: 1em; width: 200px; " type=button name="add_{$curLvl}" id='add_{$curLvl}' 
				value="Далее >>" 
				onClick='productTypeSelect_Add(document.getElementById("productTypeNew_{$curLvl}"));'
				>
</div></h2>
	<div id='nextLvl_{$curLvl}'></div> 
{elseif $showDublicateError}
	start##ERROR_DUBLICATE##
{else}<h2>
	<select name="productType_{$curLvl}" id="productType_{$curLvl}" style="font-size: 1em; width: 400px" onChange='productTypeSelect_Add(this);'>
	{section   name=prdGrp loop=$prdctGroups}
	{if $smarty.section.prdGrp.first}
	<option value="">Выберите {$prdctGroups[prdGrp].name}</option>
	<option disabled value=""></option>
	{else}
	<option value="{$prdctGroups[prdGrp].id}">{$prdctGroups[prdGrp].name}</option>	
	{/if}
	{/section}
	<option disabled value=""></option>
	<option value="new" style='color:grey;'>Добавить {$prdctGroups[$smarty.section.prdGrp.first].name} >></option>
	</select> <span id='waitImgCont'>	<img id='waitImg_{$curLvl}' border=0 src='/src/design/main/_.gif'></span>
	<div id='contProductTypeNew_{$curLvl}' style='display:none;' >	
		<input 	type="text" name="productTypeNew_{$curLvl}"  								
								style="font-size: 1em; width: 400px" 
								id="productTypeNew_{$curLvl}" 
								onkeyup='if(this.value != "") document.getElementById("add_{$curLvl}").disabled=false; else document.getElementById("add_{$curLvl}").disabled=true; '  
								value="" disabled>
		<input style="font-size: 1em; width: 200px; " type=button name="add_{$curLvl}" id='add_{$curLvl}' 
				value="Далее >>" 
				onClick='productTypeSelect_Add(document.getElementById("productTypeNew_{$curLvl}"));'
				disabled>
</div></h2>
	<div id='nextLvl_{$curLvl}'></div> 
{/if} 

			  
																			
