var loadImg = new Image(); 
	loadImg.src = '/src/design/main/blueBars.gif';
var emptyImg = new Image(); 
	emptyImg.src = '/src/design/main/_.gif';
/**********************************************AVTO ****************************************************/
function clickBodyType(obj)
	{
	if (obj.className == 'link')
		{
		var spanCol = document.getElementsByTagName('span');		
		var curBtnIndex = GetStrPrt(obj.id, '_', 1);
		for (var k = 0; k < spanCol.length; k++)
			{
			if(spanCol[k].id.indexOf('bodyTtypeBtn') >= 0)
				spanCol[k].className = 'link';			
			}
		obj.className = 'selectedCat';
		
		var bodyType = obj.innerHTML;
		
//		alert(bodyModel[1]);
		var allTypeShow = (curBtnIndex > 0)?false:true;
		for (var m = 0; m < bodyModel.length; m++)
			{
			if(!allTypeShow)
				{
				if(bodyModel[m].indexOf(bodyType) < 0)
					document.getElementById('modelGrp_' + m).style.display = "none";
				else
					document.getElementById('modelGrp_' + m).style.display = "";				
				}
			else
				document.getElementById('modelGrp_' + m).style.display = "";								
			}
		for (var i = 0; i < bodyCard.length; i++)
			{
			if(!allTypeShow)
				{
				if(bodyCard[i].indexOf(bodyType) < 0)
					document.getElementById('card_' + i).style.display = "none";
				else
					document.getElementById('card_' + i).style.display = "";				
				}
			else
				document.getElementById('card_' + i).style.display = "";												
			}
		
		}
	
	}
/**********************************************END AVTO ***********************************************/
/**********************************************cmp_2012 ****************************************************/
function cmpRenewList(result, contaner, cmpLink, strArr)
	{
	result.innerHTML = strArr[1];
	contaner.innerHTML = strArr[2];
	cmpLink.style.display = (strArr[3]>1) ? '' : 'none';
	}
function cmpRemoveElement(obj)
	{
	var code = 	GetStrPrt(obj.id, '_', 1);
	var img = document.getElementById('cmpImgWait');
	var result = document.getElementById('notepadCnt');
	var contaner = document.getElementById('cmpListContaner');
	var cmpLink = document.getElementById('cmpLink');
	img.src = loadImg.src;		
	$(contaner).animate( { opacity: 0.2 }, 10 , function() { } );
	$.post("/avto/compare/clickEl", {code:code}, function(str) 
		{	
		var strArr = str.split('~');
		cmpRenewList(result, contaner, cmpLink, strArr);
		$(contaner).animate( { opacity: 1.0 }, 500 );
		img.src = emptyImg.src;
		});
	}
function cmpElementClick(obj)
	{
	var code = 	GetStrPrt(obj.id, '_', 1);
	var img = document.getElementById('cmpImgRes_' + code);
	var result = document.getElementById('notepadCnt');
	var contaner = document.getElementById('cmpListContaner');
	var cmpLink = document.getElementById('cmpLink');
	$(contaner).animate( { opacity: 0.2 }, 10 , function() { } );
	img.src = loadImg.src;		
	obj.innerHTML = '';
	$.post("/avto/compare/clickEl", {code:code}, function(str) 
		{	
		var strArr = str.split('~');
		obj.innerHTML = (strArr[0]>1)? 'добавить к сравнению' : 'убрать из сравнени€';
		cmpRenewList(result, contaner, cmpLink, strArr);
		$(contaner).animate( { opacity: 1.0 }, 500 );
		img.src = emptyImg.src;
		});
	}
/**********************************************notes ****************************************************/
function compareRows(type)
	{
	var action =  '/products/compare';
	var code;
	var inpCol = document.getElementsByTagName('input');	
	for (var i = 0; i < inpCol.length; i++)
		{
		if((inpCol[i].id.indexOf(type+'_') >= 0)&&(inpCol[i].type == 'checkbox'))
			{
			if(inpCol[i].checked == true)
				{
				code = GetStrPrt(inpCol[i].id, '_', 1);
				$.post("/user/setAJAX/cmpProduct", {code:code}); 
				}
			}
		}
	return GB_showFullScreen('—равнение товаров', action , function(){ $.post("/user/setAJAX/clearCmpProduct", {action:'1'}); });	
	}
function deleteAll(type)
	{
	var inpCol = document.getElementsByTagName('input');		
	var cnt = 0;
	for (var i = 0; i < inpCol.length; i++)
		{		
		if((inpCol[i].id.indexOf('cnt_') >= 0)&&(inpCol[i].type == 'hidden'))
			{
			cnt ++;
			}
		}
	if(cnt>1)		
		document.getElementById('notesContaner_' + eval(type)).innerHTML = '';
	else
		{
		document.getElementById('notesCont').className = 'firmlist';
		document.getElementById('notesCont').innerHTML = '«аписей не найдено';
		}
	}
