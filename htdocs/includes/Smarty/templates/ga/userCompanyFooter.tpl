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
	<DIV class='comment-box'>�� ����� ������ ��� � ��� ���� ��� ��������? 
						<SPAN id='caption_sendError'  class='captionOfHidden' onClick='commentBoxSwitcher(this, "�������� ���");'  > + �������� ��� </SPAN>&nbsp; �� ����
									</BR>
		<DIV id='body_sendError'  style='DISPLAY:NONE; '>				
{*		
			</BR><SMALL>���������:</SMALL></BR>*}
			<TEXTAREA name='body'  cols='60' rows='5' style='margin-top: 5px; width:95%'  id='body' onClick='{literal}if(getElementById("errorTextEmpty").value==1){this.innerHTML=""; getElementById("errorTextEmpty").value=0;}{/literal}'
				onChange="EmptyCheckSimple(this.form, this, 'SUBMITRATE');" 		 
				onkeyup="EmptyCheckSimple(this.form, this, 'SUBMITRATE')"			>
� ���� ����
			</TEXTAREA>
			{if $login}
			</BR><SMALL style='width:150px' > ���� ���: </SMALL>
				<INPUT  name='anonymName' id='anonymName' type='text' value=''>			
			<SMALL style='width:150px' > ��� E-mail: </SMALL>
				<INPUT  name='anonymContact' id='anonymContact' type='text' value=''>
			{/if}
			<INPUT  name='errorTextEmpty' id='errorTextEmpty'  		 type='hidden'   		  		value='1'>			
			<INPUT  name='recipient'    id='recipient'  		 type='hidden'   		  		value='SYS'>
			<INPUT  name='sender'    id='sender'  		 type='hidden'   		  		value='{$header.userId}'>
			<INPUT  name='subject'    id='subject'  		 type='hidden'   		  		value='error_founded'>
			<INPUT  name='FIRMID'    id='FIRMID'  		 type='hidden'   		  		value='{$firm.firm_id}'>
			<INPUT  name='_REFERRER' id='_REFERRER'  		 type='hidden'   		  		value='{$menu.queryString}'>
			<INPUT  name="SUBMITRATE"  type="submit"   id="SUBMITRATE"   value="������" disabled>
		</DIV>
	</DIV>
</FORM>
{/if}
{if $option.showBossBox} 
<FORM name='sendBoss' action='/company/set/alert/' method='post' encType='multipart/form-data'  >
	<DIV class='comment-box'>�� ������������ �������� <strong>{$firm.firm_name}</strong>? ����� �� ������ �������������� ��������� ���� ���������! ��� ����� ������ 
						<SPAN id='caption_sendBoss'  class='captionOfHidden' onClick='commentBoxSwitcher(this, "���������� ���");'  > + ���������� ��� </SPAN>&nbsp; � ����, � �� �������� � ����! 
									</BR>
		<DIV id='body_sendBoss'  style='DISPLAY:NONE; '>				
			<TEXTAREA name='body'  cols='60' rows='5' style='margin-top: 5px; width:95%'  id='body' 
				onClick='{literal}if(getElementById("bossTextEmpty").value==1){this.innerHTML=""; getElementById("bossTextEmpty").value=0;}{/literal}'
				onChange="EmptyCheckSimple(this.form, this, 'SUBMITRATE');" 		 
				onkeyup="EmptyCheckSimple(this.form, this, 'SUBMITRATE')" >
�������� ���������� ���� �������, ��� , �������� � ���������� ���������� (e-mail ��� �������). �� �������� ���� ��������� � �������� {$firm.firm_name}, �������� �� ������ �� ��������� � ����� ���� ���������, � � ������ ���� ��� ��� ����� ��� ������������, �� ����������� ��� ����������� �������������� ������������ �������� ����� �����.
			</TEXTAREA>
			{if $login}
			</BR><SMALL style='width:150px' > ���� ���: </SMALL>
				<INPUT  name='anonymName' id='anonymName' type='text' value=''>			
			<SMALL style='width:150px' > ��� E-mail: </SMALL>
				<INPUT  name='anonymContact' id='anonymContact' type='text' value=''>
			{/if}			
			<INPUT  name='bossTextEmpty' id='bossTextEmpty'  		 type='hidden'   		  		value='1'>
			<INPUT  name='recipient'    id='recipient'  		 type='hidden'   		  		value='SYS'>
			<INPUT  name='sender'    id='sender'  		 type='hidden'   		  		value='{$header.userId}'>
			<INPUT  name='subject'    id='subject'  		 type='hidden'   		  		value='boss_founded'>
			<INPUT  name='FIRMID'    id='FIRMID'  		 type='hidden'   		  		value='{$firm.firm_id}'>
			<INPUT  name='_REFERRER' id='_REFERRER'  		 type='hidden'   		  		value='{$menu.queryString}'>
			<INPUT  name="SUBMITRATE"  type="submit"   id="SUBMITRATE"   value="������" disabled>
		</DIV>
	</DIV>
</FORM>
{/if}
{if $option.showGuestBox} 
	<DIV class='firm-profile'>
		��������! ����� �������� ���� ����� ��� ������� ������������ ���� ��������, ��� ����� <a href='/entry'>����� �� ����</a></BR> 
{*		���� �� ��� ���������������� �� ����� �����, �� ����� ����� <A href=''>���</A>.</BR>  
		���� �� ��� �� ����������������, �� ��� ����� ����� ��������� <A href=''>���</A> �����. </BR> 
		���� �� ��� ���������������� � ���, �� ������ ���� ������, �� �������������� <A href=''>������� �������������� ������</A>.*}
	</DIV>
{/if}
{*</DIV>*}
  </TD></TR>
</TBODY>
</TABLE>