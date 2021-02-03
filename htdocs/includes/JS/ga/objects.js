var curItem = 0;
//var itemCount = 0;
function changeNewOption(select) /*добавление нового свойства*/
	{
	var curIndex = GetElIndex(select.id);	
//	var valueElement = document.getElementById('IDnewOptionValue[' + curIndex + ']');
	for(i=0; i<optionName.length; i++)
		{
		if(optionValue[i] == select.value)
			{
			var type = optionType[i];			
			}
		}
//	alert(type);
	var oValue = document.createElement("INPUT");
	oValue.name = 'newOptionValue['+curIndex+']';
	oValue.type = (type == 'file') ? 'file' : 'text';
	oValue.id = 'ID' + 'newOptionValue['+curIndex+']';
	oValue.style.width="98%";
	oValue.value = '';	
	var div =  document.getElementById('DIVIDnewOptionValue['+curIndex +']');
	var oldChild=div.children(0);
//	alert(oValue.id);
	div.removeChild(oldChild);
	div.appendChild(oValue);	
	}
function addItem() /*добавление нового свойства*/
	{
	oName = document.createElement("SELECT");
	oName.name = 'newOptionName['+curItem+']';
	oName.id = 'ID' + 'newOptionName['+curItem+']';
	oName.style.width="98%";
//	alert(oName.fo)
	var cnt = 0;
	for(i=0; i<optionName.length; i++)
		{
//		alert(optionNameReal[i]);
		if(!document.getElementById(optionNameReal[i]))
			{
			if(cnt==0)
				var type = optionType[i];						
			oOption = document.createElement("OPTION");
			oOption.value = optionValue[i];
			oOption.appendChild(document.createTextNode(optionName[i]));
			oName.appendChild(oOption);
			cnt ++;
			}
		}
	oName.onchange = function() {changeNewOption(this)}; 
	
	oNameHeader = document.createElement("SMALL");
	oNameHeader.innerHTML =  'Дополнительное свойство №' + eval(curItem + 1);
	oValueHeader = document.createElement("SMALL");
	oValueHeader.innerHTML =  'Значение свойства №' + eval(curItem + 1);
	
	oValue = document.createElement("INPUT");
	oValue.name = 'newOptionValue['+curItem+']';
	oValue.type = type;
	oValue.id = 'ID' + 'newOptionValue['+curItem+']';
	oValue.style.width="98%";
	oValue.value = '';
	
	var div1 =  document.createElement("DIV");
	div1.id = 'DIVID'+'newOptionName['+curItem +']';
	
	var div2 =  document.createElement("DIV");
	div2.id = 'DIVID'+'newOptionValue['+curItem +']';

	var div = document.getElementById('DIVnewOption');
	
	div.appendChild(oNameHeader);
	div1.appendChild(oName);
	div.appendChild(div1);	
	
	div.appendChild(oValueHeader);	
	div2.appendChild(oValue);
	div.appendChild(div2);	
	curItem++;
	}

function delItem()
	{
	var tbody = document.getElementById('orderEdit').getElementsByTagName("TBODY")[0];	
	tbody.removeChild(tbody.lastChild);		
	curItem--;
	if(curItem)
		{		
		document.getElementById('IDnewDelete[' + eval(curItem-1) + ']').disabled = false;
		}
	autoSummOrder();
	}
	
function itemSelectAuto(parent_id) /*12_04_07*/
	{
	if(document.getElementById('item_' + parent_id))
		var container = document.getElementById('item_' + parent_id);
	if (document.getElementById('IDcurNode'))
		var mem = document.getElementById('IDcurNode');
	if(document.getElementById('IDcurType'))
		var usrType = document.getElementById('IDcurType').value;
	highlightObject(container.id, 1); 
	mem.value = container.id;
	var location =  document.getElementById('IDcurUrl').value;
	var action =  location + "showObjectEdit/";		
	if((parent_id>=0))
		{
		showWait('optionBody');
		$.post(action, {node:parent_id,location:location}, function(str) 
			{		
			var optionBody = document.getElementById('optionBody');
			optionBody.innerHTML = str;
			}
		);
		}
	}

function itemSelect(container)
	{	
	curItem = 0;
	var parent_id = GetStrPrt(container.id, '_', 1);
	if (document.getElementById('IDcurNode'))
		var mem = document.getElementById('IDcurNode');
	if(document.getElementById('IDcurType'))
		var usrType = document.getElementById('IDcurType').value;
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
		$.post(action, {node:parent_id, type:usrType, location:location}, function(str) 
			{		
			var optionBody = document.getElementById('optionBody');
			optionBody.innerHTML = str;
			}
		);
		}
	}
function newLayer()
	{					
	var location =  getLayer('IDcurUrl').value + "showEditNewLayer/";		
	var contaner = getLayer('DIVLAYER');
	var oldSelect = getLayer('LAYER');
	oldSelect.disabled = true;
	$.post(location, {}, function(str) 
		{		
		contaner.innerHTML = str;
		});
	}
function newFirm()
	{					
	var location =  getLayer('IDcurUrl').value + "showEditNewFirm/";		
	var contaner = getLayer('DIVFIRM');
	var oldSelect = getLayer('FIRM');
	oldSelect.disabled = true;
	$.post(location, {}, function(str) 
		{		
		contaner.innerHTML = str;
		});
	}
function changeCityAdd(obj)
	{						
	if(obj.value == 'new')
		{
		var location =  getLayer('IDcurUrl').value + "showEditNewCity/";		
		var contaner = getLayer('DIVCITY');
		var oldSelect = getLayer('CITY');
		oldSelect.disabled = true;
		$.post(location, {}, function(str) 
			{		
			contaner.innerHTML = str;
			});			
		newFirm();
		}
	else
		{
		var location =  getLayer('IDcurUrl').value + "showSelectNewFirm/";		
		var contaner = getLayer('DIVFIRM');
		var oldSelect= getLayer('FIRM');
	
		oldSelect.disabled = true;
		$.post(location, {city:obj.value}, function(str) 
			{		
			contaner.innerHTML = str;
			});
		}
	}
function changeCityFilter(obj)
	{					
	var location =  getLayer('IDcurUrl').value + "showSelectFilterFirm/";		
	var oldSelect = getLayer('IDFIRMFLTR');
	oldSelect.disabled = true;
	var contaner = getLayer('DIVIDFIRMFLTR');
	$.post(location, {city:obj.value}, function(str) 
		{		
		contaner.innerHTML = str;
		});
	}
	