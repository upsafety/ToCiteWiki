{* $Id: comment.tpl 43219 2012-09-30 16:29:54Z lindonb $ *}
{if empty($comment.doNotShow) or $comment.doNotShow != 1}
<article class="post {$thread_style}{if $prefs.feature_comments_moderation eq 'y'} post-approved-{$comment.approved}{/if} {if $prefs.comments_archive eq 'y' && $comment.archived eq 'y'}archived_comment{/if}" {if isset($comment.threadId)}id="threadId{$comment.threadId}" {/if}{if $prefs.comments_archive eq 'y' && $comment.archived eq 'y'}style="display: none;"{/if}>
	<div class="inner"><span class="corners-top"><span></span></span>

	<div class="clearfix postbody">
		{include file='comment-header.tpl'}
		{include file='comment-body.tpl'}
	</div>

{if $thread_style != 'commentStyle_headers'}
	{include file='comment-footer.tpl'}
	<br style="clear: both;" />
{/if}

	<span class="corners-bottom"><span></span></span></div>
</article>
{/if}

{if (!isset($first) or $first neq 'y') and isset($comment.replies_info) and $comment.replies_info.numReplies > 0
	&& $comment.replies_info.numReplies != ''
}
	{foreach from=$comment.replies_info.replies item="subcomment"}
		{if $subcomment.doNotShow != 1 && $thread_style != 'commentStyle_plain'}
		<div class="sub_comment_area">
			<div class="sub_comment">
		{/if}
		{include file='comment.tpl' comment=$subcomment}
		{if $subcomment.doNotShow != 1  && $thread_style != 'commentStyle_plain'}
			</div>
		</div>
		{/if}
	{/foreach}
{/if}
