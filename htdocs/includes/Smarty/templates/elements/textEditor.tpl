<link 	rel="stylesheet" type="text/css" href="/includes/jwysiwyg/jquery.wysiwyg.css" />
<link 	rel="stylesheet" type="text/css" href="/includes/jwysiwyg/blueprint/jquery.wysiwyg.css" />
<link 	rel="stylesheet" type="text/css" href="/includes/jwysiwyg/blueprint/jquery.wysiwyg.css" />

<SCRIPT src="/includes/JS/gd/userMessage.js" type=text/javascript></SCRIPT>
<script type="text/javascript" src="/includes/jwysiwyg/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="/includes/jwysiwyg/controls/wysiwyg.link.js"></script>
<script type="text/javascript" src="/includes/jwysiwyg/controls/wysiwyg.image.js"></script>
<script type="text/javascript" src="/includes/jwysiwyg/controls/wysiwyg.table.js"></script>

<script type="text/javascript" src="/includes/jwysiwyg/plugins/wysiwyg.i18n.js"></script> 
<script type="text/javascript" src="/includes/jwysiwyg/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="/includes/jwysiwyg/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="/includes/jwysiwyg/ui/jquery.ui.mouse.js"></script>
<script type="text/javascript" src="/includes/jwysiwyg/ui/jquery.ui.resizable.js"></script>
<script type="text/javascript" src="/includes/jwysiwyg/i18n/lang.ru.js"></script>
<div class='form'>
	<textarea id="{$SMRT_EL.name}" name="{$SMRT_EL.name}"  rows="5" cols="80" {*style='display:none'*}>{$SMRT_EL.default}</textarea>
</div>
{literal}
<script type="text/javascript">
var errorBoxActive = commentBoxActive = false;
$(document).ready(function() {
	var editorOptions  = {
						rmUnusedControls: false,
						resizeOptions: {}, 
						controls: {
/*							cut   : { visible : true },
							copy  : { visible : true },
							paste : { visible : true }, 			
							bold          : { visible : true },
							italic        : { visible : true },
							underline     : { visible : true },
							strikeThrough : { visible : true }, 
							insertOrderedList    : { visible : true },
							insertUnorderedList  : { visible : true }, 
							undo : { visible : true },
							redo : { visible : true }		*/	
							},
						plugins: {
								i18n: { lang: "ru" }}};
{/literal}
	$('#{$SMRT_EL.name}').wysiwyg(editorOptions);
{literal}
		});
</script>			
{/literal}
