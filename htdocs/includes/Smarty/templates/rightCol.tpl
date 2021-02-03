<!-- Рейтинг и комменты -->

<div class="title"><i><strong>Лучшие компании</strong></i></div>
		<div class="section">
		

			<div class="r-star">
				<div class="cn tl"></div>
				<div class="cn tr"></div>

				<div class="contentLeft">
	<table width="85%" border="0" cellpadding="2" cellspacing="0">
		<tr>
		    <th align="left" width = "70%">
			наименование
			</td>
		    <th align="center">
			балл
			</td>
		</tr>
		{section name=cnt loop=$best}
		<tr onmouseover="this.style.background='#f9f9d9';" onmouseout="this.style.background='#C1DFC7'" >
		    <td valign="top">
			<a href="{$best[cnt].link}">{$best[cnt].name}</a>
			</td>
		    <td valign="middle" align='center'>
			{$best[cnt].rate}
			</td>
		</tr>
		{/section}
	</table>
	</div>
				
				<div class="cn bl"></div>
				<div class="cn br"></div>
			</div>
			
			                           
		</div>




<div class="title"><i><b>Обсуждение</b></i></div>			

		<div class="section">
		

			<div class="r-star">
				<div class="cn tl"></div>
				<div class="cn tr"></div>

				<div class="contentLeft">
				<table width="85%" border="0" cellpadding="2" cellspacing="0">
				{section name=frm loop=$lastComments}
				{if $lastComments[frm].comments[0].comment}
					<tr>
					    <td valign="top" align='left' width = "80%">
						<a href="{$lastComments[frm].link}"><strong>{$lastComments[frm].firm_name}</strong></a> - <strong>{$lastComments[frm].comments[0].user_name}:</strong> 
						</td>
					</tr>
					<tr>
						<td  valign="top" align='left'>
						<div style= 'text-align: justify;'>{$lastComments[frm].comments[0].comment}</div>
						</td>
					</tr>
					<tr>
						<td  valign="top" align='left'>
						<div style='text-decoration: underline;' >{$lastComments[frm].comments[0].ruDate}</div>
						</td>
					</tr>
					<tr>
						<td  >
						&nbsp;
						</td>
					</tr>
				{/if}
				{/section}	
				</table>

				</div>
				
				<div class="cn bl"></div>
				<div class="cn br"></div>
			</div>
			
			
		</div>
