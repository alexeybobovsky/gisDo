{*include file='manage_js.tpl'*}	
{if $Tree.rootRight>3 }
<DIV id = 'node_0'>
<IMG class=tree src="/src/design/tree/folder.gif" width=16 align=middle>
	  <A class=tree       id='link_0'      
	  onclick="item_style('link_0','root','0','/'); 
	  {*doLoadTest(this); *} return false;" 
	  onMouseMove="this.style.cursor='hand'; return false;"      >&nbsp;
	  root
	  &nbsp;</A>
</DIV>
{/if}
{section name=tree loop=$Tree.Stree}	
	{assign var="SMRT_NODE" value=$Tree.Stree[tree]}
    <DIV id = 'node_{$SMRT_NODE.id}'>
	{section name=img loop=$SMRT_NODE.img}	
		<IMG class=tree src="/src/design/tree/
		{if $SMRT_NODE.img[img] == '3s'}		
		2.gif
		{elseif  $SMRT_NODE.img[img] == '3n'}
		2m.gif
		{elseif  $SMRT_NODE.img[img] == 'vr'}
		1.gif
		{elseif  $SMRT_NODE.img[img] == 'sp'}
		s.gif
		{elseif  $SMRT_NODE.img[img] == 'folder'}
		folder.gif
		{elseif  $SMRT_NODE.img[img] == 'node'}
		page.gif
		{elseif  $SMRT_NODE.img[img] == 'ends'}
		end.gif
		{elseif  $SMRT_NODE.img[img] == 'endn'}
		end2m.gif
		{elseif  $SMRT_NODE.img[img] == 'prop'}
		properties.gif
		{elseif  $SMRT_NODE.img[img] == 'value'}
		data.gif
		{/if}
		" width=16 align=middle>
	  
	{/section}
	  <A class=tree       id='link_{$SMRT_NODE.id}'      
	  onclick="item_style('link_{$SMRT_NODE.id}','{$SMRT_NODE.name}','{$SMRT_NODE.id}', '{$SMRT_NODE.path}', '{$SMRT_NODE.right}'); "    	  
	  onMouseMove="this.style.cursor='hand'; return false;"	  
  >&nbsp;
	  {$SMRT_NODE.name|truncate:40:"...":true}
	  &nbsp;</A>
	 </DIV>

{/section}
