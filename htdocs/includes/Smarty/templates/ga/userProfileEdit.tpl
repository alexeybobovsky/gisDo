{literal}
<script language="JavaScript">
var necessary = new Array();
var necessCount = 0;
function check2Password(the_form)
	{
	var cnt = 0;
	var elCount = document.forms[the_form.name].elements.length;
	for (var i = 0; i < elCount; i++)
		{		
		if(document.forms[the_form.name].elements[i].type == 'password')
			{
			if(cnt)
				var passInput2 = document.forms[the_form.name].elements[i].value;				
			else
				{
				cnt ++;
				var passInput1 = document.forms[the_form.name].elements[i].value;
				}
			}
		}
	return (passInput2 == passInput1) ? 1 :0;	
	}
function EmptyCheck(the_form)
	{
	var emptyCount = 0;
	var checkPass = 0;
//	alert(document.forms[the_form.name].elements[0].type);
	var elCount = document.forms[the_form.name].elements.length;
	for (var i = 0; i < elCount; i++)
		{		
		if(document.forms[the_form.name].elements[i].type == 'submit')
			{
			var submit = document.forms[the_form.name].elements[i];
			}
		if(document.forms[the_form.name].elements[i].type == 'password')
			{
			checkPass = 0;
			}
		}
	var necCount = necessary.length;
    for (var j=0; j<necCount; j++)
	    {			
		tmpName = necessary[j];
		obj = document.getElementById(tmpName);
		/*if((!obj)&&(eval('document.all.'+tmpName)!=null))
			{
			obj=eval('document.all.'+tmpName);
			}*/
		if ((obj)&&(obj.value=='')&&(!obj.disabled))
			{
			emptyCount++;
			}
		}
	if (emptyCount>0)
		{
		submit.disabled = true;
		}
	else
		{
		if(((checkPass)&&(check2Password(the_form)))||(!checkPass))
			submit.disabled = false;
		else if((checkPass)&&(!check2Password(the_form)))
			submit.disabled = true;
		}
	}	
</script>
{/literal}
	{section name=area loop=$contentHTML}
	{assign var="SMRTcontentArea" value=$contentHTML[area]}	
		{assign var="content" value=$SMRTcontentArea}
		<FORM name='{$content.form.form_name}' action='{$content.form.form_action}' method='post' encType='multipart/form-data' {if $content.form.form_onSubmit}onSubmit='{$content.form.form_onSubmit}'{/if} >
		<DIV class='form-standart'>
			{section name=el loop=$content.elements}			
			{assign var="SMRT_EL" value=$content.elements[el]}
			{if $content.el_caption[el]}
				<SMALL> {$content.el_caption[el]} </SMALL>
				
				{if $SMRT_EL.necessary}
						<font color=red>*</font>
				{else}
						&nbsp;
				{/if}				
			{/if}		
			<DIV id='DIV{$SMRT_EL.id}' {if $content.form.form_isHidden} style='DISPLAY:NONE;'{/if}>				

						{if $SMRT_EL.necessary}
						<script language="JavaScript">
							necessary[necessCount] = "{$SMRT_EL.id}";
							necessCount ++;
						</script>
						{/if}					

							{*<span id='DIV{$SMRT_EL.name}'>*}
							{if !$SMRT_EL.skipTemplate}
								{include file='elements/'|cat:$SMRT_EL.template}
								{*include file=$SMRT_EL.template*}
							{/if}
							{*</span>*}
			</DIV>
			{/section}
			{if $content.elSubmit}
				<font color=red>*</font> <SMALL> - это поле не должно быть пустым</SMALL>				
						<br><br>		
						{assign var="SMRT_EL" value=$content.elSubmit}
						<DIV>
						{include file=$SMRT_EL.template}
						</DIV>

			{/if}
			
</DIV>
		</FORM>
	{/section}
