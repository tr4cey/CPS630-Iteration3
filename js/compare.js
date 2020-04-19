angular.module('myApp').controller('compareCtrl', function(NgMap)
{
    $(document).ready(function()
    {
        $("#searchBtn").click(function()
        {
            var search = $("#search").val();
            $.ajax(
            {
                type:"POST",
                url: '../php/searchCompare.php',
                data: {searchItem : search},
                success: function(response)
                {
                    $("#searchResults").html(response);
                }
            }); 
        });
    });
});