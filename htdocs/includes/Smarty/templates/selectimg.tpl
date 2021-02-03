<select name="{$SMRT_EL.name}"  
{if $SMRT_EL.id} id="{$SMRT_EL.id}" {/if}  
{if $SMRT_EL.class} class="{$SMRT_EL.class}" {/if} 
{if $SMRT_EL.style} style="{$SMRT_EL.style}" {/if} 
{if $SMRT_EL.onChange} onChange="{$SMRT_EL.onChange}" {/if}
{if $SMRT_EL.onBlur} onBlur="{$SMRT_EL.onBlur}" {/if}
{if $SMRT_EL.onMouseOver} onMouseOver="{$SMRT_EL.onMouseOver}" {/if}
{if $SMRT_EL.disabled} disabled {/if}
{if $SMRT_EL.size} size="{$SMRT_EL.size}" {/if}
{if $SMRT_EL.multiple} multiple {/if}
{if $SMRT_EL.onFocus} onFocus="{$SMRT_EL.onFocus}" {/if}>
{if $SMRT_EL.emptyValue}
	<option label="{$SMRT_EL.emptyValue}" value="{$SMRT_EL.empty}"></option>
{/if}
{section name=sel loop=$SMRT_EL.value}	
	<option value="{$SMRT_EL.value[sel]}" {if $SMRT_EL.default == $SMRT_EL.value[sel]} selected {/if} >{$SMRT_EL.caption[sel]}</option>
{/section}
</select>		
{*if $SMRT_EL.src*}			<br>
<IMG  src="{$SMRT_EL.src}"  
		border=0
		{if $SMRT_EL.id} id="{$SMRT_EL.id}_IMG" {/if}  
		{if $SMRT_EL.class} class="{$SMRT_EL.class}" {/if}  
		>
{*/if*}