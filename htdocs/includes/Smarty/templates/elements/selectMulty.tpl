<script type="text/javascript" src="/includes/jquery/jquery.js"></script>
<script type="text/javascript" src="/includes/chosen/chosen.jquery.js"></script> 
{literal}
<style type="text/css"> 
	div { clear:both;position:relative;margin:0 0 10px; }
    div.side-by-side { width: 100%; margin-bottom: 1em; }
    div.side-by-side > div { float: left; width: 50%; }
    div.side-by-side > div > em { margin-bottom: 10px; display: block; }
	.chzn-choices .search-field input {
		height: 20px;
		}	
    .clearfix:after {
      content: "\0020";
      display: block;
      height: 0;
      clear: both;
      overflow: hidden;
      visibility: hidden;
    }
</style>
{/literal}
<link 	rel="stylesheet" href="/src/design/chosen/chosen.css" type="text/css" />	
 <div class="side-by-side clearfix">
		<div>
			<select data-placeholder="Выбор вида деятельности" class="chzn-select" id="{$SMRT_EL.name}[]" name="{$SMRT_EL.name}[]" multiple style="width:350px;" tabindex="4">
			  <option value=""></option> 
			  {section name=sel loop=$SMRT_EL.value}
			  <option value='{$SMRT_EL.value[sel]}'  {section name=def loop=$SMRT_EL.default} {if $SMRT_EL.default[def].catId == $SMRT_EL.value[sel]} selected {/if}{/section} >{$SMRT_EL.caption[sel]}</option>
			  {/section}
			</select>
      </div>
	</div>
 <script type="text/javascript">
{literal}
$(document).ready(function()
	{
	$(".chzn-select").chosen(); 		
	$(".chzn-select-deselect").chosen({allow_single_deselect:true});
	$(".chzn-choices .search-field input").css({'height' : 20});
	});
{/literal}
</script>