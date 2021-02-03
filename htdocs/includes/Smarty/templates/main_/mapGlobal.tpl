<script src="/includes/jquery/jquery.autocomplete.js" language="JavaScript"></script>
            <!-- MAP CONTAINER -->
            <div id="map_container_body">
                <div id="map_container_top">
                        <div id="map_top_left">                
                        </div>  
                        <div id="map_top_middle">                       
						{if $navi}	
							<div id="navigation">
								<ul class="navigation">
									{section name=nav loop=$navi} 
									{if $navi[nav].src}
									<li><a href="{$navi[nav].src}" title="{$navi[nav].title}" >{$navi[nav].caption}</a></li>
									{elseif $navi[nav].actionLink}
									<li><p  class="global_activeLink" id = 'mapCatSelect'   title="{$navi[nav].title}" onClick="UI.togglePanel(this, 'category_panel_map', 0, '')" >{$navi[nav].caption}</p></li>
									{else}
									<li><p  title="{$navi[nav].title}" >{$navi[nav].caption}</p></li>
									{/if}
									{if !$smarty.section.nav.last}
									<li><p>&nbsp; &raquo; &nbsp;</p></li>
									{/if}
									{/section}
								</ul>
							</div>  
						{/if}           
                       </div>                         
                        <div id="map_top_right">                 
                        </div> 
                </div>
                <!-- ...middle -->
                <div id="map_container_middle">
                        <div id="map_middle_left">
                        </div> 
                         
                        <div id="map_middle_middle">
                                            
                           <div id="map_header_container">
                               <img src="/src/design/main/img/img_map_01.jpg" title="" alt="map" />
                               <h2 class="map_header" id='pageTitle' title="">Все организации на карте города</h2> <p class="map_header" id='pageTitleMore' >{*(3 обьекта)*}</p>
								{*<div id = 'startHelp'>asdasdasdads</div>*}
                               <div id="map_search_container_body">
                                    <div id="map_search_left">
                                    </div>
                                    <div id="map_search_middle">                        
                                         <input id="searchStr" name="searchStr" class="input_map_search" value="Поиск по карте..."  onFocus='this.value=""; ' onBlur='clearSearchbar()'/>  
									 <span id=resMessage></span> 
									 {*<div id=procIndicator  >
											<img id='searchIndicatorImg' border=0 src='/src/design/tmp/main/_.gif'>
										</div>  *}                                  
									</div>
                                    <div id="map_search_right">
                                    </div>
                               </div>                                        
                           </div>
                            <div id="map_pic">
							
								<input type="hidden" id="firmId" name="firmId" value=''>		
								<input type="hidden" id="objId" name="objId" value=''>		
								<input type="hidden" id="cityId" name="cityId" value='{$client.city.id}'>
								<input type="hidden" id="cityName" name="cityName" value='{$client.city.name}'>
								{if $autoLoad}
								<input type=hidden id='autoLoadType' value='{$autoLoad.type}'>
								<input type=hidden id='autoLoadObj' value='{$autoLoad.obj}'>
								{*<input type=hidden id='autoLoadLoc' value={$autoLoad.loc}>*}
								{else}
								<input type=hidden id='autoLoadType' value=''>
								<input type=hidden id='autoLoadObj' value=''>
								{*<input type=hidden id='autoLoadLoc' value=''>*}
								{/if}
							
								<div id="mapContaner" ></div>							
								<div id="YMapsID"></div>
                               <!--img src="/src/design/main/img/pic_map.jpg" title="" alt="map" /-->          
                            </div>
                               
                        </div> 
                        <div id="map_middle_right">  
                        </div> 
                </div>
                <!--...middle end -->
                <div id="map_container_bottom">
                        <div id="map_bottom_left">                 
                        </div>  
                        <div id="map_bottom_middle">
                             
                        </div> 
                        <div id="map_bottom_right">                  
                        </div> 
                </div>
            
            </div>
			<div id="category_panel_map" >        
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
										<span id='nameLayer_{$layers[lay].item.layer_id}'  onClick='clickLayer(this, 0);' title='{$layers[lay].item.layer_title}'>{$layers[lay].item.layer_name}</span> {*if $client.isMng}({$layers[lay].item.objCnt}){/if*}
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
            <!-- enf MAP Container --> 
    </div> 