<link href="/src/design/main/css/mp.css" rel="stylesheet" type="text/css" />
<SCRIPT src="/includes/JS/gd/mp.js" type=text/javascript></SCRIPT>
   <script type="text/javascript">
{literal} 
	var cloudsProto = new Array();	
//	var Clouds = new Array();	
	var advert = new Array();	
	var aElement = new Array();	
	var positionCenter; 
    var earth_x_left; 	
    var earth_x_right; 
    var earth_y_top; 	
    var earth_y_bottom; 
	var imgPrefCloud = '/src/design/main/img/first_page/';
	var imgEarth = new Image(); 
	imgEarth.src = "/src/design/main/img/png/earth_01.png";

	$(window).load(function () {
		UI.pleaseWait();
		showStaticElements();
//		alert($('#earthBig').src);
		generateClouds();
		$('.layerCloud_0').css({'z-index' : '0'});		
		$('.layerCloud_1').css({'z-index' : '1'});		
		$('.layerCloud_2').css({'z-index' : '5'});		
		$('.layerCloud_3').css({'z-index' : '6'});		
		$('.layerCloud_4').css({'z-index' : '7'});		
		$('.layerCloud_5').css({'z-index' : '8'});		

		$('.layer_1').css({'z-index' : '2'});   //земля		
		$('.layer_2').css({'z-index' : '3'});	//объекты на Земле
		$('.layer_3').css({'z-index' : '4'});	//самолет, воздушные шары	
		$('#center_container').bind("mousemove", mousePosition);		
		
		});
	$(document).ready(function(){
		UI.pleaseWait();
		
		$('#center_container').css({'height' : ($('#center').height() + 100)});		
		$('#page').css({'background' : 'none'});		
		$('#center').css({'left' :  (UI.windowWidth/2 - $('#center').width()/2)});
		positionCenter = 	UI.getOffset('center');			
		earth_x_left = 		parseInt($('#center').css('left'),10);
		earth_x_right = 	parseInt($('#center').css('left'),10)  + parseInt($('#center').width(),10);
		earth_y_top = 		parseInt(positionCenter.top ,10);
		earth_y_bottom = 	parseInt(positionCenter.top ,10)  + parseInt($('#center').height() ,10);
		$('.aObj').bind("mouseover", objectOver);
		$('.aObj').bind("mouseout", objectOver);

		});
{/literal}
	</script>

<!-- POSITION ABSOLUTE -->
<script type="text/javascript">
	cloudsProto[0] = new createCloudProto('cloud_00.png', 282, 161);
	cloudsProto[1] = new createCloudProto('cloud_01.png', 364, 165);
	cloudsProto[2] = new createCloudProto('cloud_02.png', 369, 164);
	cloudsProto[3] = new createCloudProto('cloud_03.png', 361, 172);
	cloudsProto[4] = new createCloudProto('cloud_04.png', 361, 172);
	cloudsProto[5] = new createCloudProto('cloud_05.png', 285, 171);
	cloudsProto[6] = new createCloudProto('cloud_06.png', 285, 171);
	cloudsProto[7] = new createCloudProto('cloud_07.png', 311, 164);
	cloudsProto[8] = new createCloudProto('cloud_08.png', 311, 164);
	cloudsProto[9] = new createCloudProto('cloud_09.png', 311, 164);
	
	advert[0] = new setAdvertObj('Кабинет семейного психолога', '/catalog/Кабинет семейного психолога');
	advert[1] = new setAdvertObj('Ученый жираф', '/catalog/Ученый жираф');
	advert[2] = new setAdvertObj('Детский сад "Ай да Гномики!"', '/catalog/Ай-да гномики!');
	advert[3] = new setAdvertObj('Студия танцев "Артишок"', '/catalog/Артишок');
	advert[4] = new setAdvertObj('Магазин "Любимые дети"', '/catalog/Любимые дети');
	
	aElement[0] = new activeElement(imgPrefCloud + 'p01-01.png', imgPrefCloud + 'p01-01-act.png');
	aElement[1] = new activeElement(imgPrefCloud + 'p01-02.png', imgPrefCloud + 'p01-02-act.png');
	aElement[2] = new activeElement(imgPrefCloud + 'p01-03.png', imgPrefCloud + 'p01-03.png');
	aElement[3] = new activeElement(imgPrefCloud + 'p01-04.png', imgPrefCloud + 'p01-04-act.png');
	aElement[4] = new activeElement(imgPrefCloud + 'p01-05.png', imgPrefCloud + 'p01-05-act.png');
	aElement[5] = new activeElement(imgPrefCloud + 'p01-06.png', imgPrefCloud + 'p01-06-act.png');
	aElement[6] = new activeElement(imgPrefCloud + 'p01-07.png', imgPrefCloud + 'p01-07-act.png');
	aElement[7] = new activeElement(imgPrefCloud + 'p01-08.png', imgPrefCloud + 'p01-08-act.png');
	aElement[8] = new activeElement(imgPrefCloud + 'p01-09.png', imgPrefCloud + 'p01-09-act.png');
	aElement[9] = new activeElement(imgPrefCloud + 'p01-10.png', imgPrefCloud + 'p01-10-act.png');
	aElement[10] = new activeElement(imgPrefCloud + 'p01-11.png', imgPrefCloud + 'p01-11-act.png');
	aElement[11] = new activeElement(imgPrefCloud + 'p01-12.png', imgPrefCloud + 'p01-12-act.png');
	aElement[12] = new activeElement(imgPrefCloud + 'p01-13.png', imgPrefCloud + 'p01-13-act.png');
	
