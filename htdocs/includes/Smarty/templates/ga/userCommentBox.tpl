<script language="javascript1.2">
{*literal}
<!--
var MessageMax = "30000";
var Override = "";

function emo_pop()
{
window.open('index.php?act=legends&CODE=emoticons&s=','Legends','width=250,height=500,resizable=yes,scrollbars=yes'); 
}

function CheckLength() {
MessageLength = document.REPLIER.Post.value.length;
message = "";

	if (MessageMax !=0) {
	message = "���������:\n����������� ���������� ����� " + MessageMax + " ��������.";
		} else {
		message = "";
		}
	alert(message + "\n���� ������������ " + MessageLength + " ��������.");
}

function ValidateForm(isMsg) {
MessageLength = document.REPLIER.Post.value.length;
errors = "";

if (isMsg == 1)
{
	if (document.REPLIER.msg_title.value.length < 2)
	{
	errors = "���������� ������ ��������� ������";
	}
}

if (MessageLength < 2) {
errors = "�� ������ ������ ����� ���������!";
}
if (MessageMax !=0) {
	if (MessageLength > MessageMax) {
	errors = "����������� ���������� ����� " + MessageMax + " ��������. ������� �������: " + MessageLength;
	}
}
if (errors != "" && Override == "") {
	alert(errors);
	return false;
		} else {
		document.REPLIER.submit.disabled = true;
		return true;
	}
}

// IBC Code stuff

var text_enter_url = "������� ������ URL ������";
var text_enter_url_name = "������� �������� �����";
var text_enter_image = "������� ������ URL �����������";
var text_enter_email = "������� e-mail �����";
var text_enter_flash = "������� ������ URL ��� Flash.";
var text_code = "�������������: [CODE] ����� ��� ���.. [/CODE]";
var text_quote = "�������������: [QUOTE] ����� ���� ������.. [/QUOTE]";
var error_no_url = "�� ������ ������ URL";
var error_no_title = "�� ������ ������ ��������";
var error_no_email = "�� ������ ������ e-mail �����";
var error_no_width = "�� ������ ������ ������";
var error_no_height = "�� ������ ������ ������";
var prompt_start = "������� ����� ��� ��������������";

var help_bold = "������ ����� (alt + b)";
var help_italic = "��������� ����� (alt + i)";
var help_under = "������������ ����� (alt + u)";
var help_font = "����� ���� ������";
var help_size = "����� ������� ������";
var help_color = "����� ����� ������";
var help_close = "�������� ��� �������� �����";
var help_url = "���� ����������� (alt+ h)";
var help_img = "����������� (alt + g) [img]http://www.gorod-avto.com/img.gif[/img]";
var help_email = "���� E-mail ������ (alt + e)";
var help_quote = "���� ������ (alt + q)";
var help_list = "������� ������ (alt + l)";
var help_code = "���� ���� (alt + p)";
var help_click_close = "������� �� ������ ��� ��������";
var list_prompt = "������� ����� ������. ������� '������' ��� �������� ������ ��� ���������� ������";


//-->
{/literal*}
</script>
<div  name='COMMENTBOX' id='COMMENTBOX'>
<A name='COMMENTBOX'> ddd</A>
<FORM name='REPLIER' action={$content.form.form_action} method=post encType=multipart/form-data onSubmit='return ValidateForm()'>
{*
<input type='hidden' name='st' value='0'>
<input type='hidden' name='act' value='Post'>
<input type='hidden' name='f' value='54'>
<input type='hidden' name='CODE' value='03'>
<input type='hidden' name='t' value='135780'>*}
<TABLE cellSpacing=0 cellPadding=2 width="100%" border=0 >	
<tr> 
<td class='row1'>
<input type='radio' name='bbmode' value='ezmode' onClick='setmode(this.value)' style='DISPLAY:NONE;'> {*&nbsp;����������� �����</b><br>*}
<input type='radio' name='bbmode' value='normal' onClick='setmode(this.value)'  style='DISPLAY:NONE;' checked>{*&nbsp;<b>���������� �����</b>*}
</td>
</tr>
<tr>
<script language='Javascript' src='/includes/JS/ga/commentBox.js'></script>
<script language='Javascript' src='/includes/JS/ga/ibfcode.js'></script>
<td class='row1' width="100%" valign="top">
	<table cellpadding='2' cellspacing='2' width='100%' align='center'>
	<tr>
	<td nowrap width='10%'>
	<input type='button' accesskey='b' value=' B ' onClick='simpletag("B")' class='codebuttons' name='B' style="font-weight:bold" onMouseOver="hstat('bold')">
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
	&nbsp; <a href='javascript:closeall();' onMouseOver="hstat('close')">������� ��� ����</a>
	</td>
	</tr>
	<tr>
	<td align='left'>
	<input type='button' accesskey='h' value=' http:// ' onClick='tag_url()' class='codebuttons' name='url' onMouseOver="hstat('url')">
	<input type='button' accesskey='g' value=' ������� ' onClick='tag_image()' class='codebuttons' name='img' onMouseOver="hstat('img')">
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
	<textarea cols='60' style='width:95%' rows='15' wrap='soft' name='Post' onKeyPress='if (event.keyCode==10 || (event.ctrlKey && event.keyCode==13)) this.form.submit.click()' tabindex='3' class='textinput'></textarea>
</tr>	
{*
<tr> 
<td class='row1' width='100%' align='center'>
<input type='submit' name='submit' value='��������' tabindex='4' class='forminput'>&nbsp;
{*<input type='submit' name='preview' value='��������' tabindex='5' class='forminput'></td>
</tr>
*}
</table>
</div>
</form>
