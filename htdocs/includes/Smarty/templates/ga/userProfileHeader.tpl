<TABLE cellSpacing=0 cellPadding=0 border=0 width='95%' >
	  <THEAD>
	</THEAD>
  <TBODY>
  <TR><TD class="firm-info-title" valign='bottom' width='95%' >
  {*<div>*}{$profile.profileTitle}{*</div>*}
  </TD>
  {*<TD align=center >
  <span class="firm-info-rank-title" ><nobr>Народная оценка</nobr></span> 
	{if !$firmRate.total}
	<div class="firm-info-rank-empty" ><nobr>Нет оценок</nobr></div>
	{else}
	<div class="firm-info-rank" ><nobr>{$firmRate.total.value}</nobr></div>
	{/if}
  </TD>*}</TR>
  <TR><TD colspan='2'>
{if !$profile.hideSubMenu}  
      <DIV class=modelTabs>
      <UL>
		{section   name=mt loop=$menuTabs.tabs}
        <LI {if $menuTabs.tabs[mt].name == $menuTabs.current}class=current{/if} ><SPAN> 
		{if $menuTabs.tabs[mt].name != $menuTabs.current}<A href='{$menuTabs.tabs[mt].link}'>{$menuTabs.tabs[mt].name}</A>{else}
		{$menuTabs.tabs[mt].name}
		{/if}</SPAN> </LI>
		{/section}
		</UL></DIV>
{/if}		
  </TD></TR>
  <TR><TD colspan='2' width='100%' align='left'>  