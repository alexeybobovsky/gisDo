function showUsers()
	{
//	alert(id);
	var mem = document.getElementById('IDcurNode');
	var number= mem.value;
	var parent_id = GetStrPrt(number, '_', 1);
	var location =  document.getElementById('IDcurUrl').value;	
	if(document.getElementById('IDshowUsers'))
		{
		var showUsers =  (document.getElementById('IDshowUsers').checked) ? 1 : 0;
		}
	if(parent_id>0)
		{
		showWait('optionBody');
		$.post("/GetHTML/access/", {node:parent_id, location:location, showUsers:showUsers}, function(str) 
			{		
			var optionBody = document.getElementById('optionBody');
			optionBody.innerHTML = str;
			$(".editable_select").editable(location + "set/rightEdit", 
					{ indicator : "<img src='/src/design/jquery/indicator.gif'>",
					tooltip : "ўелчек дл€ редактировани€",
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
			}
			);
//		alert('eee');
		}
	else
		{
		optionBody.innerHTML = '';
		}
	}
function updateRight(id)
	{
//	alert(id);
	if(document.getElementById('IDshowUsers'))
		{
		var showUsers =  (document.getElementById('IDshowUsers').checked) ? 1 : 0;
		}
	$.post(location + "set/rightMove", {node:id, update:1, showUsers:showUsers}, function(str) {
		document.getElementById('content').innerHTML = str;	
	$(".editable_select").editable(location + "set/rightEdit", 
			{ indicator : "<img src='/src/design/jquery/indicator.gif'>",
			tooltip : "ўелчек дл€ редактировани€",
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
	if(document.getElementById('IDshowUsers'))
		{
		var showUsers =  (document.getElementById('IDshowUsers').checked) ? 1 : 0;
//		alert(showUsers);
		}
	var location =  document.getElementById('IDcurUrl').value;
	$.post(location + "set/rightMove", {node:id, rightId:rightId, showUsers:showUsers}, function(str) {
		document.getElementById('content').innerHTML = str;	
	$(".editable_select").editable(location + "set/rightEdit", 
			{ indicator : "<img src='/src/design/jquery/indicator.gif'>",
			tooltip : "ўелчек дл€ редактировани€",
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

	if(document.getElementById('IDshowUsers'))
		{
//		var showUsers =  document.getElementById('IDshowUsers').checked;
		var showUsers =  (document.getElementById('IDshowUsers').checked) ? 1 : 0;
//		alert(showUsers);
		}
	$.post(location + "set/rightMove", {node:id, user:user, showUsers:showUsers}, function(str) {
		document.getElementById('content').innerHTML = str;	
	$(".editable_select").editable(location + "set/rightEdit", 
			{ indicator : "<img src='/src/design/jquery/indicator.gif'>",
			tooltip : "ўелчек дл€ редактировани€",
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
function itemSelect(container)
	{	
	
//	var parent_id = container.id;
	var parent_id = GetStrPrt(container.id, '_', 1);
	
	var usrType = container.usrType;
	var mem = document.getElementById('IDcurNode');
	var number= mem.value;
	if(number != '')
		{
		var cont = document.getElementById(number);
		cont.style.backgroundColor='white';
		cont.style.border='1px solid white';
		cont.style.color='';
		}
	var location =  document.getElementById('IDcurUrl').value;
	var cont = container;
	cont.style.backgroundColor='#D7E4F6';
	cont.style.border='1px solid #AEC2DF';
	cont.style.color='#0F4695';
	mem.value = container.id;
	
	if(parent_id>0)
		{
		showWait('optionBody');
		$.post("/GetHTML/access/", {node:parent_id, location:location}, function(str) 
			{		
			var optionBody = document.getElementById('optionBody');
			optionBody.innerHTML = str;
			$(".editable_select").editable(location + "set/rightEdit", 
					{ indicator : "<img src='/src/design/jquery/indicator.gif'>",
					tooltip : "ўелчек дл€ редактировани€",
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
			}
			);
//		alert('eee');
		}
	else
		{
		optionBody.innerHTML = '';
		}
	}