<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<HTML>
	<HEAD>
		<TITLE>FileManager</TITLE>
		<META http-equiv=Content-Type content="text/html; charset=windows-1251">
		<LINK href="/src/design/admin.css" type=text/css rel=stylesheet>
		<link href="/src/design/greybox.css" rel="stylesheet" type="text/css" media="all" >
		<script type="text/javascript" src="/includes/js/script.js"></script>	
	</head>
	<BODY>
		<TABLE height="100%" width="100%" border=0 class='MainBorder'> 
		 <TR>
			<TD>
<!--<script language="JavaScript" src="/includes/JS/script.js"></script>-->
<script language="JavaScript">
function viewFile(file)
	{literal}{{/literal}
	form = document.getElementById('fm');
	form.action += 'view/' + file;
	form.submit();
	{literal}}{/literal}
function deleteFile(file)
	{literal}{{/literal}
	form = document.getElementById('fm');
	form.action += 'delete/' + file;
	form.submit();
	{literal}}{/literal}
</script>
{$content} 