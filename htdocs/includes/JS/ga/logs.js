function detail()
	{
	var nodeName = document.getElementById('IDcurNode');	
	var nodeObj = document.getElementById(nodeName.value);
	var node = GetStrPrt(nodeName.value, '_', 1);
	var action =  document.getElementById('actionValueList').value + node;// + parId;
	return GB_showFullScreen('������������ ������/������', action, function(){/* itemSelect(nodeObj); */});
	}