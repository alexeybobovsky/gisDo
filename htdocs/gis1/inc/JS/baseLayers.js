	var osm_layer = L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw', {
			maxZoom: 18,
			attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
				'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
				'RKO Foundation © <a href="http://rko38.ru">RKO Foundation</a>',
			id: 'mapbox.streets'
		}).addTo(mymap);
		
	var googleStreets_layer = 	L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
			maxZoom: 20,
			subdomains:['mt0','mt1','mt2','mt3']
		});
	var googleHybrid_layer = 	L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
			maxZoom: 20,
			subdomains:['mt0','mt1','mt2','mt3']
		});
	var googleSat_layer = 		L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
			maxZoom: 20,
			subdomains:['mt0','mt1','mt2','mt3']
		});		
	var googleTerrain_layer = 	L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}',{
			maxZoom: 20,
			subdomains:['mt0','mt1','mt2','mt3']
		});
		
	var sputnikMap = L.tileLayer('http://tiles.maps.sputnik.ru/{z}/{x}/{y}.png', {
            maxZoom: 19
        });
		
   var imagerySetAer = "Aerial"; // AerialWithLabels | Birdseye | BirdseyeWithLabels | Road
   var imagerySetRoad = "Road"; // AerialWithLabels | Birdseye | BirdseyeWithLabels | Road
//       var imagerySet = "Birdseye/52.280,104.267"; // AerialWithLabels | Birdseye | BirdseyeWithLabels | Road
//       var imagerySet = "Birdseye/37.779160067439079,-122.42004945874214"; // AerialWithLabels | Birdseye | BirdseyeWithLabels | Road
   var bingRoad = new L.BingLayer("LfO3DMI9S6GnXD7d0WGs~bq2DRVkmIAzSOFdodzZLvw~Arx8dclDxmZA0Y38tHIJlJfnMbGq5GXeYmrGOUIbS2VLFzRKCK0Yv_bAl6oe-DOc", 
			{type: imagerySetRoad}
			);
   var bingAer = new L.BingLayer("LfO3DMI9S6GnXD7d0WGs~bq2DRVkmIAzSOFdodzZLvw~Arx8dclDxmZA0Y38tHIJlJfnMbGq5GXeYmrGOUIbS2VLFzRKCK0Yv_bAl6oe-DOc", 
			{type: imagerySetAer}
			);

	var yndx = new L.Yandex();
	var yndxS = new L.Yandex("satellite");
	var yndxH = new L.Yandex("hybrid");
	var yndxN = new L.Yandex("publicMap");
	var yndxNH = new L.Yandex("publicMapHybrid");
	var ytraffic = new L.Yandex("null", {traffic:true, opacity:0.5, overlay:true});		
	var dgis = new L.DGis();
	var RKOMap;
	osm_layer.addTo(mymap);
		function layerSwitch(e) {
			switch (e.layer.options.layerId) {
				case 'adm':  addToList(); break;
				case 'eko':   addToList(); break;
				default : $('#infoContainer').html('');
			}
		}
		var cntrlLayers = new L.Control.Layers({'OSM':osm_layer,  "2ГИС":dgis,  "Yandex":yndx, "Yandex-гибрид":yndxH,   "Google streets":googleStreets_layer, "Google hybrid":googleHybrid_layer/*"Yandex-народная":yndxN, 
												"Спутник (Ростелеком)":sputnikMap,  "Bing Roads":bingRoad, "Bing Aerial":bingAer,/*, "РКО":RKOMap*/}/*, 
												{"Пробки":ytraffic, "Районы (Demo)":admDemoLayer , "Экорегион (Demo)":ekoDemoLayer }*/);
		mymap.on('overlayadd', layerSwitch);
//		mymap.on('load', function(){console.log('fired'  );});
		$(document).ready(function(){console.log('fired'  ); addToList();});
//		mymap.on('load', function(){alert('!');});
		mymap.addControl(cntrlLayers);
		mymap.addControl(new L.Control.GeoSearch({
				provider: new L.GeoSearch.Provider.Google()
			}));//.addTo(mymap);	
			
		var popup = L.popup();


		function onMapClick(e) {
			popup
				.setLatLng(e.latlng)
				.setContent("You clicked the map at " + e.latlng.toString())
				.openOn(mymap);
/*		console.log('event', showProperties(e.target, 'e.target' ));*/
//		console.log('event', e.target );
		}

		mymap.on('click', onMapClick);
function setLayer(id)
	{
	osm_layer.remove();
	googleTerrain_layer.remove();
	googleHybrid_layer.remove();
	googleSat_layer.remove();
	googleStreets_layer.remove();
	switch(id)
		{
		case 'osm' : 	{osm_layer.addTo(mymap);}
			break;
		case 'gScheme' : 	{googleTerrain_layer.addTo(mymap);}
			break;
		case 'gSpace' : {googleHybrid_layer.addTo(mymap);}
			break;
		}
	
//	alert(id);
	}
	function addToList(data) 
		{
		}