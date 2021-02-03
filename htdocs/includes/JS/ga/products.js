/**********************used*********************/
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
	$(contaner).fadeOut("fast", function(){
		contaner.innerHTML = str;
		} );
	$(contaner).fadeIn("fast", function()
		{
		if(autoSelect!=0)
			itemSelectAuto();
		});		
	hideWaitBox();
	}
function hideWaitBox()
	{
	var wb = document.getElementById('waitBox');	
	$(wb).fadeOut("fast");
	}
/**********************PROPERTIES*********************/	

function addProp()
	{
	var nodeName = document.getElementById('IDcurNode');	
//	alert(nodeName.value);	
	if(nodeName.value.length>1)
		{
		var node = GetStrPrt(nodeName.value, '_', 1);
		}
	else
		var node = 0;
	var nodeObj = document.getElementById(nodeName.value);
	var name = document.getElementById('NAMEADD').value;
	var type = document.getElementById('TYPEADD').value;
	var unit = document.getElementById('UNITADD').value;
	var contaner = document.getElementById('tree');
	var actionRenew = location + "propTree/";		

	var action =  document.getElementById('actionAddProp').value;
	setFuncStart(contaner);
	$.post(action, {node:node, name:name, type:type, unit:unit}, function(str) 
		{	
		if((str == 0))
			{
			$.post(actionRenew, {openGrp:0}, function(str1) 
				{
				$(contaner).fadeOut("fast");
				contaner.innerHTML = str1;
				$(contaner).fadeIn("fast", function(){
					if(node>0)
						{
						hideWaitBox();			
						itemSelectProperties(nodeObj);	
						}
					else
						{
						var actionRenew2 = location + "propOptionsDinamic/";		
						var option = document.getElementById('optionBody');
						$.post(actionRenew2, {tmp:0}, function(str2)
							{
							$(option).fadeOut("fast");
							option.innerHTML = str2;
							$(option).fadeIn("fast", function(){hideWaitBox();});
							});
						}
					});					
				});
			}
		else
			{
			hideWaitBox();
			alert(str);			
			}
		});					
	}
function itemOrder(node, dir, tableId, parent)
	{
	var contaner = document.getElementById('table_' + tableId);
	var actionRenew = location + "propTable/" + parent;		
	var action =  document.getElementById('IDcurUrl').value + 'set/orderPropInGroup';
	$(contaner).animate( { opacity: 0.2 }, 10 , function() { } );
	$.post(action, {node:node, dir:dir, parent:parent}, function(str) 
		{	
		if((str == 0))
			{
			$.post(actionRenew, {tableId:tableId}, function(str1) 
				{
				contaner.innerHTML = str1;
				$(contaner).animate( { opacity: 1.0 }, 500 );								
				hideWaitBox();
				});
			}
		else
			{
			alert(str);			
			}
		});					
	}
function deleteProp()
	{
	var nodeName = document.getElementById('IDcurNode');	
	var node = GetStrPrt(nodeName.value, '_', 1);
	var nodeObj = document.getElementById(nodeName.value);
	var contaner = document.getElementById('tree');
	var actionRenew = location + "propTree/";		
//	alert(nodePref + parent);
	var action =  document.getElementById('actionDeleteObj').value;
	setFuncStart(contaner);
	$.post(action, {node:node}, function(str) 
		{	
		if((str == 0))
			{
			$.post(actionRenew, {openGrp:0}, function(str1) 
				{
				nodeName.value = 1;
				$(contaner).fadeOut("fast");
				contaner.innerHTML = str1;
				$(contaner).fadeIn("fast", function(){
					var option = document.getElementById('optionBody');
					var actionRenew2 = location + "propOptionsDinamic/";		
					$.post(actionRenew2, {tmp:0}, function(str2)
						{
						$(option).fadeOut("fast");
						option.innerHTML = str2;
						$(option).fadeIn("fast", function(){hideWaitBox();});
						});
				});					
				
				});
			}
		else
			{
			hideWaitBox();
			alert(str);			
			}
		});					
	}
