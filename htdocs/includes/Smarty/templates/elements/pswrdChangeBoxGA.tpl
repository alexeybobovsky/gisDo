{literal}
<script language="JavaScript">
	necessary[necessCount] = "IDUSER_PSW_1";
	necessCount ++;
	necessary[necessCount] = "IDUSER_PSW_2";
	necessCount ++;
function showPswrdConfirm()
	{
	var label = document.getElementById('pswrdConfirmLabel');
	var value = document.getElementById('pswrdConfirmValue');
	var oldPsw = document.getElementById('CMP_IDUSER_PSW_1');
	var newPsw = document.getElementById('IDUSER_PSW_1');
	if(oldPsw.value != newPsw.value)
		{
		label.style.display = '';
		value.style.display = '';
		}
	else
		{
		label.style.display = 'none';
		value.style.display = 'none';
		}			
	}
</script>		
{/literal}	
			<tr>
				 <td align=left valign="top" width="25">&nbsp;</td>			
				 <td align=left valign="top" width=""><span class="red">Пароль</span> 									
				</td>
			</tr>
			<tr>			
				<td align=left valign="top" width="25"><img src="{$header.body.imgSrc}warning.gif">
				</td>			
				<td valign="top">
				<DIV id='DIVIDUSER_PSW_1' ><INPUT  name="USER_PSW_1"  
									 type="password"   
									 id="IDUSER_PSW_1"   		  
									 style="WIDTH: 200px"  
									 onChange="EmptyCheck(this.form); showPswrdConfirm();" 		 
									 onkeyup="EmptyCheck(this.form); showPswrdConfirm();" 										
									 value="defvalue">
			<div id='DIVCMP_IDUSER_PSW_1'>
				<INPUT  name="CMP_USER_PSW_1"  
					 type="hidden"   
					 id="CMP_IDUSER_PSW_1"   
					value='defvalue'>
			</div>												
			</DIV>
			</td>	
			</tr>
						
			<tr id='pswrdConfirmLabel' style='DISPLAY:NONE;'>
				 <td align=left valign="top" width="25">&nbsp;</td>			
				 <td align=left valign="top" width=""><span class="red">Повторите пароль </span>									
				</td>
			</tr>
			<tr id='pswrdConfirmValue' style='DISPLAY:NONE;'>			
				<td align=left valign="top" width="25">
										<img src="{$header.body.imgSrc}warning.gif">
								</td>			
				<td valign="top">
				<DIV id='DIVIDUSER_PSW_2' >																
					<INPUT  name="USER_PSW_2"  
							 type="password"   
							 id="IDUSER_PSW_2"   		  
							 style="WIDTH: 200px"  
							 onChange="EmptyCheck(this.form)" 		 
							 onkeyup="EmptyCheck(this.form)" 										
							 value="defvalue">
					<div id='DIVCMP_IDUSER_PSW_2'>
						<INPUT  name="CMP_USER_PSW_2"  
							 type="hidden"   
							 id="CMP_IDUSER_PSW_2"   
							value='defvalue'>
					</div>												
				</DIV>
			</td>	
			</tr>
