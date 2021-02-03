{if $option.showForm}
{literal}
<script language="JavaScript">
function checkActionBtn()
	{
	var $cntMess = document.getElementById('cnt').value;
	if((document.getElementById('actionSelect_top'))&&($cntMess>0))
		{
		document.getElementById('actionSelect_top').disabled = false;
		document.getElementById('actionBtn_top').disabled = false;		
		}
	else if((document.getElementById('actionSelect_top'))&&($cntMess==0)) 
		{
		document.getElementById('actionSelect_top').disabled = true;
		document.getElementById('actionBtn_top').disabled = true;		
		}
	if((document.getElementById('actionSelect_btm'))&&($cntMess>0))
		{
		document.getElementById('actionSelect_btm').disabled = false;
		document.getElementById('actionBtn_btm').disabled = false;		
		}
	else if((document.getElementById('actionSelect_btm'))&&($cntMess==0)) 
		{
		document.getElementById('actionSelect_btm').disabled = true;
		document.getElementById('actionBtn_btm').disabled = true;		
		}
	}
function checkCanMultiple(obj)
	{
	if(obj.id == 'actionSelect_btm')
		var objSubmit = document.getElementById('actionBtn_top');
	else if(obj.id == 'actionSelect_top')
		var objSubmit = document.getElementById('actionBtn_btm');
	var canMultiple = document.getElementById('multipleSend').value;
	if((!canMultiple)&&(obj.selectedIndex==2))
		{
		if(document.getElementById('actionBtn_top'))
			document.getElementById('actionBtn_top').disabled = true;
		if(document.getElementById('actionBtn_btm'))
			document.getElementById('actionBtn_btm').disabled = true;
		}
	else
		{
		if(document.getElementById('actionBtn_top'))
			document.getElementById('actionBtn_top').disabled = false;
		if(document.getElementById('actionBtn_btm'))
			document.getElementById('actionBtn_btm').disabled = false;		
		}
	
	}
function checkClicked(obj)
	{
	var cnt = 0;
	var cntMessObj = document.getElementById('cnt');
	if(obj.checked)
		{
		cntMessObj.value ++;
		}
	else
		{
		cntMessObj.value --;
		}
	checkActionBtn();
	}
	
function runSubmit(val)
	{
	var action = document.getElementById('action');
	var cntMessObj = document.getElementById('cnt');

	/*var obj = document.getElementById('actionSelect_' + objPostFiks);*/
	if(val == 1)
		{
		var confirmMessage = (cntMessObj.value < 2) ? 'Удалить сообщение?' : 'Удалить выбранные сообщения?'
		if (confirmLink(confirmMessage))
			action.value = 1;
		}
	else if (val == 2)
		{
		action.value = 2;
		}
//	alert(action.value);
	if(action.value>0)
		action.form.submit();
	}
function unCheckAll(formName)
	{
	var cnt = 0;
	var elCount = document.forms[formName].elements.length;
	for (var i = 0; i < elCount; i++)
		{		
		if(document.forms[formName].elements[i].type == 'checkbox')
			{
			document.forms[formName].elements[i].checked = false;
			cnt ++;
			}
		}
	document.getElementById('cnt').value = 0;
	checkActionBtn();
	}
function checkAll(formName)
	{
	var cnt = 0;
	var elCount = document.forms[formName].elements.length;
	for (var i = 0; i < elCount; i++)
		{		
		if(document.forms[formName].elements[i].type == 'checkbox')
			{
			document.forms[formName].elements[i].checked = true;
			cnt ++;
			}
		}
	document.getElementById('cnt').value = cnt;
	checkActionBtn();
	}
</script>
{/literal}
<FORM name='mes-form' id='mes-form'  action='{$option.formAction}' method='post' encType='multipart/form-data'  >
<INPUT  name='action' id='action' type='hidden' value='0'>
<INPUT  name='direction' id='direction' type='hidden' value='{$option.direction}'>
<INPUT  name='cnt' id='cnt' type='hidden' value='0'>
<INPUT  name='multipleSend' id='multipleSend' type='hidden' value='{$option.multipleSend}'>
<INPUT  name='actionForSelect' id='actionForSelect' type='hidden' value='0'>
<INPUT  name='USER' id='USER' type='hidden' value='{$profile.user_id}'>
<INPUT  name='_REFERRER' id='_REFERRER' type='hidden' value='{$menu.queryString}'>

{/if}


<div id='mes-menu-top' class='mestabs' style='BORDER-BOTTOM: #ccc 1px solid;'>	
<TABLE cellSpacing=0 cellPadding=0 border=0 width='100%' >
	  <THEAD>
	</THEAD>
	<TBODY>
	<TR>
		<TD align='left' >
		{if $option.showForm && $messages}
			<SPAN class='action' onClick='checkAll("mes-form");'>
			Выделить все
			</SPAN>
			<SPAN class='action' onClick='unCheckAll("mes-form");'>
			Снять выделение
			</SPAN>				
			<SPAN class='actionInput'>
			Выбранные 
			<SELECT name='actionSelect_top' id='actionSelect_top' onChange='checkCanMultiple(this)' disabled> 
			<OPTION VALUE=0> </OPTION>
			{*if !$option.direction*}
			<OPTION VALUE=1>Удалить </OPTION>
			{*/if*}
			<OPTION VALUE=2>Ответить</OPTION>
			</SELECT>
			<INPUT TYPE='BUTTON' value='&#8594;' name='actionBtn_top' id='actionBtn_top' onClick='runSubmit(document.getElementById("actionSelect_top").value);'  disabled>
			</SPAN>	
		{else}&nbsp;{/if}
		
		</TD>
		<TD align='right' >
			{if !$option.direction}
			<SPAN class='menuCurrent'>&#8594;Входящие</SPAN> 
			{else}
			<SPAN class='menu'><a href='{$option.linkInbox}' >Входящие</a></SPAN> 
			{/if}
			
			{if !$option.direction}
			<SPAN class='menu'><a href='{$option.linkOutbox}' >Исходящие</a></SPAN> 			 
			{else}
			<SPAN class='menuCurrent'>Исходящие&#8594;</SPAN>
			{/if}
		</TD>
	</TR>
