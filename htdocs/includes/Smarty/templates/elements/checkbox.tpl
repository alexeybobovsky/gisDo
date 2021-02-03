{if $SMRT_EL.showCaption && $SMRT_EL.positionCaption=='left'}
	{$SMRT_EL.title}&nbsp;
{/if}
<INPUT  name="{$SMRT_EL.name}"  
		 type="{$SMRT_EL.type}"   
		{if $SMRT_EL.id} id="{$SMRT_EL.id}" {/if}  
		{if $SMRT_EL.title} title="{$SMRT_EL.title}" {/if}  
		{if $SMRT_EL.class} class="{$SMRT_EL.class}" {/if}  
		{if $SMRT_EL.style} style="{$SMRT_EL.style}" {/if} 
		{if $SMRT_EL.onChange} onChange="{$SMRT_EL.onChange}" {/if}
		{if $SMRT_EL.onkeyup} onkeyup="{$SMRT_EL.onkeyup}" {/if}
		{if $SMRT_EL.onBlur} onBlur="{$SMRT_EL.onBlur}" {/if}
		{if $SMRT_EL.onFocus} onFocus="{$SMRT_EL.onFocus}" {/if}
		{if $SMRT_EL.onClick} onClick="{$SMRT_EL.onClick}" {/if}
		{if $SMRT_EL.onChange} onChange="{$SMRT_EL.onChange}" {/if}
		{if $SMRT_EL.default} checked {/if}		
		{if $SMRT_EL.disabled} disabled {/if}
		>
{if $SMRT_EL.label}
	<label for="{$SMRT_EL.id}">{$SMRT_EL.label}</label>
{/if}
{if $SMRT_EL.useCompare}
<div id='DIVCMP_{$SMRT_EL.id}'>
	{include file='hidden_CMP.tpl'}
</div>												
{/if}
{if $SMRT_EL.showCaption && $SMRT_EL.positionCaption=='right'}
	&nbsp;{$SMRT_EL.title}
{/if}
		