function removeProp()
	{
	var nodeName = document.getElementById('IDcurNode');	
	var node = GetStrPrt(nodeName.value, '_', 1);
	var nodeObj = document.getElementById(nodeName.value);
	var nameNew = document.getElementById('GROUP').value;
	var nameOld = document.getElementById('CMP_GROUP').value;
	var clone = (document.getElementById('CLONE').checked)?1:0;
	var contaner = document.getElementById('tree');
	var actionRenew = location + "propTree/";		
//	alert(nodePref + parent);
	var action =  document.getElementById('actionProperGroup').value;
	setFuncStart(contaner);
	$.post(action, {node:node, nameNew:nameNew, nameOld:nameOld, clone:clone}, function(str) 
		{	
		if((str == 0))
			{
			$.post(actionRenew, {openGrp:nameNew}, function(str1) 
				{
				$(contaner).fadeOut("fast");
				contaner.innerHTML = str1;
				hideWaitBox();			
				$(contaner).fadeIn("fast", function(){});					
				itemSelectProperties(nodeObj);	
				});
			}
		else
			{
			hideWaitBox();
			alert(str);			
			}
		});					
	}
function changeTypeProp()
	{
	var nodeName = document.getElementById('IDcurNode');	
	var node = GetStrPrt(nodeName.value, '_', 1);
	var nodeObj = document.getElementById(nodeName.value);
	var nameNew = document.getElementById('TYPE').value;
	var nameOld = document.getElementById('CMP_TYPE').value;
	var contaner = document.getElementById('link_' + node);
//	alert(nodePref + parent);
	var action =  document.getElementById('actionPropertiesType').value;
	setFuncStart(contaner);
	$.post(action, {node:node, nameNew:nameNew, nameOld:nameOld}, function(str) 
		{	
		if((str == 0) || (str == 1))
			{
			hideWaitBox();			
			itemSelectProperties(nodeObj);	
			if(str == 1)
				{
				var nodeIcon = document.getElementById('nodeIcon_' + node);
				nodeIcon.src = '/src/design/tree/' + 'folder.gif';
				}
			}
		else
			{
			hideWaitBox();
			alert(str);			
			}
		});					
	}
function renamePropertiesUnit()
	{
	var nodeName = document.getElementById('IDcurNode');	
	var node = GetStrPrt(nodeName.value, '_', 1);
	var nodeObj = document.getElementById(nodeName.value);
	var nameNew = document.getElementById('RENAMEUNIT').value;
	var nameOld = document.getElementById('CMP_UNIT').value;
	var contaner = document.getElementById('link_' + node);
//	alert(nodePref + parent);
	var action =  document.getElementById('actionProductRenameUnit').value;
	setFuncStart(contaner);
	$.post(action, {node:node, nameNew:nameNew, nameOld:nameOld}, function(str) 
		{	
		if(str == 0)
			{
			hideWaitBox();			
			itemSelectProperties(nodeObj);	
			}
		else
			{
			hideWaitBox();
			alert(str);			
			}
		});					
	}
function renameProp()
	{
	var nodeName = document.getElementById('IDcurNode');	
	var node = GetStrPrt(nodeName.value, '_', 1);
	var nodeObj = document.getElementById(nodeName.value);
	var nameNew = document.getElementById('RENAME').value;
	var nameOld = document.getElementById('CMP_NAME').value;
	var contaner = document.getElementById('text_' + node);
//	alert(nodePref + parent);
	var action =  document.getElementById('actionPropertiesRename').value;
	setFuncStart(contaner);
	$.post(action, {node:node, nameNew:nameNew, nameOld:nameOld}, function(str) 
		{	
		if(str == 0)
			{
			$(contaner).fadeOut("fast");
			contaner.innerHTML = nameNew;
			hideWaitBox();			
			$(contaner).fadeIn("fast", function(){itemSelectProperties(nodeObj);});	
			}
		else
			{
			hideWaitBox();
			alert(str);			
			}
		});					
	}
