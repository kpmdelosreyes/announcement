<?php /* Smarty version Smarty-3.0.6, created on 2011-11-25 14:03:57
         compiled from "./templates/ref.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4623499434ecf2fcdba0551-43116736%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e56b0f78a3c6d4d794cf491a61e46a18ba53628e' => 
    array (
      0 => './templates/ref.tpl',
      1 => 1322201032,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4623499434ecf2fcdba0551-43116736',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="pg_announcement" id="shoutout" style="border:3px solid orange"  >
    <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('qwe')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
?>
        <div class="pg_post_binder" style="border:3px solid green">
                <a href="" class="pg_announce_title"><?php echo $_smarty_tpl->tpl_vars['value']->value['title'];?>
<?php echo $_smarty_tpl->tpl_vars['value']->value['date'];?>
</a>				
                <p class="pg_recent_post">
                        <?php echo $_smarty_tpl->tpl_vars['value']->value['content'];?>
<a href="" class="pg_more">more</a>
                </p>
        </div>
    <?php }} ?>
</div>