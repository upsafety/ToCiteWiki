{* $Id: admin_date_time.tpl 49842 2014-02-11 23:04:44Z arildb $ *}

{tr}Set the site timezone and format for displaying dates and times{/tr}.
<div class="adminWizardIconleft"><img src="img/icons/large/wizard_admin48x48.png" alt="{tr}Admin Wizard{/tr}" title="{tr}Admin Wizard{/tr}" /></div><div class="adminWizardIconright"><img src="img/icons/large/icon-configuration48x48.png" alt="{tr}Set up your Date and Time{/tr}" /></div>
<div class="adminWizardContent">
<fieldset>
	<legend>{tr}Date and Time setup{/tr}</legend>
	<img src="img/icons/large/admin.gif" class="adminWizardIconright"/>
	<div class="admin clearfix featurelist">
	{preference name=server_timezone}
	{preference name=users_prefs_display_12hr_clock}
	{preference name=users_prefs_display_timezone}
	{preference name=display_field_order}
	</div>
	<br>
	<em>{tr}See also{/tr} <a href="tiki-admin.php?page=general&amp;alt=General#content4" target="_blank">{tr}Date and Time admin panel{/tr}</a></em>
</fieldset>
<br>
</div>
