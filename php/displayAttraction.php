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
    $attractValue = $_POST['attractionValue'];

    $sql = "select * from attraction where attraction_name = '$attractValue';";
    $qResult = mysqli_query($conn, $sql);
    $attractionId = "";

    if (mysqli_num_rows($qResult) > 0)
    {
        while($row = mysqli_fetch_assoc($qResult))
	    {
	    echo "<h2 style='display:inline'>".$row['attraction_name'].", </h2><div style='display:inline'> ".$row['city'].", ".$row['country']."</div><br>";
	    $attractionId = $row['attraction_id'];
	    echo "<a href='attraction.html'>Read More</a><br><br>";
	    }
    }
    else { echo "No Results Found"; }

    $sqlImage = "select * from image where attraction_id = '$attractionId' and type = 'home';";
    $imageResult = mysqli_query($conn, $sqlImage);
    
    if (mysqli_num_rows($imageResult) > 0)
    {
        while($row = mysqli_fetch_assoc($imageResult))
	    {
            $url = $row['url'];
            echo "<img src='$url' height='340' width='540'>";
	    }
    }
    else { echo "No Results Found"; }

    $_SESSION["currentID"] = $attractionId;	
    mysqli_close($conn);
?>
