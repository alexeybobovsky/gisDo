<script language="JavaScript">
	var captionString = new Array();
	var nodeString = new Array();
	
	{assign var="SMRT_INDX" value=0}
	{section name=js loop=$Tree.tree}
	{assign var="SMRT_LANG" value=$Tree.tree[js].catalog.lang_id}	

	nodeString[{$smarty.section.js.index}] = new NodeSet('{$Tree.tree[js].catalog.sc_name}',
							{$Tree.tree[js].catalog.sc_id},
							'{$Tree.tree[js].catalog.sc_handler}', 
							{$Tree.tree[js].catalog.sc_menu},
							{$Tree.tree[js].catalog.sc_published},
							'{$Tree.tree[js].catalog.sc_order}',
							'{$Tree.lang.$SMRT_LANG}'
							);
		{section name=body loop=$Tree.tree[js].body}
		{if $Tree.tree[js].body[body].name}
			captionString[{$SMRT_INDX}] = new captionSet('{$Tree.tree[js].body[body].name}',
									'{$Tree.tree[js].body[body].value|strip_tags|escape:"javascript"|truncate:40:"...":true}', 
									{$Tree.tree[js].catalog.sc_id},
									'{$Tree.tree[js].body[body].type}',
									{$Tree.tree[js].body[body].id}
									);
			{math equation="index + 1" index = $SMRT_INDX assign=SMRT_INDX}
		{/if}
		
		{/section}
	{/section}
//	alert(captionString['name']);
</script>
