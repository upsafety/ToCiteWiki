{* $Id: tiki-accounting_account_deleted.tpl 45006 2013-02-28 14:59:58Z chibaguy $ *}
{title help="accounting"}
	{$book.bookName}: {tr}Account{/tr} {$account.accountId} {$account.accountName}
{/title}
{if !empty($errors)}
	<div class="simplebox highlight">
		{icon _id=exclamation alt="{tr}Error{/tr}" style="vertical-align:middle" align="left"}
		{foreach from=$errors item=m name=errors}
			{$m}
			{if !$smarty.foreach.errors.last}<br>{/if}
		{/foreach}
	</div>
{else}
<p>{tr _0=$accountId _1=$account.accountName}Successfully deleted account %0 %1.{/tr}</p>
{/if}
{button _keepall='y' href="tiki-accounting.php" bookId=$bookId _text="{tr}Return to main accounting page{/tr}"}
