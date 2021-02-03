			<span class='firm-info-title'>{$menu.lastTitle}</SPAN>
				{if $addUser.form.form_emptyCheck}
				<script language="JavaScript" src="/includes/JS/script.js"></script>
				<script language="JavaScript">
					var necessary = new Array();
					var necessCount = 0;
				</script>
				{/if}
					<FORM name={$addUser.form.form_name} action={$addUser.form.form_action} method=post encType=multipart/form-data>									
						<TABLE style="MARGIN-LEFT: 1px; MARGIN-RIGHT: 1px" cellSpacing=0  width = '100%'  cellPadding=3 border=0>
						<TBODY id='{$addUser.table.body_id}'>									
							<TR>
								<td>
								{if $addUser.admin}
								<fieldset>
								<legend>{$addUser.table.table_label}</legend>
								{/if}
										
									<TABLE cellSpacing=1 cellPadding=5 width="100%" border=0 >
									{if $addUser.errorMsg}
										<tr>
											<td>
												<img src={$addUser.errorMsg.img} border = 0> &nbsp; &nbsp; 
												<font color=red>{$addUser.errorMsg.text} </font>
											</td>
										</tr>
									{/if}
									{section name=el loop=$addUser.elements}								
										{*math equation="index / 2 - 0.1" index = $smarty.section.el.iteration assign=SMRT_dev_val*}
										{*math equation="2 * round(dev) " index = $smarty.section.el.iteration dev = $SMRT_dev_val assign=SMRT_dev_val_round*}
										{*<tr style='background={if $SMRT_dev_val_round == $smarty.section.tree.iteration}ffffff{else}F7F7F7{/if}'>*}
										{assign var="SMRT_EL" value=$addUser.elements[el]}	
										{assign var="SMRT_INDX" value=$smarty.section.el.index}
										{if $SMRT_EL.necessary}
										<script language="JavaScript">
											necessary[necessCount] = "{$SMRT_EL.name}";
											necessCount ++;
										</script>
										{/if}
										{*if $SMRT_dev_val_round != $smarty.section.el.iteration*}
										<tr>
										{*/if*}
										  <TD style="PADDING-RIGHT: 5px; PADDING-LEFT: 5px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" colspan = 10 valign='middle'>
											<SMALL>{$addUser.el_caption[el]}
											{if $SMRT_EL.necessary}
													<font color=red>*</font>
											{else}
													&nbsp;
											{/if}</SMALL>							            
												<div id='DIV{$SMRT_EL.id}'>
												{*$SMRT_EL.name*}
												{if !$SMRT_EL.skipTemplate}
													{include file=$SMRT_EL.template}
												{elseif $SMRT_EL.type == 'img'}
													<img src='{$SMRT_EL.src}' border='0'>
												{/if}
												</div>
												{if $SMRT_EL.useCompare}
												<div id='DIVCMP_{$SMRT_EL.id}'>
													{include file='hidden_CMP.tpl'}
												</div>												
												{/if}
										</td>											
										{*if $SMRT_dev_val_round == $smarty.section.el.iteration*}
										</tr>
										{*/if*}
									{/section}
										<tr>
											<TD align='right'>
												{assign var="SMRT_EL" value=$addUser.elSubmit}	
												{include file=$SMRT_EL.template}
											</TD>
										</tr>				
									</TABLE>								
								{if $addUser.admin}
								</fieldset>
								{/if}
								</td>
							</TR>
							</TBODY>
						</TABLE>
					</form>