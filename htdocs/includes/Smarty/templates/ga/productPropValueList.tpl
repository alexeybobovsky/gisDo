<script>
{literal}
function GetStrPrt(str, del, indx)
	{
	strArr1 = str.split(del);
	var ret = strArr1[indx];
	return ret;
	}
function checkForChange(the_form)
	{
	var fullCnt = 0;
    var selectCount  = document.forms[the_form.name].elements.length;
    for (var i = 0; i < selectCount; i++)
	    {
//		if(document.forms[the_form.name].elements[i].type == 'checkbox') alert(document.forms[the_form.name].elements[i].checked);
		if (((document.forms[the_form.name].elements[i].type == 'file')||(document.forms[the_form.name].elements[i].type == 'text')||
			(document.forms[the_form.name].elements[i].type == 'checkbox'))&&
				(((document.forms[the_form.name].elements[i].type == 'text')&&(document.forms[the_form.name].elements[i].value != 
					document.getElementById('CMP_' + GetStrPrt(document.forms[the_form.name].elements[i].id, '_', 1)).value))||
						((document.forms[the_form.name].elements[i].type == 'file')&&(document.forms[the_form.name].elements[i].value != ''))||
						((document.forms[the_form.name].elements[i].type == 'checkbox')&&(document.forms[the_form.name].elements[i].id.indexOf('DEL_')>=0)&&(document.forms[the_form.name].elements[i].checked))||
						((document.forms[the_form.name].elements[i].type == 'checkbox')&&
						(((document.forms[the_form.name].elements[i].checked)&&(document.getElementById('CMP_' + GetStrPrt(document.forms[the_form.name].elements[i].id, '_', 1)).value==''))||
						((!document.forms[the_form.name].elements[i].checked)&&(document.getElementById('CMP_' + GetStrPrt(document.forms[the_form.name].elements[i].id, '_', 1)).value!=''))))))
			{
			fullCnt ++;
			}
	    } 
	document.getElementById('SUBMITINFO').disabled = (fullCnt==0) ? true : false; 
	}
</script>
{/literal}
		<TABLE cellSpacing=0 cellPadding=2 width="100%" border=0 >
		<FORM  name=info action={$curURL}set/propValue method=post encType=multipart/form-data>			
			<tr>
			<TD valign='middle' align=center width="100%" >
		<input type="hidden" id="_REFERRER" name="_REFERRER" value="{$referrer}"/>
		<input type="hidden" id="node" name="node" value="{$curNode.product_id}"/>
			<strong>{$curNode.product_name} ({$curNode.product_id})</strong>
			</TD>
			</tr>
			<tr>
			<TD align=left valign='middle' width="100%" >
			{assign var="currentGrp" value=0}
			{section name=el loop=$propList}								
			{assign var="currentPPId" value=$propList[el].pp_id}
			{if $propList[el].pp_type == 'group' && $propList[el].pp_parentId == 0}
			{assign var="currentGrp" value=$propList[el].pp_id}
			<fieldset>
				<legend>{$propList[el].pp_name}</legend>
			{else}
			<TABLE cellSpacing=0 cellPadding=2 width="100%" border=0 >
				<TR>
					<TD align=right width=50%>
						<SMALL>{$propList[el].pp_name}
								&nbsp;
						</SMALL>
					</TD>
					<TD align=left>
						<input type="hidden" id="CMP_{$propList[el].pp_id}" name="CMP_{$propList[el].pp_id}" value="{if $propListValues[$currentPPId]}{$propListValues[$currentPPId].pp_value}{/if}"/>
						{if $propList[el].pp_type == 'num' ||  $propList[el].pp_type == 'txt'}
						<input type="text" name="VAL_{$propList[el].pp_id}"  onChange='checkForChange(this.form);' onChange='checkForChange(this.form);' onkeyup='checkForChange(this.form)' style='width:{if $propList[el].pp_type == 'txt'}200{else}50{/if}px;' id="VAL_{$propList[el].pp_id}" value="{if $propListValues[$currentPPId]}{$propListValues[$currentPPId].pp_value}{/if}"/><SMALL>&nbsp;{$propList[el].pp_unit}</SMALL>
						{elseif $propList[el].pp_type == 'bool'}
						<input type="checkbox" name="VAL_{$propList[el].pp_id}"  onClick='checkForChange(this.form);' id="VAL_{$propList[el].pp_id}" {if $propListValues[$currentPPId].pp_value}checked{/if}/><SMALL>&nbsp;{$propList[el].pp_unit}</SMALL>
						{else}						
						<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
						<INPUT  onChange='checkForChange(this.form);'  name="VAL_{$propList[el].pp_id}"  type="file"   id="VAL_{$propList[el].pp_id}"   style="WIDTH: 200px;" value="">						
						{if $propListValues[$currentPPId]}
						<a href='{$propListValues[$currentPPId].pp_value}' target='_blank' title='Загруженный файл'><img src='/src/design/main/newWindow.png' border=0></a>
						<INPUT  name="DEL_{$propList[el].pp_id}"  onClick='checkForChange(this.form);' type="checkbox" id="DEL_{$propList[el].pp_id}" >
						<label for="DEL_{$propList[el].pp_id}">Удалиить</label>
						{/if}
						{/if}
					</TD>
				</TR>
			</TABLE>
			{/if}
			{if (!$smarty.section.el.last && $propList[$smarty.section.el.index_next].pp_parentId!=$currentGrp) || ($smarty.section.el.last && $currentGrp)}	
			</fieldset></br>			
			{assign var="currentGrp" value=0}			
			{/if}
			{/section}								
			<TR>
			<TD align='center'></br></br>
			<INPUT  name='SUBMITINFO'  		 type='submit'   		 id='SUBMITINFO'   		  		 style='WIDTH: 200px' value='Сохранить изменения' disabled>
			</TD>
			</tr>
			</FORM>
		</TABLE>

			  
																			
