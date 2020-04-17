<?php session_start();
    $host = 'cps630-assignment1.cvidkwrcsjty.us-east-1.rds.amazonaws.com';
    $user = 'admin';
    $pass = 'cps630team10';
    $dbname = 'assignment1';
    $conn = mysqli_connect($host, $user, $pass, $dbname);
    if(! $conn )
    {
	die('Could not connect to instance: ' . mysqli_error($conn));
    }
    
    $attractValue = $_SESSION["currentID"];

    $sqlCountry = "select country from attraction where attraction_id = '".$attractValue."'";
    $countryResult = mysqli_query($conn, $sqlCountry);
    if (mysqli_num_rows($countryResult) > 0)
    {
	$country = mysqli_fetch_assoc($countryResult);
    }

    $sqlContinent = "select continent_name from country where country_name = '".$country['country']."'";
    $continentResult = mysqli_query($conn, $sqlContinent);
    if (mysqli_num_rows($continentResult) > 0)
    {
	$continent = mysqli_fetch_assoc($continentResult);
    }

    $sqlCountries = "select country_name from country where continent_name = '".$continent['continent_name']."'";
    $sqlAttractions = "select * from attraction where country = '".$country['country']."'";

    $countriesResult = mysqli_query($conn, $sqlCountries);

    if (mysqli_num_rows($countriesResult) > 0)
    {
	while($row = mysqli_fetch_assoc($countriesResult))
	{
	    $sqlAttractions .= " or country = '".$row['country_name']."'";
	}
    }

    echo "<h2 class='main-title'>Other Close Attractions</h2>";
    echo "<div class='close-distance'>";

    $attractionsResult = mysqli_query($conn, $sqlAttractions);
    if (mysqli_num_rows($attractionsResult) > 0)
    {
	while($row = mysqli_fetch_assoc($attractionsResult))
	{
	    if($row['attraction_id'] != $attractValue)
	    {
		echo "<div class='close-place'>";

		$sqlImage = "select * from image where attraction_id = '".$row['attraction_id']."' and type = 'home'";
		$imageResult = mysqli_query($conn, $sqlImage);

		if (mysqli_num_rows($imageResult) > 0)
		{
		    while($innerRow = mysqli_fetch_assoc($imageResult))
		    {
	    		echo "<img alt='".$row['attraction_name']."' src='".$innerRow['url']."' height=180 width=320>";
		    }    
		}

                echo "<br><h3 style='display:inline'>".$row['attraction_name'].",</h3><div style='display:inline'> ".$row['city'].", ".$row['country']."</div><br>
                <a href='#!attraction' onclick='setID(".$row['attraction_id'].")'>Read More</a>
		</div>";
	    }
	}
    }
    else { echo "No results found."; }

    echo "</div>";
    mysqli_close($conn);
?>
