<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title>{$edit.title}</title>
		<META http-equiv=Content-Type content="text/html; charset=windows-1251">		
		<meta name="robots" content="noindex, nofollow">
		<LINK href="/src/design/styles.css" type=text/css rel=stylesheet/>
	</head>
	{if $edit.type!='TEXT'}
		<body onLoad ="window.resizeTo({$windowSize.w}, {$windowSize.h}), windowChangePosition({$windowSize.w}, {$windowSize.h})">
	{else}
		<script language="JavaScript">
			var w = screen.availWidth - 150;
			var h = screen.availHeight - 100;
/*			var oEditor = FCKeditorAPI.GetInstance('PAR_VALUE');
			function FCKeditor_OnComplete(oEditor)
				{literal}{{/literal}
				    alert(oEditor.EditorWindow.Height) ;
					oEditor.Config['ScreenHeight'] = h - 150;
				{literal}}{/literal}

			alert(oEditor);*/
//			oEditor.Config['ScreenHeight'] = h - 150;
			

//			alert(screen.availWidth);
		</script>
		
		<body onLoad ="window.resizeTo(w, h); windowChangePosition(w, h)">
	{/if}
				{if $edit.form.form_emptyCheck}
				<script language="JavaScript" src="/includes/JS/script.js"></script>
				<script language="JavaScript" src="/includes/JS/tree_func.js"></script>				
				<script language="JavaScript">
					var necessary = new Array();
					var necessCount = 0;
				</script>
				{/if}
				<TABLE cellSpacing=3    cellPadding=1  border=0 width = "100%" >
					<tr>
						<td valign='top'  width = "100%">		{* height='100%'	*}
						<form name={$edit.form.form_name} action={$edit.form.form_action} method=post encType=multipart/form-data>									
						<fieldset>
						<legend>{$edit.table.table_label}</legend>
						  <TABLE style="MARGIN-LEFT: 1px; MARGIN-RIGHT: 1px" cellSpacing=0    cellPadding=1 border=0  width = "100%" >
						<TBODY id='{$edit.table.body_id}'>									
								<TR>
							{section name=el loop=$edit.elements}								
								{assign var="SMRT_EL" value=$edit.elements[el]}	
								{assign var="SMRT_INDX" value=$smarty.section.el.index}
								{if $SMRT_EL.necessary}
								<script language="JavaScript">
									necessary[necessCount] = "{$SMRT_EL.name}";
									necessCount ++;
								</script>
								{/if}
								{if $smarty.section.el.index<1}
								<tr>
								  <TD  width = "50%" style="PADDING-RIGHT: 5px; PADDING-LEFT: 5px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" align='left'>
								{else}
								  <TD  width = "100%" style="PADDING-RIGHT: 5px; PADDING-LEFT: 5px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" align='left' colspan = '10'>
								{/if}
									<B><SMALL>{$edit.el_caption[el]}
									{if $SMRT_EL.necessary}
											<font color=red>*</font>
									{else}
											&nbsp;
									{/if}</SMALL></B>
								<TABLE style="MARGIN: 0px" cellSpacing=0 cellPadding=0  width = "100%">
									  <TBODY>
									  <TR>
										<TD noWrap width="100%">
											{include file=$SMRT_EL.template}										 
										  </TD>
										</TR>
										</TBODY>
									</TABLE>
									</td>
								{if $smarty.section.el.index>0}
								</TR>
								{/if}
							{/section}
							{if $textEditor}
							<tr>
								<TD  width = "100%" style="PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; PADDING-TOP: 0px" align='left' colspan = '10'>
								<B><SMALL>{$edit.editorCaption}
									{*
									{if $SMRT_EL.necessary}
											<font color=red>*</font>
									{else}
											&nbsp;
									{/if}
									*}
									</SMALL></B>
								{$textEditor}
								</td>
							</tr>
							{/if}
										{assign var="SMRT_EL" value=$edit.uri}
											{include file=$SMRT_EL.template}
