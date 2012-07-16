
var PG_Announcement = {
    
	rowStamp : 0,
	init : function(){
                var sUrl = $("#server_url").val();
                var pNode = $("#PLUGIN_Announcement").val();
                var mData = { 
				url : sUrl + "index.php",
				action : 'showcomments',
				rowStamp : PG_Announcement.rowStamp
		}				
                var interval = parseInt($("#setInterval").val() + "000");
                PLUGIN.post(pNode, mData, 'custom', 'json', function(serverResponse){
                   
                    if (PG_Announcement.rowStamp != serverResponse.rows)
                    {
                       
                        $(".showHide").html("").css({"padding":"0", "border":"0"});
                        var string = '';             
                        
                        $.each(serverResponse.aData, function(key, val){
                            
                            var date = PG_Announcement.realtime(val.date.replace(/-/g,'/'));
                            string += '<li class="pg_announce_fix_this" >';
                            string += '<h3>';
                            string += '<a href="javascript:void(0);return false;" class="pg_announce_title" rel="'+val.id+'" onclick="PG_Announcement.showThis(this);"><span class="pg_announce_h">'+val.title+'</span></a>';
                            string += '</h3>';
                            string += '<div class="content_id"><p class="showHide" style="border:1px solid #ddd;background:#fff;max-height:150px; overflow : auto; padding:5px;width : 220px"> '+val.content+' <span class="timeago" title="'+val.date+'">'+date+'</span></p> </div></li>';
 
                        });
                            
                            $('#pg_announce_accordion').prepend(string);
                            $('#pg_announce_accordion li:last-child').remove();
                            PG_Announcement.rowStamp = serverResponse.rows;

                    }
                       PG_Announcement.interval(interval);
		}); 
               
		      
             
        },
        
        
        
        realtime : function (time_value)
        {
           // $.timeago(new Date()); 
            time_value = time_value.replace(/(\+[0-9]{4}\s)/ig,"");
            var parsed_date = Date.parse(time_value);
            var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
            var timeago = parseInt((relative_to.getTime() - parsed_date) / 1000);
            if (timeago < 60) return 'less than a minute ago';
            else if(timeago < 120) return 'about a minute ago';
            else if(timeago < (45*60)) return (parseInt(timeago / 60)).toString() + ' minutes ago';
            else if(timeago < (90*60)) return 'about an hour ago';
            else if(timeago <= (24*60*60)) return 'about ' + (parseInt(timeago / 3600)).toString() + ' hour/s ago';
            else if(timeago < (48*60*60)) return '1 day ago';
            else return (parseInt(timeago / 86400)).toString() + ' days ago';
            
            
        },
        
        
        interval : function (interval)
        {
            setTimeout(function(){PG_Announcement.init()},interval);  
        },

        
        showThis : function (obj){

            
            
            if ($(obj).parents("li").find(".content_id p").is(":visible") === true){
                
                $(obj).parents("li").find(".content_id p").slideUp("fast");
               
                 setTimeout(function(){
                        var height = $("ul#pg_announce_accordion").height();
                       // var heightx = $(".pg_announcement_content1").height();
                        //alert(height+" | "+heightx);
                        $("div.pg_announcement_content1").css("height", "0");
                        $("div.pg_announcement_content1").css("height", height);

                    }, 300);
            }
            else {
                 //$(".showHide").html("").css({"border":"","height" : "", "overflow" : "", "padding":"0"});
               
                $("#pg_announce_accordion li .content_id p").slideUp("fast");
                 
               
                var rel = $(obj).attr('rel');

                var sUrl = $("#server_url").val();
                var pNode = $("#PLUGIN_Announcement").val();
                var mData = { 
                                url : sUrl + "index.php",
                                action : 'getcontent',
                                idx : rel
                }	

                PLUGIN.post(pNode, mData, 'custom', 'json', function(serverResponse){
                    var date = PG_Announcement.realtime(serverResponse.pad_modified_date.replace(/-/g,'/'));
                    
                    $(obj).parent().parent().find('.content_id p').html(serverResponse.pad_content).css({"border":"1px solid #ddd","max-height" : "150px", "overflow" : "auto", "padding":"5px", "width" : "220px", "display":"inline-block", "background":"#fff"});
                    $(obj).parent().parent().find('.content_id p').append("<span class=\"timeago\" title=\""+serverResponse.pad_modified_date+"\">"+date+"</span>");
                     var height = $(obj).parents("li").find(".content_id p").height();
                     if (height > 200) $(obj).parents("li").find(".content_id p").height(200);

                     $(obj).parents("li").find(".content_id p").slideDown("fast");
                     
                    setTimeout(function(){
                        var height = $("ul#pg_announce_accordion").height();
                      //var heightx = $(".pg_announcement_content1").height();
                       // alert("Ul: "+height+" | Div: "+heightx);
                        $("div.pg_announcement_content1").css("height", "0");
                        $("div.pg_announcement_content1").css("height", height);
                    }, 300);
                              
                });
                
                

            }
           
        }
        
}

jQuery(function($) {
     $.timeago.settings.allowFuture = true;
    $("abbr.timeago").timeago();
    PG_Announcement.interval(20);
    PG_Announcement.init(); 
    $('#pg_announce_accordion').children('li:first').remove().css("border", "1px solid red");
   
});

