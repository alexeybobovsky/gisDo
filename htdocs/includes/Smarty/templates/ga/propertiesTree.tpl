{if !$renew}
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
  <TBODY>
<SCRIPT language=JavaScript>
function treeExpand(img, oObj) 
{literal}
	{
//	alert(img.id);	
	var tr = document.getElementById(oObj);
	var image = document.getElementById(img.id);
	var imageName = GetLastEl(document.getElementById(img.id).src, '/');
	var d, new_src,  s = '/src/design/tree/';	
	if(imageName ==  'treePlus.gif')
		{
		new_src = 'treeMinus.gif';
		$(tr).fadeIn("fast", function(){image.src = s+ new_src});	
		}
	else
		{
		new_src = 'treePlus.gif';
		$(tr).fadeOut("fast", function(){image.src = s+ new_src});	
		}
	return true;
	} 
{/literal}
</SCRIPT>
{section name=tree loop=$tree}	
	{assign var="SMRT_NODE" value=$tree[tree]}
	<tr id = 'tr_{$SMRT_NODE.item.pp_id}' >
		<td>
	{if $SMRT_NODE.isFirst}
		{assign var="SMRT_CURTABLE" value=$SMRT_NODE.item.pp_id}	
		<div id='table_{$SMRT_NODE.item.pp_id}' {if $SMRT_NODE.lvl>0 && $SMRT_NODE.item.pp_parentId != $openGrp} style="DISPLAY: none" {/if}>
		<TABLE border=0  
			id='ttable_{$SMRT_NODE.item.pp_id}' 
			cellSpacing=0 cellPadding=0 width="100%" border=0 >
		  <TBODY id='body_{$SMRT_NODE.item.pp_id}' >
		<tr id='table_tr{$SMRT_NODE.item.pp_id}' >
			<td valign='middle'>			
	{/if}
	<div id='node_{$SMRT_NODE.item.pp_id}'>
	{if !$tree[tree].lvl && ($tree[$smarty.section.tree.index_next].lvl > $tree[tree].lvl) }
	<IMG class=tree 
			src="/src/design/tree/{if $SMRT_NODE.item.pp_id != $openGrp}treePlus.gif{else}treeMinus.gif{/if}" 
			width=16 align=middle 
			id = 'img_{$SMRT_NODE.item.pp_id}'
			onclick="treeExpand(this, 'table_{$tree[$smarty.section.tree.index_next].item.pp_id}')"
			onMouseMove='this.style.cursor="hand"; return false;'	>			
	{elseif !$tree[tree].lvl && ($tree[$smarty.section.tree.index_next].lvl == $tree[tree].lvl) }
	<IMG class=tree src="/src/design/tree/s.gif" width=16 align=middle>	
	{elseif $tree[tree].lvl}
	<IMG class=tree src="/src/design/tree/s.gif" width=16 align=middle>		
	<IMG class=tree src="/src/design/tree/s.gif" width=16 align=middle>		
	{/if}
	{if $tree[tree].item.pp_type != 'group'}
		<IMG id='nodeIcon_{$SMRT_NODE.item.pp_id}' class=tree src="/src/design/tree/pageInfo.gif" width=16 align=middle>		
	{else}
		<IMG id='nodeIcon_{$SMRT_NODE.item.pp_id}' class=tree src="/src/design/tree/folder.gif" width=16 align=middle>			
	{/if}
	<span id=item_{$SMRT_NODE.item.pp_id}>
					<span  id=link_{$SMRT_NODE.item.pp_id} 					
					onclick="itemSelectProperties(this); "    	  
					onMouseMove="this.style.cursor='hand'; this.style.cursor='pointer'; return false;">
					<span  id=text_{$SMRT_NODE.item.pp_id} >
						{$SMRT_NODE.item.pp_name|truncate:80:"...":true}
					</span>
					<span  id=itemId_{$SMRT_NODE.item.pp_id} style='color:#aaaaaa;' >
						&nbsp;({$SMRT_NODE.item.pp_id})
					</span>
					</span>						
					{if $tree[tree].lvl>0 && $tree[$smarty.section.tree.index_prev].lvl == $tree[tree].lvl && $tree[tree].item.pp_type != 'group'}
					<span  id=propUp_{$SMRT_NODE.pp_id} style='color:#6495ED;' onMouseMove='this.style.cursor="hand"; this.style.cursor="pointer"; return false;'
						onClick='itemOrder({$SMRT_NODE.item.pp_id}, 1, {$SMRT_CURTABLE}, {$SMRT_NODE.item.pp_parentId});'  title='Поднять'>
					&#8593;
					</span>{else}&nbsp;
					{/if}					
					{if $tree[tree].lvl>0 && $tree[$smarty.section.tree.index_next].lvl == $tree[tree].lvl  && $tree[tree].item.pp_type != 'group'}								
					<span  id=propDown_{$SMRT_NODE.pp_id} style='color:#6495ED;' onMouseMove='this.style.cursor="hand"; this.style.cursor="pointer"; return false;'
							onClick='itemOrder({$SMRT_NODE.item.pp_id}, 2, {$SMRT_CURTABLE}, {$SMRT_NODE.item.pp_parentId});'  title='Опустить'>
						&#8595;
					</span>{else}&nbsp;
					{/if}				
					
				</span>
				<span id='empty_{$SMRT_NODE.item.pp_id}'></span>
	</div>
		</td>
	</tr>	
	{if !$tree[$smarty.section.tree.index_next] || ($tree[$smarty.section.tree.index_next].lvl < $tree[tree].lvl) }
			</TBODY>
		</TABLE>
		</DIV>
			</td>
		</tr>
	{/if}
	{if !$tree[$smarty.section.tree.index_next] && $tree[tree].lvl}
			</TBODY>
		</TABLE>
		</DIV>
			</td>
		</tr>
	{/if}
{/section}
	</td>
	</tr>
	</TBODY>
