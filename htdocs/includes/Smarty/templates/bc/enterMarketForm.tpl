{*<link rel="stylesheet" href="/src/design/fileuploader.css" type="text/css"/>
<link rel="stylesheet" href="/src/design/main/css/gis/style.css" type="text/css">*}
<link rel="stylesheet" href="/src/design/chosen/chosen.css" />
<script src="/includes/chosen/chosen.jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="/includes/slidinglabels/slidinglabels.js"></script>
{*<script type="text/javascript" src="/includes/jquery/fileuploader.js" ></script>
<script type="text/javascript" src="/includes/jquery/fileuploader.js" ></script>*}
<script type="text/javascript" src="/bc/nem-sdk/dist/nem-sdk.js" ></script>
<script type="text/javascript" src="/bc/bc.js" ></script>

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
 h1 {
	font-size: 2em;
	margin-bottom: 5px;
	margin-top: 5px;
}    
	h2 { font-size: 1.5em; margin: 2.5em 0 .5em; /*border-bottom: 1px solid #999; */padding-bottom: 5px; }
    h3 { font-weight: bold; }
    
   {* ul li { list-style: disc; margin-left: 1em; }*}
    ol li { margin-left: 1.25em; }
    
    div.side-by-side { width: 100%; margin-bottom: 1em; }
    div.side-by-side > div { float: left; width: 50%; }
    div.side-by-side > div > em { margin-bottom: 10px; display: block; }
    
a { text-decoration:none;}
a:hover,a:visited,a:link{ color:#543f8d;;}  
a:hover{text-decoration:underline;
}  
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
.qq-uploader {
	position: relative;
	width: 340px;
}	
#check {
	max-width: 400px;
	overflow: auto;
}
#verifyResult {
	border-radius: 5px;	

	border: 1px solid #ccc;
	width: 340px;
	overflow: auto;
	min-height: 50px;
	/* text-align: center; */
	padding: 2px;
}
.verifyError {
	background-color: #ffdddd;
}
.verifySuccess {
	background-color: #ddffdd;
}
.inactive {
	background-color: #f7f7f7;;
}
#headerSelect li {
	float: left;
	font-size: 1.5em;
	margin: 1em 9px .5em;
	padding-bottom: 5px;
}
.activeButton, .activeButtonPressed{
	padding: 4px;
	border-radius: 3px;	
	border:1px solid;
	cursor:pointer; 
	cursor:hand;  	
	}
.activeButton{
	color:#666;
	}
.activeButtonPressed{
	background-color: #fffabd;
	color:#222;
	}

.activeButton:hover{
	background-color: #fffabd;
	color:#222;
	}


