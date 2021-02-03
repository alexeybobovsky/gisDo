	{**}
	&nbsp;
    </td>
    <td width="15"><img src="{$header.body.imgSrc}_.gif" width="15"></td>
    <td valign="top" width="300" valign="top">
<!-- логин форма -->
{*<br />*}
<SPAN id='caption_search'  class='captionOfHidden' onClick='commentBoxSwitcher(this, "Поиск");'  title='Поиск'>+ Поиск </SPAN>
	<form name="SEARCHFORM" action="/search/" method="post" enctype="multipart/form-data">									
	<DIV id='body_search'  class='body_logon' style='DISPLAY:NONE; '>	
		<table width="100%" border="0" cellpadding="0" cellspacing="2">
			<tbody><tr>
			<td width='50%';>
			<input name="searchString"  id="searchString" style="width: 100%;" type="text">
			</td>
			<td>
			<input name="submitImg" type="submit" value='&#8594;'>
			<td>
			</tr>
			</tbody>
		</table>	
	</DIV>
	</form>
</td>
<td valign="top">
{if $logout}
<TABLE>
<TBODY>
	<TR>
	<td align="right" valign='top' nowrap colspan=10><span>Здраствуйте, <strong>{$header.userName}</strong></span></td>
	</TR>
	<TR>
		<TD>
		<A href='/user/{$header.userName}'>Ваш профиль</A>
		</TD>
	</TR>
	{if $newMessages.cnt}
	<TR>
		<TD>
		<A href='/user/{$header.userName}/message'>{$newMessages.cnt} {$newMessages.name}</A>
		</TD>
	</TR>
	{/if}
	<TR>
		<TD>
		<A href='/login/logoff'>Покинуть сайт</A>
		</TD>
	</TR>
</TBODY>
</TABLE>
{else}
<TABLE width="100%" border="0" cellpadding="0" cellspacing="0">
		<TBODY>
			<TR>
			<TD valign='top' {*align='right'*}>
				<SPAN id='caption_logon'  class='captionOfHidden' onClick='commentBoxSwitcher(this, "Быстрый вход");'  > + Быстрый вход </SPAN>									
			</TD>
			</TR>
			<TR>
			<TD valign='top'>
			<DIV id='body_logon'  class='body_logon' style='DISPLAY:NONE; '>	
			<form name="LOGFORM" action="/login/" method="post" enctype="multipart/form-data">									
					<table {*width="100%"*} border="0" cellpadding="0" cellspacing="2">
		                <tbody><tr>
		                    <td>&nbsp;</td>
							
		                    <td {*align="right"*} nowrap="nowrap">
									{*<span class="style1">*}
										Пользователь
									{*</span>*}
								</td>
		                    <td width="50%">
									<input name="Username" class="input-light" style="width: 100%;" type="text">
								</td>
							</tr>
							<tr>
							 <td>&nbsp;</td>
		                    <td {*align="right"*} nowrap="nowrap">
									{*<span style="color: rgb(255, 255, 255);">*}
										Пароль
									{*</span>*}
								</td>
		                    <td width="50%">
									<input name="Password" class="input-light" style="width: 100%;" type="password">
									<input name="saveMe" value="1" type="hidden">
								</td>
							   <td width="17">
									{*<input name="submitImg" onclick="this.form.submit()" src="ksr_003_files/butt-img.gif" type="image" width="17" border="0" height="17">*}
									<input name="submitImg" type="submit" value='&#8594;'>
									{*<span name="submitImg" id="submitImg" style='cursor:pointer; ' onclick="this.form.submit()" style="" >&#8594;</SPAN>*}
								</td>
		                  </tr>
		                </tbody>
					</table>	
			</form>
			</DIV>
			</TD>
			</TR>
			<TR>
			<TD>
			<A href='/registration'>Регистрация</A>
			</TD>
			</TR>
			<TR>
			<TD>
			<A href='/password'>Восстановление пароля</A>
			</TD>
			</TR>
		</TBODY>
	</TABLE>					
{/if}
	</td>
    </td>
   </tr>
  </table>


</td>

<td width="5" rowspan='4'><img src="{$header.body.imgSrc}_.gif" width="5"></td>
</tr>
<tr>
<td colspan='2'>
<!-- Центральная часть -->

  <table width="100%" border="0" cellpadding="0" cellspacing="0">
   <tr>
    <td valign="top">
<!-- основной контент -->