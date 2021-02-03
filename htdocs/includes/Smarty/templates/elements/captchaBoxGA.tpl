<tr>
 <td align=right valign="top" width="180">
	<IMG  src="{$SMRT_EL.src}"  
			{if $SMRT_EL.border} border="{$SMRT_EL.border}" {else} border="0" {/if}  
			{if $SMRT_EL.title} title="{$SMRT_EL.title}" {/if}  
			{if $SMRT_EL.styleImg} style="{$SMRT_EL.styleImg}" {/if} 
			{if $SMRT_EL.onClick} onClick="{$SMRT_EL.onClick}" {/if}
			{if $SMRT_EL.onkeyup} onkeyup="{$SMRT_EL.onkeyup}" {/if}
			{if $SMRT_EL.onBlur} onBlur="{$SMRT_EL.onBlur}" {/if}
			{if $SMRT_EL.onFocus} onFocus="{$SMRT_EL.onFocus}" {/if}
			{if $SMRT_EL.onMouseOver} onMouseOver="{$SMRT_EL.onMouseOver}" {/if}		
			{if $SMRT_EL.onMouseOut} onMouseOut="{$SMRT_EL.onMouseOut}" {/if}		
			>
	</td>
 <td valign="top">
{if $SMRT_EL.necessary}
<script language="JavaScript">
	necessary[necessCount] = "{$SMRT_EL.nameInput}";
	necessCount ++;
</script>
{/if}					
 
 <INPUT  name='{$SMRT_EL.nameInput}'  
		 type='text'   
		{if $SMRT_EL.nameInput} id='{$SMRT_EL.nameInput}' {/if}  
		{if $SMRT_EL.class} class='{$SMRT_EL.class}' {/if}  
		{if $SMRT_EL.styleInput} style='{$SMRT_EL.styleInput}' {/if} 
		{if $SMRT_EL.onChange} onChange='{$SMRT_EL.onChange}' {/if}
		{if $SMRT_EL.onkeyup} onkeyup='{$SMRT_EL.onkeyup}' {/if}
		{if $SMRT_EL.onkeydown} onkeydown='{$SMRT_EL.onkeydown}' {/if}
		{if $SMRT_EL.onBlur} onBlur='{$SMRT_EL.onBlur}' {/if}
		{if $SMRT_EL.onFocus} onFocus='{$SMRT_EL.onFocus}' {/if}
		{if $SMRT_EL.onMouseOver} onMouseOver='{$SMRT_EL.onMouseOver}' {/if}
		{if $SMRT_EL.disabled} disabled {/if}
		value='{$SMRT_EL.default}'>
</td>
</tr>
