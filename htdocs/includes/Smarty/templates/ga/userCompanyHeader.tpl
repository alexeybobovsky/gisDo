<script type="text/javascript" src="/includes/JS/scriptUsers.js"></script>
<TABLE cellSpacing=0 cellPadding=0 border=0 width='95%' >
	  <THEAD>
	</THEAD>
  <TBODY>
  <TR><TD class="firm-info-title" valign='bottom' width='95%' >
  {*<div>*}{$firm.firm_name}{*</div>*}
  </TD><TD align=center >
  <span class="firm-info-rank-title" ><nobr>�������� ������</nobr></span> 
	{if !$firmRate.total}
	<div class="firm-info-rank-empty" ><nobr>��� ������</nobr></div>
	{else}
	<div class="firm-info-rank" ><nobr>{$firmRate.total.value}</nobr></div>
	{/if}
  </TD></TR>
  <TR><TD colspan='2'>  
      <DIV class=modelTabs>
      <UL>
		{section   name=mt loop=$menuTabs.tabs}
        <LI {if $smarty.section.mt.index == $menuTabs.current}class=current{/if} ><SPAN> 
		{if $smarty.section.mt.index != $menuTabs.current}<A href='{$menuTabs.tabs[mt].link}'>{$menuTabs.tabs[mt].name}</A>{else}
		{$menuTabs.tabs[mt].name}
		{/if}</SPAN> </LI>
		{/section}
		</UL></DIV>
  </TD></TR>
  <TR><TD colspan='2' width='100%'>  