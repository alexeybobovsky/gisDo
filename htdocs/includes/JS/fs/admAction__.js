var orgInfoFull;
function GetStrPrt(str, del, indx)
	{
	strArr1 = str.split(del);
	var ret = strArr1[indx];
	return ret;
	}
function showProperties(obj, objName) 
{
  var result = "The properties for the " + objName + " object:" + "\n";
  
  for (var i in obj) {result += i + " = " + obj[i] + "\n";}
  
  return result;
}
function changeType(obj)
	{
//	alert(document.location);
	document.location = 	document.getElementById('mainUrl').value + obj.value;
	}
function confirmState(obj)
	{
	var mes;
	if(obj.value == 1)
		mes = 'Отображать';
	else if(obj.value == 2)
		mes = 'Скрывать';
	else if(obj.value == 3)
		mes = 'Удалить';
	if(confirm(mes + ' объект?'))	
		obj.form.submit();
	}
function pleaseWait(start)
	{
/*	if( start )
		alert('wait!!!');*/
	}

function showFotoSet(objId, setNum, setDate)
	{
//	alert(objId + '   -    ' + setNum);
	var spdlType = 'fotoSet';		
	$.post("/spddl/", {type:spdlType, objId:objId, setNum:setNum}, function(str) 
			{
			var fotoId, fotoStc;
			var strArr = str.split('~~');
			if(strArr.length > 1)
				{
				$('#oldDate').val(setDate);
				var contaner = document.getElementById('fotoSetOld');
				contaner.innerHTML = '';				
				for(var i=0; i<strArr.length;  i++ )
					{					
					if(strArr[i]!='')
						{
						valArr = strArr[i].split('##');
						if(valArr.length>1)
							{
							fotoId = valArr[0];
							fotoPos = valArr[1];
							fotoSrc = valArr[2];
						/*	var prewImg = new Image(); 
							prewImg.src = responseJSON['prew'];// '/src/design/main/blueBars.gif';*/
							var oDivImg = document.createElement("DIV");
							var oDivImgInner = document.createElement("DIV");
							var oDivLabel = document.createElement("DIV");
							var oImg = document.createElement("IMG");
							var oTxt = document.createElement("input");
							var oTxtLabel = document.createElement("div");
							var oCheckBox = document.createElement("input");
							var oLabel = document.createElement("label");
							oDivImg.id = 'fotoOld_' + fotoId;
				//			oDiv.onclick = function() {alert(this);};
							oDivImg.className = 'imgPad';
							oImg.src = fotoSrc;
							oCheckBox.type = 'checkbox';
							oCheckBox.id = 'del_' + fotoId;
							oCheckBox.name = 'del_' + fotoId;
//							oCheckBox.style.float = 'left';
							oLabel.innerHTML = 'Удалить';
							oLabel.setAttribute('for', 'del_' + fotoId);
							oTxtLabel.innerHTML = '<b>Позиция <u>' + fotoPos + '</u></b>';
/*							
							oTxt.id = 'aboutImg_' + fotoId;
							oTxt.name = 'aboutImg_' + fotoId;
							oTxt.style.display = 'none';
							oTxt.className = 'qq-upload-img-about';
							oTxtLabel.innerHTML = 'Добавить описание';
							oTxtLabel.onclick = function() {toggleElementSimple(this.id); toggleElementSimple('aboutImg_' + fotoId);};
							oTxtLabel.id = 'aboutImgLbl_' + fotoId;
							oTxtLabel.className = 'qq-upload-img-about-lbl';
				//			alert(showProperties(responseJSON, 'responseJSON'));
				//			alert(contaner);
*/				
				
				
							oDivImgInner.appendChild(oImg);	
/*							oDivLabel.appendChild(oTxtLabel);	
							oDivLabel.appendChild(oTxt);	*/
							oDivLabel.appendChild(oCheckBox);	
							oDivLabel.appendChild(oLabel);	
							oDivImg.appendChild(oTxtLabel);	
							oDivImg.appendChild(oDivImgInner);	
							oDivImg.appendChild(oDivLabel);	
							contaner.appendChild(oDivImg);	
							}
						}
					}
				}
//			alert(str);
			});
	}
/*******************************Редактор****************************************/
function FCKeditor_OnComplete( editorInstance )
	{
//	alert('ready');
	var oEditor = FCKeditorAPI.GetInstance( 'firmInfo' ) ;
	oEditor.SetData(orgInfoFull);
	$('#infoUpdt').val('1');
	pleaseWait(0);
	}

function editInfo()
	{
	pleaseWait(1);
	var objType = $('#objType').val();
	document.getElementById('firmInfoDefault').style.display = 'none';
	CreateEditor();
//	alert(typeof( FCKeditorAPI ));
	var orgId = (objType == 'construction') ? $('#objId').val() :   $('#firmId').val() ;
	var spdlType = 'orgInfo';		
	if (orgId>0)
		$.post("/spddl/", {type:spdlType, orgId:orgId, objType:objType}, function(str) 
			{
			orgInfoFull = str;
			});
	else
		orgInfoFull = '';		
	}
