						<script language="JavaScript" >						
						var capCount = 0;
						function deleteCapRow()
							{literal}{{/literal}
							
							var tbody = document.getElementById("{$Table.table[1].body_id}");
							tbody.removeChild(tbody.lastChild);		
							tbody.removeChild(tbody.lastChild);		
							tbody.removeChild(tbody.lastChild);		
							tbody.removeChild(tbody.lastChild);		
							{literal}}{/literal}
						function createCapRow (indx)
							{literal}{	
						{/literal}
							capCount++;
							//alert(indx);
							//td = new array();
							var tbody = document.getElementById("{$Table.table[1].body_id}");
							var row_el0 = document.createElement("TR")
							row_el0.id = 'CAP_0_' + indx;
							var row_el1 = document.createElement("TR")
							row_el1.id = 'CAP_1_' + indx;
							var row_el2 = document.createElement("TR")
							row_el2.id = 'CAP_2_' + indx;
							var row_check = document.createElement("TR")
							td_check = document.createElement("TD");	
							td_check.colSpan = 10;
							div_check = document.createElement("DIV");
							text_check = document.createTextNode("TD");	
							check =  document.createElement("INPUT");
							check.type = 'checkbox';
							cnt = eval(indx)+1;
							check.name = '{$Table.checkbox.pattern}[' + cnt + ']';
							//alert(check.name);
							check.id = 'ID{$Table.checkbox.pattern}[' + cnt + ']';
							check.onclick = function() {literal}{ {/literal} SelectNodeProperties(this);  {literal}}{/literal};	
							//alert(check.name); 
							div_check.appendChild(check);
							div_check.appendChild(document.createTextNode('{$Table.checkbox.caption}'));
							td_check.appendChild(div_check);
							row_check.appendChild(td_check);
							
							{section name=js loop=$Table.el2_caption}
							{assign var="SMRT_INDX" value=$smarty.section.js.index}
							{assign var="SMRT_EL" value=$Table.el2[js]}	
								td_text{$SMRT_INDX} = document.createElement("TD");	
								td_el{$SMRT_INDX} = document.createElement("TD");	
								td_nes{$SMRT_INDX} = document.createElement("TD");									
								div_nes{$SMRT_INDX} =  document.createElement("DIV");								
								//text_nes{$SMRT_INDX} = document.createTextNode('*')
								font_nes{$SMRT_INDX} = document.createElement("FONT");
								font_nes{$SMRT_INDX}.color= 'red';
								font_nes{$SMRT_INDX}.appendChild(document.createTextNode('*'));

								//text_nes{$SMRT_INDX}.font.color = 'red';
								div_el{$SMRT_INDX} =  document.createElement("DIV");
								div_el{$SMRT_INDX}.id = row_el{$SMRT_INDX}.id + '_DIV_{$SMRT_INDX}';
								div_text{$SMRT_INDX} =  document.createElement("DIV");
								div_text{$SMRT_INDX}.id = row_el{$SMRT_INDX}.id + '_DIV_text_{$SMRT_INDX}';
								text{$SMRT_INDX} = document.createTextNode("{$Table.el2_caption[js]}");
							{if $SMRT_EL.type == 'text'}
								el{$SMRT_INDX} = document.createElement("INPUT");
								el{$SMRT_INDX}.type = 'text';	
								el{$SMRT_INDX}.value = {if $SMRT_EL.value}'{$SMRT_EL.value}'{else}''{/if};
							{elseif $SMRT_EL.type == 'select'}							
								el{$SMRT_INDX} = document.createElement("SELECT");
								oOption = document.createElement("OPTION");
								oOption.value = "null";
								oOption.appendChild(document.createTextNode("нет"));
								el{$SMRT_INDX}.appendChild(oOption);							
							{/if}							
							el{$SMRT_INDX}.name = '{$SMRT_EL.pattern}['+ indx + ']';
							el{$SMRT_INDX}.id = 'ID{$SMRT_EL.pattern}['+ indx + ']';
							{if $SMRT_EL.necessary}		
								
								div_nes{$SMRT_INDX}.appendChild(font_nes{$SMRT_INDX});								
								div_nes{$SMRT_INDX}.appendChild(document.createTextNode('   '));
								necessary[necessCount] = 'ID{$SMRT_EL.pattern}['+ indx + ']';
								necessCount ++;
							{/if}							
							{/section}
							{section name=js loop=$Table.el2_caption}
								{assign var="SMRT_INDX" value=$smarty.section.js.index}							
								div_text{$SMRT_INDX}.appendChild(text{$SMRT_INDX});
								div_el{$SMRT_INDX}.appendChild(el{$SMRT_INDX});
								td_text{$SMRT_INDX}.appendChild(div_text{$SMRT_INDX});
								td_el{$SMRT_INDX}.appendChild(div_el{$SMRT_INDX});
								td_nes{$SMRT_INDX}.appendChild(div_nes{$SMRT_INDX});
							    row_el{$SMRT_INDX}.appendChild(td_text{$SMRT_INDX});
							    row_el{$SMRT_INDX}.appendChild(td_el{$SMRT_INDX});
							    row_el{$SMRT_INDX}.appendChild(td_nes{$SMRT_INDX});
							{/section}			
						    tbody.appendChild(row_el0);
						    tbody.appendChild(row_el1);
						    tbody.appendChild(row_el2);
							tbody.appendChild(row_check);
						{literal}							
							}
						{/literal}						
						</script>
