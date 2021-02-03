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
	<div id='comments' class='mesages'{if $SMRT_CNT.lvl}style='margin-left: 30px; margin-top: 5px;'{/if}>		
	<ul>
			<li>
			{if !$SMRT_CNT.lvl}Написал {else}Ответил {/if}
				{if $SMRT_CNT.mes_showSender}<a href="/user/{$SMRT_CNT.user_name}" ><STRONG>{$SMRT_CNT.user_name}</STRONG></a>{else}
				<STRONG>{$SMRT_CNT.user_name}</STRONG>{/if}
			</li>
			<li>
				<abbr title=''> {$SMRT_CNT.mes_date_ru}</abbr>
			</li>
		<ul>
{*		
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
*}		
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