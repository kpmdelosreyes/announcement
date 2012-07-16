<?php /* Smarty version Smarty-3.0.6, created on 2011-11-23 11:06:21
         compiled from "./templates/view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2830663824ecc490fa7d546-80763684%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eea967d38310e600b927e19a494c428c5f0e4b53' => 
    array (
      0 => './templates/view.tpl',
      1 => 1322016579,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2830663824ecc490fa7d546-80763684',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('view')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
?>
    <form class="pg_announce_textarea" id="pg_view_style">
            <input type="hidden" name="view_id" id="view_id" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" />
            <!--<input type="text" name="view_title" id="view_title" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['title'];?>
" />-->
            <!--<textarea col="80" row="50" name="view_newpost" id="modify_newpost"><?php echo $_smarty_tpl->tpl_vars['value']->value['content'];?>
</textarea>	       -->
	    <p id="view_title" class="pg_viewTitle_style"><?php echo $_smarty_tpl->tpl_vars['value']->value['title'];?>
</p>
	    <p id="modify_newpost" class="pg_viewContent_style"><?php echo $_smarty_tpl->tpl_vars['value']->value['content'];?>
</p>
	    <a href="#" class="btn_apply fix" title="Ok" onclick="addpostsave();">Okay</a>  
    </form>
<?php }} ?> 
