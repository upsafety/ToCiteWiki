{* $Id: admin_text_area.tpl 49842 2014-02-11 23:04:44Z arildb $ *}

{tr}Set up the text area environment (Editing and Plugins){/tr}.
<div class="adminWizardIconleft"><img src="img/icons/large/wizard_admin48x48.png" alt="{tr}Admin Wizard{/tr}" title="{tr}Admin Wizard{/tr}" /></div><div class="adminWizardIconright"><img src="img/icons/large/editing48x48.png" alt="{tr}Set up the Text Area{/tr}" /></div>
<div class="adminWizardContent">
<fieldset>
	<legend>{tr}General settings{/tr}</legend>
	<div class="admin clearfix featurelist">
	{preference name=feature_fullscreen}
	{preference name=wiki_edit_plugin}
	{preference name=wiki_edit_icons_toggle}
	{preference name=wikipluginprefs_pending_notification}
	{if $isRTL eq false and $isHtmlMode neq true}		{* Disable Codemirror for RTL languages. It doesn't work. *}
		{preference name=feature_syntax_highlighter}
		{preference name=feature_syntax_highlighter_theme}
	{/if}
	</div>
	<br>
	<em>{tr}See also{/tr} <a href="tiki-admin.php?page=textarea&amp;alt=Editing+and+Plugins#content1" target="_blank">{tr}Editing and plugins admin panel{/tr}</a></em>
</fieldset>
</div>
