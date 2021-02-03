function itemSelectLayer(container/*, right, admin*/)
	{	
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
	var action =  location + "showLayerEdit/";		
	if((parent_id>=0)/*&&(admin)&&(right>=3)*/)
		{
/*		var button = document.getElementById('opt_IDNewImg');
		pushButton(button);*/
//		memType.value = usrType;
		showWait('optionBody');
		$.post(action, {node:parent_id, location:location}, function(str) 
			{		
			var optionBody = document.getElementById('optionBody');
//			alert (str);
			optionBody.innerHTML = str;
			}
		);
		}
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
	if((parent_id>=0)/*&&(admin)&&(right>=3)*/)
		{
/*		var button = document.getElementById('opt_IDNewImg');
		pushButton(button);*/
//		memType.value = usrType;
		showWait('optionBody');
		$.post("/GetHTML/optionsReferences/", {node:parent_id, type:usrType, location:location}, function(str) 
			{		
			var optionBody = document.getElementById('optionBody');
//			alert (str);
			optionBody.innerHTML = str;
			}
		);
		}
	}

function itemSelect(container/*, right, admin*/)
	{	
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
	if((parent_id>=0)/*&&(admin)&&(right>=3)*/)
		{
/*		var button = document.getElementById('opt_IDNewImg');
		pushButton(button);*/
//		memType.value = usrType;
		showWait('optionBody');
		$.post("/GetHTML/optionsReferences/", {node:parent_id, type:usrType, location:location}, function(str) 
			{		
			var optionBody = document.getElementById('optionBody');
//			alert (str);
			optionBody.innerHTML = str;
			}
		);
		}
	}