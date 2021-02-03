/*
function createFilter(city, firm, layer)
	{
	this.city = city;
	this.firm = firm;
	this.layer = layer;
	}
	*/
function applyFilterValues()
	{				
	var curCity = 	getLayer('IDCITYFLTR');
	var curFirm = 	getLayer('IDFIRMFLTR');
	var curLayer = 	getLayer('IDLAYERFLTR');
	var defCity = 	getLayer('DEFCITY');
	var defFirm = 	getLayer('DEFFIRM');
	var defLayer = 	getLayer('DEFLAYER');
	var applyBtn =  getLayer('IDAPPLYFLTR');
	defCity.value = curCity.value;
	defFirm.value = curFirm.value;
	defLayer.value = curLayer.value;
	applyBtn.disabled = true;		
	}
	
function applyFilter()
	{						
	var curCity = 	getLayer('IDCITYFLTR');
	var curFirm = 	getLayer('IDFIRMFLTR');
	var curLayer = 	getLayer('IDLAYERFLTR');
	var container = getLayer('tree');		
	var location =  getLayer('IDcurUrl').value + "renew/";
	var wb = getLayer('waitBox');
	MoveElementInCenterOfAnother(wb, container);
	$(wb).fadeIn("fast");	
	$.post(location, {curCity:curCity.value, curFirm:curFirm.value, curLayer:curLayer.value}, function(str) 
		{		
		container.innerHTML = str;
		applyFilterValues();
		$(wb).fadeOut("slow");	
		$("table#order").tableSorter({
			sortClassAsc: 'sortUp', 
			sortClassDesc: 'sortDown', 
			highlightClass: 'highlight',
			headerClass: 'largeHeaders',
			dateFormat: 'dd/mm/yyyy' 
		});
		}
		);
	}
	
function changeFilter()
	{		
	var curCity = 	getLayer('IDCITYFLTR');
	var curFirm = 	getLayer('IDFIRMFLTR');
	var curLayer = 	getLayer('IDLAYERFLTR');
	var defCity = 	getLayer('DEFCITY');
	var defFirm = 	getLayer('DEFFIRM');
	var defLayer = 	getLayer('DEFLAYER');
	var applyBtn =  getLayer('IDAPPLYFLTR');
	if((curCity.value!=defCity.value)||(curFirm.value!=defFirm.value)||(curLayer.value!=defLayer.value))
		{			
		applyBtn.disabled = false;
		}
	 if ((curCity.value==defCity.value)&&(curFirm.value==defFirm.value)&&(curLayer.value==defLayer.value))
		{
		applyBtn.disabled = true;
		}
	}
function showFilter(obj)
	{		
	window.event.cancelBubble = true;
	var filterName = 'filter';
	var obj = document.getElementById('filterImg');
	var curobj = getLayer(filterName);
	if (isFilterShowed >0 )
		{
		$(curobj).hide("slow", function(){obj.style.filter = 'alpha(opacity=50)';  obj.title='Показать фильтр'; });	
		isFilterShowed = 0;
		}
	else
		{
		moveFilterHere(obj);
		$(curobj).show("slow", function(){obj.style.filter = 'alpha(opacity=100)'; obj.title='Скрыть фильтр';});	
		isFilterShowed = 1;
		}
	}	
function moveFilterHere(cursel)
	{
	var cont=getLayerStyle('tree');		
	if(cont!=null)
		{
		var filterWidth = cont.pixelWidth - 2*cursel.offsetWidth;
		var filterHeight = 100;			
		}
	var obj = cursel;
	for(i=obj, x=0, y=0; i; i = i.offsetParent) 
		{
		x += i.offsetLeft;
		y += i.offsetTop;
		}
	var posX = x - filterWidth;
	var posY = y - 0.5*cursel.offsetHeight;
	SetLayerRect(fiter.name, posX, posY, filterWidth, filterHeight);
	}
