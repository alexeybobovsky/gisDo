	<div class="tag-cloud">
		<ul>
 {section  name=tag loop=$SMRT_tag.list}		
		<li><a class="w{$SMRT_tag.list[tag].size}" rel="tag" href='{$SMRT_tag.list[tag].link}' title='{$SMRT_tag.list[tag].title}'><nobr>{$SMRT_tag.list[tag].name}</nobr></a></li>
 {/section}  
		</ul>
		</br>&#8594;<a class="summ" href='{$SMRT_tag.summ.link}'>{$SMRT_tag.summ.name}</a>
	</div>
