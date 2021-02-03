{section name=area loop=$contentHTML}
	<fieldset>
	<legend>{if $contentArea[area].label}{$contentArea[area].label}{elseif $contentHTML[area].table.table_label}{$contentHTML[area].table.table_label}{/if}</legend>
		<TABLE cellSpacing=0 cellPadding=2 width="100%" border=0 >
	{assign var="SMRTcontentArea" value=$contentHTML[area]}	
	{section name=frm loop=$SMRTcontentArea}
		{assign var="content" value=$SMRTcontentArea[frm]}
				{*<FORM name={$content.form.form_name} action={$content.form.form_action} method=post encType=multipart/form-data>*}
			<tr>
			  <TD align=left valign='middle'>
				{section name=el loop=$content.elements}
					{assign var="SMRT_EL" value=$content.elements[el]}
					{assign var="SMRT_INDX" value=$content.section.el.index}
						{if $SMRT_EL.necessary}
						<script language="JavaScript">
							necessary[necessCount] = "{$SMRT_EL.name}";
							necessCount ++;
						</script>
						{/if}					
						{if $content.form.form_elementCaption[el]}
						<SMALL>{$content.form.form_elementCaption[el]}
						{if $SMRT_EL.necessary}
								<font color=red>*</font>
						{else}
								&nbsp;
						{/if}
						</SMALL><br>					
					{/if}
							<span id='DIV{$SMRT_EL.id}'>
							{if !$SMRT_EL.skipTemplate}
								{include file='elements/'|cat:$SMRT_EL.template}
								{*include file=$SMRT_EL.template*}
							{/if}
							</span>
				{/section}
				</td>											
			</tr>
			{if $content.elSubmit}
			<tr>
			  <TD align=left valign='middle'>				
						{assign var="SMRT_EL" value=$content.elSubmit}	
						{include file=$SMRT_EL.template}
				</td>											
			</tr>
			{/if}
				</div>
				{*</FORM>*}
	{/section}		
	</TABLE>
	</fieldset>
{/section}