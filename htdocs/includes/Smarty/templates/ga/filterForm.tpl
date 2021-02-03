 {if $filter}
 "<div id='filterCont'  style='background: #ffffff;'>" + 
  "<fieldset>"+
	"<legend>Фильтр</legend>" +
		"<TABLE cellSpacing=0  width = '100%'  style='' cellPadding=1 border=0>" + 
			"<FORM name='{$filter.form.form_name}' action='{$filter.form.form_action}' method=post encType=multipart/form-data>" + 
			"<tr>" +
				{section name=el loop=$filter.elements}
					{assign var="SMRT_EL" value=$filter.elements[el]}
					{assign var="SMRT_INDX" value=$filter.section.el.index}
					{*if $filter.elements[el].type !='hidden'*}
					"<td  align='left' {if $filter.elements[el].type =='button'} valign='bottom' {/if}>"+
					
					{if $filter.form.form_elementCaption[el]}
						"<SMALL>{$filter.form.form_elementCaption[el]}"+
						{if $SMRT_EL.necessary}
								"<font color=red>*</font>"+
						{else}
								"&nbsp;"+
						{/if}
						"</SMALL><br>" +
					{/if}
							"<span id='DIV{$SMRT_EL.id}'>"+
							{if !$SMRT_EL.skipTemplate}
								"{include file='elements/'|cat:$SMRT_EL.template}" +
							{/if}
							"</span>" + 
					"</td>" +
				{/section}
{*				
				"<TD align=left valign='bottom'>" + 
						{assign var="SMRT_EL" value=$filter.elSubmit}	
						"{include file='elements/'|cat:$SMRT_EL.template}" +
				"</td>"+			
*}				
			"</tr>" + 							
		"</table>" + 
  "</fieldset>" +						
"</div>";
{/if}