<!-- 1 -->
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr><td>
	
<table style="background-image: url({$header.body.imgSrc}bg_up.gif); background-rpeat: repeat-x;" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td> 
<!-- �������� ����� -->

<table style="background-image: url({$header.body.imgSrc}header/bg0.gif);" border="0" cellpadding="0" cellspacing="0" width="100%" height="195">
  <tbody>
	<tr>
		<td height="81" width="134"><img src="{$header.body.imgSrc}header/index_01.gif" width="134" height="81"></td>
		<td style="background-image: url({$header.body.imgSrc}header/bg1.gif);" colspan="2" height="81">

&nbsp;


		</td>
		<td rowspan="2" height="162" width="229"><img src="{$header.body.imgSrc}header/index_03.gif" width="229" height="162"></td>
		<td rowspan="2" height="162" width="163" height="162"><img src="{$header.body.imgSrc}header/index_04.gif" alt="" width="163" height="162"></td>
		<td rowspan="3" height="195" width="242"><a href="/"><img src="{$header.body.imgSrc}header/logo.gif" alt="�����-����.���" border="0" width="242" height="195"></a></td>
	</tr>
	
	<tr>
		<td width="134" height="81"><img src="{$header.body.imgSrc}header/index_06.gif" width="134" height="81"></td>
		<td width="262" height="81"><img src="{$header.body.imgSrc}header/index_07.gif" width="262" height="81"></td>
		<td style="background-image: url({$header.body.imgSrc}bg2.gif);" height="81">&nbsp;</td>
	</tr>
	
	<tr>
		<td style="background-image: url({$header.body.imgSrc}bg3.gif);" colspan="5" height="33">


		<table border="0" cellpadding="0" cellspacing="0" width="100%" height="33">
		<tbody><tr><td align="left">		
		<div class="MenuTabs">
		<ul>
		<li><span><a href="/about/" class="header_menu">� �������</a></span></li>
		<li><span><a href="/advert/" class="header_menu">������� �� �����</a></span></li>
		<li><span><a href="/feedback/" class="header_menu">�������� �����</a></span></li>
{if $logout}		
		<li><span><a href="/login/logoff/" class="header_menu">�����</a></span></li>
{/if}				
		</ul>
		</div>
{*		
		&nbsp;&nbsp;&nbsp;		
		<span title="�� �������" class="small bel"><a class="bel" href="/"><img src="{$header.body.imgSrc}home.gif" alt="�� �������" border="0"></a></span>&nbsp;
		<span title="�������� �����" class="small bel"><a class="bel" href="/feedback"><img src="{$header.body.imgSrc}feedback.gif" alt="�������� �����" border="0"></a>&nbsp;
		<span title="� �����" class="small bel"><a class="bel" href="/about/"><font style="text-decoration: none;" color="white"><img src="{$header.body.imgSrc}issue.gif" alt="� �����" border="0"></font></a>&nbsp;
{if $logout}		
				<span title="�����" class="small bel"><a class="bel" href="/login/logoff/"><img src="{$header.body.imgSrc}exit.gif" alt="�����" border="0"></a>&nbsp;
{/if}				
			</span></span></span>
		<noscript><span style=' cursor:pointer; cursor:hand;  ' class="bel small" title='����� ����������� ����� ����������'>&nbsp;&nbsp;� �������� �������� Java Script*</span></noscript>
*}
		</td>


	<td align="right">

    <form name="SEARCHFORM" action="/search/" method="post">
	<span class="small bel" id="body_search"> 
	�����
	&nbsp;	<input class="login" id="searchString" style="width: 150px;" name="searchString">
	<input name="submitImg" type="image" src="{$header.body.imgSrc}search.gif"> 
	</span>
&nbsp;&nbsp;&nbsp;&nbsp;
	</form>
	</td>	</tr>


	</tbody>
</table>

<script type="text/javascript">
var newCompanyLink = '{$header.newFirmLink}';
</script>	

</td></tr></tbody></table>


<br></td>


</tbody></table>

</td></tr>


<tr><td><!-- ������ ����������� ����� -->
{if $menuTopLvlUse}
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tbody>
   <tr>
		<td width="5"><img src="{$header.body.imgSrc}_.gif" border="0" width="5" height="1"></td>

    <td valign="top">


<table border="0" cellpadding="0" cellspacing="0" width="100%">
   <tbody>
   <tr>
    <td width="10">
		<img src="{$header.body.imgSrc}_.gif" border="0" width="25" height="1">
	</td>
    <td valign="top" width="100%">
	<h3>
     <a class="Up_menu{if $menuTopLvlUse.active == 'company'} active{/if}" href="/company/"><i>������������� �����</i></a>&nbsp;&nbsp;&nbsp;&nbsp;
     <a class="Up_menu{if $menuTopLvlUse.active == 'products'} active{/if}" href="/products/"><i>������� �������</i></a>&nbsp;&nbsp;&nbsp;&nbsp;
     <a class="Up_menu{if $menuTopLvlUse.active == 'market_guide'} active{/if}" href="/market_guide/"><i>���������</i></a>&nbsp;&nbsp;&nbsp;&nbsp;
     <a class="Up_menu{if $menuTopLvlUse.active == 'map'} active{/if}" href="/map/"><i>����� ��������</i></a>
	</h3>
	</td>
   </tr>
  </tbody>
 </table>
<br />

<!--��������� ����� �������� �� 300 �������� � ���� ? -->
<h1 style="PADDING-LEFT: 300px;">{if $menuTopLvlUse.links}
{section  name=lnk loop=$menuTopLvlUse.links}
<a class='gray' href='{$menuTopLvlUse.links[lnk].link}'>{$menuTopLvlUse.links[lnk].label}</a>{if !$smarty.section.lnk.last}&nbsp;/&nbsp;{/if}
{/section}{else}{$menuTopLvlUse.title}{/if}&nbsp;<span class="red">{if $menuTopLvlUse.counter}{$menuTopLvlUse.counter}{/if}</span></h1>
{/if}