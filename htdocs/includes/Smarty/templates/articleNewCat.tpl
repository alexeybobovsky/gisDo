{section name=area loop=$contentArea}
	<fieldset>
	<legend>{$contentArea[area].label}</legend>
		<TABLE cellSpacing=0 cellPadding=2 width="100%" border=0 >
	{assign var="SMRTcontentArea" value=$contentHTML[area]}	
	{section name=frm loop=$SMRTcontentArea}
		{assign var="content" value=$SMRTcontentArea[frm]}
				<FORM name={$content.form.form_name} action={$content.form.form_action} method=post encType=multipart/form-data>
			<tr>
			  <TD align=left valign='middle'>
				{section name=el loop=$content.elements}
					{assign var="SMRT_EL" value=$content.elements[el]}
					{assign var="SMRT_INDX" value=$content.section.el.index}
					{if $content.form.form_elementCaption[el]}
						<SMALL>{$content.form.form_elementCaption[el]}
						{if $SMRT_EL.necessary}
								<font color=red>*</font>
						{else}
								&nbsp;
						{/if}
						</SMALL><br>					
					{/if}
							{*<span id='DIV{$SMRT_EL.id}'>*}
							{if !$SMRT_EL.skipTemplate}
								{include file=$SMRT_EL.template}
							{/if}
							{*</span>*}
				{/section}
				</td>											
			</tr>
			<tr>
			  <TD align=left valign='middle'>	
					{if $content.elSubmit}
						{assign var="SMRT_EL" value=$content.elSubmit}	
						{include file=$SMRT_EL.template}
					{/if}
				</td>											
			</tr>
				</div>
				</FORM>
				
	{/section}
		</TABLE>
	</fieldset>
{/section}