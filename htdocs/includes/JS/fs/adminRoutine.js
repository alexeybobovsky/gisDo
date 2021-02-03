function apMngSimpleAction(act, apIdStr)	
	{
	var messageConfirm, messageSucess;
	if(act == 'Update' )
		{
		messageConfirm = 'обновить';
		messageSucess = 'обновлён';
		}
	else if(act == 'Return')
		{
		messageConfirm = 'вернуть в продажу';
		messageSucess = 'вернут в продажу';
		}
	else if(act == 'Sold')
		{
		messageConfirm = 'снять с продаж';
		messageSucess = 'снят с продаж';
		}
	var url = '/apartment/set/simpleEdit'
	if(confirm('Точно ' + messageConfirm + '?'))
		{
		UI.pleaseWait();
		$.post(url, {action: act, apIdStr: apIdStr}, function(str)
			{
			UI.pleaseWait();
//			alert(str);
			if(str == 1) //всё отлично - изменено
				{
//				submitFilterAp();
				alert('Объект (объекты) успешно ' + messageSucess + '. Обновите карточку');
				}
			else if(str == 2) //ошибка
				{
				alert('Какая-то ошибка');
				}		
			});
		}
	
	
	}
function apSingleAction(obj)	
	{
/*	alert(obj.id);*/
	strArr = obj.id.split('_');
	var apId = strArr[2];
	var act = strArr[1];
	apMngSimpleAction(act, apId);
	}
function apMultyAction(obj)	
	{
//	alert(obj.id);
	var apId = '';
	var act = UI.GetStrPrt(obj.id, '_', 1);
	$('[id ^= apCheck_]').each(function (i) 
		{
		if($('#' + this.id).prop('checked'))
			apId += (apId == '') ? UI.GetStrPrt(this.id, '_', 2) : '~' + UI.GetStrPrt(this.id, '_', 2); 
		});
	apMngSimpleAction(act, apId);
//	alert( apId + ' - ' + act);
	}
function apToggleAllItems(obj, isProfile)	
	{
	if(isProfile === undefined)
		var isProfile = 0;	
	var apId, objId;
	if($("#" + obj.id).prop("checked"))	
		{
		
//		alert('checked');
		$('[id ^= apCheck_]').each(function (i) 
			{
			strArr = this.id.split('_');
			apId = strArr[2];
			objId = strArr[1];
			contId = (isProfile>0) ? 'listApItem_' + apId : 'listApItem_' + objId + '_' + apId;
			if(document.getElementById(contId).style.display !='none')
				$('#' + this.id).prop({checked: true});
			else
				$('#' + this.id).prop({checked: false});
//				$('#' + this.id).prop({checked: true});
				
			});
		$('#apAdmMultyActContaner').show();
		}
	else
		{
//		alert('unchecked');
		$('[id ^= apCheck_]').each(function (i) 
			{
			$('#' + this.id).prop({checked: false});
			});
		$('#apAdmMultyActContaner').hide();
		}	
//	alert(showProperties($("#" + obj.id).attr()))
	}
function apToggleSingleItem()	
	{
	var apCount = apCountSelected = 0;
	$('[id ^= apCheck_]').each(function (i) 
		{
		apCount ++;
		if($('#' + this.id).prop('checked'))
			apCountSelected ++;
		});	
	if(apCountSelected > 0)
		$('#apAdmMultyActContaner').show();
	else
		$('#apAdmMultyActContaner').hide();
	if((apCountSelected == apCount) && (apCount>0))
		$("#apEdit_All").prop({checked: true});
	else
		$("#apEdit_All").prop({checked: false});
		
//	alert(showProperties($("#" + obj.id).attr()))
	}
function mesToggle(obj)	
	{
	if(confirm('Изменить статус сообщения и всех ответов?'))
		{
		UI.pleaseWait();
		var messId = GetStrPrt(obj.id, '_', 1);
		var result = 0;
		$.post("/list/set", {type:'mesToggle', objId:messId}, function(str) 
			{
			UI.pleaseWait();
			if(str.length == 1)
				{
				result = str;
				objList = new Array();
				objList[0] = messId;
				}
			else
				{
				resultArr = str.split('#');
				result = resultArr[0];
				objList = resultArr[1].split('_');
				objList[objList.length] = messId;				
				}				
			if(result == 1) //всё отлично - сообщение скрыто
				{
				for(var i=0; i<objList.length; i++)
					{
					$('#mesageSinleContaner_' + objList[i]).removeClass('message');
					$('#mesageSinleContaner_' + objList[i]).addClass('messageHidden');					
					$('#mesState_' + objList[i]).text('отобразить');					
					}					
				}
			else if(result == 2) //всё отлично - сообщение отображается
				{
				for(var i=0; i<objList.length; i++)
					{
					$('#mesageSinleContaner_' + objList[i]).removeClass('messageHidden');
					$('#mesageSinleContaner_' + objList[i]).addClass('message');					
					$('#mesState_' + objList[i]).text('скрыть');					
					}					
				}
			else if(result == 3) //всё отлично - сообщение отображается
				{
				UI.showMessage('info', 'Какая-то ошибка.');				
				}			
			});
		}
	}
