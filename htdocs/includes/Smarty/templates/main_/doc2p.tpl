<link 	rel="stylesheet" type="text/css" href="/src/design/fancybox/jquery.fancybox.css?v=2.1.2" media="screen" /><link 	rel="stylesheet" type="text/css" href="/src/design/fancybox/jquery.fancybox-thumbs.css?v=1.0.7" /><script type="text/javascript" src="/includes/fancybox/jquery.fancybox.pack.js"></script><script type="text/javascript" src="/includes/fancybox/jquery.fancybox-thumbs.js?v=1.0.7"></script><script type="text/javascript">{literal}	$(window).load(function () {$('#center_articles_middleL').css({'height' : $('#center_articles_middleM').height()});$('#center_articles_middleR').css({'height' : $('#center_articles_middleM').height()});});$(document).ready(function() {$('.imgLink').fancybox({				wrapCSS    : 'fancybox-custom',				closeClick : true,				openEffect : 'none',				helpers : {					title : {						type : 'inside'					},					overlay : {						css : {							'background' : 'rgba(238,238,238,0.85)'						}					},//					buttons	: {},					thumbs : {						width: 50,						height: 50					}				},				afterLoad: function() 					{					$('.fancybox-skin').bind("mouseover", function() {$('.fancybox-close').css({'top' : '-4px', 'right' : '-4px'})}); 					}			});						});			</script>			{/literal}{if $naviKeyword}<script type="text/javascript">{literal}$(document).ready(function() {		$("#keywordPanel").css({'display':'none'});				});</script>			{/literal}				<div id="keywordPanel" >        	<div id="keywordPanelList">		<ul class="keywordPanelList">{section name=lay loop=$naviKeyword}{if $smarty.section.lay.index != 0 && $smarty.section.lay.index%15 == 0}</ul><ul class="keywordPanelList">{/if}		<li id='nameLayer_{$naviKeyword[lay].catId}'  title='{$naviKeyword[lay].cat_name}'>				<a href="/doc/key/{$naviKeyword[lay].cat_name}" title="">{$naviKeyword[lay].cat_name}</a> 				</li>{/section}							</ul>	</div>								   </div>{/if}  <div id = 'mainContent' >    	<div id="center_page_02">              <img 			src="/src/design/main/img/png/earth_top_airplane.png" 			border=0 />			<div id="center_articles">			<div id="center_articles_top">					<div id="center_articles_topL"></div>					<div id="center_articles_topM">			{if $navi}	                <div id="navigation">                    <ul class="navigation">						{section name=nav loop=$navi} 						{if $navi[nav].src}                        <li><a href="{$navi[nav].src}" title="{$navi[nav].title}" >{$navi[nav].caption}</a></li>						{elseif $navi[nav].actionLink}                        <li><p  class="global_activeLink" id = 'newsCatSelect'   title="{$navi[nav].title}" onClick="UI.togglePanel(this, 'keywordPanel', 0, '')" >{$navi[nav].caption}</p></li>						{else}                        <li><p  title="{$navi[nav].title}" >{$navi[nav].caption}</p></li>						{/if}						{if !$smarty.section.nav.last}                        <li><p>&nbsp; &raquo; &nbsp;</p></li>						{/if}						{/section}                    </ul>{*                    <ul class="navigationDoc" {if !$properties.fatDoc}style="margin-right:19%"{/if}>						{section name=kwrd loop=$news.attr.tags}							<li> <a href='{$properties.linkKeywordPref}{$news.attr.tags[kwrd].cat_name}'>{$news.attr.tags[kwrd].cat_name}</a></li>							<li><p>&nbsp;&nbsp;</p></li>						{/section}						                    </ul>*}                </div>  			{/if}            					</div>					<div id="center_articles_topR"></div>									</div>            <!-- center middle left -->						<div id="center_articles_middle">				<div id="center_articles_middleL"></div>				<div id="center_articles_middleM">				<div id="center_left" {if $properties.fatDoc}style="width:100%"{/if}>	                    					<div id="оrganization_events_header">                    	<h2 class="оrganization_events_header">                        	{*<img src="/src/design/main/img/gif/kov-left.gif" class="news_list_kov" alt="" /> *}                        	<img src="/src/design/main/img/_.gif" class="news_list_kov" alt="" /> 							{$title}                             {*<img src="/src/design/main/img/gif/kov-right.gif" class="news_list_kov" alt="" />*}                        </h2>   <p class="оrganization_events_header">{$objNumStr}</p>                    </div>	                    <ul class="navigationDoc" {*if !$properties.fatDoc}style="margin-right:19%"{/if*}>						{section name=kwrd loop=$news.attr.tags}							<li> <a href='{$properties.linkKeywordPref}{$news.attr.tags[kwrd].cat_name}'>{$news.attr.tags[kwrd].cat_name}</a></li>							<li><p>&nbsp;&nbsp;</p></li>						{/section}						                    </ul>					               	   <div id="article_body">                   		                                    					{if $news.attr.imgCnt}				   					<div id="article_img">					{section name=img loop=$news.attr.img}					{if $news.attr.img[img].img_src_prew}					<a  class='imgLink company_detail_pictures' href='{$news.attr.img[img].img_src}' 											rel="gallery_news" title = '{$news.attr.img[img].img_title}' target="_blank">                        											<img src="{$news.attr.img[img].img_src_prew}" class="article_img" title="" alt="{$news.attr.img[img].img_title}" />                             					</a>					{/if}					{/section}					</div>					{/if}					 <div id="article_text">					<p class="article_text">	  					{$news.news_body}	  					</p>											 						<div id="article_date">							{if $news.updated}							   <p class="article_date">Последнее изменение от {$news.comm_date_ru}</p>														{else}							   <p class="article_date">{$news.comm_date_ru}</p>														{/if}						 </div>   					 </div>					{if $news.news_src}					  <div id="article_src">						   {$news.news_src}							{*<a href="#">adasdad</a>*}						   					  </div>   					{/if}					                   </div>				   {*                   <div id="news_keywords"> 					{section name=kwrd loop=$news.attr.tags}						<span> <a href='{$properties.linkKeywordPref}{$news.attr.tags[kwrd].cat_name}'>{$news.attr.tags[kwrd].cat_name}</a></span>					{/section}				   </div>*}                	{*<a href="" title="Сообщить об ошибке" alt="" class="check_error">Сообщить об ошибке &raquo; </a>*}										                   </div>