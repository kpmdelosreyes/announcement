$(document).ready(function(){
    
    flexi();
});

function flexi()
{
    var a = $("#flexigridDiv").innerHeight();//this takes the height of the 2nd tr dynamically 
   var dir = $("#dir").val();
    
    $("#flex1").flexigrid(
    {
        url: dir+'test.php',
        type : 'POST',
        dataType: 'json',
        colModel : [
                    {display: 'ID', name : 'pg_states_idx', width : 40, sortable : true, align: 'left'},
                    {display: 'state', name : 'state', width : 150, sortable : true, align: 'left'},
                    {display: 'code', name : 'alpha_code', width : 150, sortable : true, align: 'left'},
                    {display: 'country', name : 'country', width : 250, sortable : true, align: 'left'}
                    ],
        buttons : [
                    {name: 'Edit', bclass: 'edit', onpress : doCommand},
                    {name: 'Delete', bclass: 'delete', onpress : doCommand},
                    {separator: true}
                    ],
        searchitems : [
                    {display: 'state', name : 'state'},
                    {display: 'code', name : 'alpha_code', isdefault: true},
                    {display: 'country', name : 'country'}
                    ],
        sortname: "pg_states_idx",
        sortorder: "asc",
        usepager: true,
        title: "Country",
        useRp: true,
        rp: 10,
        showTableToggleBtn: true,
        resizable: true,
        width: 700,
        height: a,
        singleSelect: true
       // onSubmit: addFormData
        
        
    });
}


function doCommand(com, grid)
{
    if (com == 'Edit') 
    {
        $('.trSelected', grid).each(function() {
        var id = $(this).attr('id');
        id = id.substring(id.lastIndexOf('row')+3);
        alert("Edit row " + id);
        });
        } else if (com == 'Delete') {
        $('.trSelected', grid).each(function() {
        var id = $(this).attr('id');
        id = id.substring(id.lastIndexOf('row')+3);
        alert("Delete row " + id);
        });
    }
    
    
}



//This function adds paramaters to the post of flexigrid. You can add a verification as well by return to false if you don't want flexigrid to submit            
/*
function addFormData()

    {

    

    //passing a form object to serializeArray will get the valid data from all the objects, but, if the you pass a non-form object, you have to specify the input elements that the data will come from

    var dt = $('#sform').serializeArray();

    $("#flex1").flexOptions({params: dt});

    return true;

    }

    

$('#sform').submit

(

    function ()

        {

            $('#flex1').flexOptions({newp: 1}).flexReload();

            return false;

        }

);                        
*/