function mesDel(obj)	
	{
	if(confirm('Удалить сообщение и все ответы?'))
		{
		UI.pleaseWait();
		var messId = GetStrPrt(obj.id, '_', 1);
		var result = 0;
		$.post("/list/set", {type:'mesDelete', objId:messId}, function(str) 
			{
			UI.pleaseWait();
			if(str.length == 1)
				{
				result = str;
				objList = new Array();
				objList[0] = messId;
				}
			else
				{
				resultArr = str.split('#');
				result = resultArr[0];
				objList = resultArr[1].split('_');
				objList[objList.length] = messId;				
				}				
			if(result == 1) //всё отлично - сообщение удалено
				{
				for(var i=0; i<objList.length; i++)
					{
					$('#mesageSinleContaner_' + objList[i]).hide();
					}					
				}
			else if(result == 3) //error
				{
				UI.showMessage('info', 'Какая-то ошибка.');				
				}			
			});
		}
	}
	
	
function soldApFast(url, id, sold)
	{
	
	var messageConfirm;
	if(sold == 1 ) //продана
		{
		messageConfirm = 'вернуть в продажу';
		}
	else
		{
		messageConfirm = 'снять с продаж';
		}
	
	if(confirm('Точно ' + messageConfirm + '?'))
		{		
		UI.pleaseWait();
		$.post(url, {id: id, isSold: sold}, function(str)
			{
			UI.pleaseWait();
			window.location.href = window.location.href; 
			});
		}
	}
function soldAp(url)
	{
	var messageConfirm;
	if($('#apSold').val() == 1 ) //продана
		{
		messageConfirm = 'вернуть в продажу';
		}
	else
		{
		messageConfirm = 'снять с продаж';
		}
	
	if(confirm('Точно ' + messageConfirm + '?'))
		{
		UI.pleaseWait();
		$.post(url, {id: $('#apId').val(), isSold: $('#apSold').val()}, function(str)
			{
			UI.pleaseWait();
//			alert(str);
			if(str == 1) //всё отлично - изменено
				{
				alert('Объект успешно изменен. Обновите карточку');
				}
			else if(str == 2) //ошибка
				{
				alert('Какая-то ошибка');
				}		
			});
		}
	}
function showEdtBoxAp(obj)
	{
	var apId = (obj === undefined) ? $('#apId').val() : UI.GetStrPrt(obj.id, '_', 1);
	if($("input").is("#apeUrl"))
		{
		var info = 'Редактор объекта';
		var url = $("#apeUrl").val() + '' + apId;
		return GB_showFullScreen(info, url, function()
			{ 
			window.location.href = window.location.href; 
			});	
		}
	else
		{
		alert('Superpath not found!')
		}
	}
function showEdtBox(url, type)
	{
	var info = 'Редактор объекта';
	return GB_showFullScreen(info, url, function()
		{ 
//		alert(window.location.href);
		window.location.href = window.location.href; 
		});	
	}

function delObj(url)
	{	
	var curObjId = document.getElementById('objId').value;	
	if(confirm('Точно удалить объект?'))
		{
		UI.pleaseWait();
		$.post(url, {objId:$('#objId').val()}, function(str)
			{
			UI.pleaseWait();
//			alert(str);	
			if(str == 1) //всё отлично - удалено
				{
				UI.showMessage('info', 'Объект успешно удален. Обновите страницу');				
				}
			else if(str == 2) //ошибка
				{
				UI.showMessage('info', 'Какая-то ошибка.');				
				}
			else 			//последний объект
				{
				if(confirm('Внимание! Это последний объект в организации и его удаление удалит всю организацию. Вы уверенны?'))
					{
					UI.pleaseWait();
					$.post(url, {objId:$('#objId').val(), addParam:str}, function(str)
						{
						UI.pleaseWait();
						if(str == 1) //всё отлично - удалено
							{
							UI.showMessage('info', 'Организация успешно удалена ПОЛНОСТЬЮ. Обновите страницу');				
							}
						else if(str == 2) //ошибка
							{
							UI.showMessage('info', 'Какая-то ошибка с организвцией.');
							}
						});
					}
				}
			});
		}
	}