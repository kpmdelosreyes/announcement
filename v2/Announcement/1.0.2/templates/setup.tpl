<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html;  charset=iso-8859-1">
        <title>Administrator</title>
        <link href="{$sPgDir}/css/common.css" rel="stylesheet" type="text/css" media="screen" />	
        <link href="{$jqueryuicss}" rel="stylesheet" type="text/css" media="screen" />
       
        <script type="text/javascript" src="{$jquery}"></script>
        <script type="text/javascript" src="{$emulation}"></script>
        <script type="text/javascript" src="{$jqueryuijs}"></script>
        <script language="javascript" src="{$sJsValidate}"></script>
        <script language="javascript" src="{$sPopUp}"></script>
        <script type="text/javascript" src="{$sPgDir}js/announcement.admin.js"></script> 

        </head>
    <body id="PG_{$PLUGIN_NAME}">
    <div id="WRAP_{$PLUGIN_NAME}">
            {$sScriptCrossDomain}
            <!-- message box -->		
            <div class="msg_suc_box" id="msg_suc_box" style="display:{$sSave}">
                    <p><span>Saved successfully.</span></p>
            </div>
            <h3 class="extension_plugin_name" style="display:inline-block;">{$PLUGIN_NAME}</h3>
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
