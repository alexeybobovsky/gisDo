
function itemSelectAuto(parent_id, right) /*12_04_07*/
	{
	var container = document.getElementById('link_' +  parent_id);// GetStrPrt(container.id, '_', 1);
	var usrType = container.usrType;
	var mem = document.getElementById('IDcurNode');
	var memType = document.getElementById('IDcurType');
	var number= mem.value;
	if(number != '')
		{
		var cont = document.getElementById('item_'+number);
		cont.style.backgroundColor='white';
		cont.style.border='1px solid white';
		cont.style.color='';
		}
	var cont = document.getElementById('item_' + parent_id);
	var location = document.location;
	cont.style.backgroundColor='#D7E4F6';
	cont.style.border='1px solid #AEC2DF';
	cont.style.color='#0F4695';
	mem.value = parent_id;
	if((parent_id>0)&&(right>=3))
		{
/*		var button = document.getElementById('opt_IDNewImg');
		pushButton(button);*/
		memType.value = usrType;
		showWait('optionBody');
		$.post("/GetHTML/optionsInfo/", {node:parent_id, type:usrType, location:location}, function(str) 
			{		
			var optionBody = document.getElementById('optionBody');
//			alert (str);
			optionBody.innerHTML = str;
			}
		);
		}
	}

function itemSelect(container, right, admin)
	{	
	var parent_id = GetStrPrt(container.id, '_', 1);
	var usrType = container.usrType;
	var mem = document.getElementById('IDcurNode');
	var memType = document.getElementById('IDcurType');
	var number= mem.value;
	if(number != '')
		{
		var cont = document.getElementById('item_'+number);
		cont.style.backgroundColor='white';
		cont.style.border='1px solid white';
		cont.style.color='';
		}
	var cont = document.getElementById('item_' + parent_id);
	var location = document.location;
	cont.style.backgroundColor='#D7E4F6';
	cont.style.border='1px solid #AEC2DF';
	cont.style.color='#0F4695';
	mem.value = parent_id;
	if((parent_id>=0)&&(admin)&&(right>=3))
		{
/*		var button = document.getElementById('opt_IDNewImg');
		pushButton(button);*/
		memType.value = usrType;
		showWait('optionBody');
		$.post("/GetHTML/optionsInfo/", {node:parent_id, type:usrType, location:location}, function(str) 
			{		
			var optionBody = document.getElementById('optionBody');
//			alert (str);
			optionBody.innerHTML = str;
			}
		);
		}
	}