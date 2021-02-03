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
/*	
	if (tr.style.display == '')
		{
		d	= 'none';	
		if(imageName ==  'treeMinus.gif')
			new_src = 'treePlus.gif';
		} 
	else
		{	
		d	= '';		
		if(imageName ==  'treePlus.gif')
			new_src = 'treeMinus.gif';
		}
//	alert(imageName + ' ' + new_src);
//	image.img_src = new_src;
	tr.style.display	= d;	
	image.src	= s + new_src;*/
	return true;
	} 
{/literal}
</SCRIPT>
{section name=tree loop=$tree}	
	{assign var="SMRT_NODE" value=$tree[tree]}
	<tr id = 'tr_{$SMRT_NODE.item.news_id}' >
		<td>
	{if $SMRT_NODE.isFirst}
		<TABLE border=0 {if $SMRT_NODE.lvl>0} style="DISPLAY: none" {/if} 
			id='table_{$SMRT_NODE.item.news_id}' 
			cellSpacing=0 cellPadding=0 width="100%" border=0 >
		  <TBODY id='body_{$SMRT_NODE.item.news_id}' >
		<tr id='table_tr{$SMRT_NODE.item.news_id}' >
			<td valign='middle'>			
	{/if}
	<div id='node_{$SMRT_NODE.item.news_id}'>
	{*<IMG class=tree src="/src/design/tree/s.gif" width=16 align=middle>	*}
	{if !$tree[tree].lvl && ($tree[$smarty.section.tree.index_next].lvl > $tree[tree].lvl) }
	<IMG class=tree src="/src/design/tree/treePlus.gif" width=16 align=middle 
			id = 'img_{$SMRT_NODE.item.news_id}'
			onclick="treeExpand(this, 'table_{$tree[$smarty.section.tree.index_next].item.news_id}')"
			onMouseMove='this.style.cursor="hand"; return false;'	>			
	{elseif !$tree[tree].lvl && ($tree[$smarty.section.tree.index_next].lvl == $tree[tree].lvl) }
	<IMG class=tree src="/src/design/tree/s.gif" width=16 align=middle>	
	{elseif $tree[tree].lvl}
	<IMG class=tree src="/src/design/tree/s.gif" width=16 align=middle>		
	<IMG class=tree src="/src/design/tree/s.gif" width=16 align=middle>		
	{/if}
	{if $tree[tree].lvl}
		<IMG class=tree src="/src/design/tree/pageInfo.gif" width=16 align=middle>		
	{else}
		<IMG class=tree src="/src/design/tree/folder.gif" width=16 align=middle>			
	{/if}
	<span id=item_{$SMRT_NODE.item.news_id}>
					<span  id=link_{$SMRT_NODE.item.news_id} 					
					{*if $Tree.admin*}
					onclick="itemSelectNews(this); "    	  
					onMouseMove="this.style.cursor='hand'; return false;"
					{*/if*}>
					{*if !$Tree.admin && $SMRT_NODE.type == 'article'}
						<a href='/articles/show/{$SMRT_NODE.id}'>
					{/if}
					{if !$SMRT_NODE.is_published}
					<font color='gray'>
					{/if*}
						{$SMRT_NODE.item.news_name|truncate:80:"...":true}
					{*if !$SMRT_NODE.is_menu}
					</font>
					{/if}
					{if !$Tree.admin && $SMRT_NODE.type == 'article'}
						</a>
					{/if*}						
					</span>	
				</span>
				<span id='empty_{$SMRT_NODE.item.news_id}'></span>
	</div>
		</td>
	</tr>	
	{if !$tree[$smarty.section.tree.index_next] || ($tree[$smarty.section.tree.index_next].lvl < $tree[tree].lvl) }
			</TBODY>
		</TABLE>
			</td>
		</tr>
	{/if}
	{if !$tree[$smarty.section.tree.index_next] && $tree[tree].lvl}
			</TBODY>
		</TABLE>
			</td>
		</tr>
	{/if}
{/section}
	</td>
	</tr>
	</TBODY>
</TABLE>
{*if $Properties && $Tree.curNode } 
<img src='{$header.body.imgSrc}_.gif'  id='fake' width=0 height=0 style="DISPLAY: none" onLoad='itemSelectAuto({$Tree.curNode.id}, {$Tree.curNode.right});'>
{/if*} 

