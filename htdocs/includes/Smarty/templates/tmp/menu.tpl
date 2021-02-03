					{if $menu.MenuItems}
						{section name=menu loop=$menu.MenuItems}	
						{if $menu.MenuItems[menu].selected}
							<td  height='24' align = 'center' class='list_th' >
						{else}
							<td  height='24' align = 'center' class='list_td' >
						{/if}
							<table border='0' cellpadding='1' cellspacing='1' >							
								<tr>
									{if $menu.MenuItems[menu].icon}
									<td>
										<a href='{$menu.MenuItems[menu].link}'>
										<img src='{$header.body.imgSrc}{$menu.MenuItems[menu].icon}' 
										border = '0' title='{$menu.MenuItems[menu].label}' >
										</a>
									</td>
									{/if}
									<td>
										<a href='{$menu.MenuItems[menu].link}'
										{if $MenuItems[menu].opt}
										{$MenuItems[menu].opt}
										{/if} 
										>
											<nobr>{$menu.MenuItems[menu].label}</nobr>
										</a>
									</td>
								</tr>
							</table>
						</td>
						{/section}
					{/if}	
					<td align=right width='100%'>
						&nbsp;
					</td>
						</tr>
					</table>
				  </td>			  			  
	            </tr>
	        </table>
	        </td>
	      </tr>
	      <tr>
	        <td width="100%" valign="top">
			<H2>{$menu.lastTitle}</H2>
			</td>
		  </tr>
		  <tr>
	        <td height="100%" width="100%" valign="top">
