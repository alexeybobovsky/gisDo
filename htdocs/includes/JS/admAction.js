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
function clearPav(object, contaner)
	{
	if (confirm('Очистить содержимое павильона?'))
		{
		var pavId = GetStrPrt(object.id, '_', 1);
		var marketId = document.getElementById('market').value;
		document.location = '/market/set/clear/' + marketId + '/' + pavId;
		}
	else
		return 0;
	}	
function addInfoOnPav(object)
	{
//	alert(market);
	showBox(object, '/market/newPav/'+market+'/'+object, 'ser');
	}
function getFirmObjects(contaner, firmId, marketId, type)
	{	
	$.post('/spddl/', {type:'objOfFirmForMrkt', firmId:firmId, opType:type, 	marketId:marketId}, function(str) 
		{
		contaner.innerHTML = str;
		if(type=='new')
			{
			if(str.indexOf('<!--noOffice-->')>=0)
				{
				switchStateControlsAddOfficeToFirm();
				document.getElementById('newFirm').checked=true;
				}				
			}
		});			
	
	}
	
function switchStateControlsAddOfficeToFirm()
	{
	document.getElementById('firmName').value = document.getElementById('ac_name').value;
	document.getElementById('firmName').disabled = true;
	document.getElementById('phone').disabled = '';
	document.getElementById('ac_name').disabled = true;
	}
function switchStateControlsNewFirm(state)
	{
	document.getElementById('firmName').disabled = (state) ? '' : true;
	document.getElementById('phone').disabled = (state) ? '' : true;
	}
function switchStateControlsRealFirm(state)
	{
	document.getElementById('ac_name').disabled = (state) ? '' : true;
	}
function GetStrPrt(str, del, indx)
	{
	strArr1 = str.split(del);
	var ret = strArr1[indx];
//	alert(strArr1[0]);
	return ret;
	}
function addInfoOnPav_(object)
	{
//	alert(market);
	showBox(getFirmObjectsobject, '/market/newPav/'+market+'/'+object, 'ser');
	}
/************************************************************GB Manipulations 2011**************************************************************************/	
function showBox(object, action, contaner)
	{
	if (object.id)
		{
		var node = GetStrPrt(object.id, '_', 1);
		var info = object.title;
		action = action+'/'+node;
		}
	else
		{		
		var info = 'Редактор параметров';
		}
	return GB_showFullScreen(info, action, function(){ boxOnClose(''); });	
	}
function setFuncStart(object)
	{
//	object.disabled = true;
	object.style.border = '0px';
	object.value = '...загрузка....';
	}	
function setFuncEnd(contaner, str)
	{
//	alert(str);
	$(contaner).fadeOut("fast", function(){
		contaner.innerHTML = str;
		} );
	$(contaner).fadeIn("fast", function(){});
	}
function boxOnClose(contaner)
	{
//	alert(str);
	if(contaner!='')
		{
		var node = document.getElementById('curNode').value;
		var action =  document.getElementById('actionInfoBoxRenew').value;
		setFuncStart(contaner)
		$.post(action, {node:node}, function(str) 
			{
			setFuncEnd(contaner, str)
			});			
		}
	}