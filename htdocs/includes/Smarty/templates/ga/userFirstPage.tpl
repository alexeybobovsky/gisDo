 
 <div class="title"><i><b>{*<a href="/category" class='u1'>*}Категории{*</a>*}</b></i></div>
{assign var="SMRT_tag" value=$tagsCat}
{include file='ga/tagCloud.tpl'}</br>
 <div class="title"><i><b>{*<a href="/company" class='u1'>*}Компании{*</a>*}</b></i></div>
{assign var="SMRT_tag" value=$tagsFirms}
{include file='ga/tagCloud.tpl'} 
 
 <TABLE cellSpacing=10 cellPadding=1 border=0  width='100%' >
	  <THEAD>
	</THEAD>
  <TBODY>

  <TR>
  <TD width='100%'>
<fieldset>
<legend>Добавились комментарии к компаниям:</legend> 	
  {section  name=cmt loop=$comments}		
  <DIV><A href='/company/{$comments[cmt].firm_nameTranslit}'>
				{$comments[cmt].firm_name}
		</A> - всего камментов - {$comments[cmt].firm_comments} 
</DIV>
 {/section}  
</fieldset>
  </TD>
  </TR>
  <TR>
  <TD width='100%'>
<fieldset>
<legend>Изменились оценки у компаний: </legend> 	
  {section  name=cmt loop=$rates}		
  <DIV><A href='/company/{$rates[cmt].firm_nameTranslit}'>
				{$rates[cmt].firm_name} 
		</A> - средний балл - {$rates[cmt].firm_rank} 
</DIV>
 {/section}  
</fieldset>
  </TD>
  </TR>
  <TR>
  <TD width='100%'>
  {*
<fieldset>
<legend>Чарты: </legend> 	
  <DIV>Ну и рейтинги компаний по оценкам, количествам просмотра (надо, кстати, сделать "умный" счетчик посещений - типо напоминалка ;-) ), комментариям и т.п. - примерно как на images.irkut
</DIV>
</fieldset>*}
  </TD>
  </TR>
  </TBODY>
 </TABLE>