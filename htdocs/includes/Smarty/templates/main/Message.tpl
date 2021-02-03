<script type="text/javascript">
{literal}
$(document).ready(function() {

	});
</script>			
{/literal}
<input type="hidden" id="cityId" name="cityId" value='{$client.city.id}'>
<input type="hidden" id="cityName" name="cityName" value='{$client.city.name}'>

	<div id="titleBar">
		<div id='titleContent'>
		<h2>{$MESS->Header}</h2>
		<div id='filtershow' class='simple' onClick='UI.togglePanel(document.getElementById("titleBar"), "filterPanel", 0, "highlightFilterStarter");'>Фильтр</div>
		</div>
	</div>
	<div id="pageContent">	
		<div id="message_404">	
			{$MESS->Body}
		</div>	
	<div id='empty'></div>		
	</div>