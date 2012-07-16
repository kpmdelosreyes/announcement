<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>Announcement</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>{$sTitle}</title>
        
        <link type="text/css" rel="stylesheet" href="{$sPgDir}css/common.css" />
        <link type="text/css" rel="stylesheet" href="{$sPgDir}css/front.css" />
        <link type="text/css" rel="stylesheet" href="{$sPgDir}css/popup.calendar.css" />
        
	<script type="text/javascript" src="{$sJQuery}"></script>
	<script type="text/javascript" src="{$sEmuRoot}"></script>
        <script type="text/javascript" src="{$sBaseUrl}lib/js/jquery.validate.js"></script>
        <script type="text/javascript" src="{$sBaseUrl}lib/js/common.js"></script>
        <script type="text/javascript" src="{$sBaseUrl}lib/js/jquery.calendar.js"></script>
        
	<script type="text/javascript" src="{$sBaseUrl}lib/js/popup.js"></script>
	<script type="text/javascript" src="{$sPgDir}js/{$sJsFile}"></script>
	
	<!--[if IE 6]>
	<script type="text/javascript" src="{$sPgDir}js/pngfix.js"></script>
	<script type="text/javascript">
		DD_belatedPNG.fix('img, .pg_announce_corner_1, .pg_announce_corner_2, .pg_announce_corner_3, .pg_announce_fold  '); 
	</script>
	<![endif]-->
	<!--[if IE 7]>
	<link href="{$sPgDir}css/ie7.css" rel="stylesheet" type="text/css" media="screen" />	
	<![endif]-->
	<!--[if lte IE 7]>
	<link href="{$sPgDir}css/lte_ie7.css" rel="stylesheet" type="text/css" media="screen" />
	<script defer type="text/javascript" language="Javascript" src="{$sPgDir}js/pngfix.js"></script>
	<![endif]-->
	<!--[if IE 6]>
	<link href="{$sPgDir}css/ie6.css" rel="stylesheet" type="text/css" media="screen" />	
	<![endif]-->

</head>
<body id="PLUGIN_Announce">


<div id="pg_announce_contentcontainer">
	<div id="plugin_validation_message"></div>
	{$sScriptCrossDomain}
	<input type="hidden" id="pg_announce_documentroot" value="{$sPgDir}" />
	<table border="1" cellpadding="0" cellspacing="0" class="table_hor_03">
	<tr>
		<td>
		<!-- <form action="" method="GET" id='search-form'> -->
		<input type="hidden" name="search_hidden" value="">
			<table cellpadding="3" cellspacing="3">
				<tr>
					<td><span  class="title">Registered Date</span></td>
					<td>
						<input type="text" id="pg_announce_daystart" name="pg_announce_dayend" class="input_table" style="width:85px;" readonly />
						<img src="images/icon_calendar.gif" class="img_calendar" onclick="PLUGIN_Announce_content.getDate(this);" /> ~ 
					</td>
					<td>
						<input type="text" id="pg_announce_dayend" name="pg_announce_dayend" class="input_table" style="width:85px;" readonly />
						<img src="images/icon_calendar.gif" class="img_calendar" onclick="PLUGIN_Announce_content.getDate(this);" />
					</td>
					<td>
						<span><input type="button"  class="btn01" value="today" onclick="PLUGIN_Announce_content.searchDateButton('{$sToday}', '{$sToday}');"/></span>
						<span><input type="button" class="btn01" value="1week" onclick="PLUGIN_Announce_content.searchDateButton('{$sWeekDate}', '{$sToday}');"/></span>
						<span><input type="button" class="btn01" value="1month" onclick="PLUGIN_Announce_content.searchDateButton('{$sMonthDate}', '{$sToday}');"/></span>
						<span><input type="button" class="btn01" value="3months" onclick="PLUGIN_Announce_content.searchDateButton('{$s3MonthDate}', '{$sToday}');"/></span>
						<span><input type="button" class="btn01" value="all" onclick="PLUGIN_Announce_content.searchDateButton('', '');"/></span>
					</td>
				</tr>
				<tr>
					<td><span class="title">Keyword</span></td>
					<td>
						<select id="pg_announce_typeselect" style="width:120px">
							<option value="pad_title" selected>Title</option>
							<option value="pad_content">Content</option>
						</select>
					</td>
					<td colspan="2">
						<input type="text" id="pg_announce_searchcontent" class="input_search"/> 
						<input type='submit' class="btn01" value="Search" onclick="PLUGIN_Announce_content.searchNote();" />
						<a href="#" class="add_link" onclick="PLUGIN_Announce_content.resetDefault();">Reset</a></td>
				</tr>
			</table>
		 <!-- </form> -->
		</td>
	</tr>	
	</table>
	<br />	
	<div id="pg_announce_content">
		{if isset($sList)}{$sList}{/if}
	</div>
	<div id="pg_announce_popup" style="display:none;">
		<form id="pg_announce_form">
			<div id="pg_announce_messagecontainer" class="message_container">
				<input type="text" id="pg_announce_notetitle" name="pg_announce_notetitle" class="message_title1" maxlength="50" onFocus="if(this.value=='Title')this.value='';" onBlur="if(this.value=='')this.value='Title';" value="Title" validate="required|notvalue[Title]" />
				<textarea id="pg_announce_notecontent" name="pg_announce_notecontent" class="message_content1" onFocus="if(this.value=='Content')this.value='';" onBlur="if(this.value=='')this.value='Content';" validate="required|notvalue[Content]">Content</textarea>
			</div>
			<div class="add_popup_control">
				<span><input id="pg_announce_submitbutton"  class="btn01" type="submit" value="Save" /></span>
			</div>
		</form>
	</div>
	
	<div id="pg_announce_viewnote" style="display:none;">
		<div id="pg_announce_viewnotecontainer" class="message_container">
			<input type="text" id="pg_announce_viewnotetitle" class="message_title1" readonly />
			<!--<textarea id="pg_announce_viewnotecontent" class="pg_announce_textarea" readonly>Content</textarea>-->
			<p id="pg_announce_viewnotecontent" class="message_content1"></p>
		</div>
	</div>
</div>