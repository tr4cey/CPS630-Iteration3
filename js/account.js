angular.module('myApp').controller('accountCtrl', function()
{
    jQuery.ajax({
        type: "POST",
        url: '../php/getAccountInfo.php',
        dataType: 'JSON',
        success: function(response)
        {
            console.log(response);
            var email = response[0].email;
            var firstName = response[0].firstName;
            var lastName = response[0].lastName;
            var address = response[0].address;
            var telephone = response[0].telNum;

            var html = "<h3>" + email + "</h3>" + 
            "<h3>" + firstName + " " + lastName + "</h3>" + 
            "<p><strong>Address: </strong>" + address + "<br/>" + 
            "<strong>Telephone #: </strong>" + telephone + "</p>";

            $("#accountInfo").html(html);
        }
    });
});