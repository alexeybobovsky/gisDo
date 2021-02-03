		<script type="text/javascript">
{literal}
/*$(document).ready(function() {*/
	$(window).load(function () {
$('#center_articles_middleL').css({'height' : $('#center_articles_middleM').height()});
$('#center_articles_middleR').css({'height' : $('#center_articles_middleM').height()});
	});
{/literal}		
		</script>
    	<div id="center_page_02">
            <img 
			src="/src/design/main/img/png/earth_top_airplane.png" 
			border=0 />        
			<div id="center_articles">
			<div id="center_articles_top">
					<div id="center_articles_topL"></div>
					<div id="center_articles_topM"></div>
					<div id="center_articles_topR"></div>						
            </div>
            <!-- center middle left -->
			<div id="center_articles_middle">
				<div id="center_articles_middleL"></div>
				<div id="center_articles_middleM">
				<div id="center_left">
                	<!-- bigin -->
                    <div id="оrganization_events_header">
                    	<h2 class="оrganization_events_header">
                        	<img src="/src/design/main/img/gif/kov-left.gif" class="news_list_kov" alt="" /> {$MESS->Header}
                            <img src="/src/design/main/img/gif/kov-right.gif" class="news_list_kov" alt="" />
                        </h2> 
                    </div>					
                    <div id="оrganization_events_body">                   		                   
                   <!-- end -->
						 <div id="category_panel_middle_row">  
							<div id="message_404">  
							<h3 {*class="category_panel_middle_header"*} >{$MESS->Body} </h3>
							</div>
						</div> 
					</div>
				</div>