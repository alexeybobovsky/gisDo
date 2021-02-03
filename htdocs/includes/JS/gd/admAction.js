var orgInfoFull;
function showProperties(obj, objName) 
{
  var result = "The properties for the " + objName + " object:" + "\n";
  
  for (var i in obj) {result += i + " = " + obj[i] + "\n";}
  
  return result;
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
	if(confirm(mes + ' организацию?'))	
		obj.form.submit();
	}
function pleaseWait(start)
	{
/*	if( start )
		alert('wait!!!');*/
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
	document.getElementById('firmInfoDefault').style.display = 'none';
	CreateEditor();
//	alert(typeof( FCKeditorAPI ));
	var orgId = document.getElementById('firmId').value;
	var spdlType = 'orgInfo';		
	$.post("/spddl/", {type:spdlType, orgId:orgId}, function(str) 
		{
		orgInfoFull = str;
		});
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
	if(document.getElementById('fileIcon'))
		{
		var uploader;
	 	uploader = new qq.FileUploader({
			element: document.getElementById('fileIcon'),
			action: '/map/set/upload',
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
//	$("#phone1").mask("9 999 9 999 999", {placeholder:" "});
	
	}

var loadImg = new Image(); 
	loadImg.src = '/src/design/main/blueBars.gif';
var emptyImg = new Image(); 
	emptyImg.src = '/src/design/main/_.gif';