angular.module('myApp').controller('compareCtrl', function(NgMap, $http)
{
    var vm = this;
    vm.origin = "20 W 34th St, New York, NY 10001, United States";
    vm.destination = "20 W 34th St, New York, NY 10001, United States";
    $(document).ready(function()
    {
        $('#searchResults2').on('click', ':checkbox' , function() {
            if ($('input[type=checkbox]:checked').length > 2) 
            {
                $(this).prop('checked', false);
            }
        });

        $("#searchBtn2").click(function()
        {
            var search = $("#search").val();
            $.ajax(
            {
                type:"POST",
                url: '../php/searchCompare.php',
                data: {searchItem : search},
                success: function(response)
                {
                    $("#searchResults2").html(response);
                }
            }); 
        });
        $("#compareBtn").click(function()
        {
            if ($('input[type=checkbox]:checked').length == 2) 
            {
                var checked = [];
                $.each($("input[type=checkbox]:checked"), function()
                {
                    checked.push($(this).val());
                });
                var leftAddress = "";
                var rightAddress = "";
                $http.post(
                    '../php/compareData.php',
                    JSON.stringify(checked[0]))
                .then (function(response)
                {
                    $("#compareLeft").html(response.data);
                    vm.origin = $("#compareLeft").find("#address").text();
                }); 
                $http.post(
                    '../php/compareData.php',
                    JSON.stringify(checked[1]))
                .then (function(response)
                {
                    $("#compareRight").html(response.data);
                    vm.destination= $("#compareRight").find("#address").text();
                }); 
            }
        }); 
    });
});