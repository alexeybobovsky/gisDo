<SCRIPT src="/includes/jquery/jquery.js" type=text/javascript></SCRIPT>
<SCRIPT src="/includes/JS/gd/user.js" type=text/javascript></SCRIPT>
<script language="JavaScript">
var necessary = new Array();
var canCheckPsw = false;
var necessCount = 0;
var successImg = new Image();
	successImg.src = '{$header.body.imgSrc}hand_ok.gif';
var errorImg =  new Image();
	errorImg.src = '{$header.body.imgSrc}hand_nook.gif';
var waitImg = new Image();
	waitImg.src = '{$header.body.imgSrc}blueBars.gif';
var defImg = new Image();
	defImg.src = '{$header.body.imgSrc}_.gif';
</script>

<!-- Начало центральной части -->
<div id="titleBar">
	<div id='titleContent'>
	<h2>{$menu.lastTitle}</h2>
	</div>
</div>
<div id="pageContent">	

<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 width="100%" height="100%" >
<tr> <td valign = 'top'  width="50%" >
{*<H1 class="title"><nobr><img src="{$header.body.imgSrc}users.gif">{$menu.lastTitle}</nobr></h1><br />*}
{if $errorMsg}
	<TR>
		<TD align='center' colspan='2'>
		<DIV id='result' class='error' >{$errorMsg.text}</DIV>
		</TD>
	</TR>
{/if} 
	{section name=area loop=$contentHTML}
	<TABLE class="content list-row-2" cellSpacing=0 cellPadding=0 border=0 >
	{assign var="SMRTcontentArea" value=$contentHTML[area]}	
		{assign var="content" value=$SMRTcontentArea}
		<FORM name='{$content.form.form_name}' action='{$content.form.form_action}' method='post' encType='multipart/form-data' {if $content.form.form_onSubmit}onSubmit='{$content.form.form_onSubmit}'{/if} >
			{section name=el loop=$content.elements}			
			{assign var="SMRT_EL" value=$content.elements[el]}
			{if $content.el_caption[el]}
			<tr>
			 <td align=right valign="top" width="180">
				{$content.el_caption[el]}<div class="small red" style='color: #AA0000; font-size: 70%;' id='result_{$SMRT_EL.id}'></div>
			</td>
			<td valign="top">
				<SPAN id='DIV{$SMRT_EL.id}' {if $content.form.form_isHidden} style='DISPLAY:NONE;'{/if}>				
							{if $SMRT_EL.necessary}
							<script language="JavaScript">
								necessary[necessCount] = "{$SMRT_EL.id}";
								necessCount ++;
							</script>
							{/if}					

								{if !$SMRT_EL.skipTemplate}
									{include file='elements/'|cat:$SMRT_EL.template}
								{/if}
				</SPAN><SPAN><img id='resultImg_{$SMRT_EL.id}' src="{$header.body.imgSrc}_.gif" border=0><SPAN>
			</td>
			</tr>			
			{else}
				{if !$SMRT_EL.skipTemplate}
					{include file='elements/'|cat:$SMRT_EL.template}
				{/if}
			{/if}
			{/section}
			{if $content.elSubmit}
			<tr>
			<td align=right valign="top" width="180">&nbsp;</td>
			<td >	<br /><br />	
				{assign var="SMRT_EL" value=$content.elSubmit}
				<DIV>
				{include file=$SMRT_EL.template}
				</DIV>
			</td>
			</tr>
			{/if}
</FORM>	
</table>	
{/section}			

	</TD>

     <TD width="20"><IMG height=1  src="{$header.body.imgSrc}_.gif" width="20" border="0"></TD>
 <TD valign="top"><!-- Информация о фирме -->


<!-- Центральная информация / Список компаний -->

{if $helpString}
      <H3 class="title"><img src="{$header.body.imgSrc}warning.gif">&nbspИнформация</h3><br />
		<DIV class='help-message small gray'>
		{$helpString}
		</div>
{else}	    
&nbsp;
{/if}
   </TD>

</tr></table>
</div>