{* $Id: blog_post_postbody_content.tpl 48840 2013-11-29 19:59:39Z xavidp $ *}
{if $blog_post_context eq 'view_blog' && $use_excerpt eq 'y' && !empty($post_info.excerpt)}
	<div class="postbody-content postbody-excerpt">
	{$post_info.excerpt}
	</div>
	{self_link _script=$post_info.postId|sefurl:blogpost _noauto='y'}{tr}Read more{/tr}{/self_link}
{else}
	<div class="postbody-content">
		{$post_info.parsed_data}
	</div>
{/if}

{if $post_info.pages > 1}
	<div class="postbody-pagination">
		{if $blog_post_context eq 'view_blog'}
			<a {if $prefs.mobile_mode eq "y"}data-role="button" data-inline="true" {/if}class="link more" href="{$post_info.postId|sefurl:blogpost}">
			{tr}More...{/tr} ({$post_info.pages} {tr}pages{/tr})</a> {* mobile *}
		{else}
			<div align="center">
				<a {if $prefs.mobile_mode eq "y"}data-role="button" data-inline="true" {/if}href="tiki-view_blog_post.php?blogId={$smarty.request.blogId}&amp;postId={$smarty.request.postId}&amp;page={$post_info.first_page}">{icon _id='resultset_first' alt="{tr}First page{/tr}"}</a> {* mobile *}
				<a {if $prefs.mobile_mode eq "y"}data-role="button" data-inline="true" {/if}href="tiki-view_blog_post.php?blogId={$smarty.request.blogId}&amp;postId={$smarty.request.postId}&amp;page={$post_info.prev_page}">{icon _id='resultset_previous' alt="{tr}Previous page{/tr}"}</a> {* mobile *}
				<small>{tr}page:{/tr}{$post_info.pagenum}/{$post_info.pages}</small>
				<a {if $prefs.mobile_mode eq "y"}data-role="button" data-inline="true" {/if}href="tiki-view_blog_post.php?blogId={$smarty.request.blogId}&amp;postId={$smarty.request.postId}&amp;page={$post_info.next_page}">{icon _id='resultset_next' alt="{tr}Next page{/tr}"}</a> {* mobile *}
				<a {if $prefs.mobile_mode eq "y"}data-role="button" data-inline="true" {/if}href="tiki-view_blog_post.php?blogId={$smarty.request.blogId}&amp;postId={$smarty.request.postId}&amp;page={$post_info.last_page}">{icon _id='resultset_last' alt="{tr}Last page{/tr}"}</a> {* mobile *}
			</div>
		{/if}
	</div>
{/if}

{* Copyright display is being turned off if being called through the "BLOG" plugin with "simple" mode turned off and a max character count supplied (preview mode). If in preview mode end user most likely is wantingto conserve space with a smaller display of information *}
{if $blog_post_context neq 'plugin_preview'}
	{capture name='copyright_section'}
		{include file='show_copyright.tpl'}
	{/capture}
	{* When copyright section is not empty show it *}
	{if $smarty.capture.copyright_section neq ''}
		<footer class="editdate">
			{$smarty.capture.copyright_section}
		</footer>
	{/if}
{/if}
