<!--####-->
{*<script language="JavaScript" src="/includes/JSHttpRequest/JsHttpRequest.js" type=text/javascript></script>*}
{*<script language="JavaScript" src="/includes/JS/tree_capTable.js"></script>
<script language="JavaScript" src="/includes/JS/tree_GetHTML.js"></script>*}
<SCRIPT language="JavaScript" src="/includes/jquery/jquery.js" type=text/javascript></SCRIPT>
<SCRIPT language="JavaScript" src="/includes/jquery/jeditable.js" type=text/javascript></SCRIPT>
<script language="JavaScript" src="/includes/JS/script.js"></script>
<script language="JavaScript" src="/includes/JS/tree_func.js"></script>

				<TABLE cellSpacing=5    cellPadding=3  height = "100%" border=0>
					<tr>
						<td valign='top' width = '500' height='70%'>								
							<DIV >									
							   <fieldset>
								<legend>{$Tree.table_tree.table_label}</legend>
									<div id='tree' class= scrBoxTree>
											{include file='tree.tpl'}		
									</div>
								</fieldset>
							</div>
						</td>
						<td valign='top' height='100%' rowspan = 10>					
						<DIV>
							<fieldset>
							<legend>{$Table.table[0].table_label}</legend>
							
							<DIV  class= scrBoxForm >
								{include file='manage_edit.tpl'}	
							</DIV>
							</fieldset>
						</DIV>
						</td>					
					</tr>
						<td width = '500'>
							<DIV>									
							   <fieldset>
								<legend>Свойства узла</legend>
									<div id='divCaption' class= scrBoxTreeProp>
									</div>
								</fieldset>
							</div>
						</td>
					</tr>
				</table>
			<div id="sorting" style="z-index:10">
				<div><img src='/src/design/jquery/indicator.gif' border=0><br>Загрузка данных... пожалуйста подождите...</div>
			</div>
	