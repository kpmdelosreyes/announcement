$(document).ready(function(){
    $("#msg_suc_box").hide();
    PLUGIN_Announce_setup.numberOnly();
});

var PLUGIN_Announce_setup = {
    
    numberOnly : function(){
        $("#show_rows, #show_time").keydown(function(event) {
            // Allow only backspace and delete
            if ( event.keyCode == 46 || event.keyCode == 8 ) {
                // let it happen, don't do anything
            }
            else {
                // Ensure that it is a number and stop the keypress
                if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                    event.preventDefault(); 
                }   
            }
        });
    },
    
    saveSettings : function(){
        
        var display_rows = parseInt($("#show_rows").val());
        var show_time = $("#show_time").val();
        var template = $("input[type='radio']:checked").val();
       
        if(display_rows > 10 || display_rows=="" || display_rows < 5){
            $("#error_msg").show().fadeOut(5000);
        }
        
        else if(show_time > 20 || show_time=="" || show_time < 5)
        {
            $("#error_msg1").show().fadeOut(5000);
            
        }
        else
        {
            $.ajax({
                url : "setup.php",
                type : "POST",
                dataType : "html",
                data : {
                    action : "saveSettings",
                    aData : {
                             pas_num_display : display_rows+1,
                             pas_template : template,
                             pas_time : show_time
                            }
                }, success : function(){
                    $('#msg_suc_box').show().delay(3000).fadeOut('slow', function(){ $('#Wrap_Announcement').resizeIframe();});
                   

                }
            });
        }
     
    },
    
    resetSetting : function(){
        
        $("#show_rows").val("5");
        $("#show_time").val("5");
        $("input[type='radio']:checked").val();
        
    }
    
}
