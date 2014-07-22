{* $Id: tiki-wizard_admin.tpl 49646 2014-01-30 17:29:39Z xavidp $ *}

{* {title}{tr}Admin Wizard{/tr}{/title} *}

<form action="tiki-wizard_admin.php" method="post">
{include file="wizard/wizard_bar_admin.tpl"}
<div id="wizardBody">
<table class="adminWizardTable">
	<tr>
	{if !empty($wizard_toc)}
		<td class="adminWizardTOC">
			<span class="adminWizardTOCTitle">{tr}Wizard Steps{/tr}</span><br>
			{$wizard_toc}
		</td>
	{/if}
		<td class="adminWizardBody">
			{include file="{$wizardBody}"}
		</td>
	</tr>
</table>
</div>
{include file="wizard/wizard_bar_admin.tpl"}
</form>
