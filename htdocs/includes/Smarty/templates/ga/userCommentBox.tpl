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
	message = "Сообщение:\nМаксимально допустимая длина " + MessageMax + " символов.";
		} else {
		message = "";
		}
	alert(message + "\nВами использовано " + MessageLength + " символов.");
}

function ValidateForm(isMsg) {
MessageLength = document.REPLIER.Post.value.length;
errors = "";

if (isMsg == 1)
{
	if (document.REPLIER.msg_title.value.length < 2)
	{
	errors = "Необходимо ввести заголовок письма";
	}
}

if (MessageLength < 2) {
errors = "Вы должны ввести текст сообщения!";
}
if (MessageMax !=0) {
	if (MessageLength > MessageMax) {
	errors = "Максимально допустимая длина " + MessageMax + " символов. Текущие символы: " + MessageLength;
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

var text_enter_url = "Введите полный URL ссылки";
var text_enter_url_name = "Введите название сайта";
var text_enter_image = "Введите полный URL изображения";
var text_enter_email = "Введите e-mail адрес";
var text_enter_flash = "Введите полный URL для Flash.";
var text_code = "Использование: [CODE] Здесь Ваш код.. [/CODE]";
var text_quote = "Использование: [QUOTE] Здесь Ваша Цитата.. [/QUOTE]";
var error_no_url = "Вы должны ввести URL";
var error_no_title = "Вы должны ввести название";
var error_no_email = "Вы должны ввести e-mail адрес";
var error_no_width = "Вы должны ввести ширину";
var error_no_height = "Вы должны ввести высоту";
var prompt_start = "Введите текст для форматирования";

var help_bold = "Жирный текст (alt + b)";
var help_italic = "Наклонный текст (alt + i)";
var help_under = "Подчёркнутый текст (alt + u)";
var help_font = "Выбор типа шрифта";
var help_size = "Выбор размера шрифта";
var help_color = "Выбор цвета шрифта";
var help_close = "Закрытие все открытых тэгов";
var help_url = "Ввод гиперссылки (alt+ h)";
var help_img = "Изображение (alt + g) [img]http://www.gorod-avto.com/img.gif[/img]";
var help_email = "Ввод E-mail адреса (alt + e)";
var help_quote = "Ввод Цитаты (alt + q)";
var help_list = "Создать список (alt + l)";
var help_code = "Ввод кода (alt + p)";
var help_click_close = "Нажмите на кнопку для закрытия";
var list_prompt = "Введите пункт списка. Нажмите 'отмена' или оставьте пробел для завершения списка";


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
<input type='radio' name='bbmode' value='ezmode' onClick='setmode(this.value)' style='DISPLAY:NONE;'> {*&nbsp;Расширенный режим</b><br>*}
<input type='radio' name='bbmode' value='normal' onClick='setmode(this.value)'  style='DISPLAY:NONE;' checked>{*&nbsp;<b>Нормальный режим</b>*}
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
	<option value='0'>ШРИФТ</option>
	<option value='Arial' style='font-family:Arial'>Arial</option>
	<option value='Times' style='font-family:Times'>Times</option>
	<option value='Courier' style='font-family:Courier'>Courier</option>
	<option value='Impact' style='font-family:Impact'>Impact</option>
	<option value='Geneva' style='font-family:Geneva'>Geneva</option>
	<option value='Optima' style='font-family:Optima'>Optima</option>
	</select><select name='fsize' class='codebuttons' onchange="alterfont(this.options[this.selectedIndex].value, 'SIZE')" onMouseOver="hstat('size')">
	<option value='0'>РАЗМЕР</option>
	<option value='1'>Малый</option>
	<option value='7'>Большой</option>
	<option value='14'>Огромный</option>
	</select><select name='fcolor' class='codebuttons' onchange="alterfont(this.options[this.selectedIndex].value, 'COLOR')" onMouseOver="hstat('color')">
	<option value='0'>ЦВЕТ</option>
	<option value='blue' style='color:blue'>Синий</option>
	<option value='red' style='color:red'>Красный</option>
	<option value='purple' style='color:purple'>Фиолетовый</option>
	<option value='orange' style='color:orange'>Оранжевый</option>
	<option value='yellow' style='color:yellow'>Жёлтый</option>
	<option value='gray' style='color:gray'>Серый</option>
	<option value='green' style='color:green'>Зелёный</option>
	</select>
	&nbsp; <a href='javascript:closeall();' onMouseOver="hstat('close')">Закрыть все тэги</a>
	</td>
	</tr>
	<tr>
	<td align='left'>
	<input type='button' accesskey='h' value=' http:// ' onClick='tag_url()' class='codebuttons' name='url' onMouseOver="hstat('url')">
	<input type='button' accesskey='g' value=' Рисунок ' onClick='tag_image()' class='codebuttons' name='img' onMouseOver="hstat('img')">
	<input type='button' accesskey='e' value=' E-mail ' onClick='tag_email()' class='codebuttons' name='email' onMouseOver="hstat('email')">
	<input type='button' accesskey='q' value=' Цитировать ' onClick='simpletag("QUOTE")' class='codebuttons' name='QUOTE' onMouseOver="hstat('quote')">
	<input type='button' accesskey='p' value=' Код ' onClick='simpletag("CODE")' class='codebuttons' name='CODE' onMouseOver="hstat('code')">
	<input type='button' accesskey='l' value=' Список ' onClick='tag_list()' class='codebuttons' name="LIST" onMouseOver="hstat('list')">
	</td>
	</tr>
	<tr>
	<!-- Help Box -->
	<td align='left' valign='middle'>
	Открытые тэги:&nbsp;<input type='text' name='tagcount' size='3' maxlength='3' style='font-size:10px;font-family:verdana,arial;border:0px;font-weight:bold;' readonly class='row1' value="0">
	&nbsp;<input type='text' name='helpbox' size='50' maxlength='120' style='width:80%;font-size:10px;font-family:verdana,arial;border:0px' readonly class='row1' value="Подсказка: Наведите курсор на любой элемент для подсказки...">
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
<input type='submit' name='submit' value='Ответить' tabindex='4' class='forminput'>&nbsp;
{*<input type='submit' name='preview' value='Просмотр' tabindex='5' class='forminput'></td>
</tr>
*}
</table>
</div>
</form>
