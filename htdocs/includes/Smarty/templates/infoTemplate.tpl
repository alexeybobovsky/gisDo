<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<HTML>
	<HEAD>
		<TITLE>{$header.body.title}</TITLE>
		<META http-equiv=Content-Type content="text/html; charset=windows-1251">
		<LINK href="{$header.body.cssSrc}/main.css" type=text/css rel=stylesheet>
	</head>
	<BODY>
	<SCRIPT src="/includes/jquery/jquery.js" type=text/javascript></SCRIPT>		
	<TABLE height="100%" width="100%" border=0 class='MainBorder'> 
		 <TR>
			<TD>
				{section name=parents loop=$parents.all}
				<img src="{$header.body.imgSrc}arrow-sm-green.gif" width="6" height="9" border="0" align="absmiddle">
					{$parents.all[parents].name}
				{/section}		
			</td>
		</TR>
		 <TR>
			<TD>
				{$info.body.full_descr}
			</td>
		</TR>
	</TABLE>
	</BODY>
</HTML>