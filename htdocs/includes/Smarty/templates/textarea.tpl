<TEXTAREA 
	name="{$SMRT_EL.name}"  
	{if $SMRT_EL.id} id="{$SMRT_EL.id}" {/if}  
	{if $SMRT_EL.class} class="{$SMRT_EL.class}" {/if}  
	{if $SMRT_EL.style} style="{$SMRT_EL.style}" {/if} 
	{if $SMRT_EL.onChange} onChange="{$SMRT_EL.onChange}" {/if}
	{if $SMRT_EL.onkeyup} onkeyup="{$SMRT_EL.onkeyup}" {/if}
	{if $SMRT_EL.onBlur} onBlur="{$SMRT_EL.onBlur}" {/if}
	{if $SMRT_EL.onFocus} onFocus="{$SMRT_EL.onFocus}" {/if}
	{if $SMRT_EL.onMouseOver} onMouseOver="{$SMRT_EL.onMouseOver}" {/if}
	{if $SMRT_EL.disabled} disabled {/if}
	{if $SMRT_EL.rows} rows="{$SMRT_EL.rows}" {/if}
	{if $SMRT_EL.cols} cols="{$SMRT_EL.cols}" {/if}
	{if $SMRT_EL.wrap} wrap="{$SMRT_EL.wrap}" {/if}
	>{$SMRT_EL.default}
</TEXTAREA>
{if $SMRT_EL.useCompare}
<div id='DIVCMP_{$SMRT_EL.id}'>
	{include file='hidden_CMP.tpl'}
</div>												
{/if}
	
