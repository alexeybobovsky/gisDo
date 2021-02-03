<SCRIPT src="/includes/JS/script.js" type=text/javascript></SCRIPT>
<SCRIPT src="/includes/JS/menu.js" type=text/javascript></SCRIPT>
<div style="position: relative; display: ;" id='menuAll'>
<div  id="subMenu_0" onMouseOver="cancelHide()" onMouseOut="hideMenu()" style="position: absolute; display: none;" class="active" >
	<table width="100%" border="0" cellspacing="0">
	{section name=menu loop=$menu.MenuItems}
		<tr  onmouseover="this.style.background='#D3E379'" onmouseout="this.style.background='#DBEDBD'">		
		<td width= '100%'>
		 <a 
		{if $menu.MenuItems[menu].selected}
			class="link_sub_active" 
		{else}
			class="link_sub" 
		{/if}
			href="{$menu.MenuItems[menu].link}"><nobr>{$menu.MenuItems[menu].label}</nobr></a>
		</td>
		</tr>
		{if $menu.MenuItems[menu].selected} 
			{assign var="SMRT_CURMENU" value=$menu.MenuItems[menu]}
		{/if}
	{/section}
	<tr><td><a class="link_sub" href="/login/logoff/">Выход</td></tr>
	</table>
</div>
<table  border="0" cellspacing="0" cellpadding="0">
	<tr>
	{section name=smenu loop=$menu.SubMenuItems}
	{if $menu.SubMenuItems[smenu].parent == $SMRT_CURMENU.id}
		{if $menu.SubMenuItems[smenu].selected} 
			{assign var="SMRT_CURSMENU" value=$menu.SubMenuItems[smenu].id}
		{/if}
	    <td id=menuHolder_{$smarty.section.smenu.iteration} onMouseOver="showMenu(this)" onMouseOut="hideMenu()">
			{*<SPAN id = 'icon_{$smarty.section.smenu.iteration}' >
				<img src="/menusrc/content.gif">
			</SPAN>*}
			<SPAN id = 'menuCaption_{$smarty.section.smenu.iteration}' >
			{if $menu.SubMenuItems[smenu].selected}				
				<a class="link_main_active" href="{$menu.SubMenuItems[smenu].link}">
			{else}
				<a class="link_main" href="{$menu.SubMenuItems[smenu].link}">	
			{/if}
					<NOBR>{$menu.SubMenuItems[smenu].label}</NOBR>
				</a>
					&nbsp;&nbsp;&nbsp;
			</SPAN>
		</td>
	{/if}
	{/section}
	    <td id=menuHolder_0 onMouseOver="showMenu(this)" onMouseOut="hideMenu()">
			{*<SPAN id = 'icon_{$smarty.section.smenu.iteration}' >
				<img src="/menusrc/content.gif">
			</SPAN>*}
			<SPAN id = 'menuCaption_0' >

				<a class="link_main" href="/">	
					<NOBR>Сайт</NOBR>
				</a>
					&nbsp;&nbsp;&nbsp;
			</SPAN>
		</td>
	</tr>
</table>
{section name=smenu loop=$menu.SubMenuItems}
<div  id="subMenu_{$smarty.section.smenu.iteration}" onMouseOver="cancelHide()" onMouseOut="hideMenu()" style="position: absolute; display: none;" class="active" >
	<table width="100%" border="0" cellspacing="0">
	{section name=Lmenu loop=$menu.links}
		{if $menu.links[Lmenu].parent == $menu.SubMenuItems[smenu].id}		  					
		<tr  onmouseover="this.style.background='#D3E379'" onmouseout="this.style.background='#DBEDBD'">		
		{*
		<td>
		 <img src='/menusrc/t_dmc_notepage_16.gif' border='0'>
		</td>*}
		<td width= '100%'>
		 <a 
		{if $menu.links[Lmenu].selected}
			class="link_sub_active" 
		{else}
			class="link_sub" 
		{/if}
			href="{$menu.links[Lmenu].link}"><nobr>{$menu.links[Lmenu].label}</nobr></a>
		</td>
		</tr>
		{/if}
	{/section}
	</table>
</div>	
{/section}

</div>
