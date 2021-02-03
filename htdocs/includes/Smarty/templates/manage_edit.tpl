<script language="JavaScript">
	var newNodeString = new Array();
	var GB_ANIMATION = true;
	{section name=js loop=$Table.menu}
	newNodeString[{$smarty.section.js.index}] = new MenuOptionsSet('{$Table.menu[js].name}',
							'{$Table.menu[js].caption }',
							'menuTable',
							'',
							{$Table.menu[js].necessary}
							);
	{/section}
</script>
				{if $Table.form.form_emptyCheck}
				<script language="JavaScript">
					var necessary = new Array();
					var necessCount = 0;
				</script>
				{/if}
				<TABLE cellSpacing=10    cellPadding=3  border=0>
					<tr>
						<td valign='top'>			
					<FORM name={$Table.form.form_name} action={$Table.form.form_action} method=post encType=multipart/form-data>									
						  <TABLE style="MARGIN-LEFT: 1px; MARGIN-RIGHT: 1px" cellSpacing=0    cellPadding=3 border=0>
						<TBODY id='{$Table.table[0].body_id}'>									
							<TR>
								<td>
									<TABLE cellSpacing=1 cellPadding=5 width="100%" border=0 >
										{assign var="SMRT_EL" value=$Table.hidden}	
											{include file=$SMRT_EL.template}

									{section name=el loop=$Table.el1_caption}								
										{math equation="index / 2 - 0.1" index = $smarty.section.el.iteration assign=SMRT_dev_val}
										{math equation="2 * round(dev) " index = $smarty.section.el.iteration dev = $SMRT_dev_val assign=SMRT_dev_val_round}
										{*<tr style='background={if $SMRT_dev_val_round == $smarty.section.tree.iteration}ffffff{else}F7F7F7{/if}'>*}
										{assign var="SMRT_EL" value=$Table.el1[el]}	
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
										  <TD style="PADDING-RIGHT: 5px; PADDING-LEFT: 5px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" colspan = 10>
											<SMALL>{$Table.el1_caption[el]}
											{if $SMRT_EL.necessary}
													<font color=red>*</font>
											{else}
													&nbsp;
											{/if}</SMALL>
							            <TABLE style="MARGIN: 0px" cellSpacing=0 cellPadding=0>
								              <TBODY>
								              <TR>
								                <TD noWrap width="100%">
													<div id='DIV{$SMRT_EL.id}'>
													{include file=$SMRT_EL.template}
													</div>
												  <INPUT id=parent_id type=hidden name=parent_id> 
												  </TD>
												</TR>
												</TBODY>
											</TABLE>
											</td>											
										{*if $SMRT_dev_val_round == $smarty.section.el.iteration*}
										</tr>
										{*/if*}
									{/section}
									</TABLE>
								</td>
							</TR>
							</TBODY>
							</TABLE>
					</td>
				</tr>
				<TR>
					<td colspan='10'>
						<DIV id='menuOptions'>
						</DIV>
					</td>
				</TR>
				<TR>
					<td colspan='10'>
						<TABLE cellSpacing=10    cellPadding=0 width="100%" border=0>
							<tr>
								<TD align='right'>
									{assign var="SMRT_EL" value=$Table.elSubmit}	
									{include file=$SMRT_EL.template}
								</TD>
							</tr>				
						</TABLE>
					</td>
				</TR>
				</form>
			</td>
		</tr>
		</table>
