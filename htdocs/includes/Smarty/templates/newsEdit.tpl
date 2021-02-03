				{if $news.form.form_emptyCheck}
				<script language="JavaScript" src="/includes/JS/script.js"></script>
				<script language="JavaScript">
					var fullTitleLocked = 0;
					var necessary = new Array();
					var necessCount = 0;
				</script>
				{/if}
					<FORM name={$news.form.form_name} action={$news.form.form_action} method=post encType=multipart/form-data>									
						<TABLE style="MARGIN-LEFT: 1px; MARGIN-RIGHT: 1px" cellSpacing=0    cellPadding=3 border=0 width='100%' height='100%'>
						<TBODY id='{$news.table.body_id}'>									
							<TR>
								<td width='100%' height='100%'>
								<fieldset>
								<legend>{$news.table.table_label}</legend>
										
									<TABLE cellSpacing=1 cellPadding=5 width="100%" height='100%' border=0 >
									{section name=el loop=$news.elements}								
										{assign var="SMRT_EL" value=$news.elements[el]}	
										{assign var="SMRT_INDX" value=$smarty.section.el.index}
										{if $SMRT_EL.necessary}
										<script language="JavaScript">
											necessary[necessCount] = "{$SMRT_EL.name}";
											necessCount ++;
										</script>
										{/if}
										{if $SMRT_EL.type !='hidden'}
										<tr>
										  <TD style="PADDING-RIGHT: 5px; PADDING-LEFT: 5px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" colspan = 10>
											<SMALL>{$news.table.table_colHeader[el]}
											{if $SMRT_EL.necessary || $SMRT_EL.fake_necessary }
													<font color=red>*</font>
											{else}
													&nbsp;
											{/if}</SMALL>							            
												<div id='DIV{$SMRT_EL.id}'>
												{include file=$SMRT_EL.template}
												</div>
												<br>
										</td>											
										</tr>
										{else}
												{include file=$SMRT_EL.template}
										{/if}
									{/section}
										<tr>
											<TD align='right'>
												{assign var="SMRT_EL" value=$news.elSubmit}	
												{include file=$SMRT_EL.template}
											</TD>
										</tr>				
									</TABLE>								
								</fieldset>
								</td>
							</TR>
							</TBODY>
						</TABLE>
					</form>