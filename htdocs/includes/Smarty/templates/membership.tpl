
<SCRIPT src="/includes/jquery/jquery.js" type=text/javascript></SCRIPT>
<script type="text/javascript" src="/includes/jquery/iutil.js"></script>
<script type="text/javascript" src="/includes/jquery/idrag.js"></script>
<script type="text/javascript" src="/includes/jquery/idrop.js"></script>
<script type="text/javascript" src="/includes/jquery/isortables.js"></script>
<LINK href="/src/design/sortables.css" type=text/css rel=stylesheet>
</head>
<body>
<table border="0" width="98%" cellpadding='1' cellSpacing='1' class='header'>
	<tr>
		<td align=center valign=top  > 
			{if $groups.type == 'user'}
			<img src='/src/design/admin/user.gif'>
			{else}
			<img src='/src/design/admin/groups.gif'>
			{/if}		
			{$groups.curUser.name}
		</td>
	</tr>
	</table>
<table border="0"  width="98%" cellpadding='0' cellSpacing='0' class='din'>
	<tr>
	{section name=group loop=$groups.colHeader}	
		<th valign=top align=center> 
		{$groups.colHeader[group]}
		</th>
	{/section}
	</tr>
	<tr>
		<td height="100%" valign=top align=center> 
		
					<ul class="sortable" id="sort1" >
					{section name=group loop=$groups.in.id}	
						<li class="sortableitem" id="gr_{$groups.in.id[group]}">
							<table width='100%' border="0" cellpadding='0' cellSpacing='0' class='din'>
								<tr>
									<td align='left' width='15%' >
										{if $groups.type == 'user'}
										<img src='/src/design/admin/groups.gif'>
										{else}
										<img src='/src/design/admin/user.gif'>
										{/if}
									</td>
									<td align='left'>
									&nbsp;{$groups.in.name[group]}
									</td>
								<tr>
							</table>							
						</li>
					{/section}
					</ul>
		</td>
		<td height="100%"  valign=top align=center>
					<ul class="sortable" id="sort2" >
					{section name=group loop=$groups.out.id}	
						<li class="sortableitem" id="gr_{$groups.out.id[group]}">
							<table width='100%' border="0" cellpadding='0' cellSpacing='0' class='din'>
								<tr>
									<td align='left' width='15%' >
										{if $groups.type == 'user'}
										<img src='/src/design/admin/groups.gif'>
										{else}
										<img src='/src/design/admin/user.gif'>
										{/if}
									</td>
									<td align='left'>
									&nbsp;{$groups.out.name[group]}
									</td>
								<tr>
							</table>							
						</li>
					{/section}
					</ul>
		</td>
	</tr>
	<tr>
		<th valign=top align=center colspan='10'> 
		</th>
	</tr>	
</table>
{*
<table width=100%>
	<tr>
		<td align=center> 
			<div  class="serializer">
				{assign var="SMRT_EL" value=$groups.elSubmit}	
				{include file=$SMRT_EL.template}
			</div>		
		</td>
	</tr>	
</table>
*}
</script>
<a href="#" onclick="serialize('sort1'); return false;" >Сохранить изменения</a>
<a href="#" onclick="self.close(); return false;" >Закрыть консоль</a>
<script type="text/javascript">
$(document).ready(
	function () {literal}{{/literal}
		$('ul').Sortable(
			{literal}{{/literal}
				accept : 		'sortableitem',
				activeclass : 	'sortableactive',
				hoverclass : 	'sortablehover',
				helperclass : 	'sorthelper',
				opacity: 		0.8,
				fx:				200,
				revert:			true,
				tolerance:		'intersect'
			{literal}}{/literal}
		)
	{literal}}{/literal}
);
function serialize(s)
{literal}{{/literal}
//	alert(s);	
	serial = $.SortSerialize(s);
	$.post("{$groups.action}", {literal}{{/literal} user:"{$groups.curUser.id}", list: serial.hash {literal}}{/literal}, function(serial){literal}{{/literal} alert("Сохранено"); {literal}}{/literal} )	;
//	alert(serial.hash);
{literal}}{/literal}
</script>
</body>
</html>