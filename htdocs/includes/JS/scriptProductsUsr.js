function showProperties(obj, objName) 
{
  var result = "The properties for the " + objName + " object:" + "\n";
  
  for (var i in obj) {result += i + " = " + obj[i] + "\n";}
  
  return result;
}
function AUUpdateStyles()
	{

	$(".chzn-select").chosen(); 
	if (document.all && !document.XMLHttpRequest) //   <=IE6  
		{}
	else		
		$('textarea#VAL_info').autoResize({
		    animateDuration : 500,
		    extraSpace : 20
			});
	$(".cb-enable").click(function(){
			var parent = $(this).parents('.switch');
			$('.cb-disable',parent).removeClass('selected');
			$(this).addClass('selected');
			$('.checkbox',parent).attr('checked', true);
		});
	$(".cb-disable").click(function(){
			var parent = $(this).parents('.switch');
			$('.cb-enable',parent).removeClass('selected');
			$(this).addClass('selected');
			$('.checkbox',parent).attr('checked', false);
		});
	$(".chzn-select").chosen(); 
	$(".chzn-select-deselect").chosen({allow_single_deselect:true});	
	if(document.getElementById('fileIcon'))
		{
		var uploader;
	 	uploader = new qq.FileUploader({
			element: document.getElementById('fileIcon'),
			action: '/usedavto/set/upload',
/*		onComplete: function(id, fileName, responseJSON){alert(fileName)},*/
			allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],
			buttonLabel: 'Прикрепить фотографии',
			sizeLimit: 7000000, // max size   
			debug: true,
			params: {
			        element: 'icon'
					}
		/*});*/}); 
		}
	
	}

var loadImg = new Image(); 
	loadImg.src = '/src/design/main/blueBars.gif';
var emptyImg = new Image(); 
	emptyImg.src = '/src/design/main/_.gif';
/*********************************************ДОБАВЛЕНИЕ БУ АВТО 2012*************************************************/	
function newModelAddClick(obj)
	{
	var contaner = document.getElementById('result');
	var action =  "/usedavto/set/newModel";		
	var errorMsg = '';
	var waitImgCur = document.getElementById('modelWaitImg');
	var userRegistered = 0;
	if(document.getElementById('VAL_156'))
		{
		userRegistered = 1;
		}
	waitImgCur.src = loadImg.src;
	$.post(action, 
		{node:obj.value, mark:mark.value, userRegistered:userRegistered}, function(str) 
		{
		if(str)
			{
			document.getElementById('newModelAdd').style.display="none";
			contaner.innerHTML = str;
			AUUpdateStyles();			
			}
		else
			{
			errorMsg = 'Внимание! Модель "' +  obj.value + '" уже присутствует в списке.';			
			contaner.innerHTML = str;
			}
		waitImgCur.src = emptyImg.src;
		if (errorMsg !='')
			alert(errorMsg);
		}
		);

	}

function AUMarkSelect(obj)
	{
	
//	var isNewNode = obj.id.indexOf('productTypeNew_'); 
	var	contaner =  document.getElementById('result');
	var objTable = document.getElementById('tableNewItemForm');
	var objTableBody = document.getElementById('tableNewItemFormBody');
	var oTR = document.createElement("TR");
	var oTDLeft = document.createElement("TD");
	var oTDRight = document.createElement("TD");
	var oLabel = document.createElement("DIV");
	var oValue = document.createElement("DIV");
	oTDLeft.className = 'slider-value';
	oTDRight.className = 'slider-input';
	var userRegistered = 0;
	var action =  "/spddl/";		
	var curLvl = GetStrPrt(obj.id, '_', 1);
	var waitImgCur = (curLvl>=0) ? document.getElementById('modelWaitImg') : document.getElementById('waitImg');
	if(document.getElementById('VAL_156'))
		{
		userRegistered = 1;
		}
	if((obj.value!='new')&&(obj.value!=''))
		{
		waitImgCur.src = loadImg.src;
		if(curLvl>0)
			{
		document.getElementById('newModelCont').style.display = 'none';
		document.getElementById('newModelName').value = '';
		document.getElementById('newModelAdd').disabled = true;			
//		document.getElementById('productTypeNew_' + curLvl).disabled = true;
			}
//		alert('userRegistered - ' + userRegistered);
		$.post(action, {type:'usedAvtoSelect', userRegistered:userRegistered, node:obj.value}, function(str) 
			{
			var strArr = str.split('####');
			if(str.indexOf('<!--~~~-->')>=0)
				{
				model.value = obj.value;
				contaner.innerHTML = str;
				AUUpdateStyles();
//			strOut = GetStrPrt(str, flag, 1);
//
				}
			else
				{
				var strArr = str.split('####');
				if(mark.value!='')
					{					
					objTableBody.removeChild(objTableBody.lastChild);	
					contaner.innerHTML = '';
					}
				mark.value = obj.value;
				
				
//		sendProdType(str, curLvl);
				oLabel.innerHTML = strArr[0];
				oValue.innerHTML = strArr[1];
				oTDLeft.appendChild(oLabel);		
				oTDRight.appendChild(oValue);		
				oTR.appendChild(oTDLeft);		
				oTR.appendChild(oTDRight);		
//				objTable.appendChild(oTR);
				objTableBody.appendChild(oTR);
//				alert(objTable);
				waitImgCur.src = emptyImg.src;
				AUUpdateStyles();
//				alert(str);
				}
			waitImgCur.src = emptyImg.src;			
			}
			);
		}
	else if((obj.value=='new')/*&&(isNewNode<0)*/)
		{
//		alert(obj.value);		
		document.getElementById('newModelCont').style.display = '';
		document.getElementById('newModelName').value = '';
		document.getElementById('newModelAdd').disabled = false;
		contaner.innerHTML = '';
//		document.getElementById('nextLvl_' + curLvl).innerHTML = '';
		}
		
	}
