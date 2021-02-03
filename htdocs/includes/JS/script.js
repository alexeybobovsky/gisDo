function highlightObject(id, on)   /*07_05_2008 вкл/выкл подсветку для элемента*/
	{
	if(document.getElementById(id))
		{ 
		if(on==0)
			{
			var cont = document.getElementById(id);		
			cont.style.backgroundColor='white';
			cont.style.border='0px solid white';
			cont.style.color='';
			}
		else
			{
			var cont = document.getElementById(id);
			cont.style.backgroundColor='#D7E4F6';
			cont.style.border='1px solid #AEC2DF';
			cont.style.color='#0F4695';			
			}
		}
	}

function checkChangesInFormAndActiveSubmut(form, comparePref, del) /*24_10_07 - проверка чекбоксов и  если не все пустые, то активируем сабмит*/
	{
	var val = 0;
//	alert(form);	
	for(i=0; i<form.length; i++)
		{
		if(form.elements[i].id.indexOf(comparePref)>=0)
			{
			var cmpElementName = GetStrPrt(form.elements[i].id, del, 1);

			var cmpElement = document.getElementById(cmpElementName);
			//alert(cmpElementName + ' - ' + cmpElement);			
			if(cmpElement.value != form.elements[i].value) 
				val ++;
			}
		if(form.elements[i].type == 'submit')
			var submit = form.elements[i];
		}
	if(val)
		submit.disabled = false;
	else
		submit.disabled = true;
	}
function checkCheckboxesInFormAndChangeSubmut(form) /*24_10_07 - проверка чекбоксов и  если не все пустые, то активируем сабмит*/
	{
	var val = 0;
	for(i=0; i<form.length; i++)
		{
		if((form.elements[i].type == 'checkbox')&&(form.elements[i].checked))
			{
			val ++;
			}
		if(form.elements[i].type == 'submit')
			var submit = form.elements[i];
		}
	if(val)
		submit.disabled = false;
	else
		submit.disabled = true;
	}
function ShowWaitBoxNew(obj) /*22_09_2007 отобпажается элемент ожидания - по центру*/
	{
	for(i=obj, x=0, y=0; i; i = i.offsetParent) 
		{
		x += i.offsetLeft;
		y += i.offsetTop;
		}		
//	var posX = x + cursel.offsetWidth + 5;//+eval(cursel.style.width);
	var posY = y;
	var W = window.screen.availWidth;
	var H = window.screen.availHeight;	
	document.getElementById('waitBox').style.left = W/2 - document.getElementById('waitBox').style.pixelWidth/2;
	document.getElementById('waitBox').style.top = posY - document.getElementById('waitBox').style.pixelHeight/2;
	document.getElementById('waitBox').style.display='';	
		
	}
function ShowWaitBox() /*22_09_2007 отобпажается элемент ожидания - по центру*/
	{
	var W = window.screen.availWidth;
	var H = window.screen.availHeight;	
	document.getElementById('waitBox').style.left = W/2 - document.getElementById('waitBox').style.pixelWidth/2;
	document.getElementById('waitBox').style.top = H/2 + document.getElementById('waitBox').style.pixelHeight/2;
	document.getElementById('waitBox').style.display='';	
//	alert(document.getElementById('waitBox').style.width + ' x ' + document.getElementById('waitBox').style.height);
	}
function HideWaitBox() /*22_09_2007 ршву элемент ожидания - по центру*/
	{
	document.getElementById('waitBox').style.display='none';	
//	alert(window.height);
	}
function formEnable(the_form, excluded) /* активация всех (кроме указанного)  элементов формы*/
	{
    var selectCount  = document.forms[the_form.name].elements.length;
	var nameEx = '';
	if (excluded)
		nameEx = excluded;
    for (var i = 0; i < selectCount; i++)
	    {
		if ((document.forms[the_form.name].elements[i].name != nameEx))
			{
//			alert(document.forms[the_form.name].elements[i].name);
			document.forms[the_form.name].elements[i].disabled=false;
			}
	    } // end for	
	}
function formDisable(the_form, excluded) /* деактивация всех (кроме указанного)  элементов формы*/
	{
    var selectCount  = document.forms[the_form.name].elements.length;
	var nameEx = '';
	if (excluded)
		nameEx = excluded;
    for (var i = 0; i < selectCount; i++)
	    {
		if ((document.forms[the_form.name].elements[i].name != nameEx))
			{
//			alert(document.forms[the_form.name].elements[i].name);
			document.forms[the_form.name].elements[i].disabled=true;
			}
	    } // end for
	
	}
