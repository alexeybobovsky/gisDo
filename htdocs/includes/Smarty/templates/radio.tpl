<INPUT  name="{$SMRT_EL.name}"  
		 type="{$SMRT_EL.type}"   
		{if $SMRT_EL.id} id="{$SMRT_EL.id}" {/if}  
		{if $SMRT_EL.value} value="{$SMRT_EL.value}" {/if}  
		{if $SMRT_EL.default} checked=1 {/if}
		{if $SMRT_EL.class} class="{$SMRT_EL.class}" {/if}  
		{if $SMRT_EL.style} style="{$SMRT_EL.style}" {/if} 
		{if $SMRT_EL.onChange} onChange="{$SMRT_EL.onChange}" {/if}
		{if $SMRT_EL.onClick} onClick="{$SMRT_EL.onClick}" {/if}
		{if $SMRT_EL.onkeyup} onkeyup="{$SMRT_EL.onkeyup}" {/if}
		{if $SMRT_EL.onBlur} onBlur="{$SMRT_EL.onBlur}" {/if}
		{if $SMRT_EL.onFocus} onFocus="{$SMRT_EL.onFocus}" {/if}
		{if $SMRT_EL.onMouseOver} onMouseOver="{$SMRT_EL.onMouseOver}" {/if}
		{*value="{$SMRT_EL.default}"*}>