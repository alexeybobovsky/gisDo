var MessageMax = "30000";
var Override = "";
var bbcode = new Array();
var imageTag = false;
//var imageSrc = 'sssss';
function open_window(url, name, w, h, scroll)
	{
	var tmp = "scrollbars=no";
	if (scroll)
		tmp = "scrollbars=yes";	
	var window_top = screen.availHeight/2 - h/2;
	var window_left = screen.availWidth/2 - w/2;
	var pos = tmp+", height="+h+", width="+w +", left="+window_left+", top="+window_top;
	windowConsole = window.open(url, name, pos);
	windowConsole.focus();
	
//	return 1;
	}
function UpImage()
	{
	var strPage = "/tools/upImg";
	var strAttr = "status:no;dialogWidth:450px;dialogHeight:450px;help:no";
//	alert(document.forms['REPLIER']);
//	var html=showModalDialog(strPage, "", strAttr);
	var html=open_window(strPage, 'upImg', 450, 450, 0);
/*	if(html)
		insertAtCaret(html,'');
	document.REPLIER.Post.focus();*/
	}
function bbstyle(btn, bbnumber) 
	{
	var bbtags = new Array('[b]','[/b]','[i]','[/i]','[u]','[/u]','[quote]','[/quote]','[code]','[/code]','[list]','[/list]','[list=]','[/list]','[img]','[/img]','[url]','[/url]');
//	var htmltags = new Array('<b>','</b>','<i>','</i>','<u>','</u>');
	var txtarea = document.REPLIER.Post;
	var clientVer = myVersion;
	txtarea.focus();
	var donotinsert = false;
	var theSelection = false;
	var bblast = 0;
	if (bbnumber == -1) 
		{ // Close all open tags & default button names
		var btnB = document.REPLIER.B;
		var btnI = document.REPLIER.I;
		var btnU = document.REPLIER.U;
		var tg = '';
//		var btnAct;
		while (bbcode[0]) 
			{
			butnumber = arraypop(bbcode) - 1;
			txtarea.value += bbtags[butnumber + 1];	
			
			tg = bbtags[butnumber].substr(1, (bbtags[butnumber].length - 2));
			tg = tg.toUpperCase( );
			if(btnB.name == tg)
				{
				btnAct = btnB;
				}
			if(btnAct)
				{
				buttext = btnAct.value;				
				btnAct.value = buttext.substr(0, (buttext.length - 1));	
				btnAct = null;
				}
/*				buttext = eval('document.MessageForm.addbbcode' + butnumber + '.value');
				eval('document.MessageForm.addbbcode' + butnumber + '.value =\"' + buttext.substr(0,(buttext.length - 1)) + '\"');*/
			}
		imageTag = false; // All tags are closed including image tags :D
		txtarea.focus();
		return;
		}
	if ((clientVer >= 4) && is_ie && is_win)		
		{
		theSelection = document.selection.createRange().text; // Get text selection
		if (theSelection) 
			{
			// Add tags around selection
			document.selection.createRange().text = bbtags[bbnumber] + theSelection + bbtags[bbnumber+1];
			txtarea.focus();
			theSelection = '';
			return;
			}
		}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))	
		{
			mozWrap(txtarea, bbtags[bbnumber], bbtags[bbnumber+1]);
			return;
		}

	// Find last occurance of an open tag the same as the one just clicked
	for (i = 0; i < bbcode.length; i++) 
		{
		if (bbcode[i] == bbnumber+1) 
			{		
			bblast = i;
			donotinsert = true;
			}
		}
	if (donotinsert) 
		{      // Close all open tags up to the one just clicked & default button names
		while (bbcode[bblast]) 
			{
			butnumber = arraypop(bbcode) - 1;
			txtarea.value += bbtags[butnumber + 1];
			buttext = btn.value;
//			buttext = eval('document.MessageForm.addbbcode' + butnumber + '.value');
//			eval('document.MessageForm.addbbcode' + butnumber + '.value =\"' + buttext.substr(0,(buttext.length - 1)) + '\"');
			btn.value = buttext.substr(0,(buttext.length - 1));
			imageTag = false;
			}
			txtarea.focus();
			return;
		} 
	else 
		{ // Open tags
		if (imageTag && (bbnumber != 14)) 
			{     // Close image tag before adding another
			txtarea.value += bbtags[15];
			lastValue = arraypop(bbcode) - 1;   // Remove the close image tag from the list
			document.MessageForm.addbbcode14.value = "Img";  // Return button back to normal state
			imageTag = false;
			}
		// Open tag
//		alert(bbtags);
		txtarea.value += bbtags[bbnumber];
		if ((bbnumber == 14) && (imageTag == false)) imageTag = 1; // Check to stop additional tags after an unclosed image tag
		arraypush(bbcode,bbnumber+1);
//		eval('document.REPLIER.addbbcode'+bbnumber+'.value += \"*\"');
		btn.value += "*";
		txtarea.focus();
		return;
		}
	storeCaret(txtarea);
	}
function storeCaret(textEl) 
	{
	if (textEl.createTextRange) textEl.caretPos = document.selection.createRange().duplicate();	
	}
function arraypop(thearray) 
	{
	thearraysize = getarraysize(thearray);
	retval = thearray[thearraysize - 1];
	delete thearray[thearraysize - 1];
	return retval;
	}
function arraypush(thearray,value) 
	{
		thearray[ getarraysize(thearray) ] = value;
	}
// Replacement for arrayname.length property
function getarraysize(thearray) 
	{
	for (i = 0; i < thearray.length; i++) 
		{
		if ((thearray[i] == "undefined") || (thearray[i] == "") || (thearray[i] == null))
			return i;
		}
	return thearray.length;
	}

// From http://www.massless.org/mozedit/
function mozWrap(txtarea, open, close)
	{
	var selLength = txtarea.textLength;
	var selStart = txtarea.selectionStart;
	var selEnd = txtarea.selectionEnd;
	if (selEnd == 1 || selEnd == 2)
		selEnd = selLength;

	var s1 = (txtarea.value).substring(0,selStart);
	var s2 = (txtarea.value).substring(selStart, selEnd)
	var s3 = (txtarea.value).substring(selEnd, selLength);
	txtarea.value = s1 + open + s2 + close + s3;
	return;
	}




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
/*		document.REPLIER.submit.disabled = true;*/
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

var help_bold = "������ �����";
var help_italic = "��������� �����";
var help_under = "������������ �����";
var help_font = "����� ���� ������";
var help_size = "����� ������� ������";
var help_color = "����� ����� ������";
var help_close = "�������� ��� �������� �����";
var help_url = "���� �����������";
var help_img = "�������� �����������";
var help_email = "���� E-mail ������";
var help_quote = "���� ������";
var help_list = "������� ������";
var help_code = "���� ���� ";
var help_click_close = "������� �� ������ ��� ��������";
var list_prompt = "������� ����� ������. ������� '������' ��� �������� ������ ��� ���������� ������";
/*
var help_bold = "������ ����� (alt + b)";
var help_italic = "��������� ����� (alt + i)";
var help_under = "������������ ����� (alt + u)";
var help_url = "���� ����������� (alt+ h)";
var help_img = "����������� (alt + g) [img]http://www.gorod-avto.com/img.gif[/img]";
var help_email = "���� E-mail ������ (alt + e)";
var help_quote = "���� ������ (alt + q)";
var help_list = "������� ������ (alt + l)";
var help_code = "���� ���� (alt + p)";
*/
