<?php /* Smarty version Smarty-3.0.6, created on 2011-11-21 10:03:17
         compiled from "./templates/test.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19706396954ec9b1652a57d8-44262278%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2319eb374ebfda6635cffe78ca7a13eed09695fd' => 
    array (
      0 => './templates/test.tpl',
      1 => 1321840995,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19706396954ec9b1652a57d8-44262278',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html;  charset=iso-8859-1">
        <title>test</title>
       <!-- <link href="<?php echo $_smarty_tpl->getVariable('sPgDir')->value;?>
/css/common.css" rel="stylesheet" type="text/css" media="screen" />	-->
        <link href="<?php echo $_smarty_tpl->getVariable('sPgDir')->value;?>
css/flexigrid.pack.css" rel="stylesheet" type="text/css" media="screen" />
       
        <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('jquery')->value;?>
"></script>
       <!-- <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('emulation')->value;?>
"></script> -->
        <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('jqueryuijs')->value;?>
"></script>
       <!-- <script language="javascript" src="<?php echo $_smarty_tpl->getVariable('sJsValidate')->value;?>
"></script> -->
      <!--  <script language="javascript" src="<?php echo $_smarty_tpl->getVariable('sPopUp')->value;?>
"></script> --> 
        <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('sPgDir')->value;?>
js/flexigrid.pack.js"></script> 
        
        <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('sPgDir')->value;?>
js/announcement.content.js"></script> 

        </head>
    <body id="PG_<?php echo $_smarty_tpl->getVariable('PLUGIN_NAME')->value;?>
">
        <input type="hidden" name="hide" id="dir" value="<?php echo $_smarty_tpl->getVariable('sPgDir')->value;?>
" />
        <table border="0" height="100%" width="100%">
            <tr height="22"><td height="20"></td></tr>
             
            <tr height="100%">
                <td height="100%"> <!—100% to take rest of space -->
                    <div id="flexigridDiv" >
                        <table id="flex1"></table>
                    </div>
                </td>
            </tr>
        </table>