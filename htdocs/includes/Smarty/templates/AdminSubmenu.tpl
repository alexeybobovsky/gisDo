        <TR>
        <TD width='20' class='cellleft '>
			&nbsp;
		</TD>
		{section name=menu loop=$menu.SubMenuItems}
			{if $menu.SubMenuItems[menu].parent == $SMRT_CURMENU}			
				<TD class='{if $menu.SubMenuItems[menu].selected}
					list_th
					{assign var="SMRT_CURSMENU" value=$menu.SubMenuItems[menu]}				
				{else} list_td{/if}'>
					<TABLE cellPadding=0 border=0>             
						<TR>
							<TD>
								<A href="{$menu.SubMenuItems[menu].link}">
									<nobr>{$menu.SubMenuItems[menu].label}</nobr>
								</A> 
							</TD>
						</TR>
					</TABLE>
				</TD>
			{/if}
		{/section}
		</TD>
          <TD width="100%"  class=cellright>&nbsp;
		</TD>
		{if $menu.links}
		<tr><td colspan=100 class=leftright>
			<TABLE cellspacing=2 cellpadding=2 border=0>
				<TR>
				{section name=Lmenu loop=$menu.links}
					{if $menu.links[Lmenu].parent == $SMRT_CURSMENU.id}
					<td style="BORDER:  2px {if $menu.links[Lmenu].selected}inset{else}outset{/if};">
						<a href="{$menu.links[Lmenu].link}" title="{$menu.links[Lmenu].label}" >
							<nobr>{$menu.links[Lmenu].label}</nobr>
						</a>
					</td>
					{/if}
				{/section}			
				</TR>
			</TABLE>
		</td></tr>
		{/if}
	
