				{if $pasRemind.form.form_emptyCheck}
				<script language="JavaScript" src="/includes/JS/script.js"></script>
				<script language="JavaScript">
					var necessary = new Array();
					var necessCount = 0;
				</script>
				{/if}
					<FORM name={$pasRemind.form.form_name} action={$pasRemind.form.form_action} method=post encType=multipart/form-data>									
						<TABLE style="MARGIN-LEFT: 1px; MARGIN-RIGHT: 1px" cellSpacing=0    cellPadding=3 border=0>
						<TBODY id='{$pasRemind.table.body_id}'>									
							<TR>
									{section name=el loop=$pasRemind.el_caption}								
										{assign var="SMRT_EL" value=$pasRemind.elements[el]}	
										{assign var="SMRT_INDX" value=$smarty.section.el.index}
										{if $SMRT_EL.necessary}
										<script language="JavaScript">
											necessary[necessCount] = "{$SMRT_EL.name}";
											necessCount ++;
										</script>
										{/if}
										  <TD colspan = 10>
											<SMALL>{$pasRemind.el_caption[el]}
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
										<TD  valign='bottom' align='center'>
											{assign var="SMRT_EL" value=$pasRemind.elSubmit}	
											{include file=$SMRT_EL.template}
										</TD>
									</tr>				
							</TBODY>
						</TABLE>
					</form>