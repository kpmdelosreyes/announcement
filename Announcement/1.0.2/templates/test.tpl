<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html;  charset=iso-8859-1">
        <title>test</title>
       <!-- <link href="{$sPgDir}/css/common.css" rel="stylesheet" type="text/css" media="screen" />	-->
        <link href="{$sPgDir}css/flexigrid.pack.css" rel="stylesheet" type="text/css" media="screen" />
       
        <script type="text/javascript" src="{$jquery}"></script>
       <!-- <script type="text/javascript" src="{$emulation}"></script> -->
        <script type="text/javascript" src="{$jqueryuijs}"></script>
       <!-- <script language="javascript" src="{$sJsValidate}"></script> -->
      <!--  <script language="javascript" src="{$sPopUp}"></script> --> 
        <script type="text/javascript" src="{$sPgDir}js/flexigrid.pack.js"></script> 
        
        <script type="text/javascript" src="{$sPgDir}js/test.js"></script> 

        </head>
    <body id="PG_{$PLUGIN_NAME}">
        <input type="hidden" name="hide" id="dir" value="{$sPgDir}" />
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