<!--noindex-->				
				<div id="mainRight">	
					<div class="listLeft">
					
						<div class='listLabel'>
							<span>Реклама</span>
						</div>
							<div id="flashContent" style="position: relative;">
							<a  rel="nofollow" style="	position: absolute; 
										width: 175px; height: 90px; left: 0; top: 0; z-index:10; 
										background: url('/src/design/main/_.gif') left top repeat;" 
								href="http://vssdom.ru/node/487" target="_blank"></a>
									<object type="application/x-shockwave-flash" data="/src/design/main/swf/vss_175x90_.swf" width="175" height="90">
									<param name="quality" value="high" />
										<param name="bgcolor" value="#ede5e2" />
										<param name="play" value="true" />
										<param name="loop" value="true" />
										<param name="wmode" value="opaque" />				
										<param name="scale" value="showall" />
										<param name="menu" value="true" />
										<param name="devicefont" value="false" />
										<param name="salign" value="" />
									</object>
							</div>
							<div id="flashContent" style="position: relative;">
							<a  rel="nofollow" style="	position: absolute; 
										width: 175px; height: 90px; left: 0; top: 0; z-index:10; 
										background: url('/src/design/main/_.gif') left top repeat;" 
								href="http://vssdom.ru/node/487" target="_blank"></a>
									<object type="application/x-shockwave-flash" data="/src/design/main/swf/vss_175x90_magenta.swf" width="175" height="90">
									<param name="quality" value="high" />
										<param name="bgcolor" value="#ede5e2" />
										<param name="play" value="true" />
										<param name="loop" value="true" />
										<param name="wmode" value="opaque" />				
										<param name="scale" value="showall" />
										<param name="menu" value="true" />
										<param name="devicefont" value="false" />
										<param name="salign" value="" />
									</object>
							</div>
	
					
						{*section name=adv loop=$adv}
							<a  rel="nofollow" href="{$adv[adv].link}" target="_blank">
								<img alt="" class='banner' src="{$adv[adv].src}" width="{$adv[adv].width}" height='{$adv[adv].height}'/>
							</a>   
							 
						{/section*}
					</div>
					{*
					<div id="banerRight">
					<a href="http://irkutsk.irr.ru/building/materials/other/Poluchi-diskont-na-remont-advert351053533.html" target="_blank">
							<img  class='banner' src="/src/design/main/img/banner_Remont_Terminal.jpg" width="175px" /></a>
					</div>	*}
					<div class="listLeft">
						<div class='listLabel'>
							<span>Обсуждение новостроек</span>
						</div>						
						{section name=list loop=$mesList} 
						
						<div class='objName'>
							<a  rel="nofollow" href='/list/construction/{$mesList[list].obj_id}' >{$mesList[list].obj_name}</a>
						</div>
						<div id='listLeftBody' class ='messageBody' >
							<a  rel="nofollow" href='/list/construction/{$mesList[list].obj_id}' title='Сообщение написано {$mesList[list].comm_date_ru}' >{$mesList[list].comm_bodyShort}</a>
						</div>
						<div class='messageBodyBottom'>
							
						</div>
						<div class='messAuth'>
							<span {if $mesList[list].providerName} class='userName_{$mesList[list].providerName}'   title='Написал пользователь "{$mesList[list].providerName}"' {else}
								class = 'userName_fs' title='Написал пользователь сайта "ФОТОСТРОЕК"'{/if} >
								 
								{$mesList[list].displayName}
							</span>
						</div>
						{*
						<div id='listLeftDate'>
							{$mesList[list].comm_date_ru}
						</div>*}
						
						{/section}
					</div>
<!--SHARE-->	
{if $header.startLink != 'http://localhost'}
<script type="text/javascript" src="//yandex.st/share/share.js"		charset="utf-8"></script>
{/if}
					<div id="listLeft">
						<div class='listLabel'>
							<span>Поделиться ссылкой</span>
						</div>						
<br />
{if $header.startLink != 'http://localhost'}
<div class="yashare-auto-init" data-yashareL10n="ru"
 data-yashareType="none" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,gplus"
></div> 				
{/if}
					</div>
<!--SHARE-->						
				</div>
				<div class='advertFooter' style="">
{if $header.startLink != 'http://localhost'}
				<script type="text/javascript"><!--
				google_ad_client = "pub-7986853574721707";
				/* FS_doska_728x90 */
				google_ad_slot = "7328968511";
				google_ad_width = 728;
				google_ad_height = 90;
				//-->
				</script>
				<script type="text/javascript"
				src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
				</script>
{/if}
				</div>
<!--/noindex-->					
