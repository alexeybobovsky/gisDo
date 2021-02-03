{if $SMRT_EL.value}
<div >
<em>Картинки</em>      
	{section name=img loop=$SMRT_EL.value}
	{if $SMRT_EL.value[img].img_src}
	<div class=imgPad style='margin-bottom:5px; padding:5px; border: 1px solid #d0d0d0'>
	<div>
	<input type="text" id="imgAbout~{$SMRT_EL.value[img].file}" name="imgAbout~{$SMRT_EL.value[img].file}" value='{$SMRT_EL.value[img].img_title}' style='margin-bottom:5px;'></br>
	<input type="hidden" id="CMP#imgAbout~{$SMRT_EL.value[img].file}" name="CMP#imgAbout~{$SMRT_EL.value[img].file}" value='{$SMRT_EL.value[img].img_title}'>
	<input type="hidden" id="imgFullPath~{$SMRT_EL.value[img].file}" name="imgFullPath~{$SMRT_EL.value[img].file}" value='{$SMRT_EL.value[img].img_src}'>
	<img src='{$SMRT_EL.value[img].img_srcPrew}' border=0> 
	</div>
	<div><input type="checkbox" id="delImg~{$SMRT_EL.value[img].file}" name="delImg~{$SMRT_EL.value[img].file}" style="float:left;" value='1'>  
	<label for="delImg~{$SMRT_EL.value[img].file}"  style='float:none;'>Удалить картинку</label></div>
	</div>
	{/if}
	{/section}	
</div>
{/if}

<link  	rel="stylesheet" href="/src/design/fileuploader.css" type="text/css"/>
<SCRIPT type="text/javascript" src="/includes/jquery/fileuploader.js" ></script>
<div>
{if $SMRT_EL.default}
<input type="hidden" id="news_date" name="news_date" value='{$SMRT_EL.default.date}'>
<input type="hidden" id="news_nameTranslit" name="news_nameTranslit" value='{$SMRT_EL.default.nameTranslit}'>
{/if}
<div id=''></div>
<div class='slider-input'><div id="fileIcon">	<noscript><p>Please enable JavaScript to use file uploader.</p></noscript> </div></div>
<div id='imgPrew'></div>
</div>
 <script type="text/javascript">
{literal}
$(document).ready(function()
	{
	if(document.getElementById('fileIcon'))
		{
		var uploader;
	 	uploader = new qq.FileUploader({
			element: document.getElementById('fileIcon'),
{/literal}
			action: '{$SMRT_EL.action}',
{literal}
/*			action: '/map/set/upload',*/
/*		onComplete: function(id, fileName, responseJSON){alert(fileName)},*/
			allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],
			buttonLabel: 'Прикрепить фотографии',
			sizeLimit: 7000000, // max size   
			debug: true,
			params: {
			        element: 'icon'
					}
		/*});*/}); 
		}
	});
{/literal}
</script>