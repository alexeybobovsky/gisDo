    </TD>
		<TD width="10"><IMG height=1  src="{$header.body.imgSrc}_.gif" width="10" border="0"></TD>
</TD>
</TR>
<TR>
<TD colspan="6">
<!-- ������ ����� ��������� / ��������� � �������� -->
<TABLE class=footer cellSpacing=0 cellPadding=0 width="100%" border=0>
  <TBODY>
  <TR vAlign=top>
    <TD width="30%">&nbsp;</TD>
    <TD vAlign=top width="45%">&nbsp;</TD>
    <TD width="25%">
      <DIV class=copyright 
      style="PADDING-LEFT: 0px"><SPAN>�&nbsp;{$header.curYear}</SPAN> �<A 
      href="/">�����-����.���</A>� <BR>
	  {*<A href="/about">�&nbsp;�������</A>&nbsp;� *}
	  <A href="/feedback">��������&nbsp;�����</A>&nbsp;&bull;&nbsp;
	  <A href="/advert">�������&nbsp;��&nbsp;�����</A>&nbsp;&bull;&nbsp;
	<A href={if $header.newFirmLink}"{$header.newFirmLink}"{else}#{/if}>
		<span id="new_firm_link" {if !$header.newFirmLink} OnClick="alert('����� �������� ����� �������� � �������, ���������� ������������������ �� �����!');" {/if} title="�������� �������� � �������" >
	<nobr>��������&nbsp;��������</nobr></span></A>&nbsp;
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