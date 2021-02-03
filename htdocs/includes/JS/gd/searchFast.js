var emptySearchStr = 'Введите поисковый запрос...';

var exluded = [' ', 'nbsp', '!','@','#','$','%','^','&','*','(',')','-','_','=','`','~',':',';','\'','"','\\','/','|','?','.',',','<','>', '№','%']; 
function str_replace ( search, replace, subject ) 
	{
	// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// +   improved by: Gabriel Paderni

	if(!(replace instanceof Array)){
		replace=new Array(replace);
		if(search instanceof Array){//If search	is an array and replace	is a string, then this replacement string is used for every value of search
			while(search.length>replace.length){
				replace[replace.length]=replace[0];
				}
			}
		}
	if(!(search instanceof Array))search=new Array(search);
	while(search.length>replace.length){//If replace	has fewer values than search , then an empty string is used for the rest of replacement values
		replace[replace.length]='';
		}
	if(subject instanceof Array){//If subject is an array, then the search and replace is performed with every entry of subject , and the return value is an array as well.
		for(k in subject){
			subject[k]=str_replace(search,replace,subject[k]);
			}
			return subject;
		}	
	for(var k=0; k<search.length; k++){
		var i = subject.indexOf(search[k]);
		while(i>-1){
			subject = subject.replace(search[k], replace[k]);
			i = subject.indexOf(search[k],i);
			}
		}
	return subject;
	}
function searchLoadStartF()
	{
//	document.getElementById('searchIndicatorImg').src = loadImg.src;
	document.getElementById('resMessageF').innerHTML = '';	
	}
function searchLoadEndF()
	{
//	document.getElementById('searchIndicatorImg').src = emptyImg.src;	
	}
function clearSearchbarF()
	{
	document.getElementById('resMessageF').innerHTML = '';
	document.getElementById('searchFast').value = emptySearchStr;
	}
function minCharachters(moreChars)
	{
	$("#resMessageF").html('еще ' + moreChars + UI.getCorrectDeclensionRu(moreChars,  ' символ', ' символа', ' символов' ) + ' ...');
	}
function noMatchesF()
	{
	document.getElementById('resMessageF').innerHTML = 'Ничего не найдено';
	}
function formatStreetF(row, i, num) 
	{	
	document.getElementById('resMessageF').innerHTML = '';
	var result;
	var type = row[0];
	var string = row[3].toLowerCase();
	var searched = str_replace(exluded, '', row[2].toLowerCase());	
//	var searched = row[2].toLowerCase();	
	var start = string.indexOf(searched);
	var end = start + searched.length;
	if ( (row[0] == 'newsName') || (row[0] == 'newsBody') )
//		type = 'новости';
		type = 'новость';
/*	if (row[0] == 'newsBody')
		type = 'новости';*/
	if ((row[0] == 'docName') || (row[0] == 'docBody'))
		type = 'статья';
/*	if (row[0] == 'newsBody')
		type = 'статьи';*/
	if (row[0] == 'catFirm')
//		type = 'рубрики организаций';
		type = 'рубрика организаций';
	if (row[0] == 'catDocs')
//		type = 'рубрики статей';
		type = 'рубрика статей';
	if (row[0] == 'catNews')
		type = 'рубрика новостей';
//		type = 'рубрики новостей';
		
	if (row[0] == 'firmInfo')
		type = 'описание организации';
	if (row[0] == 'firmName')
		type = 'название организации';
	if (row[0] == 'street')
		type = 'адрес организации';
	if (row[0] == 'phone')
		type = 'телефон организации';
	type += '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	result = '<div class= "multitypeContaner"><div class="findResult">';
	if(start >=0) 
		result += string.substring(0,   start) + '<span class="ac_searched">' +  searched + '</span>'  + string.substring(end); 
	else
		result += row[1];		
	result += '</div><div  class="findType typeName_' +row[0] + '">' + type + '</div></div>';				
	return result;
	}
function toggleSearchBar(action) 
	{
	if(action == 1)  //focus
		{		
		UI.panelName = 'searchExt';
		UI.keep = true;			
		UI.modal = true;
		var lockingPadCSS =  {'display':'block', 'width':  UI.windowWidth,  'height':  UI.documentHeight};
		$("#" + UI.lockingPadName).css(lockingPadCSS);
		$("#" + UI.lockingPadName).click(UI.Keep);	
		$('#searchExt_mM').css({'width' : (UI.windowWidth - 20 - 80)});
		$('#searchExt_bM').css({'width' : (UI.windowWidth - 20 - 80)});			
		$('#searchExt').slideDown("slow", function() {UI.panelVisible = true; } );
		$('#searchFast').focus();
		document.onkeydown = 	function(event)
			{
			if (window.event) event = window.event;
			var code = event.keyCode ? event.keyCode : event.which ? event.which : null;
			if (code == 27)
				{
				if(UI.panelVisible == true)
					{
					toggleSearchBar(0) 
					}
				else
					{			
					var container = document.getElementById (UI.panelName);
					if (!container) return;
					container.style.display = 'none';
					document.onclick = null;
					document.onkeydown = null;
					}
				}			
			}
		}
	else
		{
		UI.modal = false;				
		$('#searchExt').slideUp("slow", function() {			
					var lockingPadCSS =  {'display':'none'};
					$("#" + UI.lockingPadName).css(lockingPadCSS);
					UI.panelVisible = false;
					} );		
		document.onkeydown = null;
		UI.keep = false;	
		$('#searchFast').blur();
		}
	}
function selectNameF(str) 
	{	
//	alert(showProperties(str.extra));
	window.location = str.extra[3];
/*	if(str.selectValue == 'layer')
		clickLayer(str.extra[2]);
	if(str.selectValue == 'org')
		showOrgObjects(str.extra[2]);
	if(str.selectValue == 'phone')
		showObject(str.extra[3], 1);
	if(str.selectValue == 'street')
		showObject(str.extra[3], 1);
	if(str.selectValue == 'newsName')
		showObject(str.extra[3], 1);
	if(str.selectValue == 'newsBody')
		showObject(str.extra[3], 1);
	document.getElementById('searchFast').value = emptySearchStr;
	document.getElementById('searchFast').blur();*/
	
	}
function initSearch() 
	{
	$("#searchFast").autocomplete('/spddl/',
		{
		minChars:4,
		lineSeparator:"##",
		cellSeparator:"**",
		maxItemsToShow:20,
		selectOnly:true, 
		formatItem:formatStreetF,
		minCharachters:minCharachters,
		noMatchesFound:noMatchesF,
		loadingStart:searchLoadStartF,
		loadingEnd:searchLoadEndF,
		onItemSelect:selectNameF,
		extraParams:{type:"fastSearch"}
		}
		);		
	}
	
	