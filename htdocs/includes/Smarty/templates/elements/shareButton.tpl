{literal}
<style type="text/css"> 
.shareTitle {
border-bottom : 5px;
font-size:	13px;
font-weight:	700;
font-style:	normal;
color:	#444444;
letter-spacing:	normal;
line-height:	18px;
text-align:	start;
}
#share42 {
  display: inline-block;
  padding: 6px 0 0 6px;
  background: #FFF;
  border: 1px solid #E9E9E9;
  border-radius: 4px;
}
#share42:hover {
  background: #F6F6F6;
  border: 1px solid #D4D4D4;
  box-shadow: 0 0 5px #DDD;
}
#share42 a {opacity: 0.5;}
#share42:hover a {opacity: 0.7}
#share42 a:hover {opacity: 1}
</style>
{/literal}
{*<div "shareStr">*}
{*<span class="shareTitle">Поделиться ссылкой</span>*}
<div class="shareTitle">Поделиться ссылкой</div>
<div class="share42init" data-url="{$shareButton.link}" data-title="{$shareButton.title}"></div>
{*</div>*}
<script type="text/javascript" src="/includes/share/share42.js"></script>
<script type="text/javascript">share42('http://www.gorod-avto.com/includes/share/')</script>