</TABLE>
{else}
{section name=tree loop=$tree}	
	{assign var="SMRT_NODE" value=$tree[tree]}
	{if $smarty.section.tree.first}
	<TABLE border=0  
		id='ttable_{$SMRT_NODE.pp_id}' 
		cellSpacing=0 cellPadding=0 width="100%" border=0 >
	  <TBODY id='body_{$SMRT_NODE.pp_id}' >		
	{/if}
	<tr id = 'tr_{$SMRT_NODE.pp_id}' >
		<td>
	<div id='node_{$SMRT_NODE.pp_id}'>
	<IMG class=tree src="/src/design/tree/s.gif" width=16 align=middle>		
	<IMG class=tree src="/src/design/tree/s.gif" width=16 align=middle>		
	<IMG id='nodeIcon_{$SMRT_NODE.pp_id}' class=tree src="/src/design/tree/pageInfo.gif" width=16 align=middle>		
	<span id=item_{$SMRT_NODE.pp_id}>
					<span  id=link_{$SMRT_NODE.pp_id} 					
					onclick="itemSelectProperties(this); "    	  
					onMouseMove="this.style.cursor='hand'; this.style.cursor='pointer'; return false;">
					<span  id=text_{$SMRT_NODE.pp_id} >
						{$SMRT_NODE.pp_name|truncate:80:"...":true}
					</span>
					<span  id=itemId_{$SMRT_NODE.pp_id} style='color:#aaaaaa;' >
						&nbsp;({$SMRT_NODE.pp_id})
					</span>
					</span>						
					{if !$smarty.section.tree.first}
					<span  id=propUp_{$SMRT_NODE.pp_id} style='color:#6495ED;' onMouseMove='this.style.cursor="hand"; this.style.cursor="pointer"; return false;'
						onClick='itemOrder({$SMRT_NODE.pp_id}, 1, {$SMRT_CURTABLE}, {$SMRT_NODE.pp_parentId});'  title='Поднять'>
					&#8593;
					</span>{else}&nbsp;
					{/if}					
					{if !$smarty.section.tree.last}								
					<span  id=propDown_{$SMRT_NODE.pp_id} style='color:#6495ED;' onMouseMove='this.style.cursor="hand"; this.style.cursor="pointer"; return false;'
							onClick='itemOrder({$SMRT_NODE.pp_id}, 2, {$SMRT_CURTABLE}, {$SMRT_NODE.pp_parentId});'  title='Опустить'>
						&#8595;
					</span>{else}&nbsp;
					{/if}				
					
				</span>
				<span id='empty_{$SMRT_NODE.item.pp_id}'></span>
	</div>
		</td>
	</tr>	
	{if $smarty.section.tree.last}
			</TBODY>
		</TABLE>
	{/if}
{/section}
{/if}
