<A  name='COMMENTBOX'></A>
<TABLE cellSpacing=0 cellPadding=2 width="100%" border=0 >	
<tr> 
<td class='row1'>
<input type='radio' name='bbmode' value='ezmode' onClick='setmode(this.value)' style='DISPLAY:NONE;'checked > 
<input type='radio' name='bbmode' value='normal' onClick='setmode(this.value)'  style='DISPLAY:NONE;' ></td>
</tr>
<tr>
<script language='Javascript' src='/includes/JS/ga/commentBox.js'></script>
<script language='Javascript' src='/includes/JS/ga/ibfcode.js'></script>
<td class='row1' width="100%" valign="top">
	<table cellpadding='2' cellspacing='2' width='100%' align='center'>
	<tr>
	<td nowrap width='10%'>
	<input type='button' accesskey='b' value=' B ' onClick='bbstyle(this, 0)' class='codebuttons' name='B' style="font-weight:bold" onMouseOver="hstat('bold')">
	<input type='button' accesskey='i' value=' I ' onClick='simpletag("I")' class='codebuttons' name='I' style="font-style:italic" onMouseOver="hstat('italic')">
	<input type='button' accesskey='u' value=' U ' onClick='simpletag("U")' class='codebuttons' name='U' style="text-decoration:underline" onMouseOver="hstat('under')">

	<select name='ffont' class='codebuttons' onchange="alterfont(this.options[this.selectedIndex].value, 'FONT')" onMouseOver="hstat('font')">
	<option value='0'>�����</option>
	<option value='Arial' style='font-family:Arial'>Arial</option>
	<option value='Times' style='font-family:Times'>Times</option>
	<option value='Courier' style='font-family:Courier'>Courier</option>
	<option value='Impact' style='font-family:Impact'>Impact</option>
	<option value='Geneva' style='font-family:Geneva'>Geneva</option>
	<option value='Optima' style='font-family:Optima'>Optima</option>
	</select><select name='fsize' class='codebuttons' onchange="alterfont(this.options[this.selectedIndex].value, 'SIZE')" onMouseOver="hstat('size')">
	<option value='0'>������</option>
	<option value='1'>�����</option>
	<option value='7'>�������</option>
	<option value='14'>��������</option>
	</select><select name='fcolor' class='codebuttons' onchange="alterfont(this.options[this.selectedIndex].value, 'COLOR')" onMouseOver="hstat('color')">
	<option value='0'>����</option>
	<option value='blue' style='color:blue'>�����</option>
	<option value='red' style='color:red'>�������</option>
	<option value='purple' style='color:purple'>����������</option>
	<option value='orange' style='color:orange'>���������</option>
	<option value='yellow' style='color:yellow'>Ƹ����</option>
	<option value='gray' style='color:gray'>�����</option>
	<option value='green' style='color:green'>������</option>
	</select>
	&nbsp; <a href='javascript:closeall(); bbstyle(this, -1)' onMouseOver="hstat('close')">������� ��� ����</a>
	</td>
	</tr>
	<tr>
	<td align='left'>
	<input type='button' accesskey='h' value=' http:// ' onClick='tag_url()' class='codebuttons' name='url' onMouseOver="hstat('url')">
	<input type='button' accesskey='g' value=' ������� ' onClick='UpImage()' class='codebuttons' name='img' onMouseOver="hstat('img')">
	{*<input type='button' accesskey='g' value=' ������� ' onClick='tag_image()' class='codebuttons' name='img' onMouseOver="hstat('img')">*}
	<input type='button' accesskey='e' value=' E-mail ' onClick='tag_email()' class='codebuttons' name='email' onMouseOver="hstat('email')">
	<input type='button' accesskey='q' value=' ���������� ' onClick='simpletag("QUOTE")' class='codebuttons' name='QUOTE' onMouseOver="hstat('quote')">
	<input type='button' accesskey='p' value=' ��� ' onClick='simpletag("CODE")' class='codebuttons' name='CODE' onMouseOver="hstat('code')">
	<input type='button' accesskey='l' value=' ������ ' onClick='tag_list()' class='codebuttons' name="LIST" onMouseOver="hstat('list')">
	</td>
	</tr>
	<tr>
	<!-- Help Box -->
	<td align='left' valign='middle'>
	�������� ����:&nbsp;<input type='text' name='tagcount' size='3' maxlength='3' style='font-size:10px;font-family:verdana,arial;border:0px;font-weight:bold;' readonly class='row1' value="0">
	&nbsp;<input type='text' name='helpbox' size='50' maxlength='120' style='width:80%;font-size:10px;font-family:verdana,arial;border:0px' readonly class='row1' value="���������: �������� ������ �� ����� ������� ��� ���������...">
	</td>
	</tr>
	</table>
	</td>
</tr>
<tr> 
<td class='row1' width='100%' valign='top'>
	<textarea cols='60' style='width:95%' rows='15' wrap='soft' name='Post' onKeyPress='if (event.keyCode==10 || (event.ctrlKey && event.keyCode==13)) this.form.submit.click()' tabindex='3' class='textinput' id='commentText'></textarea>
</tr>	

</table>