</script> 
<!-- CENTER -->    
<div id="center"  class='layer_1' >	
<img id='earthBig'
	src="/src/design/tmp/main/_.gif" 
	border=0 />  
<a href = '/news'>
<div id="aElement_0"   class='layer_3 aObj' title="" >	
	<img id='i01-01' border= '0'
{*	src="/src/design/main/img/first_page/p01-01.png" *}
	src="/src/design/tmp/main/_.gif" 
	border=0 /> 
</div></a> 
<a href = '/main/Кладовая'>
<div id="aElement_1"  class='layer_2 aObj'title="" >
	<img id='i01-02'
{*	src="/src/design/main/img/first_page/p01-02.png"  *}
	src="/src/design/tmp/main/_.gif" 
	border=0 />
</div> </a> 
{*<a href = '/main/Кладовая'>*}
<div id="aElement_2"  class='layer_2' title="">
	<img  id='i01-03'
{*	src="/src/design/main/img/first_page/p01-03.png"  *}
	src="/src/design/tmp/main/_.gif" 
	border=0 />  
</div> 
{*</a> *}
<a href = '/main/Развитие'>
<div id="aElement_3"  class='layer_2 aObj' title="">
	<img  id='i01-04'
{*	src="/src/design/main/img/first_page/p01-04.png"  *}
	src="/src/design/tmp/main/_.gif" 
	border=0 />  
</div>
</a> 
<a href = '/main/SOS'>
<div id="aElement_4"  class='layer_2 aObj' title="">
	<img  id='i01-05'
{*	src="/src/design/main/img/first_page/p01-05.png"  *}
	src="/src/design/tmp/main/_.gif" 
	border=0 />  
</div>
</a> 
<a href = '/main/Законы'>
<div id="aElement_5"  class='layer_2 aObj' title="">
	<img  id='i01-06'
{*	src="/src/design/main/img/first_page/p01-06.png"  *}
	src="/src/design/tmp/main/_.gif" 
	border=0 />  
</div>
</a> 
<a href = '/main/Детский лагерь'>
<div id="aElement_6"  class='layer_2 aObj' title="">
	<img  id='i01-07'
{*	src="/src/design/main/img/first_page/p01-07.png"  *}
	src="/src/design/tmp/main/_.gif" 
	border=0 />  
</div>
</a> 
<a href = '/main/Развлечения'>
<div id="aElement_7"  class='layer_2 aObj' title="">
	<img  id='i01-08'
{*	src="/src/design/main/img/first_page/p01-08.png"  *}
	src="/src/design/tmp/main/_.gif" 
	border=0 />  
</div>
</a> 
<a href = '/main/Товары'>
<div id="aElement_8"  class='layer_2 aObj' title="">
	<img  id='i01-09'
{*	src="/src/design/main/img/first_page/p01-09.png"  *}
	src="/src/design/tmp/main/_.gif" 
	border=0 />  
</div>
</a> 
<a href = '/main/Детский сад'>
<div id="aElement_9"  class='layer_2 aObj' title="">
	<img  id='i01-10'
{*	src="/src/design/main/img/first_page/p01-10.png"  *}
	src="/src/design/tmp/main/_.gif" 
	border=0 />  
</div>
</a> 
<a href = '/main/Праздники'>
<div id="aElement_10"  class='layer_2 aObj' title="">
	<img  id='i01-11'
{*	src="/src/design/main/img/first_page/p01-11.png"  *}
	src="/src/design/tmp/main/_.gif" 
	border=0 />  
</div>
</a> 
<a href = '/main/Медицина'>
<div id="aElement_11"  class='layer_2 aObj' title="">
	<img  id='i01-12'
{*	src="/src/design/main/img/first_page/p01-12.png"  *}
	src="/src/design/tmp/main/_.gif" 
	border=0 />  
</div>
</a> 
<a href = '/main/Образование'>
<div id="aElement_12"  class='layer_2 aObj' title="">
	<img  id='i01-13'
{*	src="/src/design/main/img/first_page/p01-13.png" *}
	src="/src/design/tmp/main/_.gif" 
	border=0 />  
</div>
</a>
        
</div>    
</div>
