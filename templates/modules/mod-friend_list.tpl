{if $user}
	{tikimodule error=$module_params.error title=$tpl_module_title name="friend_list" flip=$module_params.flip decorations=$module_params.decorations nobox=$module_params.nobox notitle=$module_params.notitle}
		{include file="social/list_friends.tpl" friends=$mod_friend_list.friends incoming=$mod_friend_list.incoming outgoing=$mod_friend_list.outgoing}
	{/tikimodule}
{/if}
