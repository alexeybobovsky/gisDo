<DIV class='user-profile' >	
 <TABLE cellSpacing=0 cellPadding=3 border=0 {*width='100%' *}>
	  <THEAD>
	</THEAD>
  <TBODY>
  {section  name=inf loop=$userInfo}
  <TR>
  <TD {*width='20%'*} valign = 'top' class='left-col' align='right'>
		<strong>{$userInfo[inf].name}</strong> &nbsp;
  </TD>
  <TD {*width='50%'*} valign = 'top'>
		{$userInfo[inf].value} &nbsp;
  </TD>
  </TR>
  {/section}  
  </TBODY>
 </TABLE>
</DIV>