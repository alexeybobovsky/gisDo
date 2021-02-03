	function activeElement(srcInactive, srcActive)
		{
		this.imgA = new Image(); 
		this.imgA.src =  srcActive;
		this.imgI = new Image(); 
		this.imgI.src =  srcInactive;
		}  
	function createCloudProto(src, w, h)
		{
		this.img = new Image(); 
		this.img.src =  imgPrefCloud + src;
		this.w = w;
		this.h = h;
		}  
	function setAdvertObj(text, link)
		{
		this.text = text;
		this.link = link;
		}  
	function showStaticElements()
		{
		$('#earthBig').attr('src' , imgEarth.src);				
		for(var i=0; i < aElement.length; i++ )
			{
			if(i<9)
				$('#'+ 'i01-0'+ (i+1)).attr('src' , aElement[i].imgI.src);		
			else
				$('#'+ 'i01-'+ (i+1)).attr('src' , aElement[i].imgI.src);						
			}

		}
	function generateClouds()
		{
		var contaner = document.getElementById('center_container');
		var cloudLayers = 3;
		var cloudNumInLayer = 5;
		var oDivCloud, oImgCloud, curCloudName;
		var curLayer = 0;
		var curX = curY = W = H = difX = difY = stop = cloudCenterX = cloudCenterY = advertCnt =  0;
		curY = 50;
		var even = true;  //четное число
//		alert(cloudsProto[0].img.src);
//		alert($(Clouds[0].cloudObj).css('height'));
		for(var i=0; i < 50; i++ )
			{
			even = (Math.floor(i/2) * 2 == i) ? true : false;
			if(!stop)
				{
				curCloudName = UI.rand(0, 9);
				oDivCloud = document.createElement("DIV");
				oImgCloud = document.createElement("IMG");
				oImgCloud.src = cloudsProto[curCloudName].img.src;
				oDivCloud.className = "cloud";
//				oDivCloud.id = "cloudAuto-" + curCloudName;
				oDivCloud.id = "cloudAuto-" + i;
				oDivCloud.appendChild(oImgCloud);
				contaner.appendChild(oDivCloud);
				W = $(oDivCloud).width();
				H = $(oDivCloud).height();
/*				W = cloudsProto[curCloudName].w;
				H = cloudsProto[curCloudName].h;*/
/*				if(i<3)
					alert($(oDivCloud).css('height'));*/
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
						curLayer = UI.rand(2, 5);	
						}
					$(oDivCloud).css({'left': (curX + difX), 'top': (curY + difY)});
					curX += W + difX;
					$(oDivCloud).addClass('layerCloud_' + curLayer);
					}

				}
			else 				{ break;}
			}
		}

	function objectOver(event)
		{
//		alert(showProperties(event.currentTarget , 'event'));
		var elementId = GetStrPrt(event.currentTarget.id, '_', 1);
		var ie, activeImgSrc,  activeImgArr, obj;
		ie = (event.currentTarget.childNodes[0].src) ? 1 : 0;
		obj = (ie) ? event.currentTarget.childNodes[0] : event.currentTarget.firstElementChild;
		activeImgSrc = obj.src ;
		activeImgArr = activeImgSrc.split('.');
		if(event.type == 'mouseover')
			{
			obj.src =  aElement[elementId].imgA.src;
			}
		else if(event.type == 'mouseout')
			{
			obj.src =  aElement[elementId].imgI.src;
			}
		}
	function mousePosition(event)
		{
		var kPositionCloud = new Array();	
		kPositionCloud[0] = 45;
		kPositionCloud[1] = 40;
		kPositionCloud[2] = 15;
		kPositionCloud[3] = 11;
		kPositionCloud[4] = 7;
		kPositionCloud[5] = 3;
		var center_x = UI.windowWidth/2;
		var center_y = UI.windowHeight/2;
		var earthCenter_x = $('#center').css('left')  + $('#center').width()/2;
		var earthCenter_y = $('#center').css('top')  + $('#center').height()/2;
		
		for(var i=0; i<6; i++)
			{
			$('.layerCloud_' + i).css({'margin-left' : parseInt(((center_x - event.clientX)/kPositionCloud[i]),10)});
			$('.layerCloud_' + i).css({'margin-top' : parseInt(((center_y - event.clientY)/kPositionCloud[i]),10)});
			}

		$('.layer_1').css({'margin-left' : parseInt(((center_x - event.clientX)/30),10)});
		$('.layer_2').css({'margin-left' : 	parseInt(((earthCenter_x - event.clientX)/30),10)});
		$('.layer_3').css({'margin-left' : parseInt(((center_x - event.clientX)/28),10)});

		$('.layer_1').css({'margin-top' : parseInt(((center_y - event.clientY)/30),10)});
		$('.layer_2').css({'margin-top' : 	parseInt(((earthCenter_y - event.clientY)/30),10)});	
		$('.layer_3').css({'margin-top' : parseInt(((center_y - event.clientY)/28),10)});
		}
	


