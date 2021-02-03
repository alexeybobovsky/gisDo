function setFuncStart(contaner)
	{
	var wb = document.getElementById('waitBox');	
	if(contaner)
		MoveElementInCenterOfAnother(wb, contaner);
	else
		MoveElementInCenterOfScreen(wb);
	$(wb).fadeIn("fast");			
	}	
function setFuncEnd(contaner, str, autoSelect)
	{
//	alert(str);
	$(contaner).fadeOut("fast", function(){
		contaner.innerHTML = str;
		} );
	$(contaner).fadeIn("fast", function()
		{
		if(autoSelect!=0)
			itemSelectAuto();
		$(document).ready(function(){
		$("table#order").tableSorter({
			sortClassAsc: 'sortUp', // class name for asc sorting action
			sortClassDesc: 'sortDown', // class name for desc sorting action
			highlightClass: 'highlight', // class name for sort column highlighting.
										//alternateRowClass: ['odd','even'],
			headerClass: 'largeHeaders', // class name for headers (th's)
			dateFormat: 'yyyy-mm-dd' // set date format for non iso dates default us, in this case override and set uk-format
		});
		});						
		});
		
/*	var wb = document.getElementById('waitBox');	
	$(wb).fadeOut("fast");*/
	hideWaitBox()
	}
function hideWaitBox()
	{
	var wb = document.getElementById('waitBox');	
	$(wb).fadeOut("fast");
	}
function itemSelectAuto() /*12_04_07*/
	{
/*	if(document.getElementById('item_' + parent_id))
		var container = document.getElementById('item_' + parent_id);*/
	if (document.getElementById('IDcurNode'))
		var mem = document.getElementById('IDcurNode');
	var parent_id = GetStrPrt(mem.value, '_', 1);
	highlightObject('link_' + parent_id, 1); 
//	alert(parent_id);
//	mem.value = container.id;
	var location =  document.getElementById('IDcurUrl').value;
	var action =  location + "showSelectedItem/";	
	var container = document.getElementById('optionBody');
	if((parent_id>=0))
		{
		setFuncStart('')
		$.post(action, {node:parent_id}, function(str) 
			{		
			setFuncEnd(container, str, 0);			
			}
		);
		}
	}
function itemSelect(item)
	{	
	curItem = 0;
	var location =  document.getElementById('IDcurUrl').value;
	var parent_id = GetStrPrt(item.id, '_', 1);
	if (document.getElementById('IDcurNode'))
		var mem = document.getElementById('IDcurNode');
	var lastItem = mem.value;
	if(lastItem != '')
		{
		highlightObject(lastItem, 0); 
		}	
	highlightObject(item.id, 1); 
	mem.value = item.id;
	var container = document.getElementById('optionBody');
	var action =  location + "showSelectedItem/";		
//	alert(action);
	if((parent_id>=0))
		{
		setFuncStart('');
		$.post(action, {node:parent_id}, function(str) 
			{		
//			alert(str);
			setFuncEnd(container, str, 0);
			}
		);
		}
	}	

	
function editCurObj()
	{
	/*
	var action =  document.getElementById('actionEditObj').value;
	var id = GetStrPrt(document.getElementById('IDcurNode').value, '_', 1);
	alert(id);*/
	var parId = GetStrPrt(document.getElementById('IDcurNode').value, '_', 1);
	var action =  document.getElementById('actionEditObj').value + parId;
	return GB_showFullScreen('Редактирование новости', action, function(){ renewTree(1); });	
	/*
	var name = document.getElementById('NAME');
	$.post(action, {node:id, name:name.value}, function(str) 
		{	
		if(str == '1')
			{
			renewTree(1);
			}
		});	*/				
	
	}
function renewTree(autoSelect)
	{
	var location =  document.getElementById('IDcurUrl').value;
	var action =  location + "list/";
	var contaner = document.getElementById('tree');
	setFuncStart(contaner);
	$.post(action, {}, function(str) 
		{	
		if(str)
			{
			setFuncEnd(contaner, str, (autoSelect!=0) ? 1 : 0 );
//			alert(str);
			}
//			contaner.innerHTML = str;*/
		});					
	}
function createCategory(obj)
	{
//	var parId = GetStrPrt(document.getElementById('IDcurNode').value, '_', 1);
	var action =  document.getElementById('actionCreateCategory').value;// + parId;
	var name = document.getElementById('NAME');
	var submitBtn = document.getElementById('SUBMITADDCAT');	
	$.post(action, {name:name.value}, function(str) 
			{	
//			alert(str);
			if(str == 0) /*good*/
				{
				alert('Категория <' +name.value + '> успешно добавлена');
				name.value = '';
				submitBtn.disabled=true;
				}
			else  /*other errors*/
				{
				alert('Возникла ошибка при добавлении категории <' +name.value + '>. ' + str + ' Попробуйте повторить операцию снова');
				}
	//			contaner.innerHTML = str;*/
			});		
	}
function createNews(obj)
	{
	var action =  document.getElementById('actionNewsAdd').value;// + parId;
	return GB_showFullScreen('Создание новости', action, function(){ renewTree(1); });
	}

function deleteObj()
	{
	var nodeObj = document.getElementById('IDcurNode');
	var nodePref = GetStrPrt(nodeObj.value, '_', 0);
	var node = GetStrPrt(nodeObj.value, '_', 1);
	var action =  document.getElementById('actionDeleteObj').value;
	$.post(action, {node:node}, function(str) 
		{	
		if(str == 1)
			{
			nodeObj.value = nodePref + '_0';
			renewTree(1);		
			}
		else
			alert(str);
			
//			contaner.innerHTML = str;*/
		});					
	}
function visibleObj(status)
	{
	var node = GetStrPrt(document.getElementById('IDcurNode').value, '_', 1);
	var action =  document.getElementById('actionVisibleObj').value;
	$.post(action, {node:node, status:status}, function(str) 
		{	
		if(str == 1)
			{
			renewTree(1);		
			}
		else
			alert(str);
//			contaner.innerHTML = str;*/
		});					
	}
function ajaxFileUpload(fileName)
	{
	var node = 		GetStrPrt(document.getElementById('IDcurNode').value, '_', 1);
	var action =  	document.getElementById('actionNewImg').value + fileName + '/' + node;
//		alert(action);
		//starting setting some animation when the ajax starts and completes
		$("#waitBox")
			.ajaxStart(function(){  $(this).fadeIn("fast");})
			.ajaxComplete(function(){  $(this).fadeOut("fast");});
		$.ajaxFileUpload
		(
			{
			url:action, 
			secureuri:false,
//				fileElementId:'fileToUpload',
			fileElementId:fileName,
			dataType: 'json',
//				dataType: 'script',
			success: function (data, status)
				{
//				alert(data);
				renewTree(1);						
				},
			error: function (data, status, e)
				{
//				alert(data);
				renewTree(1);	
				}
			}
		)
		
		return false;

	}  	
function deleteImg()
	{
	var node = GetStrPrt(document.getElementById('IDcurNode').value, '_', 1);
	var action =  document.getElementById('actionDeleteImg').value;
	$.post(action, {node:node}, function(str) 
		{	
		if(str == 1)
			{
			renewTree(1);		
			}
		else
			alert(str);
//			contaner.innerHTML = str;*/
		});					
	}
	