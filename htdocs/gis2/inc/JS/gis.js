function gisRoutine()	
	{
	this.home = [];
	this.overSingleObj = 0;
	this.searchedSingleObj = 0;
	this.styleReg = {
											"color": "#222222",
											"fillColor": "#ff0000",
											"weight": 1,
											"fillOpacity": 0.2,
											"opacity": 0.5
										};
	this.styleBorderRed = {
											"color": "#ee4444",
											"weight": 1,
											"opacity": 0.8,
											"smoothFactor": 1,
											"noClip" : true
										};
	this.layerSwitch = function(e) {
			switch (e.layer.options.layerId) {
				case 'adm':  addToList(); break;
				case 'eko':   addToList(); break;
				default : $('#infoContainer').html('');
			}
		}		
	this.routingToPoint = function() {
		console.log(popup.getLatLng());
		coord = (GIS.home['center']!= undefined) ? GIS.home['center'] : L.latLng(GIS.home['lat'], GIS.home['lon']);
//		L.Routing.Formatter({language: 'pt'});
		rout = L.Routing.control({
				waypoints: 
				[
				coord,
				L.latLng(popup.getLatLng())
				],
				language: 'ru',
				showAlternatives: true, 
				altLineOptions: {
					styles: [
						{color: 'black', opacity: 0.15, weight: 9},
						{color: 'white', opacity: 0.8, weight: 6},
						{color: 'blue', opacity: 0.5, weight: 2}
					] 				
				}
				});
//		rout.Formatter({language: 'pt'});		
				
		rout.addTo(mymap);
		}
	this.geoKoderOSM = function(str) {
			var action = ($(location).attr('href') == 'http://gis2.localhost/') ? '/getFromFile.php' :'/gis2/getFromFile.php';

			$.post(action, {type:'geoKoderOSM', location:$('#cityLabel').text(), str:str}, function(str)
				{	
				UI.pleaseWait();
				if(str != '')
					{
					parArr = str.split('##');
					for(var k=0; k<parArr.length; k++)        
						{
						parSingle = parArr[k].split('=');
						GIS.home[parSingle[0]] = parSingle[1];
						}
//					pointArr = 	GIS.home['display_name'].split(',');
					adrArr = 	GIS.home['display_name'].split(', ');
					boundArr = 	GIS.home['boundingbox'].split(',');
//					console.log(boundArr);
					GIS.home['point'] = L.marker([GIS.home['lat'], GIS.home['lon']]).addTo(mymap);
//					console.log(GIS.home);
					mymap.fitBounds([[boundArr[0],boundArr[2]],[boundArr[1],boundArr[3]]]);
//					L.rectangle([[boundArr[0],boundArr[2]],[boundArr[1],boundArr[3]]], {color: "#ff7800", weight: 1}).addTo(mymap);	

					$('#detailAdrSearchLabel').html(adrArr[1] + ' ' + adrArr[0]);
					$('#detailAdrSearchContaner').hide();
					$('#detailAdrSearchToggle').hide();			
					$('#detailAdrSearchRenew').show();
					$('#detailAdrSearchLabel').show();			
					
					}
				else	
					GIS.home = [];
			

				});
		}	
	this.showSingleObj = function(type, objIndex)
		{
		console.log(type, objIndex);
		switch(type)
			{
			case 'city' : {	
				obj = $.grep(settlements, function( item, index ){
//					console.log(item);
					if(item.indexSrc == objIndex) return true;					
				});
				
				} break;
			}
		mymap.removeLayer(this.searchedSingleObj);
//		this.searchedSingleObj = 0;
//				mymap.addLayer(arr[k]);
//				arr[k].state=1;

		this.searchedSingleObj = obj[0];
		mymap.addLayer(this.searchedSingleObj);
		mymap.fitBounds(this.searchedSingleObj.getBounds());
		console.log(this.searchedSingleObj.getBounds().getCenter());
		this.home.center = this.searchedSingleObj.getBounds().getCenter();
		}
	this.searchCity = function(objArr, str)
		{
		console.log(str);
		return $.map(objArr, function( item ){
//			console.log(item);				
			if(item.name.indexOf(str)==0)
				{
//				console.log(item);				
				return {label:item.name, value:item.index};			
//				return {value:item.index, label:item.name};			
				}
			})
		}
	this.setTitle = function(type, string)
		{
		var strout='';
		switch (type)
			{
			case 'org' : {strout = 'Станции арендодателя <strong>' + string + '</strong>'}
				break;
			case 'location' : {strout = 'Станции, расположенные в <strong>' + string + '</strong>'}
				break;
			case 'type' : {strout = 'Станции производителя <strong>' + string + '</strong>'}
				break;
			case 'load' : {strout = 'Станции в статусе <strong>' + string + '</strong>'}
				break;
			
			}
		return strout;		
		}

	this.BSListItemClick = function(index)
		{
//		reg[index].poly.openPopup();
	
//		mymap.setView(reg[index].poly.coordPoint);
		mymap.fitBounds(this.overSingleObj.getBounds());
		}
	this.BSListItemOver = function(index)
		{
//		reg[index].poly.setStyle({'fillOpacity' : 0.6});
		if(this.overSingleObj == 0)
			{
			this.overSingleObj = L.polygon(reg[index], this.styleReg).addTo(mymap);
			}
		}
	this.BSListItemOut = function(index)
		{
//		reg[index].poly.setStyle({'fillOpacity' : 0.2});
		mymap.removeLayer(this.overSingleObj);
		this.overSingleObj = 0;
		}
	this.showTitle = function(x, y, title){
		if($('#titlePoly').css('display') != 'block')
			{
			$('#titlePoly').css({'display' : 'block', 'left' : x, 'top' : y});
			$('#titlePoly').text(title);
			}
		}
	this.hideTitle = function(){
			$('#titlePoly').css({'display' : 'none'});
		}

	this.genTextBigList = function(obj)
		{
//		var htmCont = '<ul class="accItem"  id="' + obj.id + '_Contaner" >';
		var htmCont = '';
		var letterArr = [];
		obj.sort(function(a,b)
			{
			 if (a.name < b.name){
				return -1;
			 }else if (a.name > b.name) {
				return  1;
			 }else{
				return  0;
			 /*
				if (a[0] < b[0]) {
				   return -1; 
				}
				else if (a[0] > b[0]) {
				   return 1;
				} 
				else {
				   return 0;
				}*/
			 }
			})
		
//		for(var k=0; k<obj.length; k++)
		for(var k=0; k<300; k++)
			{
			if(obj[k].name)
			htmCont += "<li><span class='activeLink' id='accItem-" + obj.id + "_" + k + "'  onMouseOver='GIS.BSListItemOver(" + obj[k].index + ");' onMouseOut='GIS.BSListItemOut(" + obj[k].index + 
									");' onClick='  GIS.BSListItemClick(" + obj[k].index + ");'>" + obj[k].name + "</span>";
			}
//		htmCont += "</ul>";
		return htmCont;
		}
	this.genLocList = function()
		{
//		var htmCont = "<div class='switchContaner'><label for='switchDistr'>Отображать</label><input type='checkbox' class='js-switch' id='switchDistr' checked /></div> <ul class='accItem'>";		
//		var htmCont = "<ul class='accItem'>";
//		nameReg.sort();
		var htmCont = "";		
		for(var k=0; k<nameReg.length; k++)
			{
			htmCont += "<li><span class='activeLink' id='accItemBS_" + k + "'  onMouseOver='GIS.BSListItemOver(" + k + ");' onMouseOut='GIS.BSListItemOut(" + k + 
									");' onClick='  GIS.BSListItemClick(" + k + ");'>" + nameReg[k] + "</div>";
			}
//		htmCont += "</ul>";
		$('#distrList').html(htmCont);
		var switchDistr = new Switchery(document.querySelector('#switchDistr'), { size: 'small'});		
		}
		
	this.toggleRegAll = function(reg)
		{
		for(var k=0; k<reg.length; k++)        
			{
			if(reg[k]['poly'].state==0)
				{
				mymap.addLayer(reg[k]['poly']);
				reg[k]['poly'].state=1;
				}
			else
				{
				mymap.removeLayer(reg[k]['poly']);
				reg[k]['poly'].state=0;
				}
			}
		}
	this.togglePolyArr = function(arr)
		{
		for(var k=0; k<arr.length; k++)        
			{
			if(arr[k].state==0)
				{
				mymap.addLayer(arr[k]);
				arr[k].state=1;
				}
			else
				{
				mymap.removeLayer(arr[k]);
				arr[k].state=0;
				}
			}
		}	
	this.loadReg = function(reg)
		{
		var state = 0; //отключено по умолчанию
		var east = [], west = [], south = [], north = []; 
		styleReg = 	{
										"color": "#222222",
										"fillColor": "#ff0000",
										"weight": 1,
										"fillOpacity": 0.2,
										"opacity": 0.5
									};
		for(var k=0; k<reg.length; k++)        
			{			
			popupContent = "<div class='balContaner'><div class='balMainInfo'><div class='balName'>" + nameReg[k] + '</div></div></div>';
//			reg[k]['poly'] = L.polygon(reg[k],styleReg).addTo(mymap);
//			reg[k]['poly'] = L.polygon(reg[k],styleReg);
			reg[k]['poly'] = L.polyline(reg[k],styleReg);
			reg[k]['poly'].bindPopup(popupContent);
			reg[k]['poly'].title = nameReg[k];
			reg[k]['poly'].state = state;
			reg[k]['poly'].index = k;
			reg[k]['poly'].on("mouseout", function (e) {this.setStyle({'fillOpacity' : 0.2}); GIS.hideTitle(); /*BSSectorOver=-1; BSIndexOver = -1;*/});   
			reg[k]['poly'].on("mouseover", function (e) { this.setStyle({'fillOpacity' : 0.6});  BSIndexOver = this.index; GIS.showTitle(e.originalEvent.clientX, e.originalEvent.clientY, this.title)});   
			east.push(reg[k]['poly'].getBounds().getEast());
			west.push(reg[k]['poly'].getBounds().getWest());
			south.push(reg[k]['poly'].getBounds().getSouth());
			north.push(reg[k]['poly'].getBounds().getNorth());
			}
		mymap.fitBounds([[north.max(),west.min()],[south.min(),east.max()]]);
		this.genLocList();
		}

	this.parseGISFlow = function(obj, id)		
		{
		var GISArr = []; 
		var state = 0; //отключено по умолчанию
		var coordSingle = []; var coordArr = []; var semArr = [];
		var name, type;
		var counter = 0;
		var east = [], west = [], south = [], north = []; 
		var lats = []; var lngs = [];             
		var strArr = obj.split("--");        
//		for(var k=0; k<5; k++)        
		for(var k=0; k<strArr.length; k++)        
			{
			if(strArr[k].length>20)
				{
				name = type = '';
/*				GISArr[k]['index'] = k;*/
				popupContent = "<div class='balContaner'><div class='balMainInfo'><div class='balName'>" + nameReg[k] + '</div></div></div>';
				partArr = strArr[k].split('^^');
				semArr = partArr[0].split("#");
				geoArr = partArr[1].split("#");
				coordSingle = [];
				for(var l=0; l<semArr.length; l++)        
					{
					semArr = semArr[l].split("~");
					switch(semArr[0])
						{
						case 'regName' : name = semArr[1]; break;
						case 'regType' : type = semArr[1]; break;
						}
					}
				if ((name!='') && (name!='Нет данных') && (name!='(нежил.)'))
					{
					for(var l=0; l<geoArr.length; l++)        
						{
						coordSingle.push(L.latLng(geoArr[l].split("~")));// coordSingleArr = geoArr[l].split("~");					
						}
					coordSingle.push(coordSingle[0]);
//					coordArr.push(coordSingle);
//					GISArr[counter] = L.polygon(coordSingle, styleReg);
					GISArr[counter] = L.polyline(coordSingle,this.styleBorderRed);
					GISArr[counter]['indexSrc'] = k+1;
					GISArr[counter]['index'] = counter;
					GISArr[counter]['name'] = name;
					GISArr[counter]['type'] = type;
					GISArr[counter]['state'] = state;
					popupContent = "<div class='balContaner'><div class='balMainInfo'><div class='balName'>" + GISArr[counter]['name'] + '</div></div></div>';
					GISArr[counter].bindPopup(popupContent);
					
					east.push(GISArr[counter].getBounds().getEast());
					west.push(GISArr[counter].getBounds().getWest());
					south.push(GISArr[counter].getBounds().getSouth());
					north.push(GISArr[counter].getBounds().getNorth());
					counter ++;
					}
				}
			
			}
//		L.rectangle([[north.max(),west.min()],[south.min(),east.max()]], {color: "#ff7800", weight: 1}).addTo(mymap);	
		GISArr.bounds =  L.latLngBounds([[north.max(),west.min()],[south.min(),east.max()]]);
		GISArr.counter =  counter;
		GISArr.id =  id;
//		mymap.fitBounds(GISArr.bounds);
//		mymap.fitBounds([[north.max(),west.min()],[south.min(),east.max()]]);
//		console.log(counter);
		return GISArr;
		}
	}