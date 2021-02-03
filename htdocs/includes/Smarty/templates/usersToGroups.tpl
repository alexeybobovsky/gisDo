<div>
{literal}
<input type=text findCnt=0 style="width: 98%" value='Напишите название' title='Напишите название' name='search' id='search' 
	onClick='if(this.findCnt==0) {this.value = ""; this.findCnt++;}'
	onkeyup = 'searchElement(this, this.form)'
	onchange = 'searchElement(this, this.form)'
	>
{/literal}
</div>	
	<div id = 'tree'  style=" HEIGHT: 100px; OVERFLOW: auto; PADDING-LEFT: 5px; WIDTH: 98%; border-width: 1px; border-style: solid; border-color: #DEDEDE;" >
	{section name=el loop=$content.groupCaption}
		{assign var="SMRT_EL" value=$content.groups[el]}	
		<DIV id='DIV_{$content.groups[el].name}'> 
		{include file=$SMRT_EL.template}
		&nbsp;
		{$content.groupCaption[el]}
		</DIV>
	{/section}
	</div>
<br>
{assign var="SMRT_EL" value=$content.membSubmit}	
{include file=$content.membSubmit.template}	


