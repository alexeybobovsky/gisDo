<link href="/src/design/main/css/mp.css" rel="stylesheet" type="text/css" />
<SCRIPT src="/includes/JS/gd/mp.js" type=text/javascript></SCRIPT>
   <script type="text/javascript">
{literal} 
	var advert = new Array();	
	var positionCenter; 
    var earth_x_left; 	
    var earth_x_right; 
    var earth_y_top; 	
    var earth_y_bottom; 

	
	$(document).ready(function(){
				
		$('#center_container').css({'height' : ($('#center').height() + 100)});		
		$('#page').css({'background' : 'none'});		
		$('#center').css({'left' :  (UI.windowWidth/2 - $('#center').width()/2)});
		positionCenter = 	UI.getOffset('center');			
		earth_x_left = 		parseInt($('#center').css('left'),10);
		earth_x_right = 	parseInt($('#center').css('left'),10)  + parseInt($('#center').width(),10);
		earth_y_top = 		parseInt(positionCenter.top ,10);
		earth_y_bottom = 	parseInt(positionCenter.top ,10)  + parseInt($('#center').height() ,10);
		generateClouds();
		$('.layerCloud_0').css({'z-index' : '0'});		
		$('.layerCloud_1').css({'z-index' : '1'});		
		$('.layerCloud_2').css({'z-index' : '5'});		
		$('.layerCloud_3').css({'z-index' : '6'});		

		$('.layer_1').css({'z-index' : '2'});   //земля		
		$('.layer_2').css({'z-index' : '3'});	//объекты на Земле
		$('.layer_3').css({'z-index' : '4'});	//самолет, воздушные шары	
		$('#center_container').bind("mousemove", mousePosition);
		$('.aObj').bind("mouseover", objectOver);
		$('.aObj').bind("mouseout", objectOver);
/*		$('#p01-01').bind("mouseover", objectOver);
		$('#p01-01').bind("mouseout", objectOver);
		$('#p01-03').unbind("mouseover", objectOver);
		$('#p01-03').unbind("mouseout", objectOver);*/
//		document.onmousemove = mousePosition;

		})
{/literal}
	</script>

<!-- POSITION ABSOLUTE -->
<script type="text/javascript">
	advert[0] = new setAdvertObj('Кабинет семейного психолога', '/catalog/Кабинет семейного психолога');
	advert[1] = new setAdvertObj('Ученый жираф', '/catalog/Ученый жираф');
	advert[2] = new setAdvertObj('Детский сад "Ай да Гномики!"', '/catalog/Ай-да гномики!');
	advert[3] = new setAdvertObj('Студия танцев "Артишок"', '/catalog/Артишок');
	advert[4] = new setAdvertObj('Магазин "Любимые дети"', '/catalog/Любимые дети');
</script> 
<!-- CENTER -->    
<div id="center"  class='layer_1' >	
<img 
	src="/src/design/main/img/png/earth_01.png" 
	border=0 />  
<div id="p01-01"   class='layer_3 aObj' onclick="location.href='http://spb.superjob.ru/';"  title="" >
	<img 
	src="/src/design/main/img/first_page/p01-01.png" 
	border=0 />  
</div>
<div id="p01-02"  class='layer_2 aObj' onclick="window.open('http://spb.superjob.ru/');" title="" >
	<img 
	src="/src/design/main/img/first_page/p01-02.png" 
	border=0 />  
</div>
<div id="p01-03"  class='layer_2' title="">
	<img 
	src="/src/design/main/img/first_page/p01-03.png" 
	border=0 />  
</div>
<div id="p01-04"  class='layer_2 aObj' title="">
	<img 
	src="/src/design/main/img/first_page/p01-04.png" 
	border=0 />  
</div>
<div id="p01-05"  class='layer_2 aObj' title="">
	<img 
	src="/src/design/main/img/first_page/p01-05.png" 
	border=0 />  
</div>
<div id="p01-06"  class='layer_2 aObj' title="">
	<img 
	src="/src/design/main/img/first_page/p01-06.png" 
	border=0 />  
</div>
<div id="p01-07"  class='layer_2 aObj' title="">
	<img 
	src="/src/design/main/img/first_page/p01-07.png" 
	border=0 />  
</div>
<div id="p01-08"  class='layer_2 aObj' title="">
	<img 
	src="/src/design/main/img/first_page/p01-08.png" 
	border=0 />  
</div>
<div id="p01-09"  class='layer_2 aObj' title="">
	<img 
	src="/src/design/main/img/first_page/p01-09.png" 
	border=0 />  
</div>
<div id="p01-10"  class='layer_2 aObj' title="">
	<img 
	src="/src/design/main/img/first_page/p01-10.png" 
	border=0 />  
</div>
<div id="p01-11"  class='layer_2 aObj' title="">
	<img 
	src="/src/design/main/img/first_page/p01-11.png" 
	border=0 />  
</div>
<div id="p01-12"  class='layer_2 aObj' title="">
	<img 
	src="/src/design/main/img/first_page/p01-12.png" 
	border=0 />  
</div>
<div id="p01-13"  class='layer_2 aObj' title="">
	<img 
	src="/src/design/main/img/first_page/p01-13.png" 
	border=0 />  
</div>

        
</div>    
</div>
