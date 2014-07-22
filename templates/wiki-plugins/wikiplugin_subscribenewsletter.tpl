{* $Id: wikiplugin_subscribenewsletter.tpl 47507 2013-09-16 13:52:16Z chibaguy $ *}
{if $wpSubscribe eq 'y'}
	{if empty($subscribeThanks)}
		{tr}Subscription confirmed!{/tr}
	{else}
		{$subscribeThanks|escape}
	{/if}
{else}
	<form method="post">
		<input type="hidden" name="wpNlId" value="{$subscribeInfo.nlId|escape}">
		{if empty($user)}
			{if !empty($wpError)}
				{remarksbox type='errors'}
						{$wpError|escape}
				{/remarksbox}
			{/if}
			<label>{tr}Email:{/tr} <input type="text" name="wpEmail" value="{$subscribeEmail|escape}"></label>
		{/if}
		{if !$user and $prefs.feature_antibot eq 'y'}
			{include file='antibot.tpl' tr_style="formcolor" antibot_table="y"}
		{/if}
		{if empty($subcribeMessage)}
			<input type="submit" class="btn btn-default" name="wpSubscribe" value="{tr}Subscribe to the newsletter:{/tr} {$subscribeInfo.name}">
		{else}
			<input type="submit" class="btn btn-default" name="wpSubscribe" value="{$subcribeMessage|escape}">
		{/if}
	</form>
{/if}