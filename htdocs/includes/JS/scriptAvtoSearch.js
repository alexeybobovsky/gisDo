function GetStrPrt_l(str, del, indx)
	{
	var strArr1 = str.split(del);
	var ret = strArr1[indx];
	return ret;
	}	
/*	
function showProperties(obj, objName) 
{
  var result = "The properties for the " + objName + " object:" + "\n";
  
  for (var i in obj) {result += i + " = " + obj[i] + "\n";}
  
  return result;
}
*/
function setSelectedParam(name, value)
	{
//	alert(name);
	var spanCol = document.getElementsByTagName('span'); 
	var delim = '_';
	var elementId;
	res = (value) ? value.split('_') : 0;
	if(res.length>1)
		{
		for(var k=0; k<res.length;  k++ )
			{
			elementId = name + delim + res[k];
//			alert(elementId);
			for(var i=0; i<spanCol.length;  i++ )
				{
				if((spanCol[i].id.indexOf(elementId) >= 0) && (value!=0))
					{
					spanCol[i].className = 'selectedC';
					}
				else if((spanCol[i].id.indexOf(elementId) >= 0) && (value==0))
					{
//					alert(elementId);
					spanCol[i].className = 'selected';
					}
				}
			}
		}
	else
		{
		elementId = name + delim + value;
		for(var i=0; i<spanCol.length;  i++ )
			{
			if((spanCol[i].id.indexOf(elementId) >= 0) && (value!=0))
				{
				spanCol[i].className = 'selectedC';
				}
			else if((spanCol[i].id.indexOf(elementId) >= 0) && (value==0))
				{
//				alert(elementId);
				spanCol[i].className = 'selected';
				}				
			}
		}
	document.getElementById(name).value = value;				
	}
function searchInit()
	{
	setSelectedParam('mark', mark_);
	setSelectedParam('bodyType', bodyType_);
	setSelectedParam('transmission', transmission_);
	setSelectedParam('driveType', driveType_);
	setSelectedParam('engineType', engineType_);
	setSelectedParam('sortType', sortType_);
	setSelectedParam('sortDir', sortDir_);
	setSelectedParam('resCnt', resCnt_);
	}
function toggleRowsSearchResult(obj, modifCnt)
	{
	var name = 	GetStrPrt_l(obj.id, '_', 0);
	var trCol = document.getElementsByTagName('tr'); 
	var tdCol = document.getElementsByTagName('td'); 
	for(var i=0; i<trCol.length;  i++ )
		{
		if(trCol[i].id.indexOf(name) >= 0)
			{
			trCol[i].style.display  = (trCol[i].style.display == 'none')? '' : 'none';
			}
		}
	for(var i=0; i<tdCol.length;  i++ )
		{
		if(tdCol[i].id.indexOf(name) >= 0)
			{
//			alert(tdCol[i].rowspan);
//			alert(showProperties(tdCol[i], 'td'))
			tdCol[i].rowSpan  = (tdCol[i].rowSpan == modifCnt)? 1 : modifCnt;
			}
		}
	obj.title = (obj.title == 'показать')? 'скрыть' : 'показать';
//	obj.title = (obj.title == 'показать')? 'скрыть' : 'показать';
	
	}
function startSearch()
	{
	if(document.getElementById('extendedSection').style.display == 'none')
		{
		document.getElementById('engineVolumeStart').value = 0;		
		document.getElementById('engineVolumeEnd').value = 0;		
		document.getElementById('enginePowerStart').value = 0;		
		document.getElementById('enginePowerEnd').value = 0;		
		document.getElementById('transmission').value = 0;		
		document.getElementById('driveType').value = 0;		
		document.getElementById('engineType').value = 0;		
		document.getElementById('mark').value = 0;		
		}
	else
		{
		document.getElementById('extendedSearch').value = 1;		
		}
	document.forms["searchCar"].submit();
	}
function showExtendedArea(obj)
	{
	document.getElementById('extendedSection').style.display = '';							
	obj.style.display = 'none';	
	}