function deleteRows(type)
	{
//	var cnt = 0;
	type = eval(type);
	var code;
	var elementName = new Array();
	var cnt = 0;
	var cntFull = 0;
	var inpCol = document.getElementsByTagName('input');	
	var result = document.getElementById('notepadCnt');
	var elementStr = '';
//	alert (inpCol.length);
	for (var i = 0; i < inpCol.length; i++)
		{
//		alert(inpCol[i].id + '   :    ' + inpCol[i].id.indexOf(type+'_'));
		if((inpCol[i].id.indexOf(type+'_') >= 0)&&(inpCol[i].type == 'checkbox'))
			{
			cntFull ++;
			if(inpCol[i].checked == true)
				{
				code = GetStrPrt(inpCol[i].id, '_', 1);
				elementName[cnt] = code;
				elementStr += code + '_';
				cnt ++;
				}
			}
		}
//	alert  ()	
	$.post("/user/setAJAX/deleteProduct", {code:elementStr}, function(str) 
		{
		result.innerHTML = str;
		if(cnt==cntFull)
			deleteAll(type);
		else 
			{
			for (var i = 0; i < elementName.length; i++)
				{
				document.getElementById('row_' + elementName[i]).className = '';
				document.getElementById('row_' + elementName[i]).innerHTML = '';
				}
			document.getElementById('cnt_' + type).value = 0;
			checkActionBtn(type);
			}
		});
	}
function checkActionBtn(type)
	{
//	var cnt = 0;
	var cntMessObj = document.getElementById('cnt_' + type);
//	alert(cntMessObj.value);
	if(cntMessObj.value > 1 )
		{		
		document.getElementById(type + '_delete').style.display = '';
		document.getElementById(type + '_compare').style.display = '';
		}
	else if(cntMessObj.value > 0 )
		{		
		document.getElementById(type + '_delete').style.display = '';
		document.getElementById(type + '_compare').style.display = 'none';
		}
	else
		{
		document.getElementById(type + '_delete').style.display = 'none';		
		document.getElementById(type + '_compare').style.display = 'none';
		}
	}

function unCheckAll(type)
	{
//	var cnt = 0;
	var inpCol = document.getElementsByTagName('input');		
	for (var i = 0; i < inpCol.length; i++)
		{		
		if((inpCol[i].id.indexOf(type+'_') >= 0)&&(inpCol[i].type == 'checkbox'))
			{
			inpCol[i].checked = false;
//			cnt ++;
			}
		}
	document.getElementById('cnt_' + type).value = 0;
	checkActionBtn(type);
//	checkActionBtn();
	}
function checkAll(type)
	{
	var cnt = 0;
	var inpCol = document.getElementsByTagName('input');		
	for (var i = 0; i < inpCol.length; i++)
		{		
		if((inpCol[i].id.indexOf(type+'_') >= 0)&&(inpCol[i].type == 'checkbox'))
			{
			inpCol[i].checked = true;
			cnt ++;
			}
		}
	document.getElementById('cnt_' + type).value = cnt;
	checkActionBtn(type);
//	checkActionBtn();
	}
function checkClicked(obj)
	{
	var cnt = 0;
	var type = 	GetStrPrt(obj.id, '_', 0);
	var cntMessObj = document.getElementById('cnt_' + type);
	if(obj.checked)
		{
		cntMessObj.value ++;
		}
	else
		{
		cntMessObj.value --;
		}
	checkActionBtn(type);
//	alert(cntMessObj.value);
	}
function addProductToNotes(item)
	{
/*	if (item.className == 'imgInactive')
		{*/
	var code = 	GetStrPrt(item.id, '_', 1);
//		alert(item.id);	
	var img = document.getElementById('imgWait_' + code);
	var result = document.getElementById('notepadCnt');
	img.src = loadImg.src;		
	item.innerHTML = '';
	$.post("/user/setAJAX/saveProduct", {code:code}, function(str) 
		{	
		result.innerHTML = str;
		img.src = emptyImg.src;
		});
	}	
/********************************************** END notes *************************************************/
function switchImgModels(item)
	{
	if (item.className == 'imgInactive')
		{
		var code = GetStrPrt(item.id, '_', 1);
		var img = document.getElementById('imgFull');
//		var resNew = document.getElementById('res_' + code);
		var resOld = document.getElementById('imgPrev_' + curItem);
/*		var titleNew = item;
		var titleOld = document.getElementById('title_' + resCur[model]);*/
		img.src = pic[code].src;
/*		resOld.style.display = "none";
		resNew.style.display = "";*/
		item.className = 'imgActive';
		resOld.className = 'imgInactive';
		curItem = code;
	//	alert(item.className);
		}
	}	
function switchSubModels(item, model)
	{
	if (item.className == 'subModelInactive')
		{
		var code = GetStrPrt(item.id, '_', 1);
		var img = document.getElementById('img_' + model);
		var resNew = document.getElementById('res_' + code);
		var resOld = document.getElementById('res_' + resCur[model]);
		var titleNew = item;
		var titleOld = document.getElementById('title_' + resCur[model]);
		img.src = pic[code].src;
		resOld.style.display = "none";
		resNew.style.display = "";
		titleOld.className = 'subModelInactive';
		titleNew.className = 'subModelActive';
		resCur[model] = code;
//	alert(item.className);
		}
	}	

