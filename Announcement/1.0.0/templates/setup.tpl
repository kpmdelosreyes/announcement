<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html;  charset=iso-8859-1">
        <title>Administrator</title>
        <link href="{$sPgDir}/css/common.css" rel="stylesheet" type="text/css" media="screen" />	
       
        <script type="text/javascript" src="{$jquery}"></script>
        <script type="text/javascript" src="{$emulation}"></script>
        <script language="javascript" src="{$sPopUp}"></script>
        <script language="javascript" src="{$sBaseUrl}lib/js/common.js"></script>
        <script type="text/javascript" src="{$sPgDir}js/announcement.admin.js"></script> 

    </head>
    <body id="PG_Announcement">
    <div id="Wrap_Announcement">
            {$sScriptCrossDomain}
            <!-- message box -->		
            <div class="msg_suc_box" id="msg_suc_box" >
                    <p><span>Saved successfully.</span></p>
            </div>
            <h3 style="display:inline-block;">Plugin ID: {$PLUGIN_NAME}</h3>
            <!-- input area -->
            <table border="1" cellspacing="0" class="table_input_vr dropdown_option">
                    <colgroup>
                            <col width="115px" />
                            <col width="*" />
                    </colgroup>
                    <tr>
                            <th><label for="module_label">Show rows</label></th>
                            <td><span id="module_label_wrap"><input type="text" class="fix1" id="show_rows" maxlength="2" name="show_rows" /></span>
			            <span id="error_msg" class="error_msg_fix" style="display:none;"> You can display from 5 to 10 announcements only. </span>
			    </td>
                    </tr>
		    <tr>
                            <th><label for="module_label">Set time</label></th>
                            <td><span id="module_label_wrap"><input type="text" class="fix1" id="show_time" maxlength="2" name="show_time" />seconds</span>
   			             <span id="error_msg1" class="error_msg_fix" style="display:none;"> Set time interval atmost 20 minutes. </span>
			    </td>
                    </tr>
                    <tr>

                    <tr>
                            <th class="padt1"><label for="module_label">Template</label></th>
                            <td class="padt1">
                                    <ul class="template_wrap">
                                            <li class="marginr1">
                                                    <p>
                                                            <span class="module_label_wrap3">

                                                                    <input type="radio" name="plugin_template" id="blue_template" checked value="blue" class="fix_radio" />
                                                                    <label for="blue_template">Blue</label>
                                                            </span>
                                                    </p>
                                                    <p><image src="images/pg_template_bl.jpg" alt="" /></p>
                                            </li>
                                            <li>
                                                    <p>
                                                            <span class="module_label_wrap3">
                                                                    <input type="radio" name="plugin_template" id="gray_template"  value="gray" class="fix_radio" />
                                                                    <label for="gray_template">Gray</label>
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
                                    <a href="#" class="btn_apply" title="Save changes" id="submit_announce" onclick="PLUGIN_Announce_setup.saveSettings();"  >Save</a>
                                    <a href="#" class="add_link" onclick="PLUGIN_Announce_setup.resetSetting();" title="Reset to default">Reset to Default</a>
                            </div>
                            </td>
                    </tr>
            </table>

</div>
    </body>
</html>
