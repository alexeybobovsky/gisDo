{*<DIV class='firm-profile'>*}
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
{if $option.showErrorBox} 
<FORM name='sendError' action='/company/set/alert/' method='post' encType='multipart/form-data'  >
	<DIV class='comment-box'>Вы нашли ошибку или у вас есть что добавить? 
						<SPAN id='caption_sendError'  class='captionOfHidden' onClick='commentBoxSwitcher(this, "Сообщите нам");'  > + Сообщите нам </SPAN>&nbsp; об этом
									</BR>
		<DIV id='body_sendError'  style='DISPLAY:NONE; '>				
{*		
			</BR><SMALL>Сообщение:</SMALL></BR>*}
			<TEXTAREA name='body'  cols='60' rows='5' style='margin-top: 5px; width:95%'  id='body' onClick='{literal}if(getElementById("errorTextEmpty").value==1){this.innerHTML=""; getElementById("errorTextEmpty").value=0;}{/literal}'
				onChange="EmptyCheckSimple(this.form, this, 'SUBMITRATE');" 		 
				onkeyup="EmptyCheckSimple(this.form, this, 'SUBMITRATE')"			>
В этом поле
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
			<INPUT  name='subject'    id='subject'  		 type='hidden'   		  		value='error_founded'>
			<INPUT  name='FIRMID'    id='FIRMID'  		 type='hidden'   		  		value='{$firm.firm_id}'>
			<INPUT  name='_REFERRER' id='_REFERRER'  		 type='hidden'   		  		value='{$menu.queryString}'>
			<INPUT  name="SUBMITRATE"  type="submit"   id="SUBMITRATE"   value="Готово" disabled>
		</DIV>
	</DIV>
</FORM>
{/if}
{if $option.showBossBox} 
<FORM name='sendBoss' action='/company/set/alert/' method='post' encType='multipart/form-data'  >
	<DIV class='comment-box'>Вы руководитель компании <strong>{$firm.firm_name}</strong>? Тогда вы можете самостоятельно управлять этой страницей! Для этого просто 
						<SPAN id='caption_sendBoss'  class='captionOfHidden' onClick='commentBoxSwitcher(this, "Расскажите нам");'  > + Расскажите нам </SPAN>&nbsp; о себе, и мы свяжемся с Вами! 
									</BR>
		<DIV id='body_sendBoss'  style='DISPLAY:NONE; '>				
			<TEXTAREA name='body'  cols='60' rows='5' style='margin-top: 5px; width:95%'  id='body' 
				onClick='{literal}if(getElementById("bossTextEmpty").value==1){this.innerHTML=""; getElementById("bossTextEmpty").value=0;}{/literal}'
				onChange="EmptyCheckSimple(this.form, this, 'SUBMITRATE');" 		 
				onkeyup="EmptyCheckSimple(this.form, this, 'SUBMITRATE')" >
Сообщите пожалуйста Ваши Фамилию, Имя , Отчество и контактную информацию (e-mail или телефон). Мы проверим Ваше отношение к компании {$firm.firm_name}, позвонив по одному из имеющихся в нашей базе телефонов, и в случае если Вас там знают как руководителя, мы предоставим Вам возможность самостоятельно сопровождать страницу Вашей фирмы.
			</TEXTAREA>
			{if $login}
			</BR><SMALL style='width:150px' > Ваше имя: </SMALL>
				<INPUT  name='anonymName' id='anonymName' type='text' value=''>			
			<SMALL style='width:150px' > Ваш E-mail: </SMALL>
				<INPUT  name='anonymContact' id='anonymContact' type='text' value=''>
			{/if}			
			<INPUT  name='bossTextEmpty' id='bossTextEmpty'  		 type='hidden'   		  		value='1'>
			<INPUT  name='recipient'    id='recipient'  		 type='hidden'   		  		value='SYS'>
			<INPUT  name='sender'    id='sender'  		 type='hidden'   		  		value='{$header.userId}'>
			<INPUT  name='subject'    id='subject'  		 type='hidden'   		  		value='boss_founded'>
			<INPUT  name='FIRMID'    id='FIRMID'  		 type='hidden'   		  		value='{$firm.firm_id}'>
			<INPUT  name='_REFERRER' id='_REFERRER'  		 type='hidden'   		  		value='{$menu.queryString}'>
			<INPUT  name="SUBMITRATE"  type="submit"   id="SUBMITRATE"   value="Готово" disabled>
		</DIV>
	</DIV>
</FORM>
{/if}
{if $option.showGuestBox} 
	<DIV class='firm-profile'>
		Внимание! Чтобы оставить свой отзыв или оценить деятельность этой компании, Вам нужно <a href='/entry'>войти на сайт</a></BR> 
{*		Если Вы уже регистрировались на нашем сайте, то зайти можно <A href=''>тут</A>.</BR>  
		Если Вы еще на регистрировались, то для этого нужно заполнить <A href=''>эту</A> форму. </BR> 
		Если Вы уже регистрировались у нас, но забыли свой пароль, то воспользуйтесь <A href=''>службой восстановления пароля</A>.*}
	</DIV>
{/if}
{*</DIV>*}
  </TD></TR>
</TBODY>
</TABLE>