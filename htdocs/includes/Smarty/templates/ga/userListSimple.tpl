 <TABLE cellSpacing=5 cellPadding=1 border=0  width='100%' >
	  <THEAD>
	</THEAD>
  <TBODY>
  {assign var="SMRT_ID" value=$option.idName}
  {assign var="SMRT_CAPTION" value=$option.captionName}
  {section  name=lst loop=$list}
  <TR>
  <TD width='100%'>
		<A href='{$option.link}{$list[lst].$SMRT_ID}'>
			{if $option.captionUpper}
				{$list[lst].$SMRT_CAPTION|upper}
			{else}
				{$list[lst].$SMRT_CAPTION}
			{/if}
		</A>
  </TD>
  </TR>
  {/section}  
  </TBODY>
 </TABLE>