function check4LabelVisibilityText(obj, action) //проверка  видимости заголовка у текстовых полей
	{
	if(document.getElementById(obj.id + '_Label'))
		{
		var label = document.getElementById(obj.id + '_Label');
		if(action == 1) //onFocus
			{		
			label.style.display = '';
			}
		else if(action == 2) //onBlur
			{
			if(obj.value != '')
				label.style.display = '';
			else
				label.style.display = 'none';			
			}
		}
	}
function check4LabelVisibility(obj) //проверка  видимости заголовка
	{
//	alert(obj.value);
	if(document.getElementById(obj.id + '_Label'))
		{
		var label = document.getElementById(obj.id + '_Label');		
/*		if(obj.type=='select')
			{*/
		if(obj.value != '')
			label.style.display = '';
		else
			label.style.display = 'none';			
/*			}
		else if(obj.type=='text')
			{
//			if()
			alert('text');
			}*/
		}
	}
function sendProdType2012(str, curLvl)
	{	
	var flagError = 	  '##ERROR_DUBLICATE##';
	var flag = 	  '##LAST_LEVEL##';
	if (str.indexOf(flagError) <0)
		{
		var lastLvl = str.indexOf(flag); // GetStrPrt(str, flag, 0);
		var strOut, contaner;
		if(lastLvl>=0)
			{
			contaner =  document.getElementById('result');
			strOut = GetStrPrt(str, flag, 1);
			}
		else
			{
			contaner = (curLvl>=0) ? document.getElementById('nextLvl_' + curLvl) : document.getElementById('topLvl');
			strOut = GetStrPrt(str, flag, 1);
			document.getElementById('result').innerHTML = '';
			strOut = str;
			}
		
		contaner.innerHTML = strOut;
		}
	else
		{
		alert('Элемент с таким названием уже существует!')
		}		
	}
	
/**********************************************ДОБАВЛЕНИЕ БУ АВТО 2012************************************************/	
	
function GetStrPrt(str, del, indx)
	{
	strArr1 = str.split(del);
	var ret = strArr1[indx];
	return ret;
	}
function checkForChange_Edit(the_form)
	{
//	alert(the_form);
	var fullCnt = 0;
    var selectCount  = document.forms[the_form.name].elements.length;
    for (var i = 0; i < selectCount; i++)
	    {
		if (((document.forms[the_form.name].elements[i].type == 'file')||(document.forms[the_form.name].elements[i].type == 'text')||
			(document.forms[the_form.name].elements[i].type == 'checkbox'))&&
				(((document.forms[the_form.name].elements[i].type == 'text')&&(document.forms[the_form.name].elements[i].value != 
					document.getElementById('CMP_' + GetStrPrt(document.forms[the_form.name].elements[i].id, '_', 1)).value))||
						((document.forms[the_form.name].elements[i].type == 'file')&&(document.forms[the_form.name].elements[i].value != ''))||
						((document.forms[the_form.name].elements[i].type == 'checkbox')&&(document.forms[the_form.name].elements[i].id.indexOf('DEL_')>=0)&&(document.forms[the_form.name].elements[i].checked))||
						((document.forms[the_form.name].elements[i].type == 'checkbox')&&
						(((document.forms[the_form.name].elements[i].checked)&&(document.getElementById('CMP_' + GetStrPrt(document.forms[the_form.name].elements[i].id, '_', 1)).value==''))||
						((!document.forms[the_form.name].elements[i].checked)&&(document.getElementById('CMP_' + GetStrPrt(document.forms[the_form.name].elements[i].id, '_', 1)).value!=''))))))
			{
			fullCnt ++;
			}
	    }
	document.getElementById('SAVE').disabled = (fullCnt==0) ? true : false; 
	}
	
