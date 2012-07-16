<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html;  charset=iso-8859-1">
        <title>Administrator</title>
        <link href="{$sPgDir}/css/common.css" rel="stylesheet" type="text/css" media="screen" />	
        <link type="text/css" rel="stylesheet" href="{$sPgLib}css/popup.calendar.css" />
        
        <script type="text/javascript" src="{$jquery}"></script>
        <script type="text/javascript" src="{$emulation}"></script> 
        <script type="text/javascript" src="{$jqueryuijs}"></script>
        <script language="javascript" src="{$sJsValidate}"></script> 
        <script language="javascript" src="{$sPopUp}"></script>
        <script type="text/javascript" src="{$sPgLib}js/common.js"></script>
        <script type="text/javascript" src="{$sPgLib}js/jquery.calendar.js"></script>
        <script type="text/javascript" src="{$sPgDir}js/announcement.content.js"></script> 
          
   
 </head>

 <body>
    <div id="pg_announce_contentcontainer">
        <div id="pg_validation_message"></div>
         {$sScriptCrossDomain}
      <!-- table header -->
        
            <div class="table_header_area">
                    <div class="left_header_1 fl" style="margin-top:20px;border:1px solid red">
                            <span class="input_date_wrap1">
                                    <label for="reg_date">Registered Date</label>
                                    
                                    <span class="pg_announce_calendarborder">
                                        <input type="text"  name="pg_announce_daystart"  id="pg_announce_daystart" class="input_date" readonly="readonly" title="Registered Date"  />
                                    </span>
                                    <image src="{$sPgDir}images/icon_calendar.gif" alt="calendar icon" class="pg_announce_calendaricon" onclick="getDate(this);" /> ~
   
                            </span>
                            <span class="input_date_wrap1" >
                                    <input type="text" id="pg_announce_dayend" name="pg_announce_dayend" title="Registered Date" class="input_text"/>
                                     <image src="{$sPgDir}images/icon_calendar.gif" alt="calendar icon" class="pg_announce_calendaricon" onclick="getDate(this);" />
                            </span>
                            <span class="btn_1">
                                    <input type="button" value="today" onclick="datebutton('{$sToday}', '{$sToday}');"/>
                                    <input type="button" value="1week" onclick="datebutton('{$sWeekDate}', '{$sToday}');"/>
                                    <input type="button" value="1month" onclick="datebutton('{$sMonthDate}', '{$sToday}');"/>
                                    <input type="button" value="3months" onclick="datebutton('{$s3MonthDate}', '{$sToday}');"/>
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
		{if isset($sList)}{$sList}{/if}
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
