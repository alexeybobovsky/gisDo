var defSpeed = 90;
var oldTyres = '1757013';
var newTyres = '1757013';
function tyresChange() 
	{	
	var recalcBtn = document.getElementById('calcTyresBtn');
	
	var oldWidth=document.getElementById('oldWidth');
	var oldProfile=document.getElementById('oldProfile');
	var oldRadius=document.getElementById('oldRadius');
	var newWidth=document.getElementById('newWidth');
	var newProfile=document.getElementById('newProfile');
	var newRadius=document.getElementById('newRadius');
	
	var newTyresTmp = newWidth.value+newProfile.value+newRadius.value;
	var oldTyresTmp = oldWidth.value+oldProfile.value+oldRadius.value;
	if((newTyresTmp!=oldTyresTmp)&&((newTyresTmp!=newTyres)||(oldTyresTmp!=oldTyres)))
		recalcBtn.className = 'calcSpeedActive';
	else
		recalcBtn.className = 'calcSpeedInactive';		
	}
function searchTyres(btn)
	{
	if(btn.className == 'calcSpeedActive')
		{
		var searchBtn = document.getElementById('searchTyresBtn');
		var newWidth=document.getElementById('newWidth');
		var newProfile=document.getElementById('newProfile');
		var newRadius=document.getElementById('newRadius');		
		
		var searchedWidth = document.getElementById('W');
		var searchedProfile = document.getElementById('H');
		var searchedRadius = document.getElementById('R');
		var searchedSeason = document.getElementById('SEASON');
		var searchedMark = document.getElementById('MARK');
		
		var form = searchedWidth.form;
		searchedWidth.value = newWidth.value;
		searchedProfile.value = newProfile.value;
		searchedRadius.value = newRadius.value;
		searchedSeason.value = '0';
		searchedMark.value = '0';
		form.submit();				
		}		
	}
function calcTyres(btn)
	{
	if(btn.className == 'calcSpeedActive')
		{
		var searchBtn = document.getElementById('searchTyresBtn');
		var oldWidth=document.getElementById('oldWidth');
		var oldProfile=document.getElementById('oldProfile');
		var oldRadius=document.getElementById('oldRadius');
		var newWidth=document.getElementById('newWidth');
		var newProfile=document.getElementById('newProfile');
		var newRadius=document.getElementById('newRadius');		
		newTyres = newWidth.value+newProfile.value+newRadius.value;
		oldTyres = oldWidth.value+oldProfile.value+oldRadius.value;
		btn.className = 'calcSpeedInactive';	
		searchBtn.className = 'calcSpeedActive';	
		calculateshi();
		calculateWidth();		
		}
	}
function recalcSpeed(btn)
	{
	if(btn.className == 'calcSpeedActive')
		{
		var oldSpeed = document.getElementById('oldSpeed');
		defSpeed = oldSpeed.value;
		btn.className = 'calcSpeedInactive';	
		calculateshi();
		}
	}
function speedChange(speed) 
	{
	var recalcBtn = document.getElementById('recalcSpeed');
	if((speed.value != '') && (speed.value != defSpeed))
		recalcBtn.className = 'calcSpeedActive';
	else
		recalcBtn.className = 'calcSpeedInactive';		
	}

function calculateshi() {
	var oldAshi=document.getElementById('oldAshi');
	var oldWidth=document.getElementById('oldWidth');
	var newWidth=document.getElementById('newWidth');
	var newA=document.getElementById('newA');
	var difAshi=document.getElementById('difAshi');
	var oldC=document.getElementById('oldC');
	var newC=document.getElementById('newC');
	var difC=document.getElementById('difC');
	var oldD=document.getElementById('oldD');
	var newD=document.getElementById('newD');
	var difD=document.getElementById('difD');
	var oldB=document.getElementById('oldB');
	var newB=document.getElementById('newB');
	var difB=document.getElementById('difB');

	var difClearense=document.getElementById('difClearense');
	var newSpeed=document.getElementById('newSpeed');
	var oldSpeed=document.getElementById('oldSpeed');
	var difSpeed=document.getElementById('difSpeed');
	var newRadius=document.getElementById('newRadius');
	var oldRadius=document.getElementById('oldRadius');
	var oldProfile=document.getElementById('oldProfile');
	var newProfile=document.getElementById('newProfile');


	oldAshi.innerHTML = oldWidth.value;
	newA.innerHTML = newWidth.value;
	difAshi.innerHTML = newA.innerHTML - oldAshi.innerHTML;

	oldC.innerHTML = Math.round(oldRadius.value*25.4);
	newC.innerHTML = Math.round(newRadius.value*25.4);
	difC.innerHTML = newC.innerHTML - oldC.innerHTML;

	oldD.innerHTML = Math.round(oldWidth.value*oldProfile.value*0.02
      +oldRadius.value*25.4);
	newD.innerHTML = Math.round(newWidth.value*newProfile.value*0.02
      +newRadius.value*25.4);
	difD.innerHTML = newD.innerHTML - oldD.innerHTML;

	oldB.innerHTML = Math.round((oldD.innerHTML - oldC.innerHTML)/2);
	newB.innerHTML = Math.round((newD.innerHTML - newC.innerHTML)/2);
	difB.innerHTML = newB.innerHTML - oldB.innerHTML;

	difClearense.innerHTML = (Math.round(newWidth.value*newProfile.value*0.02
      +newRadius.value*25.4)
      -Math.round(oldWidth.value*oldProfile.value*0.02
      +oldRadius.value*25.4))/2;

  newSpeed.innerHTML = Math.round((Math.round(newWidth.value*newProfile.value*0.02
      +newRadius.value*25.4)
      /Math.round(oldWidth.value*oldProfile.value*0.02
      +oldRadius.value*25.4))*oldSpeed.value*100)/100;
  difSpeed.innerHTML = Math.round((newSpeed.innerHTML - oldSpeed.value)*100)/100;

}


function calculateWidth()
{
	 var width = document.getElementById('newWidth').value;
	 var profile = document.getElementById('newProfile').value;
	 var radius = document.getElementById('newRadius').value;

	 if(profile<50) scalar=0.85;
	 if(profile>=50) scalar=0.7;

	 rimWidthMin = (Math.round(((width*scalar)*0.03937)*2))/2;
	 rimWidthMax = (rimWidthMin+1.5);

	 document.getElementById('resultWidthMin').innerHTML = rimWidthMin;
	 document.getElementById('resultWidthMax').innerHTML = rimWidthMax;
	 document.getElementById('resultDiameter').innerHTML = radius;
}


