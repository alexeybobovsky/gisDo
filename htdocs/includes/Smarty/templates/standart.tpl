{section name=el loop=$BODY}
{math equation="index / 2 - 0.1" index = $smarty.section.el.iteration assign=SMRT_dev_val}
{math equation="2 * round(dev) " index = $smarty.section.el.iteration dev = $SMRT_dev_val assign=SMRT_dev_val_round}
	{$BODY[el]}

{/section}
<!-- Субменю третье и последующие ответвления -->
{*if $menu.links}
Ссылки по теме:<br /> 
{section name=link loop=$menu.links}
<a class=text href="{$menu.links[link].link}">{$menu.links[link].label}</a><br>
{/section}
{/if*}
<!-- * Субменю третье и последующие ответвления -->
