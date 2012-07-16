<?php /* Smarty version Smarty-3.0.6, created on 2011-11-23 14:16:21
         compiled from "./templates/contents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20673341874ecc8fb549dc97-19206799%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3aa0344b255d4defcace30b786f1c61fe0444741' => 
    array (
      0 => './templates/contents.tpl',
      1 => 1322028961,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20673341874ecc8fb549dc97-19206799',
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


<ul class="row_1">
                    <li class="comment">
                            <span class="all selected">All (<?php echo $_smarty_tpl->getVariable('iTotalRow')->value;?>
)</span>
                    </li>					
             </ul>                        
            
            <!-- // table header -->
            <ul style="margin-top:20px">
                    <li style="display:inline">
                            <span>			
                                    <input type="button" id="delete" name="delete" class="btn_2" onclick="deleteThis();" value="Delete" />
                            </span>
                    </li>
                    <li style="display:inline;float:right">
                            <span>
                                    <label for="pg_simplenote_showrow"  >Show Rows</label>
                                    <select id="pg_simplenote_showrow" onchange="paginate();">
                                        <option<?php if ($_smarty_tpl->getVariable('iLimit')->value=="10"){?> selected<?php }?>>10</option>
					<option<?php if ($_smarty_tpl->getVariable('iLimit')->value=="20"){?> selected<?php }?>>20</option>
					<option<?php if ($_smarty_tpl->getVariable('iLimit')->value=="30"){?> selected<?php }?>>30</option>
					<option<?php if ($_smarty_tpl->getVariable('iLimit')->value=="50"){?> selected<?php }?>>50</option>
					<option<?php if ($_smarty_tpl->getVariable('iLimit')->value=="100"){?> selected<?php }?>>100</option>
                                    </select>
                            </span>
                    </li>
            </ul>
            <!-- table horizontal -->
            <table border="1" cellpadding="0" cellspacing="0" class="table_hor_02" style="margin-top:10px;">
                    <colgroup>
                            <col width="5%" />
                            <col width="5%" />
                            <col width="65%" />	
                            <col width="12%" />				
                            <col width="13%" />					
                    </colgroup>
                    <thead>			
                            <tr id="">
                                    <th class="chk"><input type="checkbox" id="select-all" title="select all" class="input_chk" onClick="checkAll(this);" /></th>
                                    <th>No.</th>
                                    <th><a href="#" <?php if ($_smarty_tpl->getVariable('sOrderby')->value=='pad_title'){?>class="<?php if ($_smarty_tpl->getVariable('sSortby')->value=='DESC'){?>asc<?php }else{ ?>desc<?php }?>"<?php }?> onclick="sortThis('pad_title','<?php if ($_smarty_tpl->getVariable('sSortby')->value=='DESC'){?>ASC<?php }else{ ?>DESC<?php }?>')">Announcement</a></th>				
                                    <th><a href="#" <?php if ($_smarty_tpl->getVariable('sOrderby')->value=='pad_modified_date'){?>class="<?php if ($_smarty_tpl->getVariable('sSortby')->value=='DESC'){?>asc<?php }else{ ?>desc<?php }?>"<?php }?> onclick="sortThis('pad_modified_date','<?php if ($_smarty_tpl->getVariable('sSortby')->value=='DESC'){?>ASC<?php }else{ ?>DESC<?php }?>')">Registered Date</a></th>		
                                    <th class="no_border">Management</th>
                            </tr>
                    </thead>
                    <tbody id="pg_tbl_content">
                       
                        <?php if (count($_smarty_tpl->getVariable('aData')->value)>0){?>
                        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('aData')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
                           
                            <tr onmouseover="this.className='over'" onmouseout="this.className=''" style="border:1px solid green">
                                <input type="hidden" name="hidden_id" id="hidden_id" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" />
                                <td><input type="checkbox" id="<?php echo $_smarty_tpl->tpl_vars['value']->value['pad_idx'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" name="file_checkbox"  title="" class="input_chk" /></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['value']->value['pad_no'];?>
 </td>
                                <td class="table_subtitle"><a href="#" title="View Content" onclick="viewPost(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
);return false;" ><?php echo $_smarty_tpl->tpl_vars['value']->value['title'];?>
</a></td>				
                                <td><?php echo $_smarty_tpl->tpl_vars['value']->value['date'];?>
</td>				
                                <td>
                                    <input type="button" class="btn_2" name="modify"  id="modify" style="margin-right:5px" onclick="modifypost(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
);return false;" value="Modify" />
                                    <!--<input type="button" id="delete" name="delete" class="btn_2" onclick="deleteThis(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
);" value="Delete" /> -->
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
            <!-- // table horizontal -->	
            <div style="margin-top:10px">			
                    <span><input type="button" id="delete" name="delete" class="btn_2" onclick="deleteThis();" value="Delete" /></span>
                    <span style="float:right"><input type="button" id="addpost" name="addpost" value="Add New Post" class="btn_2" onclick="addnewpost();return false;" /></span>
            </div>	
            <!-- pagination -->
            <div class="pagination">				
                   <?php echo $_smarty_tpl->getVariable('pagination')->value;?>
				
            </div>