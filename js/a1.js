var app = angular.module("myApp", ['ngRoute']);
app.config(function($routeProvider){
    $routeProvider
    .when("/", {
        templateUrl:"home.htm",
        controller:"myCtrl"
    })
    .when("/about", {
        templateUrl:"about.htm",
        controller:"myCtrl"
    })
    .when("/contact", 
    {
        templateUrl:"about.htm",
        controller:"myCtrl"
    })
    .when("/cart", 
    {
        templateUrl:"cart.htm",
        controller:"myCtrl"
    })
    .when("/dbMaintain", 
    {
        templateUrl:"dbMaintain.htm",
        controller:"myCtrl"
    })
    .when("/account", 
    {
        templateUrl:"account.htm",
        controller:"myCtrl"
    })
    .when("/attractionMaintain", 
    {
        templateUrl:"attractionMaintain.htm",
        controller:"myCtrl"
    });
});

app.controller('myCtrl', function($scope) {
    
$(document).ready(function () 
{

    let na = ['Canada', 'United States'];
    let eu = ['Russia', 'Germany'];
    let sa = ['Brazil', 'Argentina'];
    let afr = ['South Africa', 'Egypt'];
    let asia = ['China', 'India'];

    let attractions = new Map()

    attractions.set("Canada", ['CN Tower', 'Banff National Park']);
    attractions.set("United States", ['Disneyland', 'Grand Canyon National Park']);

    attractions.set("Russia", ['State Hermitage Museum', 'The Moscow Kremlin']);
    attractions.set("Germany", ['Neuschwanstein Castle', 'Brandenburg Gate']);

    attractions.set("Brazil", ['Christ the Redeemer', 'Sugarloaf Mountain']);
    attractions.set("Argentina", ['Perito Moreno Glacier', 'Parque Nacional Los Glaciares']);

    attractions.set("South Africa", ['Kruger National Park', 'Cape of Good Hope']);
    attractions.set("Egypt", ['Giza Necropolis', 'Valley of the Kings']);

    attractions.set("China", ['Great Wall of China', 'Forbidden City']);
    attractions.set("India", ['Taj Mahal', 'Amber Palace']);

    var navhtml = "";

    navhtml += "<a href='#/!' class='navItem'>Home</a>";
    navhtml += "<a href='#!about' class='navItem'>About Us</a>";
    navhtml += "<a href='#!about' class='navItem'>Contact Us</a>";
    navhtml += "<a href='#!cart' class='navItem'>Shopping Cart</a>";
    navhtml += "<a class='navItem' id='dbMaintain' style='text-decoration: underline;'>Maintain Database</a>";

    $.ajax(
    {
        async: false,
        type:"POST",
        url: '../php/checkLogin.php',
        success: function(response)
        {
            if(response == "true")
            {
                navhtml += "<a class='navItem' href='#!account'>My Account</a>";
                navhtml += "<a class='navItem' id='logout' style='text-decoration: underline;'>Log Out</a>";
            }
            else if(response == "false")
            {
                navhtml += "<a class='navItem' id='login' style='text-decoration: underline;'>Login</a>";
            }
        }
    });
    
    $("#navbar").html(navhtml); 
    
    $.ajax(
    {
        type:"POST",
        url: '../php/checkLogin.php',
        success: function(response)
        {
            var navhtmlEnd
            if(response == "true")
            {
                navhtmlEnd += "<a class='navItem' id='login' style='text-decoration: underline;'>Login</a>";
                navhtmlEnd += "<a class='navItem' id='myAccount' style='text-decoration: underline;'>My Account</a>";
                navhtmlEnd += "<a class='navItem' id='logout' style='text-decoration: underline;'>Log Out</a>";
            }
            else if(response == "false")
            {
                navhtmlEnd += "<a class='navItem' id='login' style='text-decoration: underline;'>Login</a>";
            }
        }
    });
    $("#navbar").html(navhtml);
    
    $.ajax({
	type:"POST",
	url: '../php/attractionPage.php',
	success: function(response)
	{
	    $("#attraction-container").html(response);
	}
    });

    $.ajax({
        type:"POST",
        url: '../php/attractionMaintain.php',
        success: function(response)
        {
            $("#attraction-maintain").html(response);
        }
    });


    $("#dialog").dialog({
        autoOpen : false, modal : true, show : "blind", hide : "blind"
    });
    $("#loginBox").dialog({
        autoOpen : false, modal : true, show : "blind", hide : "blind"
    });
    $("#createAccBox").dialog({
        autoOpen : false, modal : true, show : "blind", hide : "blind"
    });

    $("#continent").change(function () 
    {

        let html = "<span>Country: </span><select name='country' id='country'>";
        html += "<option value='none' selected disabled hidden>Select an Option</option >";

        var val = $(this).val();
        if (val == "na") {
            for (var i = 0; i < na.length; i++) {
                html += "<option value='" + na[i] + "'>" + na[i] + "</option>";
            }
        }
        else if (val == "eu") {
            for (var i = 0; i < eu.length; i++) {
                html += "<option value='" + eu[i] + "'>" + eu[i] + "</option>";
            }
        }
        else if (val == "sa") {
            for (var i = 0; i < sa.length; i++) {
                html += "<option value='" + sa[i] + "'>" + sa[i] + "</option>";
            }
        }
        else if (val == "afr") {
            for (var i = 0; i < afr.length; i++) {
                html += "<option value='" + afr[i] + "'>" + afr[i] + "</option>";
            }
        }
        else if (val == "asia") {
            for (var i = 0; i < asia.length; i++) {
                html += "<option value='" + asia[i] + "'>" + asia[i] + "</option>";
            }
        }

        $("#countryDiv").html(html);
    });

    $(document).on('change', '#country', function () {
        let html = "<span>Attraction: </span><select name='attraction' id='attraction'>";
        html += "<option value='none' selected disabled hidden>Select an Option</option >";

        var val = $("#country").val();

        places = attractions.get(val);

        for (let i = 0; i < places.length; i++) {
            html += "<option value='" + places[i] + "'>" + places[i] + "</option>";
        }

        $("#attractionsDiv").html(html);
    });
    $(document).on('change', '#attraction', function ()
    {
	var attractName = $("#attraction").val();
        $.ajax({
            type:"POST",
            url: '../php/displayAttraction.php',
	        data: {attractionValue : attractName},
            success: function(response) 
            {
                $("#main-attraction").html(response);
            }
        });
	$.ajax({
	    type:"POST",
	    url: '../php/closeDistance.php',
	    success: function(response)
	    {
		$("#close-distance").html(response);
	    }
	});
    });
    $("#popular-places").change(function ()
    {
        var attractName = $("#popular-places").val();
        $.ajax({
            type:"POST",
            url: '../php/displayAttraction.php',
            data: {attractionValue : attractName},
            success: function(response)
            {
            $("#main-attraction").html(response);
            }
        });
	$.ajax({
	    type:"POST",
	    url: '../php/closeDistance.php',
	    success: function(response)
	    {
		$("#close-distance").html(response);
	    }
	});
    });

    $("#searchBtn").click(function()
    {
        var search = $("#search").val();
	
	$.ajax({
            type:"POST",
            url: '../php/search.php',
            data: {searchItem : search},
            success: function(response)
            {
                $("#searchResults").html(response);
            }
        });
    });

    $("#dbMaintain").click(function()
    {
        $("#dialog").dialog("open");
    });
    $("#login").click(function()
    {
        $("#loginBox").dialog("open");
    });
    $("#logout").click(function()
    {
        $.ajax(
        {
            type:"POST",
            url: '../php/logout.php',
            success: function(response)
            {
                location.reload();
            }
        });
    });
    $("#createAcc").click(function()
    {
        $("#loginBox").dialog("close");
        $("#createAccBox").dialog("open");
    });

    $("#passwordBtn").click(function()
    {
        var password = "cps630team10";
        var inputPwd = $("#pwd").val();
        
        if(inputPwd == password)
        {
            window.location.href = '#!dbMaintain';
        }
        else
        {
            $("#dialog").dialog("close");
        }
    });
    $("#loginBtn").click(function() 
    {
        var email = $("#loginEmail").val();
        var password = $("#loginPwd").val();

        $.ajax(
        {
            type:"POST",
            url: '../php/login.php',
            data: 
            {
                email : email,
                password : password
            },
            success: function(response)
            {
                if(response == "true")
                {
                    $("#loginResponse").html("<p>Login Successful</p>");
                    $("#loginBox").dialog("close");
                    location.reload();
                }
                else if(response == "false")
                {
                    $("#loginResponse").html("<p>Email or Password Incorrect</p>");
                }
            }
         });
    });
    $("#createAccBtn").click(function() 
    {
        var firstName = $("#createFname").val();
        var lastName = $("#createLname").val();
        var email = $("#createEmail").val();
        var password = $("#createPwd").val();
        var address = $("#createAddress").val();
        var phoneNum = $("#createPhone").val();

        $.ajax(
        {
            type:"POST",
            url: '../php/createAccount.php',
            data: 
            {
                firstName : firstName,
                lastName : lastName,
                email : email,
                password : password,
                address : address,
                phoneNum : phoneNum
            },
            success: function(response)
            {
                $("#createAccResponse").html(response);
            }
        });
    });
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
    $(document).on('click', '#adv', function ()
	{
        var attractSelect = $("#attraction-select").val();
	var aType = $("#attraction-type").val();

    	$.ajax({
        	type:"POST",
        	url: '../php/amValue.php',
        	data: {attractionValue : attractSelect,
			attractionType : aType},
        	success: function(response)
        	{
            		$("#attraction-value").html(response);
        	}
    	});
    });
    $(document).on('click', '#add', function ()
        {
        var newVal = $("#inputVal").val();
	var attractSelect = $("#attraction-select").val();
        var aType = $("#attraction-type").val();

        $.ajax({
                type:"POST",
                url: '../php/amAdder.php',
                data: {inputVal : newVal,
			attractionId : attractSelect,
			attractionType : aType},
                success: function()
                {
        		$.ajax({
                		type:"POST",
                		url: '../php/amValue.php',
                		data: {attractionValue : attractSelect,
                        	attractionType : aType},
                		success: function(response)
                		{
                        		$("#attraction-value").html(response);
                		}
        		});
                }
        });
    });
function setID (id){
                var attractSelect = $("#attraction-select").val();
var aType = $("#attraction-type").val();
        jQuery.ajax({
                type: "POST",
                url: '../php/amRemover.php',
                data: {labelID : id,
                        attractionType : aType},
                success: function(response)
        {
                $.ajax({
                        type:"POST",
                        url: '../php/amValue.php',
                        data: {attractionValue : attractSelect,
                        attractionType : aType},
                        success: function(response)
                        {
                                $("#attraction-value").html(response);
                        }
                });
        }
        });
}
function editID (id, type){
                var attractSelect = $("#attraction-select").val();
var aType = $("#attraction-type").val();
        var val = $("#newValue").val();
        jQuery.ajax({
                type: "POST",
                url: '../php/amEditor.php',
                data: {labelID : id,
                        newVal : val,
                        aType : type},
                success: function(response)
        {
                $.ajax({
                        type:"POST",
                        url: '../php/amValue.php',
                        data: {attractionValue : attractSelect,
                        attractionType : aType},
                        success: function(response)
                        {
                                $("#attraction-value").html(response);
                        }
                });
        }
        });
}
});
