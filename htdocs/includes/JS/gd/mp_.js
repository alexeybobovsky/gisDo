	function setAdvertObj(text, link)
		{
		this.text = text;
		this.link = link;
		}  
	function generateClouds()
		{
/*		var earth_x_left = 		parseInt($('#center').css('left'),10);
		var earth_x_right = 	parseInt($('#center').css('left'),10)  + parseInt($('#center').width(),10);
		var positionCenter = UI.getOffset('center');	*/		
//		alert(showProperties(positionCenter , 'css'));
/*		var earth_y_top1 = 		parseInt(positionCenter.top ,10);
		var earth_y_bottom1 = 	parseInt(positionCenter.top ,10)  + parseInt($('#center').height() ,10);
		var earth_y_top = 		parseInt($('#center').css('top'),10);
		var earth_y_bottom = 	parseInt($('#center').css('top'),10)  + parseInt($('#center').height(),10);*/
/*		var earth_y_top = 		parseInt(positionCenter.top ,10);
		var earth_y_bottom = 	parseInt(positionCenter.top ,10)  + parseInt($('#center').height() ,10);*/
//		alert(showProperties($('#center').css('bottom') , 'css'));
		var contaner = document.getElementById('center_container');
		var cloudLayers = 3;
		var cloudNumInLayer = 5;
		var oDivCloud, oImgCloud, curCloudName;
		var curLayer = 0;
		var curX = curY = W = H = difX = difY = stop = cloudCenterX = cloudCenterY = advertCnt =  0;
		curY = 50;
		var even = true;  //четное число
		for(var i=0; i < 50; i++ )
			{
			even = (Math.floor(i/2) * 2 == i) ? true : false;
			if(!stop)
				{
				curCloudName = UI.rand(0, 9);
				oDivCloud = document.createElement("DIV");
				oImgCloud = document.createElement("IMG");
				oImgCloud.src = '/src/design/main/img/first_page/cloud_0' + curCloudName + '.png' ;
				oDivCloud.className = "cloud";
				oDivCloud.id = "cloudAuto-" + curCloudName;
				oDivCloud.appendChild(oImgCloud);
				contaner.appendChild(oDivCloud);
				W = $(oDivCloud).width();
				H = $(oDivCloud).height();
				if(i<3)
					alert($(oDivCloud).css('height'));
//				alert ('W = ' + W + ';H = ' + H);
				difX = UI.rand(30, 70);
				difY = UI.rand(0, 50);	
				if(even == false) {difY = UI.rand(H/2, H/1.3); /*alert(i)*/};
				if(UI.windowWidth < (curX + W/2) )  // заполнена горизонталь
					{
					curX  = -70;
					curY += parseInt(H*1.5);
					}
				if(UI.windowHeight < (curY) )
					{
					stop ++;
					contaner.removeChild(oDivCloud);
					}
				if(!stop)
					{
					cloudCenterX = curX + difX + W/2;
					cloudCenterY = curY + difY + H/2;
					cloudCenterX *= 1;
					cloudCenterY *= 1.2;
//					alert(cloudCenterX + ' > ' + earth_x_left + ' && '+ cloudCenterX+' < '+earth_x_right+' && '+cloudCenterY +' > '+ earth_y_top +'&&'+ cloudCenterY +' < ' + earth_y_bottom);
					if ((cloudCenterX > earth_x_left)&&(cloudCenterX < earth_x_right)&&(cloudCenterY > earth_y_top)&&(cloudCenterY < earth_y_bottom))
						curLayer = UI.rand(0, 1);	
					else 
						{
						if((curX + difX > -30)&&(curX + difX + W < UI.windowWidth +70)&&
							(curY + difY > 50)&&(curY + difY + H < UI.windowHeight +70)
							&& (advertCnt < advert.length))
							{
//							alert(cloudCenterX + ' > ' + earth_x_left + ' && '+ cloudCenterX+' < '+earth_x_right+' && '+cloudCenterY +' > '+ earth_y_top +'&&'+ cloudCenterY +' < ' + earth_y_bottom);
							
							oAdvText = document.createElement("DIV");
							oAdvText.className = "cloudAdvert";
							oAdvText.innerHTML = '<a href="' +advert[advertCnt].link+ '">' + advert[advertCnt].text + '</a>';
							oDivCloud.appendChild(oAdvText);
							$(oAdvText).css({'max-width': (W-W/3)});
							$(oAdvText).css({'left': (W/2 - $(oAdvText).width()/2), 'top': (H/2 - $(oAdvText).height()/2)});
							advertCnt ++;
							}
						curLayer = UI.rand(2, 3);	
						}
					$(oDivCloud).css({'left': (curX + difX), 'top': (curY + difY)});
					curX += W + difX;
					$(oDivCloud).addClass('layerCloud_' + curLayer);
					}

				}
			else 				{	alert ($(oDivCloud).html()); break;}
			}
		}

	function objectOver(event)
		{
//		alert(showProperties1(event.currentTarget.childNodes[0] , 'event'));
//		alert(event.currentTarget.childNodes[0].src );
		var ie, activeImgSrc,  activeImgArr, obj;
		ie = (event.currentTarget.childNodes[0].src) ? 1 : 0;
		obj = (ie) ? event.currentTarget.childNodes[0] : event.currentTarget.firstElementChild;
		activeImgSrc = obj.src ;
		activeImgArr = activeImgSrc.split('.');
//		event.currentTarget.id
		if(event.type == 'mouseover')
			{
			obj.src =  activeImgArr[0] + '-act.' + activeImgArr[1];
			}
		else if(event.type == 'mouseout')
			{
			var activeImgArrTmp = activeImgSrc.split('-act');
			obj.src =  activeImgArrTmp[0] + '.' + activeImgArr[1];			
			}
		}
	function mousePosition(event)
		{
		var center_x = UI.windowWidth/2;
		var center_y = UI.windowHeight/2;
		var earthCenter_x = $('#center').css('left')  + $('#center').width()/2;
		var earthCenter_y = $('#center').css('top')  + $('#center').height()/2;

		$('.layerCloud_0').css({'margin-left' : parseInt(((center_x - event.clientX)/45),10)});
		$('.layerCloud_1').css({'margin-left' : parseInt(((center_x - event.clientX)/40),10)});
		$('.layerCloud_2').css({'margin-left' : parseInt(((center_x - event.clientX)/10),10)});
		$('.layerCloud_3').css({'margin-left' : parseInt(((center_x - event.clientX)/5),10)});

		$('.layer_1').css({'margin-left' : parseInt(((center_x - event.clientX)/30),10)});
		$('.layer_2').css({'margin-left' : 	parseInt(((earthCenter_x - event.clientX)/30),10)});
		$('.layer_3').css({'margin-left' : parseInt(((center_x - event.clientX)/28),10)});

		$('.layer_1').css({'margin-top' : parseInt(((center_y - event.clientY)/30),10)});
		$('.layer_2').css({'margin-top' : 	parseInt(((earthCenter_y - event.clientY)/30),10)});	
		$('.layer_3').css({'margin-top' : parseInt(((center_y - event.clientY)/28),10)});

		$('.layerCloud_0').css({'margin-top' : parseInt(((center_y - event.clientY)/45),10)});
		$('.layerCloud_1').css({'margin-top' : parseInt(((center_y - event.clientY)/40),10)});
		$('.layerCloud_2').css({'margin-top' : parseInt(((center_y - event.clientY)/10),10)});
		$('.layerCloud_3').css({'margin-top' : parseInt(((center_y - event.clientY)/5),10)});		
		}
	


