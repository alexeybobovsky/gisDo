 
 <div class="title"><i><b>{*<a href="/category" class='u1'>*}���������{*</a>*}</b></i></div>
{assign var="SMRT_tag" value=$tagsCat}
{include file='ga/tagCloud.tpl'}</br>
 <div class="title"><i><b>{*<a href="/company" class='u1'>*}��������{*</a>*}</b></i></div>
{assign var="SMRT_tag" value=$tagsFirms}
{include file='ga/tagCloud.tpl'} 
 
 <TABLE cellSpacing=10 cellPadding=1 border=0  width='100%' >
	  <THEAD>
	</THEAD>
  <TBODY>

  <TR>
  <TD width='100%'>
<fieldset>
<legend>���������� ����������� � ���������:</legend> 	
  {section  name=cmt loop=$comments}		
  <DIV><A href='/company/{$comments[cmt].firm_nameTranslit}'>
				{$comments[cmt].firm_name}
		</A> - ����� ��������� - {$comments[cmt].firm_comments} 
</DIV>
 {/section}  
</fieldset>
  </TD>
  </TR>
  <TR>
  <TD width='100%'>
<fieldset>
<legend>���������� ������ � ��������: </legend> 	
  {section  name=cmt loop=$rates}		
  <DIV><A href='/company/{$rates[cmt].firm_nameTranslit}'>
				{$rates[cmt].firm_name} 
		</A> - ������� ���� - {$rates[cmt].firm_rank} 
</DIV>
 {/section}  
</fieldset>
  </TD>
  </TR>
  <TR>
  <TD width='100%'>
  {*
<fieldset>
<legend>�����: </legend> 	
  <DIV>�� � �������� �������� �� �������, ����������� ��������� (����, ������, ������� "�����" ������� ��������� - ���� ����������� ;-) ), ������������ � �.�. - �������� ��� �� images.irkut
</DIV>
</fieldset>*}
  </TD>
  </TR>
  </TBODY>
 </TABLE>