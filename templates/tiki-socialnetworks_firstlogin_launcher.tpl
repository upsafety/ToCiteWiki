{jq}
{{if $mid != 'tiki-socialnetworks_firstlogin.tpl'}}
if ($("form > input[name=origin]:hidden").length === 0) {	// lightweight fix to avoid clash of user_conditions and fb 1st login
	setTimeout(function () {
		$("body").colorbox({
			open: true,
			href: "tiki-socialnetworks_firstlogin.php",
			iframe: true,
			scrolling: false,
			width: 650,
			height: 600
		});
	}, 1000);
}
{{/if}}
{/jq}
{literal}
<style type="text/css">
#cboxClose{display:none !important;}
#cboxIframe{overflow:hidden;}
</style>
{/literal}