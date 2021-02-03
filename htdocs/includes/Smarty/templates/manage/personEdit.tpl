{if $contentHTML[0].form.form_emptyCheck}
<script language="JavaScript" src="/includes/JS/script.js"></script>
<script language="JavaScript">
	var fullTitleLocked = 0;
	var necessary = new Array();
	var necessCount = 0;
</script>
{/if}

{if $contentHTML[0].table.table_label}
	<fieldset>
	<legend>{$contentHTML[0].table.table_label}</legend>
{/if}
{section name=area loop=$contentHTML}
	{assign var="SMRTcontentArea" value=$contentHTML[area]}	
		{assign var="content" value=$SMRTcontentArea}	
	<fieldset>
	<legend>{if $contentArea[area].label }{$contentArea[area].label}{elseif $contentHTML[area].table.table_label}{$contentHTML[area].table.table_label}{/if}</legend>
		<TABLE cellSpacing=0 cellPadding=2 width="100%" border=0 >
			<tr>
			  <TD align=left valign='middle' width="100%" >
			{if $content.form.form_action}<FORM  name={$content.form.form_name} action={$content.form.form_action} method=post encType=multipart/form-data>{/if}
			  
				{section name=el loop=$content.elements}
					{assign var="SMRT_EL" value=$content.elements[el]}
					{assign var="SMRT_INDX" value=$content.section.el.index}
					
				{if $SMRT_EL.group && $SMRT_EL.group != $content.elements[$smarty.section.el.index_prev].group}
				<TABLE id='{$content.table.body_id}' cellSpacing=0 cellPadding=2 border=0 width=100% {if $SMRT_EL.width} width='{$SMRT_EL.width}'{/if}>
				<TBODY>
				<tr>
				{/if}
				{if $SMRT_EL.group}
				<td {if $SMRT_EL.width}width='{$SMRT_EL.width}'{/if}>
				{/if}
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
							<span id='DIV{$SMRT_EL.id}' {*style='border: 1px #000 solid;'*} align='left'>
							{if !$SMRT_EL.skipTemplate}
								{include file='elements/'|cat:$SMRT_EL.template}
								
							{/if}
							</span>
				{if $SMRT_EL.group}
				</td>
				{/if}				
				{if $SMRT_EL.group && $SMRT_EL.group != $content.elements[$smarty.section.el.index_next].group}
					</tr>
				</TABLE>
				{/if}
				{/section}

				</td>											
			</tr>
				</div>
			</TBODY>
		</TABLE>
	</fieldset>

{if $content.elSubmit}
<div align = 'center'>	<br>
{assign var="SMRT_EL" value=$content.elSubmit}	
						{include file='elements/'|cat:$SMRT_EL.template}
						{*include file=$SMRT_EL.template*}
</div>
{/if}
{if $smarty.section.area.last}
</FORM>
{/if}
{/section}
{if $contentHTML[0].table.table_label}
	</fieldset>
{/if}
