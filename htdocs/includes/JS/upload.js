function showFileList()
	{
	var url = '/upload/list';
	var select = document.getElementById('IDPRECATALOGS');	
	var text = document.getElementById('IDUSERCATALOG');	
	if(text.value !='')
		url += text.value;
	else
		url += select.value;		
	var name = 'editConsole';
	var w = 600;
	var h = 600;
	var scroll =1;
	open_window(url, name, w, h, scroll);
	}