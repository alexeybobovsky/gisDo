<input type=hidden name='minShow_{$SMRT_EL.name}' id='minShow_{$SMRT_EL.name}'  value='{$SMRT_EL.minShow}' >
<input type=hidden name='maxShow_{$SMRT_EL.name}' id='maxShow_{$SMRT_EL.name}'  value='{$SMRT_EL.maxShow}' >
<input type=hidden name='curDate_{$SMRT_EL.name}' id='curDate_{$SMRT_EL.name}'  value='{$SMRT_EL.curDate}' >

<select name="{$SMRT_EL.name}_date"  
 id="{$SMRT_EL.id}_date" 
 style = "width:50px" >
{section name=sel loop=$SMRT_EL.day}	
	<option value="{$SMRT_EL.day[sel]}" {if $SMRT_EL.default.day == $SMRT_EL.day[sel]} selected {/if} >{$SMRT_EL.day[sel]}</option>
{/section}
</select>					
&nbsp;
<select name="{$SMRT_EL.name}_month"  
 id="{$SMRT_EL.id}_month" 
 style = "width:100px" >
{section name=sel loop=$SMRT_EL.month.values}	
	<option value="{$SMRT_EL.month.values[sel]}" {if $SMRT_EL.default.month == $SMRT_EL.month.values[sel]} selected {/if} >{$SMRT_EL.month.captions[sel]}</option>
{/section}
</select>					
&nbsp;
<select name="{$SMRT_EL.name}_year"  
 id="{$SMRT_EL.id}_year" 
 style = "width:100px" >
{section name=sel loop=$SMRT_EL.year}	
	<option value="{$SMRT_EL.year[sel]}" {if $SMRT_EL.default.year == $SMRT_EL.year[sel]} selected {/if} >{$SMRT_EL.year[sel]}</option>
{/section}
</select>					
&nbsp;
<IMG  src="{$SMRT_EL.src}"  
		border=0
		{if $SMRT_EL.id} id="{$SMRT_EL.id}_IMG" {/if}  
		{if $SMRT_EL.class} class="{$SMRT_EL.class}" {/if}  
		{if $SMRT_EL.onMouseMove} onMouseMove="{$SMRT_EL.onMouseMove}" {/if}
		{if $SMRT_EL.onClick} onClick="{$SMRT_EL.onClick}" {/if}
		>		