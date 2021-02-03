	{section name=area loop=$contentHTML}
	{assign var="SMRTcontentArea" value=$contentHTML[area]}	
		{assign var="content" value=$SMRTcontentArea}
		<FORM name='{$content.form.form_name}' action='{$content.form.form_action}' method='post' encType='multipart/form-data' {if $content.form.form_onSubmit}onSubmit='{$content.form.form_onSubmit}'{/if} >
		<DIV class='comment-box'>
			{if $content.form.form_elementCaption}
				<SPAN id='caption_{$content.form.form_name}' {if $content.form.form_isHidden} class='captionOfHidden' onClick='commentBoxSwitcher(this, "{$content.form.form_elementCaption}");' {/if} > + {$content.form.form_elementCaption} </SPAN>
				
				{if $SMRT_EL.necessary}
						<font color=red>*</font>
				{else}
						&nbsp;
				{/if}				
			{/if}		
			<DIV id='body_{$content.form.form_name}' {if $content.form.form_isHidden} style='DISPLAY:NONE;'{/if}>				
			{section name=el loop=$content.elements}
					{assign var="SMRT_EL" value=$content.elements[el]}
						{if $SMRT_EL.necessary}
						<script language="JavaScript">
							necessary[necessCount] = "{$SMRT_EL.name}";
							necessCount ++;
						</script>
						{/if}					

							{*<span id='DIV{$SMRT_EL.name}'>*}
							{if !$SMRT_EL.skipTemplate}
								{include file='elements/'|cat:$SMRT_EL.template}
								{*include file=$SMRT_EL.template*}
							{/if}
							{*</span>*}
				{/section}
			{if $content.elSubmit}
						{assign var="SMRT_EL" value=$content.elSubmit}
						{include file=$SMRT_EL.template}

			{/if}
			</DIV>
</DIV>
		</FORM>
	{/section}
