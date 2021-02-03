 <div class="title"><i><b>{$option.title}</b></i></div>
{if !$searchList}
По Вашему запросу ничего не найдено.
{else}
<div class = 'firm-list-abc'>
<TABLE cellSpacing=0 cellPadding=0 border=0  width='80%' >
	  <THEAD>
	<TR>
	<TH align='left' valign='top'>	
		Компании ({$option.resultNum}){*на <u>{$option.selectedLetter}</u>*} &#8595;
		&nbsp;
	</TH>		
	<TH align='center' >
		Рейтинг
	<TH>
	</TR>
	</THEAD>
  <TBODY>
{section  name=lst loop=$searchList}
	<TR>
	<TD align='left'valign='top'>	
		<a href='{$searchList[lst].firm_link}' title='{$searchList[lst].firm_name}'>{$searchList[lst].firm_nameNew}</a>
	</TD>		
	<TD align='center' class='rankCatalog'>{*<div >*}
		<span class='w{$searchList[lst].class}'>{$searchList[lst].firm_rank}</span>{*</div>*}
	<TD>
	</TR>
{/section}
 </TBODY>
</TABLE>
</div>
{/if}