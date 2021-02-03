 <TABLE cellSpacing=10 cellPadding=1 border=0  width='100%' >
	  <THEAD>
	</THEAD>
  <TBODY>
  <TR>
  <TD width='100%'>
  {section  name=nav loop=$navigator.elements.link}
		{if $navigator.elements.link[nav] }
		<A href='{$navigator.elements.link[nav]}'>
		{/if}
			{$navigator.elements.caption[nav]}
		{if $navigator.elements.link[nav] }
		</A>
		{/if}
	{if $navigator.elements.caption[$smarty.section.nav.index_next]}
		{$navigator.separator}		
	{/if}		
  {/section}  
  </TD>
  </TR>
    </TBODY>
 </TABLE>
