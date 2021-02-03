{literal}
<script language="JavaScript">
function EmptyCheckSimple(the_form, obj, submitName)
	{
	if(document.forms[the_form.name].elements[obj.id].value!='')
		document.forms[the_form.name].elements[submitName].disabled = false;
	else
		document.forms[the_form.name].elements[submitName].disabled = true;
	}	
</script>
{/literal}
<TABLE cellSpacing=0 cellPadding=0 border=0 width='95%' >
	  <THEAD>
	</THEAD>
  <TBODY>
  <TR><TD class="firm-info-title" valign='bottom' width='95%' >
  {$feedback.title}
  </TD>
</TR>
  <TR><TD colspan='2'>  
<FORM name='sendError' action='/feedback/set/fMes/' method='post' encType='multipart/form-data'  >
	<DIV class='comment-box'>Если у Вас имеется несколько слов  по поводу нашего портала, </br>
	если у Вас есть предложения по его улучшению, </br>
	если у Вас имеются какие-то супер важные вопросы на которые можем ответить только мы,</br>
	или если Вы просто хотите нас похвалить или наоборот наругать - тогда 
						<SPAN id='caption_sendError'  class='captionOfHidden' onClick='commentBoxSwitcher(this, "Милости просим");'  > + Милости просим </SPAN>!&nbsp;</br>
	Кстати, Ваше сообщение прежде чем попасть на эту страницу, будет сначала нами прочитано а затем уже мы его опубликуем - если оно нам понравиться, конечно :) 
									</BR>
		<DIV id='body_sendError'  style='DISPLAY:NONE; '>				

		<TEXTAREA name='body'  cols='60' rows='5' style='margin-top: 5px; width:95%'  id='body' onClick='{literal}if(getElementById("errorTextEmpty").value==1){this.innerHTML=""; getElementById("errorTextEmpty").value=0;}{/literal}'
				onChange="EmptyCheckSimple(this.form, this, 'SUBMITRATE');" 		 
				onkeyup="EmptyCheckSimple(this.form, this, 'SUBMITRATE')"			>
			</TEXTAREA>
			{if $login}
			</BR><SMALL style='width:150px' > Ваше имя: </SMALL>
				<INPUT  name='anonymName' id='anonymName' type='text' value=''>			
			<SMALL style='width:150px' > Ваш E-mail: </SMALL>
				<INPUT  name='anonymContact' id='anonymContact' type='text' value=''>
			{/if}
			<INPUT  name='errorTextEmpty' id='errorTextEmpty'  		 type='hidden'   		  		value='1'>			
			<INPUT  name='recipient'    id='recipient'  		 type='hidden'   		  		value='SYS'>
			<INPUT  name='sender'    id='sender'  		 type='hidden'   		  		value='{$header.userId}'>
			<INPUT  name='subject'    id='subject'  		 type='hidden'   		  		value='feedback'>
			<INPUT  name='FIRMID'    id='FIRMID'  		 type='hidden'   		  		value='{$firm.firm_id}'>
			<INPUT  name='_REFERRER' id='_REFERRER'  		 type='hidden'   		  		value='{$menu.queryString}'>
			<INPUT  name="SUBMITRATE"  type="submit"   id="SUBMITRATE"   value="Написать!" disabled>
		</DIV>
	</DIV>
</FORM>


  </TD></TR>
  <TR><TD colspan='2' width='100%' align='left'>  </br>