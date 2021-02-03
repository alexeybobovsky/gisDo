<LINK href="/src/design/admin.css" type=text/css rel=stylesheet>
<SCRIPT src="/includes/jquery/jquery.js" type=text/javascript></SCRIPT>
<script language="JavaScript" src="/includes/JS/script.js"></script>
<script type="text/javascript" src="/includes/JS/script.js"></script>
<script type="text/javascript" src="/includes/JS/tree_func.js"></script>
<SCRIPT type="text/javascript" src="/includes/jquery/jeditable.js" ></SCRIPT>
<script type="text/javascript" src="/includes/jquery/jquery.tablesorter.js"></script>
<script language="JavaScript">
</script>
<TABLE cellSpacing=10    cellPadding=3 width="100%"  height = "100%" border=0>

	<tr>
	<td>
	<FORM name=tmp action={$groups.form.form_action} method=post encType=multipart/form-data>	
	</form>
	</td>
	</tr>
	<tr>
		<td valign='top'>	
			<div id='content'>
			{include file='rightsList.tpl'}
			</div>
	</td>
	</tr>
</table>
<div id="sorting">
	<div>Sorting tables, please hold on...</div>
</div>
<SCRIPT type=text/javascript>{literal}
$(document).ready(function() {
$(".editable_select").editable("/admin/users/set/rightEdit", { indicator : "<img src='/src/design/jquery/indicator.gif'>",
tooltip : "щелчек для редактирования",
xmlload : "/GetXML/right",
//extload : "/Gettest/",
//container : 'tree',
event : "click",
type : "select"
});
$("table#UserList").tableSorter({
	sortClassAsc: 'sortUp', // class name for asc sorting action
	sortClassDesc: 'sortDown', // class name for desc sorting action
	highlightClass: 'highlight', // class name for sort column highlighting.
	//alternateRowClass: ['odd','even'],
	headerClass: 'largeHeaders', // class name for headers (th's)
	dateFormat: 'dd/mm/yyyy' // set date format for non iso dates default us, in this case override and set uk-format
});
});
{/literal}
</script>
</p>