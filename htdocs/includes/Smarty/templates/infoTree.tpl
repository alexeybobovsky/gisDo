<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
  <TBODY>
<SCRIPT language=JavaScript>
function treeExpand(img, oObj) 
{literal}
	{
	var tr = document.getElementById(oObj);
	var image = document.getElementById(img.id);
	var imageName = GetLastEl(document.getElementById(img.id).src, '/');
	var d, new_src,  s = '/src/design/tree/';
	if (tr.style.display == '')
		{
		d	= 'none';	
		if(imageName ==  'end2m_closed.gif')
			new_src = 'end2m.gif';
		if(imageName ==  'end2m.gif')
			new_src = 'end2m_closed.gif';
		if(imageName ==  '2m_closed.gif')
			new_src = '2m.gif';
		if(imageName ==  '2m.gif')
			new_src = '2m_closed.gif';			
		} 
	else
		{	
		d	= '';		
		if(imageName ==  'end2m_closed.gif')
			new_src = 'end2m.gif';
		if(imageName ==  'end2m.gif')
			new_src = 'end2m_closed.gif';
		if(imageName ==  '2m_closed.gif')
			new_src = '2m.gif';
		if(imageName ==  '2m.gif')
			new_src = '2m_closed.gif';
		}
	image.img_src = new_src;
	tr.style.display	= d;	
	image.src	= s + new_src;
	return true;
	} 
{/literal}
</SCRIPT>
{section name=tree loop=$Tree.Stree}	
	{assign var="SMRT_NODE" value=$Tree.Stree[tree]}
	<tr id = 'node_{$SMRT_NODE.id}' >
		<td>
	{if $SMRT_NODE.topen}
		<TABLE border=0 {if $Tree.Stree[tree].level>0 && !$Tree.Stree[tree].visible} style="DISPLAY: none" {/if} id='table_{$SMRT_NODE.id}' cellSpacing=0 cellPadding=0 width="100%" border=0 >
		  <TBODY id='body_{$SMRT_NODE.id}' >
		<tr id='table_tr{$SMRT_NODE.id}' >
			<td valign='middle'>			
	{/if}
	<div id='node_{$SMRT_NODE.id}'>
	{section name=img loop=$SMRT_NODE.img}	
		<IMG class=tree 
		{if $SMRT_NODE.havechild && ($SMRT_NODE.img[img] == 'endn' || $SMRT_NODE.img[img] == '3n')}
			id = 'img_{$SMRT_NODE.id}'
			img_src='{if $SMRT_NODE.img[img] == 'endn'}end2m_closed.gif{elseif $SMRT_NODE.img[img] == '3n'}2m_closed.gif{/if}'
			onclick="treeExpand(this, 'table_{$Tree.Stree[tree.index_next].id}')"
			onMouseMove='this.style.cursor="hand"; return false;'
		{/if}
		src="/src/design/tree/
		{if $SMRT_NODE.img[img] == '3s'}		
		2.gif
		{elseif  $SMRT_NODE.img[img] == '3n'}
			{if !$Tree.Stree[tree.index_next].visible}
			2m_closed.gif
			{else}
			2m.gif
			{/if}
		{elseif  $SMRT_NODE.img[img] == 'vr'}
		1.gif
		{elseif  $SMRT_NODE.img[img] == 'sp'}
		s.gif
		{elseif  $SMRT_NODE.img[img] == 'infoFolder'}
		folderInfo.gif
		{elseif  $SMRT_NODE.img[img] == 'emptyFolder'}
		folder.gif
		{elseif  $SMRT_NODE.img[img] == 'infoNode'}
		pageInfo.gif
		{elseif  $SMRT_NODE.img[img] == 'emptyNode'}
		page.gif
		{elseif  $SMRT_NODE.img[img] == 'ends'}
		end.gif
		{elseif  $SMRT_NODE.img[img] == 'endn'}
			{if !$Tree.Stree[tree.index_next].visible}
			end2m_closed.gif
			{else}
			end2m.gif
			{/if}
		{elseif  $SMRT_NODE.img[img] == 'prop'}
		properties.gif
		{elseif  $SMRT_NODE.img[img] == 'value'}
		data.gif
		{/if}
		" width=16 align=middle>	  
	{/section}	<span id=item_{$SMRT_NODE.id}>
					<span  id=link_{$SMRT_NODE.id} 					
					usrType='{$SMRT_NODE.type}'		
					{if $Tree.admin}
					onclick="itemSelect(this, '{$SMRT_NODE.right}',{if $Properties}1{else}0{/if} ); "    	  
					onMouseMove="this.style.cursor='hand'; return false;"
					{/if}>
					{if !$Tree.admin && $SMRT_NODE.type == 'article'}
						<a href='/articles/show/{$SMRT_NODE.id}'>
					{/if}
					{if !$SMRT_NODE.is_published}
					<font color='gray'>
					{/if}
						{$SMRT_NODE.name|truncate:40:"...":true}{*$SMRT_NODE.id*}
					{if !$SMRT_NODE.is_menu}
					</font>
					{/if}
					{if !$Tree.admin && $SMRT_NODE.type == 'article'}
						</a>
					{/if}						
					</span>	
				</span>
				<span id='empty_{$SMRT_NODE.id}'></span>
	</div>
		</td>
	</tr>	
	{if $SMRT_NODE.tclose}
		{section name=tclose loop=$SMRT_NODE.tclose}	
			</TBODY>
		</TABLE>
			</td>
		</tr>
		{/section}
	{/if}
{/section}
	</td>
	</tr>
	</TBODY>
</TABLE>
{if $Properties && $Tree.curNode } 
<img src='{$header.body.imgSrc}_.gif'  id='fake' width=0 height=0 style="DISPLAY: none" onLoad='itemSelectAuto({$Tree.curNode.id}, {$Tree.curNode.right});'>
{/if} 

