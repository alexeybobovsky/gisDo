{*literal}
<SCRIPT src="/includes/jquery/jquery.js" type=text/javascript></SCRIPT>
<SCRIPT type=text/javascript>
function abc(obj)
	{						
	var location =  "/company/test/";
	var param = obj.id;
	var res = document.getElementById('result');
	$.post(location, {id:param}, function(str) 
		{
		res.innerHTML = str;
		}
		);
	} 
</SCRIPT>
{/literal*}
<div class="title">Алфавитный указатель</div>
<div class='abc'>
<TABLE cellSpacing=5 cellPadding=1 border=0  width='100%' >
	  <THEAD>
	</THEAD>
  <TBODY>
{section  name=abc1 loop=$abcarr}
    <TR>
  <TD width='100%'>
		{section  name=abc2 loop=$abcarr[abc1].name}
		
		<A  href='{$option.link}{$abcarr[abc1].link[abc2]}'   id = 'letter_{$abcarr[abc1].linkl[abc2]}' {*onClick='abc(this)'*}{if $abcarr[abc1].link[abc2] == $option.selectedLetter}class='big-letter'{/if}>
			{$abcarr[abc1].name[abc2]}
		</A>
		{/section}   
  </TD>
  </TR>  
 {/section}
  </TBODY>
 </TABLE>
</DIV> 
{if $option.resultNum}
{* <TABLE cellSpacing=1 cellPadding=0 border=0  width='100%' >
	<TR>
	<TD valign='top'>
	<div><strong>
	<nobr>Компании, казвание которых ничинается на &#8594;&nbsp;&nbsp;</nobr></strong> 
	</div>&nbsp;
	</TD>
	<TD width='100%' valign='top' width='70%' >*}
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
{section  name=lst loop=$listFirm}
	<TR>
	<TD align='left'valign='top'>	
		<a href='{$listFirm[lst].link}' title='{$listFirm[lst].name}'>{$listFirm[lst].name}</a>
	</TD>		
	<TD align='center' class='rankCatalog'>{*<div >*}
		<span class='w{$listFirm[lst].class}'>{$listFirm[lst].rank}</span>{*</div>*}
	<TD>
	</TR>
{/section}
 </TBODY>
</TABLE>
</div>
{*</TD>
</TR>
</TABLE>*}
{elseif $option.selectedLetter}
<div class = 'firm-list-abc'>
<div class='title'>В каталоге отстутствуют компании, название которых начинается на выбранную Вами букву.</div>
</div>
{else}
<div class = 'firm-list-abc'>
<div class='title'>Название компании начинается на... ?</div>
</div>{/if}
<DIV id='result'>


</DIV>