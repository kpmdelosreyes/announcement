<?php /* Smarty version Smarty-3.0.6, created on 2011-11-23 12:58:46
         compiled from "./templates/setup.tpl" */ ?>
<?php /*%%SmartyHeaderCode:320118204ecc7d86dbb076-05290263%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '21a8d11e79c8a778d5f09c7f204a632362d12d7d' => 
    array (
      0 => './templates/setup.tpl',
      1 => 1322016580,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '320118204ecc7d86dbb076-05290263',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html;  charset=iso-8859-1">
        <title>Administrator</title>
        <link href="<?php echo $_smarty_tpl->getVariable('sPgDir')->value;?>
/css/common.css" rel="stylesheet" type="text/css" media="screen" />	
        <link href="<?php echo $_smarty_tpl->getVariable('jqueryuicss')->value;?>
" rel="stylesheet" type="text/css" media="screen" />
       
        <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('jquery')->value;?>
"></script>
        <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('emulation')->value;?>
"></script>
        <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('jqueryuijs')->value;?>
"></script>
        <script language="javascript" src="<?php echo $_smarty_tpl->getVariable('sJsValidate')->value;?>
"></script>
        <script language="javascript" src="<?php echo $_smarty_tpl->getVariable('sPopUp')->value;?>
"></script>
        <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('sPgDir')->value;?>
js/announcement.admin.js"></script> 

        </head>
    <body id="PG_<?php echo $_smarty_tpl->getVariable('PLUGIN_NAME')->value;?>
">
    <div id="WRAP_<?php echo $_smarty_tpl->getVariable('PLUGIN_NAME')->value;?>
">
            <?php echo $_smarty_tpl->getVariable('sScriptCrossDomain')->value;?>

            <!-- message box -->		
            <div class="msg_suc_box" id="msg_suc_box" style="display:<?php echo $_smarty_tpl->getVariable('sSave')->value;?>
">
                    <p><span>Saved successfully.</span></p>
            </div>
            <h3 class="extension_plugin_name" style="display:inline-block;"><?php echo $_smarty_tpl->getVariable('PLUGIN_NAME')->value;?>
</h3>
            <!-- input area -->
            <table border="1" cellspacing="0" class="table_input_vr dropdown_option">
                    <colgroup>
                            <col width="115px" />
                            <col width="*" />
                    </colgroup>
                    <tr>
                            <th><label for="module_label">Show rows</label></th>
                            <td><span id="module_label_wrap"><input type="test" class="fix1" id="pg_a_txtbox" /></span>(You can display from 5 to 10 announcements only.)</td>
                    </tr>
                    <tr>
                           
                    <tr>
                            <th class="padt1"><label for="module_label">Template</label></th>
                            <td class="padt1">
                                    <ul class="template_wrap">
                                            <li class="marginr1">
                                                    <p>
                                                            <span class="module_label_wrap3">

                                                                    <input type="radio" name="plugin_template" id="module_label3"  value="front_blue.css" class="fix_radio" />
                                                                    <label for="module_label3">Blue</label>
                                                            </span>
                                                    </p>
                                                    <p><image src="images/pg_template_bl.jpg" alt="" /></p>
                                            </li>
                                            <li>
                                                    <p>
                                                            <span class="module_label_wrap3">
                                                                    <input type="radio" name="plugin_template" id="module_label4"  value="front_gray.css" class="fix_radio" />
                                                                    <label for="module_label4">Gray</label>
                                                            </span>
                                                    </p>
                                                    <p><image src="images/pg_template_gr.jpg" alt="" /></p>
                                            </li>
                                    </ul>
                            </td>
                    </tr>
                    <tr>
                            <td colspan="2">
                            <div class="tbl_lb_wide_btn">
				    <a href="#" class="btn_apply" title="Save changes" id="submit_todolist">Save</a>
				    <a href="#" class="add_link" onclick="PG_todolist.reset();" title="Reset to default">Reset to Default</a>
			    </div>
                            </td>
                    </tr>
            </table>

            
    </body>
</html>