function scrollReset(element)
	{
	var obj, limit;
	if (element.id == 'priceReset' )
		{
		obj = 'one';
		limit = priceLimit;
		}
	else if (element.id == 'evReset' )
		{
		obj = 'two';
		limit = engineVolumeLimit;
		}
	else if (element.id == 'epReset' )
		{
		obj = 'three';
		limit = enginePowerLimit;
		}
	
	trackbar.getObject(obj).updateLeftValue(0);
	trackbar.getObject(obj).updateRightValue(limit);
	if (element.id == 'priceReset' )
		{		
		setPrice(0, limit);
		}
	else if (element.id == 'evReset' )
		{		
		setEngineVolume(0, limit);
		}
	else if (element.id == 'epReset' )
		{		
		setEnginePower(0, limit);
		}
	}
function selectedDivs(type, element)
	{
	var name = 	GetStrPrt_l(element.id, '_', 0);
	var id = 	GetStrPrt_l(element.id, '_', 1);
	var spanCol = document.getElementsByTagName('span'); 
	if(type == 'radio')
		{
		document.getElementById(name).value = id;		
		for(var i=0; i<spanCol.length;  i++ )
			{
			if(spanCol[i].id.indexOf(name) >= 0)
				{
				if(spanCol[i].id != element.id)
					spanCol[i].className = 'link';
				else
					spanCol[i].className = 'selected';
				}
			
			}
		}
	else if(type == 'checkbox')
		{
		var strToInput = '';
		for(var i=0; i<spanCol.length;  i++ )
			{
			if(spanCol[i].id.indexOf(name) >= 0)
				{
				if(id>0) /*если не  выбран нулевой вариант - что означает "любой"*/
					{
					if(spanCol[i].id != element.id) 
						{
						if(spanCol[i].className == 'selectedC')
							{
							strToInput += (strToInput == '')? '' : '_';
							strToInput += GetStrPrt_l(spanCol[i].id, '_', 1);
							}
						else if ((spanCol[i].className == 'selected')&&(spanCol[i].id == name + '_0'))
							spanCol[i].className = 'link';							
						}
					else
						{
						if(spanCol[i].className == 'selectedC')
							{
							spanCol[i].className = 'link';
							}
						else if(spanCol[i].className == 'link')
							{
							spanCol[i].className = 'selectedC';
							strToInput += (strToInput == '')? '' : '_';
							strToInput += id;
							}
						}
					}
				else /*если ноль - то всё обнуляем*/
					{
					if(spanCol[i].id != element.id) 
						spanCol[i].className = 'link';
					else 
						spanCol[i].className = 'selected';					
					}
				}						
			}
		if((strToInput == '')&&(id>0))
			{
			document.getElementById(name + '_0').className = 'selected';			
			}
		if(strToInput == '')
			strToInput = 0;
		document.getElementById(name).value = strToInput;		
//		alert(name + ' - ' + strToInput);
		}
	}
function getPriceStr(onePrice, value)	
	{
	var str = '';
	var intPart = floatPart = 0
	if(value/1000000>=3)
		{
		}
	else if(value/1000000>=1)
		{			
		intPart = Math.floor(value/1000000);			
		floatPart = value - intPart*1000000; 			
		str = intPart;
		if (intPart == 1)
			
			str += (onePrice) ? ' миллион ' : ' миллиона ';
		else
			str += (onePrice) ? ' миллиона ' :' миллионов ';
		if (floatPart/1000>0)
			str += floatPart/1000 + ' тысяч';
		}
	else if(value/1000>=1)
		{
		intPart = Math.floor(value/1000);			
		floatPart = value - intPart*1000; 			
		str = intPart;
		str += ' тысяч ';
		}
	else
		{
		}
	return str;
	}
