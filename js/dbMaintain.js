$(document).ready(function () 
{
    $("#sqlSelection").change(function ()
    {
        let html = "";
        var selection = $(this).val();

        if(selection == "insert")
        {
            html += "INSERT INTO <input type='text' id='table' placeholder='table'> (<input type='text' id='columns' placeholder='columns'>) VALUES (<input type='text' id='values' placeholder='values'>);";
        }
        else if(selection == "delete")
        {
            html += "DELETE FROM <input type='text' id='table' placeholder='table'> WHERE <input type='text' id='conditions' placeholder='conditions'>;";
        }
        else if(selection == "select")
        {
            html += "SELECT * FROM <input type='text' id='table' placeholder='table'> WHERE <input type='text' id='conditions' placeholder='conditions'>;";
        }
        else if(selection == "update")
        {
            html+="UPDATE <input type='text' id='table' placeholder='table'> SET <input type='text' id='columns' placeholder='columns'> WHERE <input type='text' id='conditions' placeholder='conditions'>;";
        }
        html+="<br><button id='submitQuery'>Submit Query</button>"; 

        $("#selectResults").html(html);
    });

    $(document).on('click', '#submitQuery',function()
    {
        var selection = $("#sqlSelection").val();
        var sqlQuery = "";
        var table = "";

        if(selection == "insert")
        {
            table = $("#table").val();
            var columns = $("#columns").val();
            var values = $("#values").val();

            sqlQuery = "insert into " + table + " (" + columns + ") values (" + values + ");";
            
        }
        else if(selection == "delete")
        {
            table = $("#table").val();
            var conditions = $("#conditions").val();
            
            sqlQuery = "delete from " + table + " where " + conditions + ";";
        }
        else if(selection == "select")
        {
            table = $("#table").val();
            var conditions = $("#conditions").val();
            
            sqlQuery = "select * from " + table + " where " + conditions + ";";
        }
        else if(selection == "update")
        {
            table = $("#table").val();
            var conditions = $("#conditions").val();
            var columns = $("#columns").val();
            
            sqlQuery = "update " + table + " set " + columns + " where " + conditions + ";";
        }
        console.log(sqlQuery);
        $.ajax({
            type:"POST",
            url: '../php/dbMaintain.php',
	        data: {selection : selection, sqlQuery : sqlQuery, table : table},
            success: function(response) 
            {
                $("#results").html(response);
            }
        });
    });
});