function GetLastEl(str, del) /*07_04_11*/
	{
	strArr = str.split(del);
	
	var ret = strArr[strArr.length-1];
//	alert(strArr1[0]);
	return ret;
	}
function showWait(container) /*07_03_27*/
	{
	var cont = document.getElementById(container);
	var imgSrc = '/src/design/jquery/indicator.gif';
	cont.innerHTML = '<img src='+ imgSrc + '><br> Загрузка... ';	
	}
function imgPreview(img, src, max, preffix, defSrc)
	{
	var objImg = document.getElementById(img);
	if(max)
		{
		objImg.style.pixelWidth = max;
		objImg.style.pixelHeight = max;
		}
	var rSrc = preffix + src;
	if(!src)
		rSrc = defSrc;
	objImg.src = rSrc;
/*	alert(objImg.width);
	alert(objImg.style.pixelWidth);*/
	}
function formSubmit(form_name, id)
	{
	form = document.getElementById(form_name);
	form.action += id;
	form.submit();
	}
function resetContainer(container)
	{
	document.getElementById(container).innerHTML = '';
	}
function fillContainer(container, content)
	{
	document.getElementById(container).innerHTML = content;
	}
	
function windowChangePosition(w, h)
	{
//	alert(w + '!' + h);
	var window_top = screen.availHeight/2 - h/2;
	var window_left = screen.availWidth/2 - w/2;
	window.moveTo(window_top, window_left);
	}
function open_window(url, name, w, h, scroll)
	{
	var tmp = "scrollbars=no";
	if (scroll)
		tmp = "scrollbars=yes";	
	var window_top = screen.availHeight/2 - h/2;
	var window_left = screen.availWidth/2 - w/2;
	var pos = tmp+", height="+h+", width="+w +", left="+window_left+", top="+window_top;
	windowConsole = window.open(url, name, pos);
	windowConsole.focus();
//	return 1;
	}
function ChangeStatus(el)
	{
	if (el.disabled)
		el.disabled = false;
	else
		el.disabled = true;		
	}
function GetStrPrt(str, del, indx)
	{
	strArr1 = str.split(del);
	var ret = strArr1[indx];
//	alert(strArr1[0]);
	return ret;
	}
function GetElPreffix(str)
	{
	strArr1 = str.split('_');
	var pref = strArr1[0];
//	alert(strArr1[0]);
	return strArr1[0];
	}
function GetIncIndex(str)
	{
	var curIndx = GetElIndex(str);
	var nextIndx = eval(curIndx) + 1;
	var finalString = str.replace(curIndx, nextIndx);
//	alert(finalString);
	return finalString;
	}
function GetElArName(str)
	{
	strArr1 = str.split('[');
	var pref = strArr1[0];
//	alert(strArr1[0]);
	return strArr1[0];
	}
function GetElIndex(str)
	{
	strArr1 = str.split('[');
	strArr2 = strArr1[1].split(']', 1);
//	alert(strArr2[0]);
	return strArr2[0];
	}
function OneParamCheck(the_form, param)
	{
    var selectCount  = document.forms[the_form.name].elements.length;
    for (var i = 0; i < selectCount; i++)
	    {
		if ((document.forms[the_form.name].elements[i].type == 'select-one')&&(document.forms[the_form.name].elements[i].name != param.name))
			{
//			alert(document.forms[the_form.name].elements[i].name);
			document.forms[the_form.name].elements[i].disabled=true;
			}
	    } // end for
	
	}
function EmptyCheck(the_form)
	{
	var emptyCount = 0;
//	alert(document.forms[the_form.name].elements[0].type);
	var elCount = document.forms[the_form.name].elements.length;
	for (var i = 0; i < elCount; i++)
		{		
		if(document.forms[the_form.name].elements[i].type == 'submit')
			{
			var submit = document.forms[the_form.name].elements[i];
			}
		}
	var necCount = necessary.length;
    for (var j=0; j<necCount; j++)
	    {			
		tmpName = necessary[j];
		obj = document.getElementById(tmpName);
		if((!obj)&&(eval('document.all.'+tmpName)!=null))
			{
			obj=eval('document.all.'+tmpName);
			}
		if ((obj.value=='')&&(!obj.disabled))
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
		submit.disabled = false;
		}
	}	
function confirmLink(confirmMsg)
	{
	/*
	if (confirmMsg == '' || typeof(window.opera) != 'undefined') 
		{
		return true;
		}*/
	var is_confirmed = confirm(confirmMsg);
	return is_confirmed;
	}