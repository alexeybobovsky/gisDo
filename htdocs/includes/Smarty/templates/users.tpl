<SCRIPT src="/includes/jquery/jquery.js" type=text/javascript></SCRIPT>
<script src="/includes/jquery/GreyBox/greybox.js" type="text/javascript"></script>
<SCRIPT src="/includes/jquery/jeditable.js" type=text/javascript></SCRIPT>
<script type="text/javascript" src="/includes/JS/script.js"></script>
<script type="text/javascript" src="/includes/jquery/jquery.tablesorter.js"></script>

<TABLE cellSpacing=10    cellPadding=3 width="100%"  height = "100%" border=0>

	<tr>
	<td>
	<FORM name={$groups.form.form_name} action={$groups.form.form_action} method=post encType=multipart/form-data>	
	</form>

	
		<div title="Новый пользователь" onMouseMove='this.style.cursor="hand"; return false;' onClick="open_window(document.location + 'addUser/', 'console', 250, 500, 0);"> Создать пользователя</div>
		<div title="Новая группа" onMouseMove='this.style.cursor="hand"; return false;' onClick="open_window('/admin/addGroup/', 'console', 250, 300, 0);"> Создать группу</div>
	</td>
	</tr>
	<tr>
		<td valign='top' width = '600'>								
		   <fieldset>
			<legend>{$users.table.table_label}</legend>				
			<DIV >									
					<DIV class="scrBoxUsers">	
								{assign var="SMRT_cnt" value=$users}
								{include file='userList.tpl'}		
					</div>
			</div>
			</fieldset>
		   <fieldset>
			<legend>{$groups.table.table_label}</legend>				
			<DIV >									
					<DIV class="scrBoxUsers">	
								{assign var="SMRT_cnt" value=$groups}
								{include file='userList.tpl'}		
					</div>
			</div>
			</fieldset>
			
				<!--<a href="/admin/addUser/" title="Членство в группах" class="greybox" width='250' height='500' fullScreen=1>Членство</a>-->

	</td>
	</tr>
</table>
<div id="sorting">
	<div>Sorting tables, please hold on...</div>
</div>

<SCRIPT type=text/javascript>
var GB_ANIMATION = true;
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


$("a.greybox").click(function(){literal}{{/literal} 
  var t = this.title || $(this).text() || this.href;
  var h = this.height || 300;
  var w = this.width || 500;
  if(this.fullScreen)
{literal}{{/literal}	
	w = window.screen.availWidth - (40);
	h = window.screen.availHeight-150;
{literal}}{/literal}	  
  GB_show(t,this.href,h,w);
  return false;
{literal}}{/literal});	

$("table#UserList").tableSorter({literal}{{/literal}
	sortClassAsc: 'sortUp', // class name for asc sorting action
	sortClassDesc: 'sortDown', // class name for desc sorting action
	highlightClass: 'highlight', // class name for sort column highlighting.
	//alternateRowClass: ['odd','even'],
	headerClass: 'largeHeaders', // class name for headers (th's)
	dateFormat: 'dd/mm/yyyy' // set date format for non iso dates default us, in this case override and set uk-format
{literal}}{/literal});
$("table#GroupList").tableSorter({literal}{{/literal}
	sortClassAsc: 'sortUp', // class name for asc sorting action
	sortClassDesc: 'sortDown', // class name for desc sorting action
	highlightClass: 'highlight', // class name for sort column highlighting.
	//alternateRowClass: ['odd','even'],
	headerClass: 'largeHeaders', // class name for headers (th's)
	dateFormat: 'dd/mm/yyyy' // set date format for non iso dates default us, in this case override and set uk-format
{literal}}{/literal});

{literal}}{/literal});

$(document).sortStart(function(){literal}{{/literal}
$("div#sorting").show();
{literal}}{/literal}).sortStop(function(){literal}{{/literal}
$("div#sorting").hide();
{literal}}{/literal});

</script>
</p>