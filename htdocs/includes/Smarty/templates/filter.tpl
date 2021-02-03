<fieldset>
<legend>{$filter.table.table_label}</legend>		
	<TABLE style="MARGIN-LEFT: 1px; MARGIN-RIGHT: 1px"  cellSpacing=0 cellPadding=2 {* width="100%" *} border=0>
	<FORM name={$filter.form.form_name} action='{$filter.form.form_action}' method=post encType='multipart/form-data'>
	<tr>
	{section name=el loop=$filter.elements}								
		{assign var="SMRT_EL" value=$filter.elements[el]}	
		<TD valign='top'>
			<SMALL>{$filter.form.form_elementCaption[el]}
			{if $SMRT_EL.necessary}
					<font color=red>*</font>
			{else}
					&nbsp;
			{/if}</SMALL>							            
				{*<div id='DIV{$SMRT_EL.id}'>*}
				{if !$SMRT_EL.skipTemplate}
					{include file=$SMRT_EL.template}
				{elseif $SMRT_EL.type == 'img'}
					<img src='{$SMRT_EL.src}' border='0'>
				{/if}
				{*</div>*}
				{if $SMRT_EL.useCompare}
				<div id='DIVCMP_{$SMRT_EL.id}'>
					{include file='hidden_CMP.tpl'}
				</div>												
				{/if}
		</td>											
	{/section}
		<TD  valign='bottom' align='left'>
			{assign var="SMRT_EL" value=$filter.elSubmit}	
			{include file=$SMRT_EL.template}
		</TD>
	</tr>
	</form>
	</TABLE>								
</fieldset>