function setPrice(leftValue, rightValue)	
	{
	if(((rightValue >= priceLimit) && (leftValue == 0)) || (rightValue == 0) || (leftValue >= priceLimit)) //за любую стоимость
		{
		document.getElementById('priceStart').value = 0;		
		document.getElementById('priceEnd').value = 0;		

		document.getElementById('priceReset').style.display = 'none';						

		document.getElementById('priceAll').style.display = 'none';						
		document.getElementById('priceOne').innerHTML = ' за <span style="font-weight: bold;">любую цену</span>';
		document.getElementById('priceToTxt').innerHTML = '';
		document.getElementById('priceFromTxt').innerHTML = '';
		
		}
	else if((rightValue >= priceLimit)&&(leftValue != rightValue)) 
		{
		document.getElementById('priceStart').value = leftValue * 1000;		
		document.getElementById('priceEnd').value = 0;		

		document.getElementById('priceReset').style.display = '';						
		document.getElementById('priceDelim').style.display = 'none';						
		document.getElementById('priceStartTxt').style.display = '';						
		document.getElementById('priceAll').style.display = '';						
		document.getElementById('priceOne').innerHTML = '';
		document.getElementById('priceFromTxt').innerHTML = getPriceStr(0, leftValue * 1000);
		document.getElementById('priceToTxt').innerHTML = '';		
		}
	else if((leftValue == 0))
		{
		document.getElementById('priceStart').value = 0;		
		document.getElementById('priceEnd').value = rightValue * 1000;		

		document.getElementById('priceReset').style.display = '';						
		document.getElementById('priceDelim').style.display = '';						
		document.getElementById('priceStartTxt').style.display = 'none';						
		document.getElementById('priceAll').style.display = '';						
		document.getElementById('priceOne').innerHTML = '';
		document.getElementById('priceToTxt').innerHTML = getPriceStr(0, rightValue * 1000);
		document.getElementById('priceFromTxt').innerHTML = '';
		}
	else if(rightValue == leftValue)
		{
		document.getElementById('priceStart').value = leftValue * 1000;
		document.getElementById('priceEnd').value = rightValue * 1000;		

		var str = ' за ';
		str += '<span style="font-weight: bold;">' + getPriceStr(1, leftValue * 1000) + '</span> рублей';
		document.getElementById('priceReset').style.display = '';						
		document.getElementById('priceAll').style.display = 'none';						
		document.getElementById('priceOne').innerHTML = str;
		document.getElementById('priceToTxt').innerHTML = '';
		document.getElementById('priceFromTxt').innerHTML = '';
		}
	else
		{
		document.getElementById('priceStart').value = leftValue * 1000;
		document.getElementById('priceEnd').value = rightValue * 1000;		

		document.getElementById('priceReset').style.display = '';						
		document.getElementById('priceDelim').style.display = '';						
		document.getElementById('priceStartTxt').style.display = '';						
		document.getElementById('priceAll').style.display = '';						
		document.getElementById('priceOne').innerHTML = '';
		document.getElementById('priceFromTxt').innerHTML = getPriceStr(0, leftValue * 1000);
		document.getElementById('priceToTxt').innerHTML = getPriceStr(0, rightValue * 1000);
		}
	}
function setEngineVolume(leftValue, rightValue)	
	{
	if(((rightValue >= engineVolumeLimit) && (leftValue == 0)) || (rightValue == 0) || (leftValue >= engineVolumeLimit)) //за любую стоимость
		{
		document.getElementById('engineVolumeStart').value = 0;		
		document.getElementById('engineVolumeEnd').value = 0;		

		document.getElementById('evReset').style.display = 'none';						
		document.getElementById('evAll').style.display = 'none';						
		document.getElementById('evOne').innerHTML = ' <span style="font-weight: bold;">любой</span>';
		document.getElementById('evToTxt').innerHTML = '';
		document.getElementById('evFromTxt').innerHTML = '';
		}
	else if((rightValue >= engineVolumeLimit)&&(leftValue != rightValue)) 
		{
		document.getElementById('engineVolumeStart').value = leftValue;		
		document.getElementById('engineVolumeEnd').value = 0;		

		document.getElementById('evReset').style.display = '';						
		document.getElementById('evDelim').style.display = 'none';						
		document.getElementById('evStart').style.display = '';						
		document.getElementById('evAll').style.display = '';						
		document.getElementById('evOne').innerHTML = '';
		document.getElementById('evFromTxt').innerHTML = leftValue + '&nbsp;см<sup>3</sup>';
		document.getElementById('evToTxt').innerHTML = '';		
		}
	else if((leftValue == 0))
		{
		document.getElementById('engineVolumeStart').value = 0;		
		document.getElementById('engineVolumeEnd').value = rightValue;		

		document.getElementById('evReset').style.display = '';						
		document.getElementById('evDelim').style.display = '';						
		document.getElementById('evStart').style.display = 'none';						
		document.getElementById('evAll').style.display = '';						
		document.getElementById('evOne').innerHTML = '';
		document.getElementById('evToTxt').innerHTML = rightValue + '&nbsp;см<sup>3</sup>';
		document.getElementById('evFromTxt').innerHTML = '';
		}
	else if(rightValue == leftValue)
		{
		document.getElementById('engineVolumeStart').value = leftValue;
		document.getElementById('engineVolumeEnd').value = rightValue;		

//		var str = ' ';
		document.getElementById('evReset').style.display = '';						
		var str = '<span style="font-weight: bold;">' + leftValue + '&nbsp;см<sup>3</sup></span> ';
		document.getElementById('evAll').style.display = 'none';						
		document.getElementById('evOne').innerHTML = str;
		document.getElementById('evFromTxt').innerHTML = '';
		document.getElementById('evToTxt').innerHTML = '';
		}
	else
		{
		
		document.getElementById('engineVolumeStart').value = leftValue;
		document.getElementById('engineVolumeEnd').value = rightValue;		

		document.getElementById('evReset').style.display = '';						
		document.getElementById('evDelim').style.display = '';						
		document.getElementById('evStart').style.display = '';						
		document.getElementById('evAll').style.display = '';						
		document.getElementById('evOne').innerHTML = '';
		document.getElementById('evFromTxt').innerHTML = leftValue + '&nbsp;см<sup>3</sup>';
		document.getElementById('evToTxt').innerHTML = rightValue + '&nbsp;см<sup>3</sup>';
		}
	}
