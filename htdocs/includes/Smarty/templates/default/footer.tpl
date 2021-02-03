    </TD>
		<TD width="10"><IMG height=1  src="{$header.body.imgSrc}_.gif" width="10" border="0"></TD>
</TD>
</TR>
<TR>
<TD colspan="6">
<!-- Нижняя часть странички / сопирайты и контакты -->
<TABLE class=footer cellSpacing=0 cellPadding=0 width="100%" border=0>
  <TBODY>
  <TR vAlign=top>
    <TD width="30%">&nbsp;</TD>
    <TD vAlign=top width="45%">&nbsp;</TD>
    <TD width="25%">
      <DIV class=copyright 
      style="PADDING-LEFT: 0px"><SPAN>©&nbsp;{$header.curYear}</SPAN> «<A 
      href="/">ГОРОД-АВТО.КОМ</A>» <BR>
	  {*<A href="/about">О&nbsp;проекте</A>&nbsp;· *}
	  <A href="/feedback">Обратная&nbsp;связь</A>&nbsp;&bull;&nbsp;
	  <A href="/advert">Реклама&nbsp;на&nbsp;сайте</A>&nbsp;&bull;&nbsp;
	<A href={if $header.newFirmLink}"{$header.newFirmLink}"{else}#{/if}>
		<span id="new_firm_link" {if !$header.newFirmLink} OnClick="alert('Чтобы добавить новую компанию в каталог, необходимо зарегистрироваться на сайте!');" {/if} title="Добавить компанию в каталог" >
	<nobr>Добавить&nbsp;компанию</nobr></span></A>&nbsp;
      </DIV></TD>
      </TR></TBODY>
</TABLE>

</TD>
</TR>
</TBODY>
</TABLE>


</TD></TR></TBODY>
</TABLE>


</body>
</html>