function itemSelectProperties(item)
	{	
	curItem = 0;
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
	var action =  location + "showSelectedItemProperties/";		
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
/**********************PRODUCTS*********************/	

function propValueList()
	{
	var nodeName = document.getElementById('IDcurNode');	
	var nodeObj = document.getElementById(nodeName.value);
	var node = GetStrPrt(nodeName.value, '_', 1);
	var action =  document.getElementById('actionValueList').value + node;// + parId;
	return GB_showFullScreen('Конфигурация товара/услуги', action, function(){/* itemSelect(nodeObj); */});
	}
function propList()
	{
	var nodeName = document.getElementById('IDcurNode');	
	var nodeObj = document.getElementById(nodeName.value);
	var node = GetStrPrt(nodeName.value, '_', 1);
	var action =  document.getElementById('actionPropList').value + node;// + parId;
	return GB_showFullScreen('Назначенные свойства', action, function(){/* itemSelect(nodeObj); */});
	}
function infoObj()
	{
	var nodeName = document.getElementById('IDcurNode');	
	var nodeObj = document.getElementById(nodeName.value);
	var node = GetStrPrt(nodeName.value, '_', 1);
	var action =  document.getElementById('actionInfoObj').value + node;// + parId;
	return GB_showFullScreen('Описание товара', action, function(){ /*itemSelect(nodeObj);*/ });
	}
function visibleObj(status)
	{
	var nodeName = document.getElementById('IDcurNode');	
	var node = GetStrPrt(nodeName.value, '_', 1);
	var nodeObj = document.getElementById(nodeName.value);
	var contaner = document.getElementById('text_' + node);
	var nodeSwitch = document.getElementById('img_' + node);
	if(document.getElementById('VISIBLE_INHERIT'))
		{
		var inherit = (document.getElementById('VISIBLE_INHERIT').checked) ? 1 : 0;
		}
	else
		{
		inherit = 0;
		}
//	alert(inherit);
	var action =  document.getElementById('actionVisibleObj').value;
	var newStatus = (status!=0) ? 0 : 1;
	setFuncStart(contaner);
	$.post(action, {node:node, status:newStatus, inherit:inherit}, function(str) 
		{	
		if(str == 0)
			{
			$(contaner).fadeOut("fast");
			contaner.style.color = (newStatus==0) ? '#000000' : '#aaaaaa';
			if((inherit) && (GetLastEl(nodeSwitch.src, '/')== 'treeMinus.gif'))
				{
				var contanerExp = document.getElementById('node_' + node);
				var actionRenew = location + "expand/";		
				$.post(actionRenew, {node:node}, function(str1) 
					{
						$(contanerExp).fadeOut("fast");
						contanerExp.innerHTML = str1;
						$(contanerExp).fadeIn("fast", function(){});	
					});								
				}
			hideWaitBox();			
			$(contaner).fadeIn("fast", function(){itemSelect(nodeObj);});	
			}
		else
			{
			hideWaitBox();
			alert(str);			
			}
		});					
	}
function renameProduct()
	{
	var nodeName = document.getElementById('IDcurNode');	
	var node = GetStrPrt(nodeName.value, '_', 1);
	var nodeObj = document.getElementById(nodeName.value);
	var nameNew = document.getElementById('RENAME').value;
	var nameOld = document.getElementById('CMP_NAME').value;
	var contaner = document.getElementById('text_' + node);
//	alert(nodePref + parent);
	var action =  document.getElementById('actionProductRename').value;
	setFuncStart(contaner);
	$.post(action, {node:node, nameNew:nameNew, nameOld:nameOld}, function(str) 
		{	
		if(str == 0)
			{
			$(contaner).fadeOut("fast");
			contaner.innerHTML = nameNew;
			hideWaitBox();			
			$(contaner).fadeIn("fast", function(){itemSelect(nodeObj);});	
			}
		else
			{
			hideWaitBox();
			alert(str);			
			}
		});					
	}
function deleteObj()
	{
	var nodeName = document.getElementById('IDcurNode');	
	var nodePref = GetStrPrt(nodeName.value, '_', 0);
	var node = GetStrPrt(nodeName.value, '_', 1);
	var nodeObj = document.getElementById(nodeName.value);
	var nodeParent = document.getElementById(nodeObj.parentNode.id);
	var parent = GetStrPrt(nodeParent.id, '_', 1);
	var contaner = (parent>0) ? document.getElementById('node_' + parent) : document.getElementById('tree');
//	alert(nodePref + parent);
	var action =  document.getElementById('actionDeleteObj').value;
	setFuncStart(contaner);
	$.post(action, {node:node}, function(str) 
		{	
		if(str == 0)
			{
			var actionRenew = (parent>0) ? location + "expand/" : location + "show1Lvl/";		
			$.post(actionRenew, {node:parent}, function(str1) 
				{
				$(contaner).fadeOut("fast");
				contaner.innerHTML = str1;
				hideWaitBox();			
				$(contaner).fadeIn("fast", function(){
					itemSelect(document.getElementById(nodePref + '_' + parent));
					});	
				nodeName.value = nodePref + '_parent';				
				});
			
			}
		else
			{
			hideWaitBox();
			alert(str);			
			}
		});					
	}
function createProduct()
	{
	var node = GetStrPrt(document.getElementById('IDcurNode').value, '_', 1);
	var name = document.getElementById('NAME').value;
	var action =  document.getElementById('actionProductAdd').value;
	var contaner = (node>0) ? document.getElementById('node_' + node) : document.getElementById('tree');
	var nodeSwitch = document.getElementById('img_' + node);
	var nodeIcon = document.getElementById('nodeIcon_' + node);
//	var imageName = GetLastEl(nodeIcon.src, '/');
	setFuncStart(contaner);
	$.post(action, {nodeParent:node, name:name}, function(str) 
		{	
		if(str == 0)
			{
			var actionRenew = (node>0) ? location + "expand/" : location + "show1Lvl/";		
			$.post(actionRenew, {node:node}, function(str1) 
				{
					$(contaner).fadeOut("fast");
					contaner.innerHTML = str1;
					hideWaitBox();			
					$(contaner).fadeIn("fast", function(){});	
					if(GetLastEl(nodeSwitch.src, '/') ==  'treePlus.gif')
						{
						nodeSwitch.src = '/src/design/tree/' + 'treeMinus.gif';
						}
					if(GetLastEl(nodeIcon.src, '/') ==  'page.gif')
						{
						nodeIcon.src = '/src/design/tree/' + 'folder.gif';
						nodeSwitch.src = '/src/design/tree/' + 'treeMinus.gif';
						}
				});
			}
		else
			{
			hideWaitBox();
			alert(str);			
			}
		});					
	}
function itemSelect(item)
	{	
	curItem = 0;
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
function nodeExpand(img) 
	{
//	alert(img.id);	
	var strArr = img.id.split('_');
	var nodeId = strArr[1];
	var hiddenDiv = document.getElementById('node_' + nodeId);
	var imageName = GetLastEl(img.src, '/');
	var d, new_src,  s = '/src/design/tree/';	
	setFuncStart(document.getElementById('tree'));
	if(imageName ==  'treePlus.gif')
		{
		var action =  location + "expand/";		
		new_src = 'treeMinus.gif';					
		$.post(action, {node:nodeId}, function(str) 
			{
			hiddenDiv.innerHTML = str;
			hideWaitBox();			
			$(hiddenDiv).fadeIn("fast", function()
				{
				img.src = s+ new_src;		
				});	
			});
		}
	else
		{
		new_src = 'treePlus.gif';
		$(hiddenDiv).fadeOut("fast", function()
			{
			img.src = s+ new_src;		
			hiddenDiv.innerHTML = '';			
			hideWaitBox();
			});	
		}
	}

/**********************old*********************/	
