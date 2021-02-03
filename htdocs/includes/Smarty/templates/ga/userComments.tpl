{*include file='ga/userCompanyHeader.tpl'*}
{if !$firmComments}
	<div id='comments' class='firm-profile'>		
	<ul>
		<li>
			Пока нет ни одного отзыва об этой компании.{if $option.showCommentBox} Будете первым?{/if}
		</li>
	</ul>
	</div>
{/if}
{if $firmComments}
	{section name=cnt loop=$firmComments}
	{assign var="SMRT_CNT" value=$firmComments[cnt]}
	<div id='comments' {if !$SMRT_CNT.comm_hidden} class='comments'{else}  class='comments-hidden'{/if}>		
	<ul>
			<li>
				<a href="/user/{$SMRT_CNT.user_name}" {* class="url"*} >{$SMRT_CNT.user_name}</a>
			</li>
			<li>
				<abbr title='{*$SMRT_CNT.comm_date|date_format:"%a, %d %b %y"*}'> {$SMRT_CNT.comm_date_ru}</abbr>
			</li>
			{*if $option.showCommentBox}
			<li>
				<a href="{$option.linkQuote}/{$SMRT_CNT.comm_id}" title="Цитировать" rel="bookmark" id='Q_{$SMRT_CNT.comm_id}' onClick='quoteComment(this);'>Q</a>
			</li>
			{/if*}
			{if $SMRT_CNT.showEdit}
			<li>
				<a href="{$option.linkEdit}/{$SMRT_CNT.comm_id}" title="Редактировать" rel="bookmark">E</a>
			</li>
			{/if}
			{if $SMRT_CNT.showHide}			
			<li>
				{if !$SMRT_CNT.comm_hidden}
					<a href="{$option.linkHide}/{$SMRT_CNT.comm_id}" title="Скрыть" rel="bookmark">H</a>
				{else}
					<a href="{$option.linkShow}/{$SMRT_CNT.comm_id}" title="Открыть" rel="bookmark">S</a>				
				{/if}
			</li>
			{/if}
			{if $SMRT_CNT.showDelete}
			<li>
				<a href="{$option.linkDelete}/{$SMRT_CNT.comm_id}" title="Удалить" rel="bookmark" onclick="return confirmLink('Удалить комментарий?')">X</a>
			</li>
			{/if}
		<ul>	
		<ul>
			<li>
				<div class='comment-body' id='commentBody_{$SMRT_CNT.comm_id}'>
					{$SMRT_CNT.comm_body}
				</div>
			</li>
		</ul>
	</div>	
	{/section}
{/if}			
