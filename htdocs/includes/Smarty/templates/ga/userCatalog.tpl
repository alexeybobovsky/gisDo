 <TABLE cellSpacing=5 cellPadding=1 border=0  width='98%' >
	  <THEAD>
	</THEAD>
  <TBODY>
  <TR>
	<TD valign = 'top' align='left' width='50%' >
		<div class="title">Категории</div>	
		<div  class='catalog-list' >
	  {section  name=lst loop=$listCat}
		{if $listCat[$smarty.section.lst.index_prev].lvl && $listCat[lst].lvl < $listCat[$smarty.section.lst.index_prev].lvl}
		</div>	{/if}
		{if $listCat[lst].link}
		<a href='{$listCat[lst].link}' title='{$listCat[lst].title}'>
		{/if}
		<nobr>{$listCat[lst].name}</nobr>
		{if $listCat[lst].link}
		</a>
		{/if}
		</br>	
		{if $listCat[$smarty.section.lst.index_next].lvl && $listCat[lst].lvl < $listCat[$smarty.section.lst.index_next].lvl}
		<div>
		{/if}	{/section}
		</div>
	</TD>
	<TD valign = 'top' align='left' width='50%' >
		{if $listFirm}
		<div class="title">&#8594;{$curCat} ({$option.resultNum})</div>
		<div class = 'firm-list' width='100%' >
		<TABLE cellSpacing=0 cellPadding=0 border=0  width='100%' >
		<THEAD>
			<TR>
			<TH align='left'>	
				Компания
				&nbsp;
			</TH>		
			<TH align='center' >
				<nobr>Рейтинг &#8595;</nobr>
			<TH>
			</TR>
		</THEAD>
		<TBODY>
		{section  name=lst loop=$listFirm}
			<TR>
			<TD align='left'>	
				<a href='{$listFirm[lst].link}' title='{$listFirm[lst].name}'>{$listFirm[lst].name}</a>
			</TD>		
			<TD align='center' class='rankCatalog'>{*<div >*}
				<span class='w{$listFirm[lst].class}'><nobr>{$listFirm[lst].rank}</nobr></span>{*</div>*}
			<TD>
			</TR>
		{/section}
		</TBODY>
		</TABLE>
		{/if}
	</TD>
  </TR>
   </TBODY>
 </TABLE>