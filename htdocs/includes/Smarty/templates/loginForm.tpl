			{if $login.form.form_emptyCheck}
				<script language="JavaScript" src="/includes/JS/script.js"></script>
				<script language="JavaScript">
					var necessary = new Array();
					var necessCount = 0;
				</script>
				{/if}
					<FORM name={$login.form.form_name} action={$login.form.form_action} method=post encType=multipart/form-data>									
						<table width="100%"  border="0" cellspacing="8" cellpadding="0">
						<TBODY id='{$login.table.body_id}'>									
							<TR>
								<td>
									<TABLE cellSpacing=1 cellPadding=5 width="100%" border=0>
									{if $login.errorMsg}
										<tr>
											<td>
												<img src={$login.errorMsg.img} border = 0> &nbsp; &nbsp; 
												<font color=red>{$login.errorMsg.text} </font>
											</td>
										</tr>
									{/if}
									<tr>
									{section name=el loop=$login.el_caption}								
										{assign var="SMRT_EL" value=$login.elements[el]}	
										{assign var="SMRT_INDX" value=$smarty.section.el.index}
										{if $SMRT_EL.necessary}
										<script language="JavaScript">
											necessary[necessCount] = "{$SMRT_EL.name}";
											necessCount ++;
										</script>
										{/if}
										  <TD style="PADDING-RIGHT: 5px; PADDING-LEFT: 5px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" colspan = 10>
											<SMALL>{$login.el_caption[el]}
											{if $SMRT_EL.necessary}
													<font color=red>*</font>
											{else}
													&nbsp;
											{/if}</SMALL>							            
												<div id='DIV{$SMRT_EL.id}'>
												{if !$SMRT_EL.skipTemplate}
													{include file=$SMRT_EL.template}
												{elseif $SMRT_EL.type == 'img'}
													<img src='{$SMRT_EL.src}' border='0'>
												{/if}
												</div>
										</td>											
									{/section}
									</tr>
									<tr>
										<TD  colspan='100' align='center'>
											{assign var="SMRT_EL" value=$login.elSubmit}	
											{include file=$SMRT_EL.template}
										</TD>
									</tr>				
									</TABLE>								
								</td>
							</TR>
							</TBODY>
						</TABLE>
					</form>