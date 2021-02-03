<!-- BOTTOM --> 
	<div id="footer_container">
    	<div id="footer">
        	<div id="footer-01">
            	<h4 class="footer-menu"> </h4>
            	<!--ul class="footer-menu">
                    <li><a href="#"><img src="img/gif/f.gif" title="F" alt="F"/></a></li>
                    <li><a href="#"><img src="img/gif/t.gif" title="T" alt="T"/></a></li>
                    <li><a href="#"><img src="img/gif/in.gif" title="IN" alt="IN"/></a></li>
                    <li><a href="#"></a></li>
                </ul-->            
            </div>         
        	<div id="footer-02">
                <h4 class="footer-menu">Разделы</h4>
            	<ul class="footer-menu">
                    <li><a href="/catalog/">Организации</a></li>
                    <li><a href="/news/">Новости</a></li>
                    <li><a href="/doc/">Статьи</a></li>
                    <li><a href="/map/">Карта</a></li>
                    <li><a href="#"></a></li>
                </ul>            
            </div>            
        	<div id="footer-03">
                <h4 class="footer-menu">Организации</h4>
            	<ul class="footer-menu">
                    <li><a href="#">Детские сады</a></li>
                    <li><a href="#">Школы</a></li>
                    <li><a href="#">Колледжи</a></li>
                    <li><a href="#">Больница</a></li>
                    <li><a href="#">Игровая комната</a></li>
                    <li><a href="#">Детский магазин</a></li>
                    <li><a href="#">Институт</a></li>
                </ul>            
            </div>            
         	<div id="footer-04">
                <h4 class="footer-menu">Статьи</h4>            
            	<ul class="footer-menu">
                    <li><a href="#">Оздоровительный лагерь</a></li>
                    <li><a href="#">Детский праздник</a></li>
                    <li><a href="#">Кладовая</a></li>
                    <li><a href="#">Законы</a></li>
                    <li><a href="#">Новости</a></li>
                    <li><a href="#">SOS</a></li>                                        
            </div>          	
			<div id="footer-05">
                <h4 class="footer-menu">Проект</h4>            
            	<ul class="footer-menu">
                    <li><p class="contact" onclick='showYastchik();' >Связаться с нами </p></li>
                    <li id=eml></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li><p class="schedule"><a href="/">«ГОРОД-ДЕТЯМ.РФ»</a><br />©&nbsp;{$header.curYear} </p></li>
            </div> 
{*        	<div id="footer-05">
                <h4 class="footer-menu">Проект</h4>            
                    <p class="contact">Тел: 1.234.567.8901</p>
                    <p class="contact">Тел: 1.234.567.8901</p>
                    <p class="contact">Email: <a href="mailto:email@email.com" class="mailto" title="Email">email@email.com</a></p>
                    <br/>
                    <p class="schedule">ПОН - ПЯТ 9.00 - 18.00</p>
                    <p class="schedule">СУБ, ВОСК Выходной</p>
					<br />
					<br />
                    <p class="schedule">©&nbsp;{$header.curYear} «<a href="/">ГОРОД-ДЕТЯМ.РФ</a>» </p>
            </div>      *}                  
        </div>    
    </div>
</div> 	
</div>    
{*  <DIV class=copyright   style="PADDING-LEFT: 0px">
  <SPAN>©&nbsp;{$header.curYear}</SPAN> «<A 
  href="/">ГОРОД-ДЕТЯМ.РФ</A>» <BR>
  <A href="/feedback">Обратная&nbsp;связь</A>&nbsp;&bull;&nbsp;
  <A href="/advert">Реклама&nbsp;на&nbsp;сайте</A>
  </DIV> *}  
{literal}
<script type="text/javascript">
$(document).ready(function() {
		$("#show_site_enter").click(function(){UI.togglePanel(this, 'site_enter_panel', 1, '')});
		$(".oauthProvider").click(function(){openAuthPanel(this)});
		$("#category_panel").css({'display':'none'});	
		});
</script>			
{/literal}
<div id="lockingPad" style='display:none;'></div>
 <div id="messageBox">
	 <div id="messageBox_top">
	 </div>            
	 <div id="messageBox_middle">
			<div id="messageBox_title" class=''>
				<h3 class="messageBox_title" id="messageBox_title_text" >Ошибка</h3>
			</div>
			<div id="messageBox_close"><img src='/src/design/main/img/smallno.gif' onClick="UI.togglePanel('', 'messageBox', 1, '')" title='Закрыть панель' id='closePanelImg'></div>            
			<div id="mBody" class='messageBox_body'>        
				Message
			</div>
			<div id="mBodyAuthComment" class='messageBox_body' style='display:none'>        
				Только авторизованные пользователи могут оценивать организацию и оставлять отзывы. Войти на сайт можно <span class="messageBox_activeLink" title="Войти" onClick="UI.closeMessage(); UI.togglePanel('', 'site_enter_panel', 1, '');" >здесь</span>. </br> 
				Если вы не зарегистрированы на сайте и не желаете проходить процедуру регистрации,
				можете <span class="messageBox_activeLink" title="Войти" onClick="UI.closeMessage(); UI.togglePanel('', 'site_enter_panel', 1, '');" >авторизоваться</span> используя вашу учетную запись с любого из популярных социальных сервисов. 
			</div>
			<div id="messageBox_ok_btn">        
				<span onClick='UI.closeMessage(this);' id='mConfirm' class="site_enter_panel_check_btn" title="Оk" > Оk </span>
			</div > 
	</div>      
	<div id="messageBox_bottom">
	</div>  
 </div>    
  