function checkForChange(the_form)
	{
	var fullCnt = 0;
    var selectCount  = document.forms[the_form.name].elements.length;
    for (var i = 0; i < selectCount; i++)
	    {
//		if(document.forms[the_form.name].elements[i].type == 'checkbox') alert(document.forms[the_form.name].elements[i].checked);
		if (((document.forms[the_form.name].elements[i].type == 'file')||
			(document.forms[the_form.name].elements[i].type == 'text')||
			(document.forms[the_form.name].elements[i].type == 'textarea')||
			(document.forms[the_form.name].elements[i].type == 'checkbox'))&&
				(((document.forms[the_form.name].elements[i].type == 'text')&&(document.forms[the_form.name].elements[i].value != ''))
					||((document.forms[the_form.name].elements[i].type == 'textarea')&&(document.forms[the_form.name].elements[i].value != ''))
					||((document.forms[the_form.name].elements[i].type == 'file')&&(document.forms[the_form.name].elements[i].value != ''))))
			{
			fullCnt ++;
			}
	    } 
//	document.getElementById('PREVIEW').disabled = (fullCnt==0) ? true : false; 
	document.getElementById('SAVE').disabled = (fullCnt==0) ? true : false; 
	}
function productTypeSelect_Add(obj)
	{
	var url= '/company/spddl/';
	var contaner;
	var action =  "/company/spddl/productAddPropList";		
	var isNewNode = obj.id.indexOf('productTypeNew_'); 
//	alert (isNewNode);
	var curLvl = GetStrPrt(obj.id, '_', 1);
	var waitImgCur = (curLvl>=0) ? document.getElementById('waitImg_' + curLvl) : document.getElementById('waitImg');
	//	alert(obj.value);
	if(((obj.value!='new')||(isNewNode>=0))&&(obj.value!=''))
		{
		waitImgCur.src = loadImg.src;
		if(isNewNode>=0)
			{
			var stop = 0;
			var cycleLvl = curLvl;
			var firstParent = '';
			while(!stop)
				{
				if(document.getElementById('productType_'+cycleLvl))
					{
					if(document.getElementById('productType_'+cycleLvl).value != 'new')
						{
						stop ++;
						firstParent = document.getElementById('productType_'+cycleLvl).value;
						}
					}
				else
					{
					if(document.getElementById('productTypeNew_'+cycleLvl))
						{
						}
					else
						{
						stop ++;
						firstParent = document.getElementById('productType').value;
						}					
					}
				if(!stop)
					cycleLvl--;
				}
				
			$.post(action, {node:obj.value, newNode:1, lvl:curLvl, lvlDiff:(curLvl-cycleLvl), firstParent:firstParent}, function(str) 
				{
				sendProdType(str, curLvl);
				waitImgCur.src = emptyImg.src;
				}
				);
			}
		else
			{
			if((curLvl>=0))
				{
				document.getElementById('contProductTypeNew_' + curLvl).style.display = 'none';
				document.getElementById('productTypeNew_' + curLvl).value = '';
				document.getElementById('add_' + curLvl).disabled = true;
				document.getElementById('productTypeNew_' + curLvl).disabled = true;
				}
			$.post(action, {node:obj.value}, function(str) 
				{
				sendProdType(str, curLvl);
				waitImgCur.src = emptyImg.src;
				}
				);
			}			
		}
	else if((obj.value=='new')&&(isNewNode<0))
		{		
		document.getElementById('productTypeNew_' + curLvl).disabled=false;
		document.getElementById('contProductTypeNew_' + curLvl).style.display = '';
		document.getElementById('result').innerHTML = '';
		document.getElementById('nextLvl_' + curLvl).innerHTML = '';
		}
	else if(obj.value=='')
		{
//		alert('empty');
		if((curLvl>=0))
			{
			document.getElementById('contProductTypeNew_' + curLvl).style.display = 'none';
			document.getElementById('productTypeNew_' + curLvl).value = '';
			document.getElementById('add_' + curLvl).disabled = true;
			document.getElementById('productTypeNew_' + curLvl).disabled = true;
			}
		document.getElementById('result').innerHTML = '';
		if (document.getElementById('nextLvl_' + curLvl))
			document.getElementById('nextLvl_' + curLvl).innerHTML = '';	
		else
			document.getElementById('topLvl').innerHTML = '';
		}
	}
function sendProdType(str, curLvl)
	{	
	var flagError = 	  '##ERROR_DUBLICATE##';
	var flag = 	  '##LAST_LEVEL##';
	if (str.indexOf(flagError) <0)
		{
		var lastLvl = str.indexOf(flag); // GetStrPrt(str, flag, 0);
		var strOut, contaner;
		if(lastLvl>=0)
			{
			contaner =  document.getElementById('result');
			strOut = GetStrPrt(str, flag, 1);
			}
		else
			{
			contaner = (curLvl>=0) ? document.getElementById('nextLvl_' + curLvl) : document.getElementById('topLvl');
			strOut = GetStrPrt(str, flag, 1);
			document.getElementById('result').innerHTML = '';
			strOut = str;
			}
		
		contaner.innerHTML = strOut;
		}
	else
		{
		alert('Элемент с таким названием уже существует!')
		}		
	}
	