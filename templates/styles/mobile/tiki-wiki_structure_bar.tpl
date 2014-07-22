<div class="tocnav">
  		<div style="float: right;">
{if $struct_editable eq 'y'}
	<form action="tiki-editpage.php" method="post">
		<div class="form">
			<input type="hidden" name="current_page_id" value="{$page_info.page_ref_id}">
			<input type="text" id="structure_add_page" name="page">
			{autocomplete element='#structure_add_page' type='pagename'}
			{* Cannot add peers to head of structure *}
			{if $page_info and !$parent_info}
				<input type="hidden" name="add_child" value="checked"> 
			{else}
				<input type="checkbox" name="add_child" id="add_child" class="custom" data-mini="true"><label for="add_child">{tr}Child{/tr}</label>
			{/if}      
			<input type="submit" class="btn btn-default" name="insert_into_struct" value="{tr}Add Page{/tr}">
		</div>
	</form>
	</div>
	<div class="clearfix" data-role="controlgroup" data-type="horizontal">{* mobile *}
		
  
    {if $home_info}{if $home_info.page_alias}{assign var=icon_title value=$home_info.page_alias}{else}{assign var=icon_title value=$home_info.pageName}{/if}
    	<a data-role="button" href="{query _type='relative' page=$home_info.pageName structure=$home_info.pageName page_ref_id=$home_info.page_ref_id}">{icon _id='house' alt="{tr}TOC{/tr}" title=$icon_title}</a>
    {/if}

    {if $prev_info and $prev_info.page_ref_id}{if $prev_info.page_alias}{assign var=icon_title value=$prev_info.page_alias}{else}{assign var=icon_title value=$prev_info.pageName}{/if}
    	<a data-role="button"  href="{sefurl page=$prev_info.pageName structure=$home_info.pageName page_ref_id=$prev_info.page_ref_id}">
    		{icon _id='resultset_previous' alt="{tr}Previous page{/tr}" title=$icon_title}</a>
    {else}
    	<img src="img/icons/8.gif" alt="" height="1" width="8px">
    {/if}

    {if $parent_info}{if $parent_info.page_alias}{assign var=icon_title value=$parent_info.page_alias}{else}{assign var=icon_title value=$parent_info.pageName}{/if}
    	<a data-role="button"  href="{sefurl page=$parent_info.pageName structure=$home_info.pageName page_ref_id=$parent_info.page_ref_id}">
    		{icon _id='resultset_up' alt="{tr}Parent page{/tr}" title=$icon_title}</a>
    {else}
    	<img src="img/icons/8.gif" alt="" height="1" width="8px">
    {/if}

    {if $next_info and $next_info.page_ref_id}{if $next_info.page_alias}{assign var=icon_title value=$next_info.page_alias}{else}{assign var=icon_title value=$next_info.pageName}{/if}<a data-role="button" href="{sefurl page=$next_info.pageName structure=$home_info.pageName page_ref_id=$next_info.page_ref_id}">{icon _id='resultset_next' alt="{tr}Next page{/tr}" title=$icon_title}</a>{else}<img src="img/icons/8.gif" alt="" height="1px" width="8px">{/if}

		
	<a data-role="button" href="{query _type='relative' _script='tiki-edit_structure.php' page_ref_id=$home_info.page_ref_id _alt='{tr}Structure{/tr}' _title='{tr}Structure{/tr} ($cur_pos)'}"> {icon _id='chart_organisation' alt="{tr}Structure{/tr}" title="{tr}Structure{/tr} ($cur_pos)"}</a>&nbsp;&nbsp;
	</div>
<div>
{else}
		</div>
{/if}
	    {section loop=$structure_path name=ix}
	      {if $structure_path[ix].parent_id}&nbsp;{$prefs.site_crumb_seper}&nbsp;{/if}
		  <a href="{sefurl page=$structure_path[ix].pageName structure=$home_info.pageName page_ref_id=$structure_path[ix].page_ref_id}">
	      {if $structure_path[ix].page_alias}
	        {$structure_path[ix].page_alias}
		  {else}
	        {$structure_path[ix].stripped_pageName|pagename}
		  {/if}
		  </a>
		{/section}
	{if $prefs.feature_wiki_structure_drilldownmenu eq 'y'}
		{menu structureId=$page_info.structure_id page_id=$page_info.page_id page_name=$page_info.pageName drilldown='y'}
	{/if}
	</div>
</div>
