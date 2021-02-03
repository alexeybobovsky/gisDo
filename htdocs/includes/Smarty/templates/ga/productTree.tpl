<TABLE  class=tree cellSpacing=0 cellPadding=0 width="100%" border=0>
  <TBODY>
{section name=tree loop=$Catalog.tree}	
	{assign var="SMRT_NODE" value=$Catalog.tree[tree]}
	{if $SMRT_NODE.product_id>=0}
	<tr>  
	<td>
	<div>
		<TABLE  cellSpacing=0 cellPadding=0 width="100%" border=0>
			<tr>
			{if $SMRT_NODE.product_lvl>1}
			{section name=space loop=$SMRT_NODE.product_lvl-1 }	
			<td valign=top width='16'>
			<img  src="/src/design/tree/s.gif" border = 0>		
			</td>
			{/section}	
			{/if}
			<td valign=top width='16'>
				{if $SMRT_NODE.is_group && $SMRT_NODE.product_lvl>0}<span id='switch_{$SMRT_NODE.product_id}'>
					<img id='img_{$SMRT_NODE.product_id}{*_{$SMRT_NODE.product_lvl}*}' src=
					"/src/design/tree/treePlus.gif"
					onclick="nodeExpand(this);"
					onMouseMove="this.style.cursor='hand'; this.style.cursor='pointer'; return false;"
					></span>
				{elseif !$SMRT_NODE.is_group && $SMRT_NODE.product_lvl>0}
					<img id='img_{$SMRT_NODE.product_id}'  src="/src/design/tree/s.gif" border = 0>
				{/if}
			</td>
			<td valign=top  width='20'>
					<img id='nodeIcon_{$SMRT_NODE.product_id}' src="/src/design/tree/
					{if $SMRT_NODE.is_group}
					folder.gif
					{else}
					page.gif
					{/if}
					">
			</td>
			<td align=left width="100%" id='parent_{$SMRT_NODE.product_parent}'>
					<span  id='link_{$SMRT_NODE.product_id}'
					onclick="itemSelect(this); "    	  
					onMouseMove="this.style.cursor='hand';  this.style.cursor='pointer'; return false;"					
					>
					<span {if $SMRT_NODE.product_hidden}style='color:#aaaaaa;'{/if} title='{$SMRT_NODE.product_name}' id='text_{$SMRT_NODE.product_id}'>
							{$SMRT_NODE.product_name}
					</span>
					<span  id=itemId_{$SMRT_NODE.product_id} style='color:#aaaaaa;' >
						&nbsp;({$SMRT_NODE.product_id})
					</span>
					</span>
				</td>
			</tr>
		</table>
	</div>		
	<div id='node_{$SMRT_NODE.product_id}' style="DISPLAY: none">
	</div>
	</td>
	</tr>
	{/if}
{/section}
	</TBODY>
</TABLE>