<?php /* Smarty version Smarty-3.0.6, created on 2011-11-23 14:27:30
         compiled from "./templates/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14429529734ecc9252def6d7-27113200%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '971f13bacbfbc2d69b1e30e739e7569e225840d9' => 
    array (
      0 => './templates/content.tpl',
      1 => 1322029648,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14429529734ecc9252def6d7-27113200',
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
        <link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->getVariable('sPgLib')->value;?>
css/popup.calendar.css" />
        
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
        <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('sPgLib')->value;?>
js/common.js"></script>
        <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('sPgLib')->value;?>
js/jquery.calendar.js"></script>
        <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('sPgDir')->value;?>
js/announcement.content.js"></script> 
          
   
 </head>

 <body>
    <div id="pg_announce_contentcontainer">
        <div id="pg_validation_message"></div>
         <?php echo $_smarty_tpl->getVariable('sScriptCrossDomain')->value;?>

      <!-- table header -->
        
            <div class="table_header_area">
                    <div class="left_header_1 fl" style="margin-top:20px;border:1px solid red">
                            <span class="input_date_wrap1">
                                    <label for="reg_date">Registered Date</label>
                                    
                                    <span class="pg_announce_calendarborder">
                                        <input type="text"  name="pg_announce_daystart"  id="pg_announce_daystart" class="input_date" readonly="readonly" title="Registered Date"  />
                                    </span>
                                    <image src="<?php echo $_smarty_tpl->getVariable('sPgDir')->value;?>
images/icon_calendar.gif" alt="calendar icon" class="pg_announce_calendaricon" onclick="getDate(this);" /> ~
   
                            </span>
                            <span class="input_date_wrap1" >
                                    <input type="text" id="pg_announce_dayend" name="pg_announce_dayend" title="Registered Date" class="input_text"/>
                                     <image src="<?php echo $_smarty_tpl->getVariable('sPgDir')->value;?>
images/icon_calendar.gif" alt="calendar icon" class="pg_announce_calendaricon" onclick="getDate(this);" />
                            </span>
                            <span class="btn_1">
                                    <input type="button" value="today" onclick="datebutton('<?php echo $_smarty_tpl->getVariable('sToday')->value;?>
', '<?php echo $_smarty_tpl->getVariable('sToday')->value;?>
');"/>
                                    <input type="button" value="1week" onclick="datebutton('<?php echo $_smarty_tpl->getVariable('sWeekDate')->value;?>
', '<?php echo $_smarty_tpl->getVariable('sToday')->value;?>
');"/>
                                    <input type="button" value="1month" onclick="datebutton('<?php echo $_smarty_tpl->getVariable('sMonthDate')->value;?>
', '<?php echo $_smarty_tpl->getVariable('sToday')->value;?>
');"/>
                                    <input type="button" value="3months" onclick="datebutton('<?php echo $_smarty_tpl->getVariable('s3MonthDate')->value;?>
', '<?php echo $_smarty_tpl->getVariable('sToday')->value;?>
');"/>
                                    <input type="button" value="all" onclick="datebutton('','');"/>
                            </span>
                            <div>
                                <span>
                                    <label for="pg_announce_typeselect" >Keyword</label>
                                    <select id="pg_announce_typeselect">
                                            <option value="title">Title</option>
                                            <option value="content">Content</option>
                                    </select>
                                </span>	
                            
                                <span class="search_wrap">
                                    <input type="text" id="pg_announce_searchcontent" title="Search" class="input_text fix"/>
                                    <input type="button" value="Search" class="btn_2" onclick="searchThis();" />
                                    <a href="#" class="add_link" onclick="resetDefault();">Reset</a></td>
                                </span>
			    </div>
                    </div>
                   
            </div>
            <div id="pg_announce_content">
		<?php if (isset($_smarty_tpl->getVariable('sList',null,true,false)->value)){?><?php echo $_smarty_tpl->getVariable('sList')->value;?>
<?php }?>
            </div>	
            <!--------------------------------------------------------- POPUP - ADD NEW POST --------------------------------------------------------->     
            <!--<div id="announce_popup" class="pg_announce_popup" style="display:none;left:40%;top:30%;"> -->
                    <div class="pg_announce_content" id="announce_popup" style="display:none;left:40%;top:30%;">
                            <form class="pg_announce_textarea">
                                    <input type="text" name="pg_announce_title" id="pg_announce_title" value="" />
                                    <textarea col="80" row="50" name="pg_announce_newpost" id="pg_announce_newpost">Content</textarea>	
                                    <a href="#" class="btn_apply" title="Save" onclick="addpostsave();">Save</a>  

                            </form>
                    </div>
            <!--</div> -->
            <div class="pg_announce_content" id="modify_popup" style="display:none;left:40%;top:30%;"></div>
            <div class="pg_announce_content" id="view_popup" style="display:none;left:40%;top:30%;"></div>
          
    </div>
    
 </body>
</html>
