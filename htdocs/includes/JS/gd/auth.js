function showYastchik()
	{
	$('#eml').html('<a href="mailto:post@gorod-detyam.ru" class="mailto" title="Email">по почте</a>')
	}
function openAuthPanel(obj)
	{
	var winName = 	'authWindow';
	var url = 		'/login/' + obj.id;
	var left, top, width, height;
	width = 		500;
	height = 		500;
	left =  		UI.windowWidth/2 - width/2;
	top =  			UI.windowHeight/2 - height/2;
	var winParams = 'width=' + width + ',height=' + height + ',left=' + left + ',top=' + top + ',resizable=yes,scrollbars=yes,status=no';
	var newWin = window.open(url, winName , winParams);
	newWin.onClose = function(){window.opener.location.reload(true)};
	newWin.focus();
	}
function submitAuthForm()
	{
	var error = 0;
	if(document.getElementById('Username').value == '')
		error += 1;
	if(document.getElementById('Password').value == '')
		error += 2;
	if(error == 0)	
		document.getElementById('authForm').submit();
/*	else
		
		alert('')*/
	}