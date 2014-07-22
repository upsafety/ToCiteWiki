{* $Id: itemlink.tpl 47207 2013-08-22 14:14:36Z arildb $ *}
<select name="{$field.ins_id}{if $data.selectMultipleValues}[]{/if}" {if $data.preselection and $data.crossSelect neq 'y'}disabled="disabled"{/if} {if $data.selectMultipleValues}multiple="multiple"{/if}>
	{if $field.isMandatory ne 'y' || empty($field.value)}
		<option value=""></option>
	{/if}
	{if !empty($data.remoteData) and $data.crossSelect eq 'y'}
	{* For crossSelect links, use $data.remoteData. No item is selected*}
	{foreach key=id item=label from=$data.remoteData}
		<option value="{$id|escape}" {if $data.preselection and !$field.value and $data.preselection eq $id or (($data.selectMultipleValues and is_array($field.value) and in_array($id, $field.value) or $field.value eq $id))}selected="selected"{/if}>
			{$label|escape}
		</option>
	{/foreach}
	{else}
	{* Run the original loop *}
	{foreach key=id item=label from=$data.list}
		<option value="{$id|escape}" {if $data.preselection and !$field.value and $data.preselection eq $id or (($data.selectMultipleValues and is_array($field.value) and in_array($id, $field.value) or $field.value eq $id))}selected="selected"{/if}>
			{$label|escape}
		</option>
	{/foreach}
	{/if}
</select>