$('document').ready(function() {
    var date = new Date();
    var options = {'years_between' : [2000, (date.getFullYear() + 20)] };
    $("#pg_announce_daystart, #pg_announce_dayend").BuilderCalendar(options);
    

});


var currentPage = 1;
function paginate(page)
{
    page = page ? page : 1;
   
    $.ajax({
            url: "content.php",
            type : "POST",
            data: {
                    requestType : 'getlist',
                    aData : {
                            page : page,
                            limit : $("#pg_announce_showrow").val(),
                            orderby : $("#pg_announce_order").val(),
                            sortby : $("#pg_announce_sort").val(),
                            search : $("#pg_announce_searchtype").val(),
                            searchcontent : $("#pg_announce_searchtext").val(),
                            startdate : $("#pg_announce_startdate").val(),
                            enddate : $("#pg_announce_enddate").val()
                    }
            },
            success: function(data){
                    $("#pg_announce_content").empty();
                    $("#pg_announce_content").html(data);
                    $("#pg_announce_contentcontainer").resizeIframe();
                  
            }
    });
		
    this.currentPage = page;
}


function sortThis(order, sort)
{
    $("#pg_announce_sort").val(sort);
    $("#pg_announce_order").val(order);
    this.paginate(1);
    
}

function searchThis()
{
    var text = $.trim($("#pg_announce_searchcontent").val());
		$("#pg_announce_searchtext").val(text);
		$("#pg_announce_searchtype").val($("#pg_announce_typeselect").val());
		$("#pg_announce_startdate").val($("#pg_announce_daystart").val());
		$("#pg_announce_enddate").val($("#pg_announce_dayend").val());
		this.paginate(1);
    
}

function datebutton(sStartDate, sEndDate)
{
    $('#pg_announce_daystart').val(sStartDate);
    $('#pg_announce_dayend').val(sEndDate);
}

function getDate(obj)
{
    var sId = $(obj).prev().attr('id');
		$("#"+sId).click();
		return false;
    
    
}

function viewPost(obj)
{
    $("#view_popup").popUp({title : "View Post", resize : false, width : 400});
    $.ajax({
        url : "content.php",
        type : 'POST',
        dataType : "html",
        data : 
        {
            requestType : 'viewData',
            hiddenid : obj
        },success : function(data){
            
            $("#view_popup").html(data);
           
        }
    });
    
}

function addnewpost()
{
    $('#addpost').click(function() {
        $("#announce_popup").popUp({title : "Add New Post", resize : false, width : 400});
      
    });
}

function addpostsave()
{
    var title = $("#pg_announce_title").val();
    var content = $("#pg_announce_newpost").val();
   
   
    $.ajax({
        url : "content.php",
        type : 'POST',       
        data : 
            {
                requestType : 'saveData',
                title : title,
                content : content
               
            },
            success : function(data)
            {
               
                $("#announce_popup").popUp("close");
                $("#pg_announce_content").html(data);
                
            }
            
    });
    
}


function modifypost(obj)
{
  
    $("#modify_popup").popUp({title : "Modify Post", resize : false, width : 400});
    $.ajax({
        url : "content.php",
        type : 'POST',
        dataType : "html",
        data : 
        {
            requestType : 'modifyData',
            hiddenid : obj
        },success : function(data){
            
            $("#modify_popup").html(data);
           
        }
    });

}
var hiddenid = "";
function modifypostSave(obj)
{
    var hiddenid = $("#modify_id").val();
    var title = $("#modify_title").val();
    var content = $("#modify_newpost").val();
       
    $.ajax({
        url : "content.php",
        type : 'POST',
        data : 
            {
                requestType : 'modifiedData',
                title : title,
                content : content,
                hiddenid : obj
            },
            success : function(data)
            {
                $("#modify_popup").popUp("close");
                $("#pg_announce_content").html(data);
                paginate(1);
               
            }
            
    });
    
}

function deleteThis()
{
    
    var count = 0;
    $("#pg_tbl_content input:checkbox").each(function(){
            if ($(this).is(":checked") === true){
                    count++;
            }
    });

    if (count > 0){

            $("#pg_announce_contentcontainer").append('<div id="pg_announce_confirm"><div>Are you sure you want to delete this note(s).</div><div class="confirm_buttons"><span class="btn01 confirm_delete"><input type="button" value="Delete" class="btn_ly" onclick="deletepost();" /></span><span class="btn01 confirm_close"><input type="button" value="Close" class="btn_ly" onclick="$(\'#pg_announce_confirm\').popUp(\'remove\');" /></span></div><div>');
            $("#pg_announce_confirm").popUp({
                    title : "Delete Announcement",
                    resize : false,
                    width: 253
            });
    }
    else {
            $("#pg_validation_message").showMessage({
                    type : "error",
                    resize : "#pg_announce_contentcontainer",
                    message : {
                            error : "Please make a selection from the list."
                    }
            });
    }
    
}

function deletepost()
{
    var count = 0;
    var idArray = [];
    
    $("#pg_tbl_content input:checkbox").each(function(){
            if ($(this).is(":checked") === true){
                    idArray[count++] = $(this).val();
            }
    });


    $.ajax({
            url: "content.php",
            type : "POST",
            data: {
                    requestType : 'deletepost',
                    aData : {hiddenid : idArray}
            },
            success: function(data){
               
                
                $("#pg_validation_message").showMessage({
                        type : "success",
                        resize : "#pg_announce_contentcontainer",
                        message : {
                                success : "Note(s) was successfully delete.."
                        }
                });
                $("#pg_announce_confirm").popUp("close");
                $("#pg_announce_content").html(data);
            }
    });
}
/*
function deletepost(obj)
{
    $.ajax({
        url : "content.php",
        type : 'POST',
        data : 
            {
                requestType : 'deletepost',
                hiddenid : obj
            },
            success : function(data)
            {
               // alert(data);
                
                $("#pg_tbl_content").html(data);
               
            }
            
    });
    
}
*/

function showRows()
{
    var show_rows = $("#a_rows").val();
    $.ajax({
        url : "content.php",
        type : 'POST',
        dataType : "json",
        data : 
            {
                requestType : 'modifyData',
                title : title,
                content : content,
                show_rows : show_rows
            },
            success : function(data)
            {
               alert(data);
                $("#announce_popup").popUp("close");
               
            }
            
    });
}

/*for checkbox; for multiple selection*/
function checkAll(selector)
{
    if ($(selector).is(":checked") === true){
        $.browser.msie ? $("#pg_tbl_content input:checkbox").prop("checked", "checked") : $("#pg_tbl_content input:checkbox").attr("checked", "checked");
    }
    else {
        $.browser.msie ? $("#pg_tbl_content input:checkbox").removeProp("checked") : $("#pg_tbl_content input:checkbox").removeAttr("checked");
    }
	
}


function resetDefault()
{
    $("#pg_announce_searchtext, #pg_announce_searchcontent, #pg_announce_startdate, #pg_announce_enddate, #pg_announce_daystart, #pg_announce_dayend").val("");
    $("#pg_announce_typeselect, #pg_announce_searchtype").val("title");
    $("#pg_announce_showrow").val("10");
    this.paginate(1);
    
}