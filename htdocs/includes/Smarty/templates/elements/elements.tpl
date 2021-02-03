{section name=el loop=$elements}
	{assign var="SMRT_EL" value=$elements[el]}
	{if !$SMRT_EL.skipTemplate}
		{include file='elements/'|cat:$SMRT_EL.template}
		{*include file=$SMRT_EL.template*}
	{/if}
{/section}
