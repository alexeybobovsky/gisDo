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
	this.filterParam = '';
	this.filterValue = '';
	this.objId = 0;	
	this.titleSeparator = ' | ';
	this.setSelectedObjProperties = function(objId, type, name, title, childNum) 
		{
//		alert ('setSelectedObjProperties: ' + title + ',  ' + type +',  ' + objId + ',  ' + name + ',  ' + childNum);
		this.objId = objId;
		this.type = type;
		this.objName = name;
		this.objTitle = title;
		this.objChildNum = childNum;
		}
		
	this.backward = function (obj)
		{
//		alert(showProperties(obj.state, 'state'));
		if(obj.state)
			{
			if (obj.state.type == 'construction')
				{
				if(obj.state.objId>0)
					{
					showObject(obj.state.objId, 'construction', 1);
					}
				else
					{
					var str = GetStrPrt(obj.state.url, 'construction/', 1);
					showConstruction(str);
					}
				}
			else if(obj.state.type == 'firm')
				{
				if(obj.state.objId>0)
					{
					showObject(obj.state.objId, 'firm', 1);
					}
				else
					{
					showFirm('');
					}
				}
			else if(obj.state.type == 'apartment')
				{
				var str = GetStrPrt(obj.state.url, 'apartment/', 1);
				apApplyFilterAuto(str);
				}
			}
		}
	this.saveNavPositionAp = function () 
		{
//		filterAp
		this.type = 'apartment';
		this.url = this.startLocation + '/list/apartment/' + filterAp.getFilterURL();
		document.title = this.objTitle + this.titleSeparator + this.startTitle;
//		this.title += this.titleSeparator + this.startTitle;			
/*		alert(showProperties(filterAp, 'filterAp'));	
		alert(showProperties(this, 'this'));	*/
//		$('#titleContent h2').html(this.title);
		$('#titleContent h1').html(this.objTitle);
		$('#titleContent h1').attr('title', this.objTitle);
		$('#titleContent #titleBlur').attr('title', this.objTitle);
		$('#pageTitleMore').html('(' + this.objChildNum + ')');
		if(this.enable)
			{
			var state = 
				{
				objId: 	'',
				type: 	this.type,
				title: 	this.title,
				url:  	this.url 
				}						
			history.pushState( state, state.title, this.url);			
			}		
		
		
		}
	this.saveNavPosition = function () 
		{
//		alert(this.objTitle);
		this.type = filter.type;
		var url = '';
/*		if(filter.isEmpty()==0)
			{*/
//		alert ('saveNavPosition: ' + this.type + ',  ' + this.objTitle + ',  ' + this.objName + ',  ' + this.objChildNum);
			if (this.type == 'construction') 
				{
				startTitleCut =  GetStrPrt(this.startTitle, this.titleSeparator, 1);
//				alert (this.startTitle + ', ' + startTitleCut);
				if(filter.spec == '')
					{
					url +=  this.startLocation + '/map/' + this.type + '/';
					this.title = (this.objTitle) ? this.objTitle : this.objName;
					this.url = this.startLocation + '/map/' + this.type + '/' + filter.getFilterURL();
//					this.title += this.titleSeparator + this.startTitle;	
					this.title += this.titleSeparator + startTitleCut;	
/*					
					if(this.startTitle.indexOf(this.title)<0)
						this.title += this.titleSeparator + this.startTitle;		
					else
						this.title = this.startTitle;
*/						
					UI.map_changeTitle(this.type, (this.objTitle) ? this.objTitle : this.objName, (filter.objId != '') ? 0 : this.objChildNum);					
					if (UI.panelName != '')
						UI.togglePanel('', UI.panelName, 0, '');
					}
				else if((filter.spec == 'lastFoto')||(filter.spec == 'lastObj')||(filter.spec == 'completed')||(filter.spec == 'all'))
					{
//					alert (this.type + ',  ' + this.objTitle + ',  ' + this.objName + ',  ' + this.objChildNum);
					this.title = (this.objTitle) ? this.objTitle : this.objName;
//					this.title += this.titleSeparator + this.startTitle;			
					this.title += this.titleSeparator + startTitleCut;		
					
					UI.map_changeTitle(this.type, (this.objTitle) ? this.objTitle : this.objName, this.objChildNum);					
					}
				}
			else if (this.type == 'firm') 
				{
//				alert('firm');
	//			this.objChildNum = 0;
				url +=  this.startLocation + '/map/' + this.type + '/';
				this.title = (this.objTitle) ? this.objTitle : this.objName;
				this.url = this.startLocation; // + '/' + this.objId;			
				
				if	((this.filterParam == '')&&(this.objId != '')&&(this.objId != 0))
					{
					url +=  this.objId;				
					this.objChildNum = 0;
					}
				this.title += this.titleSeparator + this.startTitle;			
				this.url = url;		
				UI.map_changeTitle(this.type, (this.objTitle) ? this.objTitle : this.objName, this.objChildNum);
				if (UI.panelName != '')
					UI.togglePanel('', UI.panelName, 0, '');
				}
//			}
		var altUrl = str_replace( 'map', 'list', this.url);
//		alert(altUrl);
		$("#otherView a").attr('href',   altUrl);
		document.title = this.title;
		
		if(this.enable)
			{
			var state = 
				{
				objId: 	this.objId,
				type: 	this.type,
				title: 	this.title,
				url:  	this.url 
				}						
			history.pushState( state, state.title, this.url);			
			}		
		}
	}