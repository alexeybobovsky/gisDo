<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<HTML>
	<HEAD>
		<TITLE>{$header.body.title}  
{section name=title loop=$menu.curTitle}
| {$menu.curTitle[title]}
{/section}</TITLE>
		{*<META http-equiv=Content-Type content="text/html; charset=windows-1251">*}
		<META http-equiv=Content-Type content="text/html; =charset=UTF-8">
		<LINK href="/src/design/admin.css" type=text/css rel=stylesheet>
	</head>
	<BODY>
	<SCRIPT src="/includes/jquery/jquery.js" type=text/javascript></SCRIPT>		
	<TABLE height="100%" width="100%" border=0 {* class='MainBorder'*}> 
		 <TR>
			<TD >