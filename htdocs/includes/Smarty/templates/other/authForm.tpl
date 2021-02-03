<!--CSS-->
{literal}
<style type="text/css">
body                       { font:12px/1.3 Arial, Sans-serif; }
form                       { width:380px;padding:0 90px 20px;margin:auto;background:#f7f7f7;border:1px solid #ddd; }
div                        { clear:both;position:relative;margin:0 0 10px; }
label                      { cursor:pointer;display:block; }
input[type="password"]     { width:300px;border:1px solid #999;padding:5px;-moz-border-radius:4px; }
input[type="text"]:focus   { border-color:#777; }
input[type="text"]         { width:300px;border:1px solid #999;padding:5px;-moz-border-radius:4px; }
input[type="text"]:focus   { border-color:#777; }
input[name="zip"]          { width:150px; }

/* submit button */
input[type="submit"]       { cursor:pointer;border:1px solid #999;padding:5px;-moz-border-radius:4px;background:#eee; }
input[type="submit"]:hover,
input[type="submit"]:focus { border-color:#333;background:#ddd; }
input[type="submit"]:active{ margin-top:1px; }
{/literal}
</style>
<script type="text/javascript" src="/includes/slidinglabels/slidinglabels.js"></script>
{*<h1><span lang="ru">ДЕМО</span></h1>*}
<form action="" method="post" id="info" enctype="multipart/form-data">
	<h2>Contact Information</h2>
    <div id="userName-wrap" class="slider">
        <label for="userName">Имя</label>
        <input type="text" id="userName" name="userName">

    </div><!--/#name-wrap-->
    
    <div id="psw-wrap"  class="slider">
        <label for="psw">Пароль</label>
        <input type="password" id="psw" name="psw">
    </div><!--/#email-wrap-->
    <input type="submit" id="btn" name="btn" value="Войти">
</form>

