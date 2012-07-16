<?php /* Smarty version Smarty-3.0.6, created on 2011-11-23 12:58:03
         compiled from "./templates/modify.tpl" */ ?>
<?php /*%%SmartyHeaderCode:334342984ecc7d5b724520-22295289%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '41c1907381279e0a8eeceac3b06352ed2002674a' => 
    array (
      0 => './templates/modify.tpl',
      1 => 1322016580,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '334342984ecc7d5b724520-22295289',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('modify')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
?>
    <form class="pg_announce_textarea" style="border:1px solid red;">
            <input type="hidden" name="modify_id" id="modify_id" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" />
            <input type="text" name="modify_title" id="modify_title" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['title'];?>
" />
            <textarea col="80" row="50" name="modify_newpost" id="modify_newpost"><?php echo $_smarty_tpl->tpl_vars['value']->value['content'];?>
</textarea>	
            <a href="#" class="btn_apply" title="Save" onclick="modifypostSave(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
);">Save</a>  
    </form>
<?php }} ?> 
