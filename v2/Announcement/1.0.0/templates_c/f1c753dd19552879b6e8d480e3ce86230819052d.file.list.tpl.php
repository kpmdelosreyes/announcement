<?php /* Smarty version Smarty-3.0.6, created on 2011-12-09 13:07:40
         compiled from "./templates/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15209908804ee1979c5e5793-86643754%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f1c753dd19552879b6e8d480e3ce86230819052d' => 
    array (
      0 => './templates/list.tpl',
      1 => 1323315387,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15209908804ee1979c5e5793-86643754',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
	<input type="hidden" id="pg_announce_order" value="<?php echo $_smarty_tpl->getVariable('sOrderby')->value;?>
" />
	<input type="hidden" id="pg_announce_sort" value="<?php echo $_smarty_tpl->getVariable('sSortby')->value;?>
" />
	<input type="hidden" id="pg_announce_searchtype" value="<?php echo $_smarty_tpl->getVariable('sSearchType')->value;?>
" />
	<input type="hidden" id="pg_announce_searchtext" value="<?php echo $_smarty_tpl->getVariable('sSearchText')->value;?>
" />
	<input type="hidden" id="pg_announce_startdate" value="<?php echo $_smarty_tpl->getVariable('sStartDate')->value;?>
" />
	<input type="hidden" id="pg_announce_enddate" value="<?php echo $_smarty_tpl->getVariable('sEndDate')->value;?>
" />
	<div class="table_header_area" >
		<ul class="row_1" >
			<li class="comment">
				<span class="all selected">All (<?php echo $_smarty_tpl->getVariable('iTotalRow')->value;?>
)</span>
			</li>					
		</ul>
		<ul class="row_2">
			<li>
				<a href="#none" class="btn01" onclick="PLUGIN_Announce_content.confirmDelete();">Delete</a>
			</li>
			<li class="show">
				<label for="pg_announce_showrow">Show Rows</label>
				<select id="pg_announce_showrow" onchange="PLUGIN_Announce_content.paginate();">
					<option<?php if ($_smarty_tpl->getVariable('iLimit')->value=="10"){?> selected<?php }?>>10</option>
					<option<?php if ($_smarty_tpl->getVariable('iLimit')->value=="20"){?> selected<?php }?>>20</option>
					<option<?php if ($_smarty_tpl->getVariable('iLimit')->value=="30"){?> selected<?php }?>>30</option>
					<option<?php if ($_smarty_tpl->getVariable('iLimit')->value=="50"){?> selected<?php }?>>50</option>
					<option<?php if ($_smarty_tpl->getVariable('iLimit')->value=="100"){?> selected<?php }?>>100</option>
				</select>
			</li>
		</ul>
	</div>
	<table border="1" cellpadding="0" cellspacing="0" class="table_hor_02">
		<colgroup>
			<col width="40px" />
			<col width="40px" />
			<col  />
			<col width="170px" />				
			<col width="170px" />				
		</colgroup>
		<thead>			
			<tr id="">
				<th class="chk"><input type="checkbox"  title="" class="input_chk" onclick="PLUGIN_Announce_content.checkAll(this);" /></th>
				<th>No.</th>
				<th><a href="javascript:void(0);" <?php if ($_smarty_tpl->getVariable('sOrderby')->value=='pad_title'){?>class="<?php if ($_smarty_tpl->getVariable('sSortby')->value=='DESC'){?>asc<?php }else{ ?>desc<?php }?>"<?php }?> onclick="PLUGIN_Announce_content.sortNote('pad_title','<?php if ($_smarty_tpl->getVariable('sSortby')->value=='DESC'){?>ASC<?php }else{ ?>DESC<?php }?>')">Announcement</a></th>				
				<th><a href="javascript:void(0);" <?php if ($_smarty_tpl->getVariable('sOrderby')->value=='pad_modified_date'){?>class="<?php if ($_smarty_tpl->getVariable('sSortby')->value=='DESC'){?>asc<?php }else{ ?>desc<?php }?>"<?php }?> onclick="PLUGIN_Announce_content.sortNote('pad_modified_date','<?php if ($_smarty_tpl->getVariable('sSortby')->value=='DESC'){?>ASC<?php }else{ ?>DESC<?php }?>')">Registered Date</a></th>		
				<th class="no_border">Management</th>
			</tr>
		</thead>
		<tbody id="pg_announce_listcontent">
			<?php if (count($_smarty_tpl->getVariable('aData')->value)>0){?>
			<?php  $_smarty_tpl->tpl_vars['sValue'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('aData')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['sValue']->key => $_smarty_tpl->tpl_vars['sValue']->value){
?>
			<tr>
				<td><input type="checkbox" class="input_chk" value="<?php echo $_smarty_tpl->tpl_vars['sValue']->value['pad_idx'];?>
"></td>
				<td><?php echo $_smarty_tpl->tpl_vars['sValue']->value['pad_no'];?>
</td>
				<td class="col_06">
					<a href="javascript:void(0);" onclick="PLUGIN_Announce_content.viewNote(<?php echo $_smarty_tpl->tpl_vars['sValue']->value['pad_idx'];?>
);" ><?php echo $_smarty_tpl->tpl_vars['sValue']->value['pad_title'];?>
</a>
				</td>
				<td><?php echo $_smarty_tpl->tpl_vars['sValue']->value['pad_datetime'];?>
</td>
				<td>
					<span>
						<input type="button" value="Modify" class="btn01" onclick="PLUGIN_Announce_content.showModify(<?php echo $_smarty_tpl->tpl_vars['sValue']->value['pad_idx'];?>
)" />
					</span>
				</td>
			</tr>
			<?php }} ?>
			<?php }else{ ?>
			<tr>
				<td colspan="5" class="data_none">No registered note has been found.</td>
			</tr> 
			<?php }?>
		</tbody>
	</table>
	<div class="table_header_area">
		<ul class="row_2">
			<li>
				<a href="#" class="btn01" onclick="PLUGIN_Announce_content.confirmDelete();">Delete</a>
			</li>
			<li class="show">
				<a href="javascript:void(0);" class="btn01" onclick="PLUGIN_Announce_content.addNote();">Add New Post</a>
			</li>
		</ul>
	</div>
	<!-- pagination -->
	<div class="pagination">
		<?php echo $_smarty_tpl->getVariable('sPagination')->value;?>

	</div>
	<!-- // pagination -->