<div id="waitBox" style='display:none;'><img id='waitImg' border=0 src='/src/design/tmp/main/blueBars.gif'></div>
 <div id="site_enter_panel">
	 <div id="site_enter_panel_top">
	 </div>            
	 <div id="site_enter_panel_middle">
			 <div id="site_enter_panel_close"><img src='/src/design/main/img/smallno.gif' onClick="UI.togglePanel('', 'site_enter_panel', 1, '')"  title='Закрыть панель' id='closePanelImg'>
			 </div>            
			<div id="site_enter_panel_oauthProviders_p">        
				<p class="site_enter_panel_oauthProviders_p">Войти с помощью</p>
			</div>
			<div id="site_enter_panel_oauthProviders">        
				<span class='oauthProvider' 		id='Odnoklassniki'><img 		src = '/src/design/admin/oauth/ok.png' 			title='Войти через "Одноклассники"'></span>
				<span class='oauthProvider' 		id='Mailru'><img 	src = '/src/design/admin/oauth/mailru.png' 		title='Войти через "mail.ru"'></span>
				<span class='oauthProvider' 		id='Vkontakte'><img src = '/src/design/admin/oauth/vk.png' 			title='Войти через "В контакте"'></span>
				<span class='oauthProvider' 		id='Yandex'><img 	src = '/src/design/admin/oauth/yandex.png' 		title='Войти через "Яндекс"'></span>
				<span class='oauthProvider' 		id='Google'><img 	src = '/src/design/admin/oauth/gplus.png' 		title='Войти через "Google"'></span>
				<span class='oauthProvider' 		id='Facebook'><img 	src = '/src/design/admin/oauth/facebook.png' 	title='Войти через "Facebook'></span>
				<span class='oauthProvider' 		id='Twitter'><img 	src = '/src/design/admin/oauth/twitter.png' 	title='Войти через "Twitter'></span>
			</div > 		 
			<div id="site_enter_panel_oauthProviders_p">        
				<p class="site_enter_panel_oauthProviders_p">Использовать встроенную учетную запись</p>
			</div>
			<div id="site_enter_panel_margin_6">
			</div>                
			<div id="site_enter_panel_input_p">        
				<p>Логин{* или e-mail*}</p>
			</div>
			<div id="site_enter_panel_input"><form method="post" id='authForm' action="/login/">
				 <input class="input_login" name="Username" id="Username" value="" type="text" />
			</div>
			<div id="site_enter_panel_input_p">        
				<p>Пароль</p>
			</div>
			<div id="site_enter_panel_input">            
				<input class="input_password" name="Password" id="Password" value="" type="password" />
			</div>
			<div id="site_enter_panel_check_btn">
				<input type="checkbox" name="saveMe" id="saveMe" value=""  > <label for="saveMe">Запомнить меня</label>
			</div>
		
			<div id="site_enter_panel_ok_btn">        
				<span onclick='submitAuthForm();' class="site_enter_panel_check_btn" title="Войти" >ok</span>
				</form>
			</div > 

			<div id="site_enter_panel_a"> 
				<a href="" class="site_enter_panel_a"title="востановить пароль"  >Востановить пароль</a>
			</div >              
			<div id="site_enter_panel_a"> 
				<a href="" class="site_enter_panel_a"title="востановить пароль"  >Регистрация</a>
			</div >              
		</div>      
	 <div id="site_enter_panel_bottom">
	 </div>  
  </div>    

<div id="category_panel" >        
         <div id="category_panel_top"></div>            
         <div id="category_panel_middle">

        	 <div id="category_panel_middle_row">               
{section name=lay loop=$layers}
{if !$layers[lay].lvl}
				<div id="category_panel_middle_list">
				<h3 class="category_panel_middle_header" id='nameLayer_{$layers[lay].item.layer_id}' title='{$layers[lay].item.layer_title}'>
					{$layers[lay].item.layer_name}</h3>
                    <ul class="category_panel_middle_list">
{elseif $layers[lay].lvl}
                        <li id='nameLayer_{$layers[lay].item.layer_id}'  title='{$layers[lay].item.layer_title}'>
							<a href="/catalog/{$layers[lay].item.layer_name}" title="">{$layers[lay].item.layer_name}</a> {*if $client.isMng}({$layers[lay].item.objCnt}){/if*}
							</li>
{/if}
{if !$layers[$smarty.section.lay.index_next].lvl || $smarty.section.lay.last}
                    </ul>
                </div>
{/if}
{/section}					
               
         </div> 
         </div> 
			
         <div id="category_panel_bottom">         </div>      
</div>
</body>
</html>
