{if $SMRT_EL.link}
<a href='{$SMRT_EL.link}' >
{/if}
<IMG  src="{$SMRT_EL.src}"  
		{if $SMRT_EL.border} border="{$SMRT_EL.border}" {else} border="0" {/if}  
		{if $SMRT_EL.width} width="{$SMRT_EL.width}" {/if}  
		{if $SMRT_EL.height} height="{$SMRT_EL.height}" {/if}  
		{if $SMRT_EL.id} id="{$SMRT_EL.id}" {/if}  
		{if $SMRT_EL.class} class="{$SMRT_EL.class}" {/if}  
		{if $SMRT_EL.title} title="{$SMRT_EL.title}" {/if}  
		{if $SMRT_EL.style} style="{$SMRT_EL.style}" {/if} 
		{if $SMRT_EL.onChange} onChange="{$SMRT_EL.onChange}" {/if}
		{if $SMRT_EL.onClick} onClick="{$SMRT_EL.onClick}" {/if}
		{if $SMRT_EL.onkeyup} onkeyup="{$SMRT_EL.onkeyup}" {/if}
		{if $SMRT_EL.onBlur} onBlur="{$SMRT_EL.onBlur}" {/if}
		{if $SMRT_EL.onFocus} onFocus="{$SMRT_EL.onFocus}" {/if}
		{if $SMRT_EL.onMouseOver} onMouseOver="{$SMRT_EL.onMouseOver}" {/if}		
		{if $SMRT_EL.onMouseOut} onMouseOut="{$SMRT_EL.onMouseOut}" {/if}		
		>
{if $SMRT_EL.link}
</a>
{/if}
