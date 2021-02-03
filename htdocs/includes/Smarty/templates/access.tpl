<SCRIPT src="/includes/JS/script.js" type=text/javascript></SCRIPT>
<SCRIPT src="/includes/jquery/jquery.js" type=text/javascript></SCRIPT>
<script type="text/javascript" src="/includes/jquery/jquery.tablesorter.js"></script>
<SCRIPT type="text/javascript" src="/includes/jquery/jeditable.js" ></SCRIPT>
<SCRIPT src="/includes/JS/access.js" type=text/javascript></SCRIPT>
<script language="JavaScript">
	var necessary = new Array();
	var necessCount = 0;
</script>
<TABLE style="MARGIN-LEFT: 1px; MARGIN-RIGHT: 1px" cellSpacing=0  width = '100%'  cellPadding=3 border=0>
<TBODY id='{$addUser.table.body_id}'>									
	<TR>
		<td valign=top width="30%">
		   <fieldset>
			<legend>{$Tree.table_tree.table_label}</legend>
			<div id = 'tree'  style="HEIGHT: 500px; OVERFLOW: auto; PADDING-LEFT: 5px; WIDTH: 100%" >
			<FORM name={$Form.form.form_name} action={$Form.form.form_action} method=post encType=multipart/form-data>									
				{include file='accessTree.tpl'}
			{section name=el loop=$Form.elements}								
				{assign var="SMRT_EL" value=$Form.elements[el]}	
				{assign var="SMRT_INDX" value=$smarty.section.el.index}
					{include file=$SMRT_EL.template}
			{/section}
			</FORM>
			</div>
			</fieldset>
		</td>
		<td vAlign=top width="70%">
			<div id = 'edit'>
		   <fieldset>
			<legend>{$Properties.table.table_label}</legend>
			<div id = 'options'  style=" HEIGHT: 500px; OVERFLOW: auto; PADDING-LEFT: 5px;"  >
			{include file='articleOptions.tpl'}
			</div>
			</fieldset>
			</div>
		</td>
	</tr>		
<script language="JavaScript">
document.getElementById('tree').style.height = window.screen.availHeight-200;
document.getElementById('options').style.height = window.screen.availHeight-200;
</script>	