		{if $SMRT_EL.MAX_FILE_SIZE}
		<input type="hidden" name="MAX_FILE_SIZE" value="{$SMRT_EL.MAX_FILE_SIZE}">
		{/if}
<INPUT  name="{$SMRT_EL.name}"  
		 type="{$SMRT_EL.type}"   
		{if $SMRT_EL.id} id="{$SMRT_EL.id}" {/if}  
		{if $SMRT_EL.class} class="{$SMRT_EL.class}" {/if}  
		{if $SMRT_EL.style} style="{$SMRT_EL.style}" {/if} 
		{if $SMRT_EL.onChange} onChange="{$SMRT_EL.onChange}" {/if}
		{if $SMRT_EL.onkeyup} onkeyup="{$SMRT_EL.onkeyup}" {/if}
		{if $SMRT_EL.onBlur} onBlur="{$SMRT_EL.onBlur}" {/if}
		{if $SMRT_EL.onFocus} onFocus="{$SMRT_EL.onFocus}" {/if}
		{if $SMRT_EL.onMouseOver} onMouseOver="{$SMRT_EL.onMouseOver}" {/if}
		{if $SMRT_EL.disabled} disabled {/if}
		value="{$SMRT_EL.default}">
		{if $SMRT_EL.CheckIt} 
		<input type = hidden name="{$SMRT_EL.CheckIt}{$SMRT_EL.name}" value='1'>
		{/if}
