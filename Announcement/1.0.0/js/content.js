$(document).ready(function(){
	var date = new Date();
	var options = {'years_between' : [2000, (date.getFullYear() + 20)] };
	$("#pg_announce_daystart, #pg_announce_dayend").BuilderCalendar(options);
   
});

var PLUGIN_Announce_content = {

	currentPage : 1,

	serverUrl : function(){
		return $("#pg_announce_documentroot").val();
	},
	
	getDate : function(selector){
		var sId = $(selector).prev().attr('id');
		$("#"+sId).click();
		return false;
	},
	
	checkInput : function(){
		var result = $("#pg_announce_contentform").validateForm();
		alert(result);
	},
	
	resetDefault : function(){
		$("#pg_announce_searchtext, #pg_announce_searchcontent, #pg_announce_startdate, #pg_announce_enddate, #pg_announce_daystart, #pg_announce_dayend").val("");
		$("#pg_announce_typeselect, #pg_announce_searchtype").val("pad_title");
		$("#pg_announce_showrow").val("10");
		this.paginate(1);
	},
	
	searchNote : function(){
		var text = $.trim($("#pg_announce_searchcontent").val());
		$("#pg_announce_searchtext").val(text);
		$("#pg_announce_searchtype").val($("#pg_announce_typeselect").val());
		$("#pg_announce_startdate").val($("#pg_announce_daystart").val());
		$("#pg_announce_enddate").val($("#pg_announce_dayend").val());
		this.paginate(1);
	},
	
	sortNote : function(order, sort){
		$("#pg_announce_sort").val(sort);
		$("#pg_announce_order").val(order);
		this.paginate(1);
	},
	
	searchDateButton : function(sStartDate, sEndDate){
		$('#pg_announce_daystart').val(sStartDate);
		$('#pg_announce_dayend').val(sEndDate);
	},
	
	showModify : function(noteid){
		$("#pg_announce_viewnote").popUp("close");
		$("#pg_announce_form").validate().resetForm();
		$("#pg_announce_submitbutton").attr("onclick", "PLUGIN_Announce_content.saveData('modifydata'," + noteid + ");");
		var sUrl = this.serverUrl();
		$.ajax({
			url: sUrl + "content.php",
			type : "post",
			dataType : "json",
			data: {
				action : 'getnote',
				aData : {
					idx : noteid
				}
			},
			success: function(aData){
				$("#pg_announce_notetitle").val(aData.pad_title);
				$("#pg_announce_notecontent").text(aData.pad_content);
				//$("#pg_announce_notecontent").text(aData.pad_modified_date);
				
				$("#pg_announce_popup").popUp({
					title :"Modify Post",
					width : 270,
					resize : false,
					onOpen : function(){
						$("#pg_announce_contentcontainer").resizeIframe();
						$("#pg_announce_contentcontainer").resizeIframe({action: "add", height : 100});
					},
					onClose : function(){
						$("#pg_announce_contentcontainer").resizeIframe();
					}
				});
			}
		});
	},
	
	viewNote : function(noteid){
		$("#pg_announce_popup").popUp("close");
		var sUrl = this.serverUrl();
		$.ajax({
			url: sUrl + "content.php",
			type : "post",
			dataType : "json",
			data: {
				action : 'getnote',
				aData : {
					idx : noteid
				}
			},
			success: function(aData){
				$("#pg_announce_viewnotetitle").val(aData.pad_title);
				$("#pg_announce_viewnotecontent").text(aData.pad_content);
		
				
				$("#pg_announce_viewnote").popUp({
					title :"View Post",
					width : 270,
					resize : false,
					onOpen : function(){
						$("#pg_announce_contentcontainer").resizeIframe();
						$("#pg_announce_contentcontainer").resizeIframe({action: "add", height : 100});
					},
					onClose : function(){
						$("#pg_announce_contentcontainer").resizeIframe();
					}
				});
			}
		});
	},
	
	addNote : function(){
		$("#pg_announce_viewnote").popUp("close");
		$("#pg_announce_form").validate().resetForm();
		
		this.clearContent();
		$("#pg_announce_submitbutton").attr("onclick", "PLUGIN_Announce_content.saveData('savedata');");
		$("#pg_announce_popup").popUp({
			title :"Add New Post",
			width : 270,
			resize : false,
			onOpen : function(){
				$("#pg_announce_contentcontainer").resizeIframe();
				$("#pg_announce_contentcontainer").resizeIframe({action: "add", height : 100});
			},
			onClose : function(){
				$("#pg_announce_contentcontainer").resizeIframe();
			}
		});
	},
	
	clearContent : function(){
		$("#pg_announce_notetitle, #pg_announce_notecontent").css({"color" : "#777"});
		$("#pg_announce_notetitle").val("Title");
		$("#pg_announce_notecontent").val("Content");
		
	},
	
	paginate : function(page){
		page = page ? page : 1;
		var sUrl = this.serverUrl();
		$.ajax({
			url: sUrl + "content.php",
			type : "post",
			dataType : "html",
			data: {
				action : 'getlist',
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
	},
	
	checkAll : function(selector){
		if ($(selector).is(":checked") === true){
			$.browser.msie ? $("#pg_announce_listcontent input:checkbox").prop("checked", "checked") : $("#pg_announce_listcontent input:checkbox").attr("checked", "checked");
		}
		else {
			$.browser.msie ? $("#pg_announce_listcontent input:checkbox").removeProp("checked") : $("#pg_announce_listcontent input:checkbox").removeAttr("checked");
		}
	},
	
	confirmDelete : function(){
		var count = 0;
		$("#pg_announce_listcontent input:checkbox").each(function(){
			if ($(this).is(":checked") === true){
				count++;
			}
		});
		
		if (count > 0){
		
			$("#pg_announce_contentcontainer").append('<div id="pg_announce_confirm"><div class="delete_message">Are you sure you want to delete this note(s).</div><div class="confirm_buttons"><span class="confirm_delete"><input type="button" value="Delete" class="btn01" onclick="PLUGIN_Announce_content.deleteNote();" /></span><span class="confirm_close"><input type="button" value="Close" class="btn01" onclick="$(\'#pg_announce_confirm\').popUp(\'remove\');" /></span></div><div>');
			$("#pg_announce_confirm").popUp({
				title : "Delete Post",
				resize : false,
				width: 253
			});
		}
		else {
			$("#plugin_validation_message").showMessage({
				type : "error",
				resize : "#pg_announce_contentcontainer",
				message : {
					error : "Please make a selection from the list."
				}
			});
		}
	},
	
	deleteNote : function(){
		var count = 0;
		var idArray = [];
		$("#pg_announce_listcontent input:checkbox").each(function(){
			if ($(this).is(":checked") === true){
				idArray[count++] = $(this).val();
			}
		});
		
		var sUrl = this.serverUrl();
		$.ajax({
			url: sUrl + "content.php",
			type : "post",
			dataType : "html",
			data: {
				action : "deletenote",
				aData : {
					idxArray : idArray
				}
			},
			success: function(){
				$("#plugin_validation_message").showMessage({
					type : "success",
					resize : "#pg_announce_contentcontainer",
					message : {
						success : "Announcement(s) was successfully delete.."
					}
				});
				PLUGIN_Announce_content.paginate(1);
				$("#pg_announce_confirm").popUp("remove");
			}
		});
	},

	saveData : function(action, noteid){
		var title = $("#pg_announce_notetitle").val();
		$("#pg_announce_notetitle").val($.trim(title));
		
		var content = $("#pg_announce_notecontent").val();
		$("#pg_announce_notecontent").val($.trim(content));
		
		var result = $("#pg_announce_form").validateForm();
		if (result == true){
			var sUrl = this.serverUrl();
		
			$.ajax({
				url: sUrl + "content.php",
				type : "post",
				dataType : "html",
				data: {
					action : action,
					aData : {
						pad_idx : noteid,
						pad_title : $("#pg_announce_notetitle").val(),
						pad_content : $("#pg_announce_notecontent").val()
                                        }     
				},
				success: function(){
					var page = (action == "modifydata") ? PLUGIN_Announce_content.currentPage : 1;
					$("#pg_announce_popup").popUp("close");
					PLUGIN_Announce_content.paginate(page);
				}
			});
		}
	}

};