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

    navhtml += "<a href='index.html' class='navItem'>Home</a>";
    navhtml += "<a href='about.html' class='navItem'>About Us</a>";
    navhtml += "<a href='about.html' class='navItem'>Contact Us</a>";
    navhtml += "<a href='cart.html' class='navItem'>Shopping Cart</a>";
    navhtml += "<a class='navItem' id='dbMaintain' style='text-decoration: underline;'>Maintain Database</a>";

    $("#navbar").html(navhtml);

    $.ajax({
	type:"POST",
	url: '../php/attractionPage.php',
	success: function(response)
	{
	    $("#attraction-container").html(response);
	}
    });

    $("#dialog").dialog({
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
    $("#passwordBtn").click(function()
    {
        var password = "cps630team10";
        var inputPwd = $("#pwd").val();
        
        if(inputPwd == password)
        {
            window.location.href = 'dbMaintain.html';
        }
        else
        {
            $("#dialog").dialog("close");
        }
    });
});
