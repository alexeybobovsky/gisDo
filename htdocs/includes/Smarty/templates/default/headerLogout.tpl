<div style="z-index: 100; height: 100px; width: 450; top: 19px; left: 140px; position: absolute">
    <table cellpadding="10" cellspacing="0" width="450">
	<tbody>
       <tr valign="top">
         <TD style="PADDING-LEFT: 0px; PADDING-TOP: 5px; PADDING-BOTTOM: 0px;">
<div class='login'>
{$header.userName} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
</div>
                  <DIV class=modelTabs>
                  <UL>
					{if $newMessages.cnt}
			 		<LI ><SPAN>
						<A href='/user/{$header.userName}/message' class="red">{$newMessages.cnt} {$newMessages.name}</A>
					</SPAN></LI>
					{else}
			 		<LI ><SPAN>
						<A href='/user/{$header.userName}/message'>���������</A>
					</SPAN></LI>					
					{/if}
                    <LI ><SPAN><A href='/user/{$header.userName}'>�������</A></SPAN></LI>                    
					<LI ><SPAN><A href='/user/{$header.userName}/company/add'><nobr>�������� ��������</nobr></A></SPAN></LI>
                  </UL>
                  </DIV>
  	</TD>
    </tr>
	
  </tbody>
</table>
</div>
