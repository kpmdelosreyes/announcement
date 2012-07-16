<?php /* Smarty version Smarty-3.0.6, created on 2011-12-08 11:36:32
         compiled from "./templates/body.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18198417644edf2adec2d5f7-41060413%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9e18d6fb3a7bf78c9125bd8a203c08b6c395f71f' => 
    array (
      0 => './templates/body.tpl',
      1 => 1323315387,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18198417644edf2adec2d5f7-41060413',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- Blue Template   -->
        <?php echo $_smarty_tpl->getVariable('sScriptCrossDomain')->value;?>

	<input type="hidden" id="server_url" value="<?php echo $_smarty_tpl->getVariable('sPgDir')->value;?>
" />
        <input type="hidden" id="setInterval" value="<?php echo $_smarty_tpl->getVariable('setInterval')->value;?>
" />
        <?php if ($_smarty_tpl->getVariable('template')->value=="gray"){?>
            <div id="pg_announce_gray_wrap">
        <?php }else{ ?>
            <div id="pg_announce_blue_wrap">
        <?php }?>
		<h4>Announcement</h4>
		<div class="pg_announce_wrap1">
                        <p class="pg_announce_subheader">Latest Announcement</p>
			<div class="pg_announcement_content1">
                            
                         
                                 <ul id="pg_announce_accordion" > 
                                    <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('latest')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
?>
                                       <li> <h3><a href="#" class="pg_announce_title" rel="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" onclick="PG_Announcement.showThis(this);" ><span class="pg_announce_h"><?php echo $_smarty_tpl->tpl_vars['value']->value['title'];?>
</span></a></h3>
                                        <div class="content_id"><p class="showHide" style="display:none;"> </p> </div></li>
                                   <?php }} ?>
                                </ul>
                       
                        </div>
               </div>
        </div>
                        
      