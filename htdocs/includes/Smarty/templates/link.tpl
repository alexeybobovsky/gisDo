	<a  
		{if $SMRT_EL.name} name="div{$SMRT_EL.name}"  {/if}
		{if $SMRT_EL.id} id="div{$SMRT_EL.id}" {/if}
		href="{$SMRT_EL.href}" 
		{if $SMRT_EL.target} target="{$SMRT_EL.target}" {/if}  
		{if $SMRT_EL.class} class="{$SMRT_EL.class}" {/if}  
		{if $SMRT_EL.style} style="{$SMRT_EL.style}" {/if} >
		{$SMRT_EL.default}
		</a>