</TBODY>
</TABLE>
</div>
{if !$messages}
	<div id='comments' class='firm-profile'>		
	{*<ul>
		<li>*}
			Сообщений нет.
	{*	</li>
	</ul>
	</div>*}
{else}

	{section name=cnt loop=$messages}
	{assign var="SMRT_CNT" value=$messages[cnt]}
	<div id='comments' {if !$SMRT_CNT.comm_hidden} class='mesages'{else}  class='mesages-hidden'{/if}>		
	<ul>
			<li>
				{if $SMRT_CNT.mes_showSender}<a href="/user/{$SMRT_CNT.user_name}" ><STRONG>{$SMRT_CNT.user_name}</STRONG></a>{else}
				<STRONG>{$SMRT_CNT.user_name}</STRONG>{/if}
			</li>
			<li>
				<abbr title=''> {$SMRT_CNT.mes_date_ru}</abbr>
			</li>
			{*if $SMRT_CNT.showEdit}
			<li>
				<a href="{$option.linkEdit}/{$SMRT_CNT.comm_id}" title="Редактировать" rel="bookmark">E</a>
			</li>
			{/if}
			{if $SMRT_CNT.showHide}			
			<li>
				{if $SMRT_CNT.mes_state}
					<a href="{$option.linkHide}/{$SMRT_CNT.comm_id}" title="Скрыть" rel="bookmark">H</a>
				{else}
					<a href="{$option.linkShow}/{$SMRT_CNT.comm_id}" title="Опубликовать" rel="bookmark">P</a>				
				{/if}
			</li>
			{/if}
			{if $SMRT_CNT.showDelete}
			<li>
				<a href="{$option.linkDelete}/{$SMRT_CNT.comm_id}" title="Удалить" rel="bookmark" onclick="return confirmLink('Удалить комментарий?')">X</a>
			</li>
			{/if*}
		<ul>	
		<ul>
			<li>
				{if $SMRT_CNT.mes_isOfficial}
				<div class='mesages-subj-official' id='commentSubj_{$SMRT_CNT.mes_id}' title='Шаблонное сообщение'>
					{$SMRT_CNT.mes_subject}
				</div>
				{else}
				<div class='mesages-subj' id='commentSubj_{$SMRT_CNT.mes_id}'>
					{$SMRT_CNT.mes_subject}
				</div>
				{/if}
			</li>
		</ul>		
		<ul>
			<li>
				<div class='mesages-body' id='commentBody_{$SMRT_CNT.mes_id}'>
					{$SMRT_CNT.mes_body}
				</div>
			</li>
		</ul>
		{if $option.showForm}
		<ul>
			<li><div class='mesages-check'>
			<input type='checkbox' name='mes_{$SMRT_CNT.mes_id}' id='mes_{$SMRT_CNT.mes_id}' title='Выделить сообщение' onClick='checkClicked(this);'>
			</div>
		</li>
		</ul>
		{/if}
		{if $SMRT_CNT.replyes}
		<div style='margin-left: 20px;'>
		{section name=repl loop=$SMRT_CNT.replyes}
		<ul>
			<li>
				<div class='mesages-subj' id='commentSubj_{$SMRT_CNT.mes_id}'>
					{$SMRT_CNT.replyes[repl].user_name} ответил на это:
				</div>
			</li>
		</ul>		
		<ul>
			<li>
				<div class='mesages-body' id='commentBody_{$SMRT_CNT.replyes[repl].mes_id}'>
					{$SMRT_CNT.replyes[repl].mes_body}
				</div>
			</li>
		</ul>				
		{/section}
		</div>
		{/if}
	</div>	
	{/section}
{/if}			
{*if $smarty.section.cnt.total >5}
<div id='mes-menu' class='mestabs' style='BORDER-TOP: #ccc 1px solid; MARGIN-TOP:10px;'>	
<TABLE cellSpacing=0 cellPadding=0 border=0 width='100%' >
	  <THEAD>
	</THEAD>
	<TBODY>
	<TR>
		<TD align='left' >
			<SPAN class='action'>
			Выделить все
			</SPAN>
			<SPAN class='action'>
			Снять выделение
			</SPAN>				
			<SPAN class='actionInput'>
			Выбранные 
			<SELECT> 
			<OPTION VALUE=0> </OPTION>
			<OPTION VALUE=1>Удалить </OPTION>
			<OPTION VALUE=2>Ответить</OPTION>
			</SELECT>			
			</SPAN>			
		</TD>
		<TD align='right' >
			<SPAN class='menuCurrent'>&#8594;Входящие</SPAN> <SPAN class='menu'><a href='#' >Исходящие</a><SPAN>
		</TD>
	</TR>
</TBODY>
</TABLE>
</div>
{/if*}
</FORM>