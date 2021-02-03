{section name=area loop=$contentHTML}
{*	<fieldset>
	<legend>{$contentArea[area].label}</legend>*}
		<TABLE cellSpacing=0 cellPadding=2 width="100%" border=0 >
	{assign var="SMRTcontentArea" value=$contentHTML[area]}	
		{assign var="content" value=$SMRTcontentArea}
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
			{if $content.elSubmit}
			<tr>
			  <TD align=left valign='middle'>				
						{assign var="SMRT_EL" value=$content.elSubmit}	
						{include file=$SMRT_EL.template}
				</td>											
			</tr>
			{/if}
				</div>
				</FORM>
		</TABLE>
{*	</fieldset>*}
{/section}