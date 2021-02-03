/*	function show(obj)
		{
		var indx = GetLastEl(obj.id, '_');
		if(!((document.all)?document.all['subHolder_'+indx]:document.getElementById('subHolder_'+indx)))
			{
			return;
			}			
		var carHolder = (document.all)?document.all['menuHolder_'+indx]:document.getElementById('menuHolder_'+indx);
		var curObj = (document.all)?document.all['subHolder_'+indx]:document.getElementById('subHolder_'+indx);
		var curIcon = (document.all)?document.all['icon_'+indx]:document.getElementById('icon_'+indx);
		if(curObj.style.display == 'none')
			{
			carHolder.className = 'active_text';
			curIcon.className = 'active_img';
			curObj.style.display = '';
			}
		else
			{
			carHolder.className = '';
			curIcon.className = '';
			curObj.style.display = 'none';			
			}

//		$(curObj).fadeIn("slow");
		}
	function hide(obj)
		{
		var indx = GetLastEl(obj.id, '_');
		if(!((document.all)?document.all['subHolder_'+indx]:document.getElementById('subHolder_'+indx)))
			{
			return;
			}
		var curObj = (document.all)?document.all['subHolder_'+indx]:document.getElementById('subHolder_'+indx);
		curObj.style.display = 'none';
//		alert(obj.id);
		}
	function ShowItems(obj_id)
		{
		if (document.getElementById(obj_id))
			{
			var obj=document.getElementById(obj_id);		
			var curObj=document.getElementById(obj_id + '_point');		
			if($(obj).css("display")=='none')
				$(curObj).fadeOut("fast", function(){$(obj).fadeIn("slow")});		
			else
				$(obj).fadeOut("fast", function(){$(curObj).fadeIn("slow")});					
			}
		}*/
var delay = 500; //Задержка перед началом движения меню обратно(в мс)
var delayMove=10; //Задержка смещения меню на step пикселей(в мс)
var tim;          //Идентификатор таймера
var curDivID=null;//Активный слой
var divTop;       //Y-координата верхнего угла слоя
var clipTop;      //Высота отсекаемой части слоя
var step=10;       //Величина смещения слоя за время delayMove в px
var st;           //|st|=step, а знак зависит от направления движения меню: "+" - вниз, //"-" - вверх
var up=0;         //Направление движения меню(0 - вниз; 1 - вверх)
var isShowing=0; //Состояние меню(0 - не отображено; 1 - отображено)
var startHide=0; //Положение курсора мыши(0 - в пределах меню - его не нужно //закрывать; 1 - за пределами меню - его нужно закрыть)

function clearStyles()
	{
	if(curDivID!=null)
		{
		var indx = GetLastEl(curDivID.id, '_');
		var curMenu = document.getElementById('menuHolder_'+indx);	
		if(document.getElementById('icon_'+indx))
			var curIcon = document.getElementById('icon_'+indx);	
		if(curIcon)
			curIcon.className = '';
		curMenu.className = '';		
		}
		
	}
function showMenu(el/*, divID */)
	{
	var indx = GetLastEl(el.id, '_');

	var curMenu = document.getElementById('menuHolder_'+indx);	
	if(document.getElementById('icon_'+indx))
		var curIcon = document.getElementById('icon_'+indx);	
	var divID = document.getElementById('subMenu_' + indx);			
	
	if (curDivID!=null && divID!=curDivID)
		{
	    clearTimeout(tim);
	    isShowing = 0;
	    curDivID.style.display="none"; 
		clearStyles();
		}
	curDivID = divID; //Запоминаем активное меню
	cancelHide();     //Отменяем функцию сокрытия меню
	startHide=0;      
	up=0;     
//	alert (el.id);
	if (!isShowing)
		{//Меню не отображено
		if(curIcon)
			curIcon.className = 'active_img';
		curMenu.className = 'active_text';
		
		isShowing = 1;
		curDivID.style.display = "block";
		
		clipTop = curDivID.offsetHeight;     
		divTop  = el.offsetTop+el.offsetHeight - curDivID.offsetHeight;
		/*
		clipTop = 0;     
		curDivID.style.top  = el.offsetTop+el.offsetHeight;
		*/
		curDivID.style.left = el.offsetLeft;
		moveMenu();
		}
	}
function hideMenu()
	{
//	if (clipTop==0)
	if (clipTop==0)
		{ //меню полностью отображено
//		alert(clipTop);
	    up=1;
	    tim = setTimeout("moveMenu()", delay);
		}
	else startHide=1;
	}
function cancelHide()
	{ 
	if (clipTop==0) //меню полностью отображено
		clearTimeout(tim); 
	else startHide = 0;
	}

function moveMenu()
	{
    if (!up) 
		st = step; //движение меню вниз
	else 
		st = -step;    //движение меню вверх  
/*	clipTop += st;
	curDivID.style.filter = "alpha(opacity=" + clipTop + ")";
	if (clipTop>=100)
		{ //меню полностью отображено
		clipTop = 100;
		up = 1;
		if (startHide) 
			tim = setTimeout("moveMenu()", delay);
		return;
		}  
	if (clipTop<=0)	
		{ //меню полностью скрыто
		curDivID.style.display = "none";
		startHide = 0;
		isShowing = 0;
		return;
		}
	*/	
		
	divTop += st;
	clipTop -= st;
	if (clipTop<0)
		{ divTop+=clipTop; clipTop=0}
	curDivID.style.top = divTop;
	curDivID.style.clip = "rect(" + clipTop +"px auto auto auto)";
	if (clipTop==0)
		{ //меню полностью отображено
	    up = 1;
		if (startHide) 
			tim = setTimeout("moveMenu()", delay);
	    return;
		}  
	if (clipTop>=curDivID.offsetHeight)
		{ //меню полностью скрыто
		clearStyles();
	    startHide = 0;
	    isShowing = 0;
	    return;
		}    
	tim = setTimeout("moveMenu()", delayMove);
	}