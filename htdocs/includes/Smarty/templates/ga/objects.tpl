<SCRIPT src="/includes/jquery/jquery.js" type=text/javascript></SCRIPT>
<SCRIPT src="/includes/JS/ga/objects.js" type=text/javascript></SCRIPT>
<SCRIPT src="/includes/JS/ga/filter.js" type=text/javascript></SCRIPT>
<SCRIPT src="/includes/JS/ga/sList.js" type=text/javascript></SCRIPT>
<SCRIPT src="/includes/JS/layers.js" type=text/javascript></SCRIPT>
<script type="text/javascript" src="/includes/jquery/jquery.tablesorter.js"></script>
<script language="JavaScript">
{literal}
	$(document).ready(function(){
	$("table#order").tableSorter({
		sortClassAsc: 'sortUp', // class name for asc sorting action
		sortClassDesc: 'sortDown', // class name for desc sorting action
		highlightClass: 'highlight', // class name for sort column highlighting.
									//alternateRowClass: ['odd','even'],
		headerClass: 'largeHeaders', // class name for headers (th's)
		dateFormat: 'dd/mm/yyyy' // set date format for non iso dates default us, in this case override and set uk-format
	});
	});
{/literal}
var optionName = new Array({$options.cnt});
var optionValue = new Array({$options.cnt});
var optionType = new Array({$options.cnt});
var optionNameReal = new Array({$options.cnt});
{section name=options loop=$options.list}								
	optionName[{$smarty.section.options.index}] 	= '{$options.list[options].op_description}';
	optionValue[{$smarty.section.options.index}] 	= '{$options.list[options].op_id}';
	optionType[{$smarty.section.options.index}] 	= '{$options.list[options].op_type}';
	optionNameReal[{$smarty.section.options.index}] 	= '{$options.list[options].op_name}';
{/section}

var waitBoxStr = "<div style='border: 1px solid #000;	padding:2px;	margin: auto;	text-align: center;	width: 200px;	 position: relative;	background-color: #FFF;	color: #333;	font-weight: bold;'>" + 
						"<img src='/src/design/jquery/indicator.gif'><br> Загрузка... </div>";
var isFilterShowed = 0;
var isFilterOn = 0;
var strListShowed = 0;
var strListCurrent = 0;
var strListCurValue = '';
var strListMaxIndex = 0;
var fiter = 	new setLayer("filter", 1, 100, 1, 1, 1, 1);	
var Com_Set = 	new setLayer("streetList", 1, 100, 1, 1, 1, 1);

var waitBox = 	new setLayer("waitBox", 1, 100, 220, 200, 1, 1);	
//var commentString = "";

var filterStr = {include file='ga/filterForm.tpl'}				
createLayer(fiter.name, fiter.left, fiter.top, fiter.width, fiter.height, false, 1,"z-index:5;", filterStr);
createLayer(Com_Set.name, Com_Set.left, Com_Set.top, Com_Set.width, Com_Set.height, false, 1,"z-index:5;", '');
createLayer(waitBox.name, waitBox.left, waitBox.top, waitBox.width, waitBox.height, false, 1,"z-index:10;", waitBoxStr);
</script>
</script>

<script language="JavaScript">
	var necessary = new Array();
	var necessCount = 0;
</script>
<TABLE style="MARGIN-LEFT: 1px; MARGIN-RIGHT: 1px" cellSpacing=0  width = '100%'  cellPadding=3 border=0>
<TBODY id='{$addUser.table.body_id}'>									
	<TR>
			<FORM name={$orders.form.form_name} action={$orders.form.form_action} method=post encType=multipart/form-data>									
		<td valign=top width="70%">
		  <fieldset>
			<legend>{$formLabel.tree}</legend>
			<div id = 'tree'   style="HEIGHT: 500px; OVERFLOW: auto; PADDING-LEFT: 5px; WIDTH: 100%" >
				{include file='ga/objectList.tpl'}
			</div>
			<div id='addon'>

			{section name=el loop=$orders.elements}								
				{assign var="SMRT_EL" value=$orders.elements[el]}	
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
			<div id = 'options'  style="HEIGHT: 500px; OVERFLOW: auto; PADDING-LEFT: 5px;"  >
			{include file='ga/articleOptions.tpl'}
			</div>
			</fieldset>
			</div>
		</td>
	</tr>	

<script language="JavaScript">	
	document.getElementById('tree').style.height = window.screen.availHeight-200;
	document.getElementById('options').style.height = window.screen.availHeight-200;
//	moveFilter();
//	var obj = document.getElementById('options').offsetParent;
//	moveLayer('filter', document.getElementById('options').style.pixelWidth, 10);	
//	alert(document.getElementById('options').style.pixelWidth);
</script>
