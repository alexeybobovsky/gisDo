function getClientWidth()
{
  return document.compatMode=='CSS1Compat' && !window.opera?document.documentElement.clientWidth:document.body.clientWidth;
}
function getClientHeight()
{
  return document.compatMode=='CSS1Compat' && !window.opera?document.documentElement.clientHeight:document.body.clientHeight;
}
/*************************всплывающие панели*********************/
var keep = false;
var displayedPanel;
function toggleAllSelects(show) 
	{
	if(window.navigator.userAgent.indexOf('MSIE')>0)
		{
		var divCol = document.getElementsByTagName('select');	
//	alert(divCol.length);
		for(var i=0; i<divCol.length;  i++ )
			{
			divCol[i].style.display = (show) ?  '' :  'none';
//		divCol[i].disabled = (show) ?  '' :  'true';
//			divCol[i].style.zIndex = (show) ?  '0' :  '-10';
			}
		}
	}
function offsetPosition(element) 
	{
    var offsetLeft = 0, offsetTop = 0;
    do {
        offsetLeft += element.offsetLeft;
        offsetTop  += element.offsetTop;
    } while (element = element.offsetParent);
    return [offsetLeft, offsetTop];
	}
function toggleElementSimple(objId) /*hide/show element*/
	{
	var container = document.getElementById (objId);
	if (container)
		{
		var display = container.style.display;
		if (display == 'none'/* || !display*/)
			{
			displayedPanel = objId;
			container.style.display = '';     // без jquery
			}
		else
			{
			container.style.display = 'none';     // без jquery
			}
		return false;
		}
	else return true;			
	}	
function toElementManual(obj, element, offsetX, offsetY)
	{
	var container = document.getElementById(element);	
//	var W = document.body.offsetWidth;
//	var H = document.body.offsetHeight;
	var L = offsetPosition(obj)[0];
	var T = offsetPosition(obj)[1];
	container.style.left = L + eval(offsetX) + 'px';
	container.style.top = T + eval(offsetY) + 'px';
	}
function toElement(obj, element)
	{
	var container = document.getElementById(element);	
//	var W = document.body.offsetWidth;
//	var H = document.body.offsetHeight;
	var L = offsetPosition(obj)[0];
	var T = offsetPosition(obj)[1];
	container.style.left = L + eval(10) + 'px';
	container.style.top = T + eval(0) + 'px';
	}
function toCenter(objId)
	{
	var container = document.getElementById(objId);
	var innerHeight_ = window.innerHeight ? window.innerHeight : document.documentElement.offsetHeight;
	container.style.left = 	( document.body.clientWidth / 2 - container.clientWidth / 2  + document.body.scrollLeft) + 'px';
	container.style.top = 	( document.documentElement.scrollTop + innerHeight_ / 2 - container.clientHeight / 2 + document.body.scrollTop) + 'px';
/*	var W = document.body.offsetWidth;
	var H = document.body.offsetHeight;
	var L = W/2 - container.offsetWidth/2;
	var T = H/2 - container.offsetHeight/2;
	container.style.left = L +'px';
	container.style.top = T + 'px';*/
	}
function toggleDiv(objId) /*hide*/
	{
	var container = document.getElementById (objId);
	if (container)
	{
		var display = container.style.display;
		if (display == 'none' || !display)
			{
			toggleAllSelects(0);
			displayedPanel = objId;
			container.style.display = 'block';     // без jquery
//			$(container).fadeIn("fast");			

			keep = true;
			document.onclick = CloseDiv;
			document.onkeydown = EscapeDiv;
			container.onclick = Keep;

			}
		else
			{			
			toggleAllSelects(1);
			container.style.display = 'none';     // без jquery
//			$(container).fadeOut("fast");			
			}
		return false;
	}
	else return true;	
	}
function Keep()
{
	keep = true;
}

function CloseDiv (event)
{
	if (keep)
	{
		keep = false;
		return;
	}
	var container = document.getElementById (displayedPanel);
	if (!container) return;
//	toggleDiv(displayedPanel);
	toggleAllSelects(1);
	container.style.display = 'none';

	document.onclick = null;
	document.onkeydown = null;
}

function EscapeDiv (event)
{
	if (window.event) event = window.event;
	var code = event.keyCode ? event.keyCode : event.which ? event.which : null;
	if (code == 27)
	{
		var container = document.getElementById (displayedPanel);
		if (!container) return;
		toggleAllSelects(1);
		container.style.display = 'none';
//		toggleDiv(displayedPanel);

		document.onclick = null;
		document.onkeydown = null;
	}
}	
/*************************конец всплывающие панели*********************/