function CreateEditor()
	{
	var oEditor ;
	if ( typeof( FCKeditorAPI ) != 'undefined' )
		oEditor = FCKeditorAPI.GetInstance( 'firmInfo' ) ;
	if(!oEditor)
		{
		document.getElementById('FCKeditor').style.display = '';
		var oFCKeditor = new FCKeditor( 'firmInfo' ) ;
		oFCKeditor.BasePath = '/includes/FCKeditor/' ;
		oFCKeditor.ToolbarSet = 'Custom' ;
		oFCKeditor.Config['SkinPath'] = '/includes/FCKeditor/editor/skins/office2003/' ;	
		oFCKeditor.Width = '400px' ;
		oFCKeditor.Height = '350' ;
		oFCKeditor.ReplaceTextarea() ;
		}
	}
/*******************************autocomplete functions****************************************/


function noMatches()
	{
	document.getElementById('firmId').value = 0;
	if(document.getElementById('firmWWW').value!= '')
		{
		document.getElementById('firmWWW').focus();
		document.getElementById('firmWWW').value = '';
		document.getElementById('firmWWW').blur();
		document.getElementById('firmName').focus();
		}
	if(document.getElementById('orgInfoShort').value!= '')
		{	
		document.getElementById('firmInfoDefault').innerHTML = 'Добавить информацию';
		}
	document.getElementById('orgInfoShort').value  = '';
	}
function formatStreet(row, i, num) 
	{	
	var result;
	var string = row[0].toLowerCase();
	var searched = row[1].toLowerCase();	
	var start = string.indexOf(searched);
	var end = start + searched.length;
	result = string.substring(0,   start) + '<span class="ac_searched">' +  searched + '</span>'  + string.substring(end);				
	return result;
	}
function selectName(str) 
	{	
//	alert(showProperties(str.extra, 'ac'));
	var org = document.getElementById('firmId');
/*	if (str.extra[3]!='')
		{*/
		document.getElementById('firmWWW').focus();
		document.getElementById('CMP#firmId').value = str.extra[3];
		document.getElementById('firmWWW').value = str.extra[3];
		document.getElementById('firmWWW').blur();
/*		}
	else
		*/
/*	if (str.extra[4]!='')
		{*/
		document.getElementById('orgInfoShort').value  = str.extra[4];
		document.getElementById('firmInfoDefault').innerHTML = (str.extra[4]=='')?'Добавить информацию':str.extra[4];
//		}
//	var org = document.getElementById('firmId');
	org.value = str.extra[1];
	
	/*
	var sbmt = document.getElementById('SUBMITSEARCHNAME');
	if(str.extra[1]>0)
		sbmt.value = 'Перейти';
	else
		sbmt.value = 'Искать';
		*/
	}
/*******************************END autocomplete functions****************************************/
function createFileUploadParam(title, name)
	{
	this.title = title; 
	this.name =  name;
	}  
function createFileUploader(title, type, action)
	{
//	alert(title + ' ' + type + ' ' + action);
	this.obj =  new qq.FileUploader({
				element: document.getElementById('file_' + type),
				action: action,
	/*		onComplete: function(id, fileName, responseJSON){alert(fileName)},*/
				allowedExtensions: ['jpg', 'jpeg', 'png', 'gif', 'doc', 'docx', 'pdf'],
				buttonLabel: title,
				type: type,
				sizeLimit: 7000000, // max size   
				debug: true,
				params: {
						element: type
						}
			/*});*/}); 	
	}  

function updateStylesObjEdit()
	{

	$("#firmName").autocomplete('/spddl/',
		{
		minChars:1,
		lineSeparator:"##",
		cellSeparator:"**",
		maxItemsToShow:20,
		formatItem:formatStreet,
		noMatchesFound:noMatches,
		onItemSelect:selectName,
		extraParams:{type:"companyNameExt"}
	//	cacheLength:0,
	//    autoFill:false
		}
		);	
	$(".chzn-select").chosen(); 		
	$(".chzn-select-deselect").chosen({allow_single_deselect:true});	
/*	$("#VAL_fotoDateEdit").chosen().change('alert("dddd");'); 		*/
	var curPar, cnt;
	for(var i = 0; i < fileUploadParam.length; i++)
		{
//		curPar = GetStrPrt(fileUploadParam, del, indx)		
		if(document.getElementById('file_' + fileUploadParam[i].name))
			{
			uploader[cnt] = new createFileUploader('Загрузить ' + fileUploadParam[i].title, fileUploadParam[i].name, '/map/set/upload');
			cnt ++;
			}
		}
/*		
	if(document.getElementById('fileIcon1'))
		{
		var uploader1;
	 	uploader1 = new qq.FileUploader({
			element: document.getElementById('fileIcon1'),
			action: '/map/set/upload',
			allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],
			buttonLabel: 'Прикрепить картинки',
			sizeLimit: 7000000, // max size   
			debug: true,
			params: {
			        element: 'icon'
					}
		}); 
		}*/
//	$("#phone1").mask("9 999 9 999 999", {placeholder:" "});
	
	}

var loadImg = new Image(); 
	loadImg.src = '/src/design/main/blueBars.gif';
var emptyImg = new Image(); 
	emptyImg.src = '/src/design/main/_.gif';