<link rel="stylesheet" href="/src/design/chosen/chosen.css" />
<script src="/includes/chosen/chosen.jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="/includes/slidinglabels/slidinglabels.js"></script>
{literal}
  <style>
    /* RESET */
    html, body, div, span, h1, h2, h3, h4, h5, h6, p, blockquote, a,
    font, img, dl, dt, dd, ol, ul, li, legend, table, tbody, tr, th, td 
    {margin:0px;padding:0px;border:0;outline:0;font-weight:inherit;font-style:inherit;font-size:100%;font-family:inherit;list-style:none;}
    a img {border: none;}
    ol li {list-style: decimal outside;}
    fieldset {border:0;padding:0;}
    
    /*body { font-family: sans-serif; font-size: 1em; }*/
	body                       { font:12px/1.3 Arial, Sans-serif; }
	form                       { width:450px;padding:0 150px 20px;margin:auto;background:#f7f7f7;border:1px solid #ddd; }
	input[type="password"]     { width:340px;border:1px solid #999;padding:5px;-moz-border-radius:4px; }
	input[type="text"]:focus   { border-color:#777; }
	input[type="text"]         { width:340px;border:1px solid #999;padding:5px;-moz-border-radius:4px; }
	input[type="text"]:focus   { border-color:#777; }
	input[name="zip"]          { width:150px; }

	/* submit button */
	input[type="submit"]       { cursor:pointer;border:1px solid #999;padding:5px;-moz-border-radius:4px;background:#eee; }
	input[type="submit"]:hover,
	input[type="submit"]:focus { border-color:#333;background:#ddd; }
	input[type="submit"]:active{ margin-top:1px; }
	div                        { clear:both;position:relative;margin:0 0 10px; }
	label                      { cursor:pointer;display:block; }
	
    div#container { width: 780px; margin: 0 auto; padding: 1em 0;  }
    p { margin: 1em 0; max-width: 700px; }
    h1 + p { margin-top: 0; }
    
    h1, h2 { font-family: Georgia, Times, serif; }
    h1 { font-size: 2em; margin-bottom: .75em; }
    h2 { font-size: 1.5em; margin: 2.5em 0 .5em; /*border-bottom: 1px solid #999; */padding-bottom: 5px; }
    h3 { font-weight: bold; }
    
    ul li { list-style: disc; margin-left: 1em; }
    ol li { margin-left: 1.25em; }
    
    div.side-by-side { width: 100%; margin-bottom: 1em; }
    div.side-by-side > div { float: left; width: 50%; }
    div.side-by-side > div > em { margin-bottom: 10px; display: block; }
    
    a { color: orange; text-decoration: underline; }
    
    .faqs em { display: block; }
    
    .clearfix:after {
      content: "\0020";
      display: block;
      height: 0;
      clear: both;
      overflow: hidden;
      visibility: hidden;
    }
    
    footer {
      margin-top: 2em;
      border-top: 1px solid #666;
      padding-top: 5px;
    }
  </style>
{/literal}  
<form action="" method="post" id="info" enctype="multipart/form-data">
  <div id="container">
{if $markets}
	<h2>Выбор рынка</h2>
	<div class="side-by-side clearfix">
		<div>
        <em>Авторынки</em>        
        <select data-placeholder="Выбор авторынка" class="chzn-select" id="market" name="market" style="width:350px;" tabindex="1">
          <option value=""></option> 
		{section  name=markets loop=$markets}
          <option value="{$markets[markets].market_id}">{$markets[markets].firm_name}</option>
		{/section}
        </select>
      </div>
	 </div>
	 {else}
	 <h1>Добавление павильона к рынку <strong>{$curMarket.firm_name}</strong>.</h1>
        <input type="hidden" id="curMarket" name="curMarket" value={$curMarket.firm_id}>		
	<h2>Информация о павильоне</h2>
	
    <div id="pavNum-wrap" class="slider">
        <label for="pavNum">Номер павильона</label>
        <input type="text" id="pavNum" name="pavNum">
    </div><!--/#name-wrap-->
    <div id="firmName-wrap" class="slider">
        <label for="firmName">Название фирмы</label>
        <input type="text" id="firmName" name="firmName">
    </div><!--/#name-wrap-->
	
    <div id="phone1-wrap" class="slider">
        <label for="phone1">Телефон 1</label>
        <input type="text" id="phone1" name="phone1">
    </div><!--/#name-wrap-->
	
    <div id="phone2-wrap" class="slider">
        <label for="phone2">Телефон 2</label>
        <input type="text" id="phone2" name="phone2">
    </div><!--/#name-wrap-->
	
	
    <div class="side-by-side clearfix">
		<div>
        <em>Деятельность</em>        
        <select data-placeholder="Выбор вида деятельности" class="chzn-select" id="layer[]" name="layer[]" multiple style="width:350px;" tabindex="4">
          <option value=""></option> 
		{section  name=layers loop=$layers}
          <option value="{$layers[layers].ot_id}">{$layers[layers].ot_name}</option>
		{/section}
        </select>
      </div>
	 
	 
{/if}   
	<div><input type="submit" id="btn" name="btn" value="Сохранить"></div>
 
{literal}  
 <script type="text/javascript"> $(".chzn-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true}); </script>
{/literal} 
</div>
{if $curMarket}
	<div><a href='?changeMarket=1'>Выбрать другой рынок</a></div>
{/if}
</form>

