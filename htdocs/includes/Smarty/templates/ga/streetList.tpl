{if $strList}
<div id='strCont'  style='HEIGHT: 100px; OVERFLOW: auto; border: 1px solid blue; background: #ffffff;'>
{section name=streets loop=$strList}			
	<div  style='padding: 0px;' 
	TABINDEX='{$smarty.section.streets.index}' id='str_{$smarty.section.streets.index}' 
			onMouseOver='streetListNav(this);' onClick='selectStr(this);' onkeydown='streetListNav(this);'>
	{$strList[streets].str_name}
	</div>
{/section}
</div>
{else}
{/if}
