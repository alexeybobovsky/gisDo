<span  name="{$SMRT_EL.name}"  
		{if $SMRT_EL.id} id="{$SMRT_EL.id}" {/if}  
		{if $SMRT_EL.class} class="{$SMRT_EL.class}" {/if}  
		{if $SMRT_EL.style} style="{$SMRT_EL.style}" {/if} 
		{if $SMRT_EL.onMouseOver} onMouseOver="{$SMRT_EL.onMouseOver}" {/if}
		{if $SMRT_EL.onMouseMove} onMouseMove="{$SMRT_EL.onMouseMove}" {/if}
		{if $SMRT_EL.onClick} onClick="{$SMRT_EL.onClick}" {/if}
		>
		{if $SMRT_EL.bold}
		<b>
		{/if}
		{$SMRT_EL.default}
		{if $SMRT_EL.bold}
		</b>
		{/if}
		</span>