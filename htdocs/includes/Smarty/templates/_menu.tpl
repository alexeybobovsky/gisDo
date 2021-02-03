          {*<tr>
            <td height="23" background="{$header.body.imgSrc}row-bgr.gif">
			&nbsp;
			
			<table height="23"  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td bgcolor="#FFFFFF" width="1"><img src="{$header.body.imgSrc}empty.gif" width="70" height="23"></td>
                <td width="1"><img src="{$header.body.imgSrc}empty.gif" width="12" height="23"></td>
                <td bgcolor="#FFFFFF"><a href="index.htm" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('home-icon','','{$header.body.imgSrc}home-icon-on.gif',1)"><img src="{$header.body.imgSrc}home-icon.gif" alt="на главную страницу" name="home-icon" width="23" height="23" border="0"></a></td>
                <td nowrap bgcolor="#FFFFFF"><img src="{$header.body.imgSrc}row-arrow.gif" width="7" height="7" align="absmiddle"> <a href="#dcgdb" class="path-link">О компании</a> <img src="{$header.body.imgSrc}row-arrow.gif" width="7" height="7" align="absmiddle"> <strong class="path-on">Деятельность компании</strong></td>
                <td width="6" nowrap bgcolor="#FFFFFF"><img src="{$header.body.imgSrc}empty.gif" width="10" height="23"></td>
              </tr>
            </table>
			
			</td>
          </tr>*}
        </table>
		</td>
        <td width="99" height="128">&nbsp;</td>
		</tr>
    </table>
	</td>
  </tr>
  
  <tr>
    <td height="100%" valign="top"><table width="100%" height="200"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="70" height="40"><img src="{$header.body.imgSrc}empty.gif" width="70" height="40"></td>
        <td height="40">&nbsp;</td>
        <td width="50" height="40"><img src="{$header.body.imgSrc}empty.gif" width="60" height="40"></td>
        <td height="40">&nbsp;</td>
        <td width="99" height="40"><img src="{$header.body.imgSrc}empty.gif" width="99" height="40"></td>
      </tr>
      <tr valign="top">
        <td width="70">&nbsp;</td>
        <td width="193" height="100%">
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="{$header.body.imgSrc}empty.gif" width="70" height="12"></td>
          </tr>
          <tr>
            <td height="37" background="{$header.body.imgSrc}menu-top-bgr.gif" style="background-repeat:no-repeat; background-position: right top;"><img src="{$header.body.imgSrc}empty.gif" width="10" height="37"></td>
          </tr>
		  {if $menu.MenuItems}
          {section name=menu loop=$menu.MenuItems}	
		  <tr>
            <td>
			<table width="100%" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('menu-{$smarty.section.menu.iteration}','','{$header.body.imgSrc}menu-arrow-red.gif',1)" border="0" cellpadding="0" cellspacing="8" background="{$header.body.imgSrc}menu-row-bgr.gif" style=" background-repeat:no-repeat; background-position: bottom right">
              <tr >
                <td>
				<p><a href="{$menu.MenuItems[menu].link}"class="menu-link">{$menu.MenuItems[menu].label}</p>
                  </td>
                <td width="15" align="center" valign="middle"><a href="{$menu.MenuItems[menu].link}" >
					<img src="{$header.body.imgSrc}menu-arrow-gray.gif" name="menu-{$smarty.section.menu.iteration}" width="15" height="15" border="0"></a>
				</td>
              </tr>
            </table>
			</td>
          </tr>
		  {/section}
		  {/if}
          <tr>
            <td height="37" background="{$header.body.imgSrc}menu-bott-bgr.gif" style="background-repeat:no-repeat; background-position: right top;"><img src="{$header.body.imgSrc}empty.gif" width="10" height="37"></td>
          </tr>
		  
		  
          <tr>
            <td height="37" style="background-repeat:no-repeat; background-position: right top;"><img src="{$header.body.imgSrc}empty.gif" width="60" height="40"></td>
          </tr>
        </table>
		
		</td>
        <td>&nbsp;</td>
        <td>
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr >
            <td width="100%" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="45" valign="top"><h1>{if !$subHeader}
							{$menu.lastTitle}
						{else}
							{$subHeader.caption}{/if}</h1></td>
              </tr>
              <tr>
                <td>
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr valign="top">
                      <td width="10"><img src="{$header.body.imgSrc}empty.gif" width="10" height="23"></td>
                      <td>