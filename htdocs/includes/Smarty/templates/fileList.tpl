	<div id = 'tree'  style=" HEIGHT: 40px; OVERFLOW: auto; PADDING-LEFT: 5px; WIDTH: 98%; border-width: 1px; border-style: solid; border-color: #DEDEDE;" >
	{section name=el loop=$content.groupCaption}
		{assign var="SMRT_EL" value=$content.files[el]}	
		<DIV id='DIV_{$content.files[el].name}'> 
		{include file=$SMRT_EL.template}
		&nbsp;
		{$content.groupCaption[el]}
		</DIV>
	{/section}
	</div>
{assign var="SMRT_EL" value=$content.membSubmit}	
{include file=$content.membSubmit.template}


