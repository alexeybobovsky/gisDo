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
var delay = 500; //�������� ����� ������� �������� ���� �������(� ��)
var delayMove=10; //�������� �������� ���� �� step ��������(� ��)
var tim;          //������������� �������
var curDivID=null;//�������� ����
var divTop;       //Y-���������� �������� ���� ����
var clipTop;      //������ ���������� ����� ����
var step=10;       //�������� �������� ���� �� ����� delayMove � px
var st;           //|st|=step, � ���� ������� �� ����������� �������� ����: "+" - ����, //"-" - �����
var up=0;         //����������� �������� ����(0 - ����; 1 - �����)
var isShowing=0; //��������� ����(0 - �� ����������; 1 - ����������)
var startHide=0; //��������� ������� ����(0 - � �������� ���� - ��� �� ����� //���������; 1 - �� ��������� ���� - ��� ����� �������)

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
	curDivID = divID; //���������� �������� ����
	cancelHide();     //�������� ������� �������� ����
	startHide=0;      
	up=0;     
//	alert (el.id);
	if (!isShowing)
		{//���� �� ����������
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
		{ //���� ��������� ����������
//		alert(clipTop);
	    up=1;
	    tim = setTimeout("moveMenu()", delay);
		}
	else startHide=1;
	}
function cancelHide()
	{ 
	if (clipTop==0) //���� ��������� ����������
		clearTimeout(tim); 
	else startHide = 0;
	}

function moveMenu()
	{
    if (!up) 
		st = step; //�������� ���� ����
	else 
		st = -step;    //�������� ���� �����  
/*	clipTop += st;
	curDivID.style.filter = "alpha(opacity=" + clipTop + ")";
	if (clipTop>=100)
		{ //���� ��������� ����������
		clipTop = 100;
		up = 1;
		if (startHide) 
			tim = setTimeout("moveMenu()", delay);
		return;
		}  
	if (clipTop<=0)	
		{ //���� ��������� ������
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
		{ //���� ��������� ����������
	    up = 1;
		if (startHide) 
			tim = setTimeout("moveMenu()", delay);
	    return;
		}  
	if (clipTop>=curDivID.offsetHeight)
		{ //���� ��������� ������
		clearStyles();
	    startHide = 0;
	    isShowing = 0;
	    return;
		}    
	tim = setTimeout("moveMenu()", delayMove);
	}