function setEnginePower(leftValue, rightValue)	
	{
	if(((rightValue >= enginePowerLimit) && (leftValue == 0)) || (rightValue == 0) || (leftValue >= enginePowerLimit)) 
		{
		document.getElementById('enginePowerStart').value = 0;		
		document.getElementById('enginePowerEnd').value = 0;		

		document.getElementById('epReset').style.display = 'none';
		document.getElementById('epAll').style.display = 'none';						
		document.getElementById('epOne').innerHTML = ' <span style="font-weight: bold;">любая</span>';
		document.getElementById('epToTxt').innerHTML = '';
		document.getElementById('epFromTxt').innerHTML = '';
		}
	else if((rightValue >= enginePowerLimit)&&(leftValue != rightValue)) 
		{
		document.getElementById('enginePowerStart').value = leftValue;		
		document.getElementById('enginePowerEnd').value = 0;		

		document.getElementById('epReset').style.display = '';
		document.getElementById('epDelim').style.display = 'none';						
		document.getElementById('epStart').style.display = '';						
		document.getElementById('epAll').style.display = '';						
		document.getElementById('epOne').innerHTML = '';
		document.getElementById('epFromTxt').innerHTML = leftValue + '&nbsp;л.с.';
		document.getElementById('epToTxt').innerHTML = '';		
		}
	else if((leftValue == 0))
		{
		document.getElementById('enginePowerStart').value = 0;		
		document.getElementById('enginePowerEnd').value = rightValue;		

		document.getElementById('epReset').style.display = '';
		document.getElementById('epDelim').style.display = '';						
		document.getElementById('epStart').style.display = 'none';						
		document.getElementById('epAll').style.display = '';						
		document.getElementById('epOne').innerHTML = '';
		document.getElementById('epToTxt').innerHTML = rightValue + '&nbsp;л.с.';
		document.getElementById('epFromTxt').innerHTML = '';
		}
	else if(rightValue == leftValue)
		{
		document.getElementById('enginePowerStart').value = leftValue;
		document.getElementById('enginePowerEnd').value = rightValue;		

//		var str = ' ';
		document.getElementById('epReset').style.display = '';
		var str = '<span style="font-weight: bold;">' + leftValue + '&nbsp;л.с.';
		document.getElementById('epAll').style.display = 'none';						
		document.getElementById('epOne').innerHTML = str;
		document.getElementById('epFromTxt').innerHTML = '';
		document.getElementById('epToTxt').innerHTML = '';
		}
	else
		{
		
		document.getElementById('enginePowerStart').value = leftValue;
		document.getElementById('enginePowerEnd').value = rightValue;		

		document.getElementById('epReset').style.display = '';
		document.getElementById('epDelim').style.display = '';						
		document.getElementById('epStart').style.display = '';						
		document.getElementById('epAll').style.display = '';						
		document.getElementById('epOne').innerHTML = '';
		document.getElementById('epFromTxt').innerHTML = leftValue + '&nbsp;л.с.';
		document.getElementById('epToTxt').innerHTML = rightValue + '&nbsp;л.с.';
		}
	}