{*.h2{font-size: 1.5em; margin: 2.5em 0 .5em; padding-bottom: 5px; }*}
#container h1::before {
	content: "";
	display: block;
	position: absolute;
	width: 64px;
	height: 64px;
	top: 5px;
	left: -80px;
	background: url('http://bob.nem.ninja:8765/img/logo.png') right no-repeat;
}
#copy {
	position: absolute;
	right: 205px;
	font-size: 10px;
	margin-bottom: 0px;
}
  </style>
{/literal}  
<form action="" method="post" id="info" enctype="multipart/form-data">
  <div id="container">
	 <div><h1>
	 Регистратор файлов в Blockchain <strong>NEM</strong>.</h1>
	 <div>(реализация для файлов текстового формата)</div>
	 </div>
	<UL id='headerSelect'>
		<li ><span id='newFile' class='activeButtonPressed'>Зарегистрировать файл</span></li>
		<li ><span id='auditFile' class='activeButton'>Проверка регистрации файла</span></li>
	</UL>
	<div id='newFileContaner' class='actionContaner'>
		{*<div id="pavNum-wrap" class="slider">
			<label for="string">Описание</label>
			<input type="text" id="string" name="string">
		</div><!--/#name-wrap-->*}
{*		<div id="psw-wrap" class="slider">
			<label for="psw">Пароль</label>*}
			<input type="hidden" id="psw" name="psw" value=';jgf'>
{*		</div><!--/#name-wrap-->*}
		<div id="pavNum-wrap" class="slider">
		<div id="add-wrap1" class="slider">
			<label for="add">Файл</label>
			<input type="file" id="add" name="add" {*multiple="multiple"*}>
		</div><!--/#name-wrap-->
		{*			<div  id='layerFileI'  class='objPropItem'>
						<div class='objPropName'>
							Файл состояния
						</div>
						<div id='layerFileC' class='objPropValue p_valueSelectType'>
							<div>
								<div>
									<div id="file_state">	<noscript><p>Please enable JavaScript to use file uploader.</p></noscript> </div>
								</div>
							</div>
						</div>
						<div id='state_res'>	
						</div>
					</div>
		*}	
		<div id='state_res'>	
		</div>

		</div><!--/#name-wrap-->

			
		<div><input type="button" id="btn" name="btn" disabled=true   value="Сохранить"></div>
	</div>	 
	<div id='auditFileContaner' class='actionContaner' style='display:none'>
		<div id="check-wrap" class="slider">
			<label for="check">Выбрать файл</label>
			<input type="file" id="check" name="check"{* multiple="multiple"*}>
		</div><!--/#name-wrap-->
		<div><input type="button" id="btnV" name="btnV" disabled=true   value="Проверить подлинность"></div>
		<div id='verifyResult' class='inactive'>			
		</div>
	{*	<input type="hidden" id="verifiedFile" name="verifiedFile"  value="">*}
	</div>
	<div id='copy'><a href='https://t.me/fmeat'>&copy;fmeat</a></div>
	</form> 	
	</div>
{literal}  
 <script type="text/javascript"> 
	var nem, file;
	var priKey = ''
 	var uploader = {};
	var textContentV, fileNameV, hash;
	var textContent, fileName;
	var fileUploadParam = new Array();
	$(document).ready(function(){
		nem = require("nem-sdk").default;
/*		uploader = new createFileUploader('Выбрать  Файл состояния', 'state', '/bc/index.php?fileUpload=1');*/
		
		$('#headerSelect li span').on('click', function (event){actionSelect(event.currentTarget.id)});
		$('#btn').prop('disabled', true);
		$('#btnV').prop('disabled', true);
		$('#btnV').on('click', function(){	
			$('#verifyResult').removeClass('verifyError verifySuccess'); 
			$('#verifyResult').addClass('inactive'); 
			verifyApostile(hash, textContentV);});
			
		actionSelect =  function(id){  
		if($('#' + id).hasClass('activeButton')){
			$('#headerSelect li span').removeClass('activeButtonPressed');
			$('#headerSelect li span').addClass('activeButton');
			$('#' + id ).removeClass('activeButton');
			$('#' + id ).addClass('activeButtonPressed');
			
			$('.actionContaner').hide();
			$('#' + id + 'Contaner').show();
		}
		console.log(id);
		}

		$('#check').on('change', function (event) {
			hash = textContentV = '';
			var files = event.target.files;
//			console.log(event.target.files);
			for (var i = 0; i < files.length; i++) {
				let file = files[i];
				//fileName =  file.name; //console.log(file);
				var fileReader = new FileReader();
				fileReader.onload = function(event) {
					textContentV = event.target.result;
					$('#btnV').prop('disabled', false);
					
				}
			fileReader.readAsText(file);
//			fileReader.readAsArrayBuffer (file);
			hash = GetStrPrt(GetStrPrt(file.name, 'TX ', 1), ' -- Date', 0);
/*			console.log(hash);*/
			}
//			verifyApostile(hash, textContentV);
		});
//		$('#upldBtn input').on('change', function (event) {
		$('#add').on('change', function (event) {
				var files = event.target.files;
				for (var i = 0; i < files.length; i++) {
					let file = files[i];
					fileName =  file.name; 
					var fileReader = new FileReader();
					fileReader.onload = function(event) {
					  // сохраняем текст файла в переменную
					  textContent = event.target.result;
					  $('#btn').prop('disabled', false);

					}
					fileReader.readAsText(file);
//					fileReader.readAsBinaryString(file);
				}			 
		});
		$('#btn').on('click', function (event) {
			if(!$("#psw").val()) return alert('Не указан пароль!');
/*			if(!$("#verifiedFile").val()) return alert('Не выбран файфл!');*/
			
			$.post("/bc/index.php/", {type:'checkPsw', value:$("#psw").val()}, function(str) {
					var result = JSON.parse(str);
					if(result.resultPsw == 'success'){
						sendApostile(result, textContent);
					}
					else {
						return alert('Не верный пароль!');
					}
				});
			

		});
	});

// $(".chzn-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true}); 
/* function createFileUploader(title, type, action)
	{
//	alert(title + ' ' + type + ' ' + action);
	this.obj =  new qq.FileUploader({
				element: document.getElementById('file_' + type),
				action: action,
	
				allowedExtensions: ['jpg', 'jpeg', 'png', 'gif', 'doc', 'docx', 'pdf', 'zip', 'rar', 'txt'],
//				allowedExtensions: ['js', 'json', 'ini'],
				buttonLabel: title,
				onComplete: function(id, fileName, responseJSON){
					if(responseJSON['success']){
						$('#btn').prop('disabled', false);
						$('#verifiedFile').val(responseJSON['filename']+'.'+responseJSON['ext']);
					}else {
						$('#btn').prop('disabled', true);
						$('#verifiedFile').val('');
					}
				},
				onSubmit: function(id, fileName){
				
//					console.log(arguments)
				},
				
				type: type,
				sizeLimit: 10000000, // max size   
				debug: false,
				params: {
						element: type, 
						layerId: 0
						}
			}); 	
	}*/
 </script>
{/literal} 


