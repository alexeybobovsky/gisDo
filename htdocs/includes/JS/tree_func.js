	parSep = 'XX';
	valSep = 'YY';
var theoPath = '';
function updateRight(id)
	{
	$.post("/admin/users/set/right/", {node:id, update:1}, function(str) {
		document.getElementById('content').innerHTML = str;	
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
	}
function deleteRight(id, rightId)
	{
//	alert(id);
	$.post("/admin/users/set/right/", {node:id, rightId:rightId}, function(str) {
		document.getElementById('content').innerHTML = str;	
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
//	return 1;
	}
function addRight(id, user)
	{
//	alert(id);
	$.post("/admin/users/set/right/", {node:id, user:user}, function(str) {
		document.getElementById('content').innerHTML = str;	
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
//	return 1;
	}
function editRight(id)
	{
	var url = document.location + 'rights/'+ id;
	var name = 'editConsole';
	var w = 600;
	var h = 600;
	var scroll =0;
	open_window(url, name, w, h, scroll);
//	return 1;
	}
function formManip(act)
	{
	form = document.getElementById('NEWNODE');
	for(i=0; i<form.elements.length; i++)
		{
/*		if(act == 1 ) //enable
			{*/
//				alert (form.elements[i].type);
			if((form.elements[i].disabled == true)&&
				((form.elements[i].type == 'text')||(form.elements[i].type == 'select-one')||(form.elements[i].type == 'file')))
				{
				form.elements[i].disabled = false;				
				}
/*			}
		if(act == 2 ) //clear
			{*/
			if(form.elements[i].type == 'text')
				form.elements[i].value = '';				
			if(form.elements[i].type == 'file')
				form.elements[i].value = '';		
			if(form.elements[i].type == 'select')
				form.elements[i].selectedIndex = 0;				
//			}
		}
	
//	alert (form.elements.length);
	}

function pathCreate(name)
	{
	checkBox = document.getElementById('IDNODE_MENU');
	if(name)
		{
		if (checkBox.disabled)
			{
			checkBox.disabled = false;
			}
		newPath = theoPath.substring(0, theoPath.lastIndexOf('/')+1);
		theoPath  =  newPath + name ;
		el = document.getElementById('IDMENU_LINK');
		if (el)
			{
			el.value = theoPath + '/';	
			}
		}
	else
		{
		deleteMenuTable();
		}
	}
function deleteMenuTable()
	{
	checkBox = document.getElementById('IDNODE_MENU');
	if (!checkBox.disabled)
		{
		checkBox.disabled = true;
		checkBox.checked = false;						
		}
	el = document.getElementById('IDMENU_LINK');
	if (el)
		{
		container = 'menuOptions';
		arLength = necessary.length;
		necessary.splice(arLength-2);
		necessCount -=2;	
		resetContainer(container);
		}
	}

function deleteCaption(id)
	{
	form = document.getElementById('NEWNODE');
	form.action = document.location + 'set/delPar/'+ id;
//	alert(form.action);
	form.submit();
	}
function deleteNode()
	{
//	alert('22');
	form = document.getElementById('NEWNODE');
	form.action = document.location + 'set/del';
	form.submit();
	}
function changeParType(sel, the_form)
	{	
	uriEl = document.getElementById('IDURI') ;
/*	alert(uriEl.value);
	var newUrl;
	url = uriEl.value.split('/');
	len = url.length;
//	alert(url[len-1]);
	if(sel.value == 'TEXT')
		{
		if( url[len-1] == 'varchar')
			{		
			newUrl = uriEl.value.substring(0, uriEl.value.lastIndexOf('/'));
			}
		newUrl = uriEl.value + '/TEXT';
		}
	else
		{		
		if( url[len-1] == 'TEXT')
			{		
			newUrl = uriEl.value.substring(0, uriEl.value.lastIndexOf('/'));// + '/' + url[len-1] + '/vc';
			}
		newUrl = uriEl.value + '/varchar';
		}
*/
//	alert(the_form.name);
	form = document.getElementById(the_form.name);
	form.action = uriEl.value;//+ '/'+screen.availWidth + '/' + screen.availHeight;
	form.submit();
	}
function editCaption(id)
	{
	
	var url = '/tools/edit/editNodePar/'+ id + '/'+screen.availWidth + '/' + screen.availHeight;
	var name = 'editConsole';
	var w = 700;
	var h = 300;
	var scroll =0;
	open_window(url, name, w, h, scroll);
//	return 1;
	}
function showConsole(act, par, id)
	{
	var url = '/tools/edit/action'+ valSep + act + parSep + 'par' + valSep + par + parSep +'id' +valSep + id;
	var name = 'editConsole';
	var w = 700;
	var h = 400;
	var scroll = 0;
	open_window(url, name, w, h, scroll);
//	return 1;
	}
function addNewNodePar(id)
	{
	var url = '/tools/edit/addNewNodePar/'+ id + '/'+screen.availWidth + '/' + screen.availHeight;
	var name = 'editConsole';
	var w = 700;
	var h = 300;
	var scroll =0;
	open_window(url, name, w, h, scroll);
//	return 1;
	}
function isMenu(chekbox)
	{
	
//	var name = document.getElementById('IDNODE_NAME');
	container = 'menuOptions';
	if(chekbox.checked)
		{
		var length = newNodeString.length;
		var ret = '';
		var cap = 0;
		table = "<table width='100%'  height='100%' border='0' cellpadding='0' >";	
		table += "<tr>"+
					"<td>"+
						   "<fieldset>" + 
							"<legend>Дополнительные свойства</legend>" +
							  "<TABLE style='MARGIN-LEFT: 1px; MARGIN-RIGHT: 1px' cellSpacing=0    cellPadding=3 border=0>";
	    for (var i = 0; i < length; i++)
		    {
			if(newNodeString[i].optName == 'MENU_LINK')
				{
				newNodeString[i].optValue = theoPath +  '/';
//				alert (theoPath);
				}
//			if(!i%2)
				table += 				  '<tr>';
			table += 				  '<TD style="PADDING-RIGHT: 5px; PADDING-LEFT: 5px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" colspan = 10>'+
												'<SMALL>'+
												newNodeString[i].optLabel;
			if(newNodeString[i].optNecessary)
				table += 				  "<font color=red>*</font>";
			else
				table += 				  "&nbsp;";
			table +=					'</SMALL>'+
								            '<TABLE style="MARGIN: 0px" cellSpacing=0 cellPadding=0>'+
									              '<TBODY>'+
									              '<TR>'+
									                '<TD noWrap width="100%">'+
														'<input type="text" name="'+
														  newNodeString[i].optName+
														  '" id="'+
														  newNodeString[i].optId+
														  '" value = "'+
														  newNodeString[i].optValue+
															'"';
			if(newNodeString[i].optNecessary)
				table += 				  ' onChange="EmptyCheck(this.form)" 		 onkeyup="EmptyCheck(this.form)" ';													
			table += 												'>'+
													  '</TD>'+
													'</TR>'+
													'</TBODY>'+
												'</TABLE>'+
												'</td>';
//			if(i%2)
				table += 				  '</tr>';
			if(newNodeString[i].optNecessary)
				{
//				alert(newNodeString[i].optName);
				necessary[necessCount] = newNodeString[i].optName;
				necessCount ++;			
				}
			}
		table += "</TABLE>"+
							"</fieldset></td></tr></table>";
		fillContainer(container, table);
		}
	else
		{
		arLength = necessary.length;
		necessary.splice(arLength-2);
		necessCount -=2;	
		resetContainer(container);		
		}
	}
	function MenuOptionsSet (name, label, parent, value, necessary)
	{
	this.optName = name;
	this.optLabel = label;
	this.optId = 'ID' + name;
	this.optPar = parent;
	this.optValue = value;
	this.optNecessary = necessary;
	}
function item_style(container,parent, parent_id, path, right)
	{	
//	var container = 'divCaption_';
	theoPath = path;
	var divNew = document.getElementById('node_'+parent_id);	
	if(parent_id>0)
		{
//		alert(parent_id + parent);
		divContNew = divNew.innerHTML;
		if(right>3)
			{
			divContNew += "<!----><img src='/src/design/tree/drop.gif' title = 'Удалить' border='0'"+ 
							" onClick='if (confirmLink(\"Вы действительно желаете удалить объект?\")) deleteNode()' "+					
							" onMouseMove='this.style.cursor=\"hand\"; return false;'>";
			divContNew += 	"<img src='/src/design/tree/User Security.gif' title = 'Права' border='0'"+ 
							" onMouseMove='this.style.cursor=\"hand\"; return false;'" +
							"onClick='editRight(" + parent_id + ")'' >";
			}			
		divNew.innerHTML = divContNew;
		}
	var number=document.NEWNODE.PARENT_ID.value;
	var cont = document.getElementById('link_'+number);
	if(number != '')
		{
		cont.style.backgroundColor='white';
		cont.style.border='1px solid white';
		cont.style.color='';
		if(number>0)
			{
			var divOld = document.getElementById('node_'+number);	
			var divContOld = divOld.innerHTML;
			if(divContOld.indexOf('<!---->')>=0)
				divOld.innerHTML = divContOld.substring(0, divContOld.lastIndexOf('<!---->'));
			else
				divOld.innerHTML = divContOld;
			}
		}
	var cont = document.getElementById(container);
//	alert(cont);
	cont.style.backgroundColor='#D7E4F6';
	cont.style.border='1px solid #AEC2DF';
	cont.style.color='#0F4695';
	deleteMenuTable();
	formManip(2);
	document.NEWNODE.NODE_PARENT.value=parent;
	document.NEWNODE.PARENT_ID.value=parent_id;	
	$.post("/GetHTML/orderSelect/", {node:parent_id}, function(str) {
		document.getElementById('DIVIDNODE_ORDER').innerHTML = str;	
		});
	if(parent_id>0)
		{
		$("div#sorting").show();
		$.post("/GetHTML/properties/", {node:parent_id}, function(str) {
		document.getElementById('divCaption').innerHTML = str;
		$(".editable_select").editable(document.location + "SetDin", { indicator : "<img src='/src/design/jquery/indicator.gif'>",
		tooltip : "щелчек для редактирования",
		xmlload : "/GetXML",
		//extload : "/Gettest/",
		//container : 'tree',
		event : "click",
		type : "select"
		});
		$(".editable_text").editable(document.location + "SetDin", { indicator : "<img src='/src/design/jquery/indicator.gif'>",
		tooltip : "щелчек для редактирования",
		event : "click",
		type : "text"
		});
		$("div#sorting").hide();		
		});
		}
	else
		{
		document.getElementById('divCaption').innerHTML = '';		
		}
	}

function reset_style()
	{
	var number=document.NEWNODE.PARENT_ID.value;
	var cont = document.getElementById('link_'+number);
	if(number != '')
		{
		cont.style.backgroundColor='white';
		cont.style.border='1px solid white';
		cont.style.color='';
		}
	document.NEWNODE.NODE_PARENT.value='';
	document.NEWNODE.PARENT_ID.value=''
	}
	
function SelectNodeProperties(checkbox) /*Определяет добавить или удалить свойство узла*/
	{
	var indx = GetElIndex(checkbox.name);
	var name = GetElArName(checkbox.name);
	//alert (name + indx);
	if(indx>0)
		{
		prev_indx = eval(indx-1);
		id = 'ID' + name + '[' + prev_indx + ']';
		//alert (id);
		prevCheck = document.getElementById(id);
//		alert (prevCheck);
		ChangeStatus(prevCheck);
		}
	if(checkbox.checked)
		{
		createCapRow (indx);
		}
	else
		{
		deleteCapRow (indx);	
		}
	}
function delRow(id)
	{
	var tbody = document.getElementById(id).getElementsByTagName("TBODY")[0];
	tbody.removeChild(tbody.lastChild);	
	
	}

function ChangeStatusAEWPAI(str, form) /*Сменить состояние всех элементов с данным преффиксом и индексом*/
	{
	var clone_cnt = 0;
	var el_clone = new Array();
	var indx = GetElIndex(str);
	var pref = GetElPreffix(str)
	//alert(indx + ' - ' + pref);
    var elCount  = document.forms[form.name].elements.length;
    for (var i = 0; i < elCount; i++)
	    {	
		if(document.forms[form.name].elements[i].name)
			{
			el = document.forms[form.name].elements[i];
//		alert(el.name);
			if((el.name.indexOf(pref)>=0)&&(el.name.indexOf(indx)>=0))
				{
				
				el_clone[clone_cnt] = el.cloneNode(true);
				el_clone[clone_cnt].name = GetIncIndex(el_clone[clone_cnt].name);
				alert(el.ownerDocument.type);
				clone_cnt ++;
				if(el.type!='checkbox')
					{
					ChangeStatus(el);
					}
				}
			}
		}
    for (var k = 0; k < clone_cnt; k++)
	    {	
			//alert(el_clone[k].name);
		}
	/*
	var trow = document.getElementById('tr_id'+ pref + '[' + indx + ']');
	*/
//	var 
	var tbody_node = document.getElementById(pref);	
/*	alert(tbody_node);
	tbody_node.innerHTML = 'ok!';*/
	var row_node = tbody_node.firstChild;
//	alert(row_node);
	var new_node = row_node.cloneNode(true);
	if(new_node.firstChild)
		alert('yes!');
	else
		alert('yes!');	
	tbody_node.appendChild(new_node);
//	alert(tbody_node);
	}
function DisableAllClones(name, form)
	{
	strArr = name.split('[', 1);
//	alert (strArr[0]);
	var elCount  = document.forms[form.name].elements.length;
	var elVal;
    for (var i = 0; i < elCount; i++)
	    {
		if (document.forms[form.name].elements[i].name.indexOf(strArr[0],0)>=0) 
			{
			if(document.forms[form.name].elements[i].name==name)
				{
				var elVal = document.forms[form.name].elements[i].value;
				}
			document.forms[form.name].elements[i].disabled=true;
			}
	    }
	var tbody = document.getElementById("tableform");
	/*alert(tbody);*/
	var row = document.createElement("TR")
    var td1 = document.createElement("TD")
	var div1 =  document.createElement("DIV")
	oInput1 = document.createElement("INPUT");
	oInput1.type = 'hidden';	
	oInput1.name = strArr[0];
	oInput1.value = elVal;
	div1.appendChild(oInput1);
	td1.appendChild(div1);	
    row.appendChild(td1);
    tbody.appendChild(row);
	}