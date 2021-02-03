var curItem = 0;
//var itemCount = 0;
function itemSelectAutoOptions(parent_id) /*12_04_07*/
	{
	alert(parent_id);
	if(document.getElementById('item_' + parent_id))
		var container = document.getElementById('item_' + parent_id);
	if (document.getElementById('IDcurNode'))
		var mem = document.getElementById('IDcurNode');
/*	if(document.getElementById('IDcurType'))
		var usrType = document.getElementById('IDcurType').value;*/
	highlightObject(container.id, 1); 
	mem.value = container.id;
	var location =  document.getElementById('IDcurUrl').value;
	var action =  location + "showObjectEdit/";		
	if((parent_id>=0))
		{
		showWait('optionBody');
		$.post(action, {node:parent_id, location:location}, function(str) 
			{		
			var optionBody = document.getElementById('optionBody');
			optionBody.innerHTML = str;
			}
		);
		}
	}

function itemSelectOptons(container)
	{	
	curItem = 0;
	var parent_id = GetStrPrt(container.id, '_', 1);
	if (document.getElementById('IDcurNode'))
		var mem = document.getElementById('IDcurNode');
/*	if(document.getElementById('IDcurType'))
		var usrType = document.getElementById('IDcurType').value;*/
	var lastItem = mem.value;
	if(lastItem != '')
		{
		highlightObject(lastItem, 0); 
		}	
	highlightObject(container.id, 1); 
	mem.value = container.id;
	var location =  document.getElementById('IDcurUrl').value;
	var action =  location + "showObjectEdit/";		
	if((parent_id>=0))
		{
		showWait('optionBody');
		$.post(action, {node:parent_id, location:location}, function(str) 
			{		
			var optionBody = document.getElementById('optionBody');
			optionBody.innerHTML = str;
			}
		);
		}
	}

function clearObjStyle(obj) /*03_09_07 - очистка элемента*/
	{
	contClear = document.getElementById('DIV_' + obj.name);
	if(contClear)
		{
		contClear.style.backgroundColor='white';
		contClear.style.border='0px solid white';
		contClear.style.color='';	
		}
	}
function searchElement(obj, form) /*03_09_07 - поиск элементов по title*/
	{
	var length = document.forms[form.name].elements.length;
	if((obj.value) && (obj.value.trim()))
		{
		var stop=0;
		curStr = obj.value.trim();
		curStr = obj.value.toLowerCase();
		curStrLength = curStr.length;
		
		for(i=0; i<length; i++ )
			{
			tmpObj = document.forms[form.name].elements[i];
			tmpStr = document.forms[form.name].elements[i].title.toLowerCase();
			tmpStr = tmpStr.trim();
			if((tmpStr.slice(0, curStrLength) == curStr)&&(!stop))
				{
				objToFocus = tmpObj;
				stop++;
				cont = document.getElementById('DIV_' + objToFocus.name);
				objToFocus.focus();
				
				cont.style.backgroundColor='#D7E4F6';
				cont.style.border='1px solid #AEC2DF';
				cont.style.color='#0F4695';
				}
			else
				{				
				contClear = document.getElementById('DIV_' + tmpObj.name);
				if(contClear)
					{
					contClear.style.backgroundColor='white';
					contClear.style.border='0px solid white';
					contClear.style.color='';				
					}
				}
			}
		}
	else
		{
		obj.value = '';
		}
	}
	
function itemSelectAuto(containerId) /*18_06_07*/
	{
//	alert(containerId);
	var parent_id = containerId;
	var container = document.getElementById(containerId);// GetStrPrt(container.id, '_', 1);
	var mem = document.getElementById('IDcurNode');
	var cont = container;
	cont.style.backgroundColor='#D7E4F6';
	cont.style.border='1px solid #AEC2DF';
	cont.style.color='#0F4695';
	mem.value = containerId;
	var location =  document.getElementById('IDcurUrl').value;
	var type =  document.getElementById('IDcurType').value;
	if(containerId)
		{
		showWait('optionBody');
		if(type == 'users')
			{
			$.post("/GetHTML/optionsUsers/", {node:parent_id, location:location}, function(str) 
				{		
				var optionBody = document.getElementById('optionBody');
				optionBody.innerHTML = str;
				}
				);
			}
		else if(type == 'groups')
			{
			$.post("/GetHTML/optionsGroups/", {node:parent_id, location:location}, function(str) 
				{		
				var optionBody = document.getElementById('optionBody');
				optionBody.innerHTML = str;
				}
				);
			}
		}
	}

function itemSelect(container)
	{	
//	alert(container.id);
	
	var parent_id = container.id;
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
	var type =  document.getElementById('IDcurType').value;
	var cont = container;
	cont.style.backgroundColor='#D7E4F6';
	cont.style.border='1px solid #AEC2DF';
	cont.style.color='#0F4695';
	mem.value = parent_id;
	if(parent_id)
		{
		showWait('optionBody');
		if(type == 'users')
			{
			$.post("/GetHTML/optionsUsers/", {node:parent_id, location:location}, function(str) 
				{		
				var optionBody = document.getElementById('optionBody');
				optionBody.innerHTML = str;
				}
				);
			}
		else if(type == 'groups')
			{
			$.post("/GetHTML/optionsGroups/", {node:parent_id, location:location}, function(str) 
				{		
				var optionBody = document.getElementById('optionBody');
				optionBody.innerHTML = str;
				}
				);
			}
		}
	}