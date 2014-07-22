{strip}
{if $error}
	<div class="user-info">
		<span>{$error}</span>
	</div>
{else}
	<div class="user-info friend-container" data-controller="user" data-action="info" data-params='{ldelim}"username":"{$other_user}"{rdelim}'>
		<h3>{$fullname|escape} <span class="star">{$starHtml}</span></h3>
		{if $avatarHtml}
			<span class="avatar">{$avatarHtml}</span>
		{else}
			<span class="avatar">{icon _id='img/noavatar.png'}</span>
		{/if}
		<p class="info">
			{if $gender}
				<span class="gender">{icon _id=$gender|lower}<span>{tr}Gender:{/tr} {$gender}</span></span>
			{/if}
			{if $country}
				<span class="country">{icon _id='img/flags/'|cat:$country|cat:'.gif'}<span> {$country|stringfix}</span></span>
				{if !empty($distance)}<span class="distance">{tr _0=$distance}%0 away{/tr}</span>{/if}
			{/if}
			{if $email}
				<span class="email">{tr}Email:{/tr} {$email}</span>
			{/if}
			<span class="lastseen"><span>{tr}Last login:{/tr} </span>{$lastSeen|tiki_short_datetime}</span>
			{if $shared_groups}
				<span class="shared-groups">{tr}Shared groups:{/tr}<span> {$shared_groups|escape}</span></span>
			{/if}
		</p>
		{if $friendship|count}
			<ul class="friendship clearfix">
				{foreach from=$friendship item=relation}
					<li>
						{icon _id='social_'|cat:$relation.type _title=$relation.label|escape}<span> {$relation.label|escape}</span>
						{if !empty($relation.remove)}
							<a class="floatright remove-friend" href="{service controller=social action=remove_friend friend=$other_user}"
										title="{$relation.remove}" data-confirm="{tr _0=$other_user}Do you really want to remove %0?{/tr}">
								{icon _id=cross alt="{$relation.remove}"}
							</a>
						{/if}
						{if !empty($relation.add)}
							<a class="floatright add-friend" title="{$relation.add}" href="{service controller=social action=add_friend username=$other_user}">
								{icon _id=add alt="{$relation.add}"}
							</a>
						{/if}
						{if !empty($relation.approve)}
							<a class="floatright approve-friend" title="{$relation.approve}" href="{service controller=social action=approve_friend friend=$other_user}">
								{icon _id=accept alt="{$relation.approve}"}
							</a>
						{/if}
					</li>
				{/foreach}
			</ul>
		{/if}
		{if $add_friend_button}
			<p>
				<a class="add-friend" href="{service controller=social action=add_friend username=$other_user}">
					{icon _id=add alt="{tr}Add{/tr}"}
					{$add_friend_button}
				</a>
			</p>
		{/if}
	</div>
{/if}
{/strip}
