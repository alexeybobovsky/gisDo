var emptySearchStr = 'Введите поисковый запрос...';

var exluded = [' ', 'nbsp', '!','@','#','$','%','^','&','*','(',')','-','_','=','`','~',':',';','\'','"','\\','/','|','?','.',',','<','>', '№','%']; 
function searchLoadStartF()
	{
//	document.getElementById('searchIndicatorImg').src = loadImg.src;
	document.getElementById('resMessageF').innerHTML = '';	
//	alert($('#topToolBar').offset().top + document.getElementById('searchFast').offsetTop + document.getElementById('searchFast').offsetHeight);

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
//	alert(showProperties(row));
//	alert(showProperties($.browser, 'browser'));

	document.getElementById('resMessageF').innerHTML = '';
	var result;
	var type = row[0];
	var string = row[3].toLowerCase();
	var searched = str_replace(exluded, '', row[2].toLowerCase());	
//	var searched = row[2].toLowerCase();	
	var start = string.indexOf(searched);
	var end = start + searched.length;
	if ( (row[0] == 'newsName') || (row[0] == 'newsBody') )
		type = 'новость';
	if ((row[0] == 'docName') || (row[0] == 'docBody'))
		type = 'статья';
	if (row[0] == 'catFirm')
		type = 'рубрика организаций';
	if (row[0] == 'catDocs')
		type = 'рубрика статей';
	if (row[0] == 'catNews')
		type = 'рубрика новостей';
		
	if (row[0] == 'firmInfo')
		type = 'описание организации';
	if (row[0] == 'firmName')
		type = 'название организации';
	if (row[0] == 'street')
		type = 'адрес организации';
	if (row[0] == 'phone')
		type = 'телефон организации';
	if (row[0] == 'firmWWW')
		type = 'сайт организации';
	if (row[0] == 'constrName')
		type = 'название стройки';
	if (row[0] == 'constrInfo')
		type = 'описание стройки';
	if (row[0] == 'constrSales')
		type = 'отдел продаж';
	if (row[0] == 'constrAdr')
		type = 'адрес стройки';
	if (row[0] == 'constrWWW')
		type = 'сайт стройки';
	type += '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	result = '<div class= "multitypeContaner"><div class="findResult">';
	if(start >=0) 
		result += string.substring(0,   start) + '<span class="ac_searched">' +  searched + '</span>'  + string.substring(end); 
	else
		result += row[1];		
	result += '</div><div  class="findType typeName_' +row[0] + '">' + type + '</div></div>';				
	return result;
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
	
	var availableTags = [
	  "Испанский",
	  "Итальянский",
	  "Английский",
	  "Китайский",
	  "Русский"
	];	
/*	console.log(availableTags);*/
	$( "#searchCity" ).autocomplete({source:  function( request, response ) 
			{
//			var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
			arr = GIS.searchCity(settlements, request.term);
			console.log(arr );
			response(arr);
		  }
		  });	
/*	$( "#searchCity" ).autocomplete({source:  function( request, response ) 
			{
			console.log(request);
			var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
			console.log( $.grep( availableTags, function( item ){return matcher.test(item);}));
			response( $.grep( availableTags, function( item ){return matcher.test(item);}));
		  }
		  });*/
	$("#searchCity").autocomplete({select: function(event, ui) {$( "#searchCity").text(ui.item.label); console.log(ui.item), console.log(event)}});		  
/*	$("#searchFast").autocomplete('/spddl/',
	$("#searchFast").autocomplete('/spddl/',
		{
		minChars:4,
		lineSeparator:"##",
		cellSeparator:"**",
		maxItemsToShow:20,
		selectOnly:true,
		width:800,
		fixedContaner:'topToolBar',
		formatItem:formatStreetF,
		minCharachters:minCharachters,
		noMatchesFound:noMatchesF,
		loadingStart:searchLoadStartF,
		loadingEnd:searchLoadEndF,
		onItemSelect:selectNameF,
		extraParams:{type:"fastSearch"}
		}
		);	*/	
	}
	
	