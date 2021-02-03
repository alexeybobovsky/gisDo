<LINK href="/src/design/admin.css" type=text/css rel=stylesheet>
<SCRIPT src="/includes/jquery/jquery.js" type=text/javascript></SCRIPT>
<SCRIPT src="/includes/jquery/jeditable.js" type=text/javascript></SCRIPT>
</head>
<body>
<table width="100%" border="0" cellpadding='2' cellSpacing='1' class='din'>
	<tr>
		<th colspan='10'><h1>
			{$up.table.table_label}</h1>
		</th>
	</tr>
{if $up.content.is_system}	
	<tr>
		<th colspan='10'><h2>
			Внимание! это системная учетная запись - она не редактируемая.</h1>
		</th>
	</tr>
{/if}	
{section name=par loop=$up.table.table_colHeader}			
{assign var="SMRT_col" value=$up.table.table_colAlias[par]}
	<tr>
		<th align='left'>
			{$up.table.table_colHeader[par]}
		</th>
		<td {if $up.table.table_colStyle[par] &&  !$up.content.is_system} class='{$up.table.table_colStyle[par]}'{/if} 
			align='left' id='{$up.table.table_colAlias[par]}#{$up.content.user_id}'>
			{$up.content.$SMRT_col}
		</td>
	</tr>
	<tr>
	<th colspan='10'>
	</th>
	</tr>
{/section}
</table>
<SCRIPT type=text/javascript>
$(document).ready(function() {literal}{{/literal}
$(".editable_select").editable("/admin/SetDin", {literal}{{/literal} indicator : "<img src='/src/design/jquery/indicator.gif'>",
tooltip : "щелчек для редактирования",
xmlload : "/GetXML/users",
//extload : "/Gettest/",
//container : 'tree',
event : "click",
type : "select"
{literal}}{/literal});
$(".editable_text").editable("/admin/SetDin", {literal}{{/literal} indicator : "<img src='/src/design/jquery/indicator.gif'>",
tooltip : "щелчек для редактирования",
event : "click",
type : "text"
{literal}}{/literal});
{literal}}{/literal});	
</script>