/*************************ЗВЕЗДЫ*************************************/
function starClick(starObj)
	{
	var curUser = document.getElementById('senderRNK').value;		
	var curFirm = document.getElementById('firmRNK').value;		
	var newRate = eval(GetStrPrt(starObj.id, '_', 1)) + 1;
	var action = '/company/set/rank/';
	var result = document.getElementById('myRank');
	var resultTtl = document.getElementById('ttlRank');
	var voiceCnt = document.getElementById('voiceCntNum');
	var starRow = document.getElementById('starRow');
	$(starRow).animate( { opacity: 0.2 }, 300 , function() { } );				
	$.post(action, {curUser:curUser, curFirm:curFirm, newRate:newRate}, function(str) 
			{
			if(str==0)
				{
				alert('Для оценки компании необходимо зарегистрироваться на сайте!')
				$(starRow).animate( { opacity: 1.0 }, 1000 );
				}
			else
				{
				var userRank = GetStrPrt(str, '_', 0);
				var firmRank = GetStrPrt(str, '_', 1);
				var firmRankNum = GetStrPrt(str, '_', 2);
				var starFull = GetStrPrt(str, '_', 3);
				var starHalf = GetStrPrt(str, '_', 4);
				var starEmpty = GetStrPrt(str, '_', 5);
				for(var i=0; i< 10; i++)
					{
					if(i<starFull)
						stars[i] = 1;
					else if(i<(eval(starFull)+eval(starHalf)))
						stars[i] = 2;
					else 
						stars[i] = 3;
					}
				starOut(); 
				result.innerHTML = /*'я оценил на ' + -*/userRank;					
				resultTtl.innerHTML = /*'я оценил на ' + -*/firmRank;					
				voiceCnt.innerHTML = firmRankNum;
				$(starRow).animate( { opacity: 1.0 }, 1000 );	
				}
			}
		);
	}
function starOver(starObj)
	{

	curStar = starObj;
	mouseOver = true;
	var curStarIndx = GetStrPrt(starObj.id, '_', 1);

	for(var i=0; i< 10; i++)
		{
		if(i<=curStarIndx)
			document.getElementById('star_'+i).src=redStarSrc;		
		}

	}
function starOut()
	{
	mouseOver = false;
	curStar = '';
	var starId='';
	var starSrc='';
	for(var i=0; i< 10; i++)
		{
		starId = 'star_'+i;
		if(stars[i] == 1)
			starSrc = fullStarSrc;
		else if (stars[i] == 2)
			starSrc = halfStarSrc;
		else if (stars[i] == 3)
			starSrc = emptyStarSrc;
		
		document.getElementById(starId).src=starSrc;
		}
	}
/*************************КОНЕЦ ЗВЕЗДЫ*************************************/


function EmptyCheckSimple2(the_form, obj)
	{
    var selectCount  = document.forms[the_form.name].elements.length;	
    for (var i = 0; i < selectCount; i++)
	    {
		if (document.forms[the_form.name].elements[i].type == 'submit')
			{
			document.forms[the_form.name].elements[i].disabled = (document.forms[the_form.name].elements[obj.id].value!='') ? false : true;
			}
	    } 
	}
function EmptyCheckJustOne(the_form)
	{
	var fullCnt = 0;
    var selectCount  = document.forms[the_form.name].elements.length;
    for (var i = 0; i < selectCount; i++)
	    {
//		alert(document.forms[the_form.name].elements[i].value);
		if (((document.forms[the_form.name].elements[i].type == 'select-one')||(document.forms[the_form.name].elements[i].type == 'text'))&&
				(document.forms[the_form.name].elements[i].value != '')&&(document.forms[the_form.name].elements[i].value != 0))
			{
			fullCnt ++;
//			alert(document.forms[the_form.name].elements[i].name);
//			document.forms[the_form.name].elements[i].disabled=true;
			}
	    } 
	return fullCnt; 
	}
function confirmLink(confirmMsg)
	{
	/*-if (confirmMsg == '' || typeof(window.opera) != 'undefined') 
		{
		return true;
		}*/
	var is_confirmed = confirm(confirmMsg);
	return is_confirmed;
	}
function GetStrPrt(str, del, indx)
	{
	var strArr1 = str.split(del);
	var ret = strArr1[indx];
	return ret;
	}	
function commentBoxSwitcher(obj, caption)
	{
	var switchedObjName = 'body_' + GetStrPrt(obj.id, '_', 1);
	var switchedObj = document.getElementById(switchedObjName);
	if (switchedObj.style.display == "none")
		{
		switchedObj.style.display = "inline"; 
		obj.innerHTML = ' - ' + caption;
		}
	else 
		{
		switchedObj.style.display = "none";	
		obj.innerHTML = ' + ' + caption;
		}
	}	
function EmptyCheckSimple(the_form, obj, submitName)
	{
	if(document.forms[the_form.name].elements[obj.id].value!='')
		document.forms[the_form.name].elements[submitName].disabled = false;
	else
		document.forms[the_form.name].elements[submitName].disabled = true;
	}		
function convertSelect2Edit(obj)
	{						
//	alert (obj.id);
	var newObj = 	'<INPUT  name=\'NEW_' + obj.id + '\' type=\'text\' 		 id=\'NEW_' + obj.id + ' \'   style = \'width: 300px;\'   	value=\'\'>';
	var contaner = document.getElementById('DIV' + obj.id);
	contaner.innerHTML = newObj;
	}				
	