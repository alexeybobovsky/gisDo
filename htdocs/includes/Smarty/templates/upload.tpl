<script language="JavaScript" src="/includes/JS/script.js"></script>
<script language="JavaScript">
function showFileList()
	{literal}{{/literal}
	var url = '/upload/list';
	var select = document.getElementById('IDPRECATALOGS');	
	var text = document.getElementById('IDUSERCATALOG');	
	if(text.value !='')
		url += text.value;
	else
		url += select.value;		
	var name = 'editConsole';
	var w = 600;
	var h = 600;
	var scroll =1;
	open_window(url, name, w, h, scroll);
	{literal}}{/literal}
</script>

	<FORM name={$upload.form.form_name} action={$upload.form.form_action} method=post encType=multipart/form-data>									
		<TABLE style="MARGIN-LEFT: 1px; MARGIN-RIGHT: 1px" cellSpacing=0    cellPadding=3 border=0 class='upload'>
		<TBODY id='{$upload.table.body_id}'>									
			<TR>
				<td>
				<fieldset>
				<legend>{$upload.table.table_label}</legend>					
					<TABLE cellSpacing=1 cellPadding=5 width="100%" border=0>
					{section name=el loop=$upload.elements}								
						{assign var="SMRT_EL" value=$upload.elements[el]}	
						{assign var="SMRT_INDX" value=$smarty.section.el.index}
						{if $SMRT_EL.necessary}
						<script language="JavaScript">
							necessary[necessCount] = "{$SMRT_EL.name}";
							necessCount ++;
						</script>
						{/if}
						<tr>
							<TD >
							{$upload.table.table_colHeader[el]}
							{if $SMRT_EL.necessary}
									<font color=red>*</font>
							{else}
									&nbsp;
							{/if}
								<div id='DIV{$SMRT_EL.id}'>
								{include file=$SMRT_EL.template}
								</div>
							</td>
						</tr>
						{if $smarty.section.el.index == 1}								
						<tr>
							<TD align=right>
							<div 
							onMouseMove="this.style.cursor='hand'; return false;" 
							  onclick="showFileList(); return false;"
							>
							показать ресурс
							</div>
							</td>
						</tr>							
						{/if}
					{/section}
						<tr>
							<TD align='right'>
								{assign var="SMRT_EL" value=$upload.elSubmit}	
								{include file=$SMRT_EL.template}
							</TD>
						</tr>				
					</TABLE>								
				</fieldset>
				</td>
			</TR>
			</TBODY>
		</TABLE>
	</form>