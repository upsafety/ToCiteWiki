 {* $Id: wikiplugin_catorphans.tpl 46530 2013-07-03 16:25:22Z jonnybradley $ *}

{foreach from=$orphans item=orphan}
		 <a href="{$orphan.pageName|sefurl}">{$orphan.pageName|escape}</a><br>
{/foreach}
{if $pagination.step ne -1}
	{pagination_links cant=$pagination.cant step=$pagination.step offset=$pagination.offset}{/pagination_links}
{/if}