{*include file='ga/userCompanyHeader.tpl'*}
<DIV class='firm-list-abc' >	
 <TABLE cellSpacing=0 cellPadding=3 border=0 width='100%' >
	  <THEAD>
<TR><TH>����</TH><TH>������������</TH></TR>
	</THEAD>
  <TBODY>
  {section  name=obj loop=$object}
  <TR>
  <TD width='50%' valign = 'top'>
		{if $object[obj].location.adr}
		<strong>�����:</strong> &nbsp;
		{$object[obj].location.adr}
		<br>
		{/if}
		{if $object[obj].location.phone}
		<strong>�������:</strong> &nbsp;
		{$object[obj].location.phone}
		<br>
		{/if}		
  </TD>
  <TD width='50%' valign = 'top'>
	{*<strong>������������:</strong> *}
	{section name=layer loop=$object[obj].layers }
		<a href='{$option.linkCategory}{$object[obj].layers[layer].layerId}'>{$object[obj].layers[layer].layerName}</a></br>
	{/section}
  </TD>
  </TR>
  {/section}  
  </TBODY>
 </TABLE>
</DIV>
<DIV class='firm-profile'>
{if $firmRate.total.value}
��������  {if $firmRate.total.num>1} ������� {else} ������ {/if} {$firmRate.total.num} {$firmRate.total.word}. 
{else}
�������� ��� �� ����� ������.
{/if}
{if $firmRate.curRate}
�� ��������� ������ <SPAN class='rate{$firmRate.curRate.rate_value}'>{$firmRate.curRate.rate_value}</SPAN>
{else}

{/if}

</DIV>

{*include file='ga/userCompanyFooter.tpl'*}