<SCRIPT src="/includes/jquery/jquery.js" type=text/javascript></SCRIPT>
<SCRIPT src="/includes/jquery/ajaxfileupload.js" type=text/javascript></SCRIPT>
<script src="/includes/jquery/jquery.tablesorter.js" type="text/javascript" ></script>
<SCRIPT src="/includes/JS/layers.js" type=text/javascript></SCRIPT>
<SCRIPT src="/includes/JS/ga/products.js" type=text/javascript></SCRIPT>
<script language="JavaScript">
{literal}
var waitBox = 	new setLayer("waitBox", 1, 100, 220, 200, 1, 1);	
var waitBoxStr = "<div style='border: 1px solid #000;	padding:2px;	margin: auto;	text-align: center;	width: 200px;	 position: relative;	background-color: #FFF;	color: #333;	font-weight: bold;'>" + 
						"<img src='/src/design/jquery/indicator.gif'><br> Загрузка... </div>";
var necessary = new Array();
var necessCount = 0;
createLayer(waitBox.name, waitBox.left, waitBox.top, waitBox.width, waitBox.height, false, 1,"z-index:10;", waitBoxStr);
{/literal}
</script>
<TABLE style="MARGIN-LEFT: 1px; MARGIN-RIGHT: 1px" cellSpacing=0  width = '100%'  cellPadding=3 border=0>
<TBODY id='{$addUser.table.body_id}'>									
	<TR>
		<FORM name={$Catalog.form.form_name} action={$Catalog.form.form_action} method=post encType=multipart/form-data>									
		<td valign=top width="70%">
		   <fieldset>
			<legend>{$formLabel.tree}</legend>
			<div id = 'tree'  style=" HEIGHT: 500px; OVERFLOW: auto; PADDING-LEFT: 5px; WIDTH: 100%" >
			{include file='ga/propertiesTree.tpl'}
			</div>
			<div id='addon'>
			{section name=el loop=$Catalog.elements}								
				{assign var="SMRT_EL" value=$Catalog.elements[el]}	
				{assign var="SMRT_INDX" value=$smarty.section.el.index}
					{include file=$SMRT_EL.template}
			{/section}
			</div>
			</fieldset>
		</td>
			</FORM>
		<td vAlign=top width="30%">
			<div id = 'edit'>
		   <fieldset>
			<legend>{$formLabel.options}</legend>
			<div id = 'options'  style=" HEIGHT: 500px; OVERFLOW: auto; PADDING-LEFT: 5px;"  >
			{include file='ga/articleOptionsNew.tpl'}
			</div>
			</fieldset>
			</div>
		</td>
	</tr>		
<script language="JavaScript">
document.getElementById('tree').style.height = window.screen.availHeight-200;
document.getElementById('options').style.height = window.screen.availHeight-200;
</script>	