var necessary = new Array();
var necessCount = 0;
function checkOneElement(objName)
	{
	var obj = document.getElementById(objName);
	obj.checked=true; 
	checkClicked(obj);
	}
function confirmLink(confirmMsg)
	{
	if (confirmMsg == '') 
		{
		return true;
		}
	var is_confirmed = confirm(confirmMsg);
	return is_confirmed;
	}
function deleteMessages(formName)
	{
	var cntMess = document.getElementById('cnt').value;
	var action = document.getElementById('action');	
	var form = document.forms[formName];
	if(cntMess==1)
		{
		if (confirmLink('Удалить сообщение?'))
			{
			action.value = 1;
			form.submit();
			}
		}
	else if(cntMess>1)
		{
		if (confirmLink('Удалить выбранные сообщения?'))
			{
			action.value = 1;
			form.submit();
			}
		}
	else if(cntMess==0)
		{
			alert('Сообщения не выбраны!');
		}		
	}
/*	
function checkActionBtn()
	{
	var $cntMess = document.getElementById('cnt').value;
	if((document.getElementById('actionSelect_top'))&&($cntMess>0))
		{
		document.getElementById('actionSelect_top').disabled = false;
		document.getElementById('actionBtn_top').disabled = false;		
		}
	else if((document.getElementById('actionSelect_top'))&&($cntMess==0)) 
		{
		document.getElementById('actionSelect_top').disabled = true;
		document.getElementById('actionBtn_top').disabled = true;		
		}
	if((document.getElementById('actionSelect_btm'))&&($cntMess>0))
		{
		document.getElementById('actionSelect_btm').disabled = false;
		document.getElementById('actionBtn_btm').disabled = false;		
		}
	else if((document.getElementById('actionSelect_btm'))&&($cntMess==0)) 
		{
		document.getElementById('actionSelect_btm').disabled = true;
		document.getElementById('actionBtn_btm').disabled = true;		
		}
	}
function checkCanMultiple(obj)
	{
	if(obj.id == 'actionSelect_btm')
		var objSubmit = document.getElementById('actionBtn_top');
	else if(obj.id == 'actionSelect_top')
		var objSubmit = document.getElementById('actionBtn_btm');
	var canMultiple = document.getElementById('multipleSend').value;
	if((!canMultiple)&&(obj.selectedIndex==2))
		{
		if(document.getElementById('actionBtn_top'))
			document.getElementById('actionBtn_top').disabled = true;
		if(document.getElementById('actionBtn_btm'))
			document.getElementById('actionBtn_btm').disabled = true;
		}
	else
		{
		if(document.getElementById('actionBtn_top'))
			document.getElementById('actionBtn_top').disabled = false;
		if(document.getElementById('actionBtn_btm'))
			document.getElementById('actionBtn_btm').disabled = false;		
		}
	
	}*/
function checkClicked(obj)
	{
	var cnt = 0;
	var cntMessObj = document.getElementById('cnt');
	if(obj.checked)
		{
		cntMessObj.value ++;
		}
	else
		{
		cntMessObj.value --;
		}
	//checkActionBtn();
	}
/*	
function runSubmit(val)
	{
	var action = document.getElementById('action');
	var cntMessObj = document.getElementById('cnt');


	if(val == 1)
		{
		var confirmMessage = (cntMessObj.value < 2) ? 'Удалить сообщение?' : 'Удалить выбранные сообщения?'
		if (confirmLink(confirmMessage))
			action.value = 1;
		}
	else if (val == 2)
		{
		action.value = 2;
		}
//	alert(action.value);
	if(action.value>0)
		action.form.submit();
	}*/
function unCheckAll(formName)
	{
	var cnt = 0;
	var elCount = document.forms[formName].elements.length;
	for (var i = 0; i < elCount; i++)
		{		
		if(document.forms[formName].elements[i].type == 'checkbox')
			{
			document.forms[formName].elements[i].checked = false;
			cnt ++;
			}
		}
	document.getElementById('cnt').value = 0;
//	checkActionBtn();
	}
function checkAll(formName)
	{
	var cnt = 0;
	var elCount = document.forms[formName].elements.length;
	for (var i = 0; i < elCount; i++)
		{		
		if(document.forms[formName].elements[i].type == 'checkbox')
			{
			document.forms[formName].elements[i].checked = true;
			cnt ++;
			}
		}
	document.getElementById('cnt').value = cnt;
//	checkActionBtn();
	}
function check2Password(the_form)
	{
	var cnt = 0;
	var elCount = document.forms[the_form.name].elements.length;
	for (var i = 0; i < elCount; i++)
		{		
		if(document.forms[the_form.name].elements[i].type == 'password')
			{
			if(cnt)
				var passInput2 = document.forms[the_form.name].elements[i].value;				
			else
				{
				cnt ++;
				var passInput1 = document.forms[the_form.name].elements[i].value;
				}
			}
		}
	return (passInput2 == passInput1) ? 1 :0;	
	}
function EmptyCheck(the_form)
	{
	var emptyCount = 0;
	var checkPass = 0;
//	alert(document.forms[the_form.name].elements[0].type);
	var elCount = document.forms[the_form.name].elements.length;
	for (var i = 0; i < elCount; i++)
		{		
		if(document.forms[the_form.name].elements[i].type == 'submit')
			{
			var submit = document.forms[the_form.name].elements[i];
			}
		if(document.forms[the_form.name].elements[i].type == 'password')
			{
			checkPass = 0;
			}
		}
	var necCount = necessary.length;
    for (var j=0; j<necCount; j++)
	    {			
		tmpName = necessary[j];
		obj = document.getElementById(tmpName);
		/*if((!obj)&&(eval('document.all.'+tmpName)!=null))
			{
			obj=eval('document.all.'+tmpName);
			}*/
		if ((obj)&&(obj.value=='')&&(!obj.disabled))
			{
			emptyCount++;
			}
		}
	if (emptyCount>0)
		{
		submit.disabled = true;
		}
	else
		{
		if(((checkPass)&&(check2Password(the_form)))||(!checkPass))
			submit.disabled = false;
		else if((checkPass)&&(!check2Password(the_form)))
			submit.disabled = true;
		}
	}	
