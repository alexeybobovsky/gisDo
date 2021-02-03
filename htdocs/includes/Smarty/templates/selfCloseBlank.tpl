<html>
<head>
{*
<SCRIPT src="/includes/jquery/jquery.js" type=text/javascript></SCRIPT>
<SCRIPT src="/includes/jquery/jeditable.js" type=text/javascript></SCRIPT><SCRIPT type=text/javascript>
var wnd = window.opener;
var doc = wnd.document;
var cont = eval('doc.all.' + 'divCaption');
$.post("/GetHTML/properties/", {literal}{{/literal}node:{$nodeId}{literal}}{/literal}, function(str) 
	{literal}{{/literal}
	cont.innerHTML = str;	
	{literal}}{/literal}
	);
</SCRIPT>
*}
<body onLoad='opener.history.go(0); self.close()'>
</body>
</head>
</html>