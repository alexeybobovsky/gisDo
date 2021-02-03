function navigation(emulate, startLocation, startTitle) //поля метки для объекта
	{	
	this.enable = (emulate) ? false : true; //window.history.emulate;
	this.startLocation = startLocation;
	this.startTitle = startTitle;
	this.type = '';
	this.objId = '';
	this.objName = '';
	this.objTitle = '';
	this.objChildNum = '';
	this.title = '';
	this.url = '';
	this.titleSeparator = ' | ';
//	this.state 
	this.setSelectedType = function (type) 
		{
		this.type = type;
		}
	this.setSelectedObjProperties = function(objId, name, title, childNum) 
		{
		this.objId = objId;
		this.objName = name;
		this.objTitle = title;
		this.objChildNum = childNum;
		}
		
	this.backward = function (obj)
		{
//		alert(showProperties(obj.state, 'state'));
		if (obj.state.type == 'layer')
			{
			clickLayer(obj.state.objId);
			}
		else if (obj.state.type == 'org')
			{
			showOrgObjects(obj.state.objId);
			}
		else if (obj.state.type == 'singleObj')
			{
			showObject(obj.state.objId, 1);
			}				
/*		
		objId = 26
		type = layer
		title = Частные детсады - Карта Иркутска - Город-детям.рф
		url = http://localhost/map/layer/26		
*/		
		}
	this.saveNavPosition = function () 
		{
		if (this.type == 'layer') 
			{
			this.title = (this.objTitle) ? this.objTitle : this.objName;
			this.url = this.startLocation +  this.title; // + '/' + this.objId;			
			this.title += this.titleSeparator + this.startTitle;			
//			this.url = this.startLocation +  this.type + '/' + this.objId;		
			SZ.labelCatActivate((this.objTitle) ? this.objTitle : this.objName, this.objChildNum);
			}
		else if (this.type == 'org') 
			{
			this.title = this.objName;
			this.title += this.titleSeparator + this.startTitle;			
			this.url = this.startLocation +  this.objName  + '/all';						
			SZ.labelOrgActivate(this.objName);
			}
		else if (this.type == 'singleObj') 
			{
			this.title = this.objName;
			this.title += this.titleSeparator + this.startTitle;			
			this.url = this.startLocation + this.objName + '/' + this.objId;
			SZ.labelOrgActivate(this.objName);
			}
		document.title = this.title;
		if(this.enable)
			{
			var state = 
				{
				objId: 	this.objId,
				type: 	this.type,
				title: 	this.title,
	//			title: 	jQuery.trim(this.innerHTML),
				url:  	this.url 
				}						
			history.pushState( state, state.title, this.url);			
			}
		
		}
	}