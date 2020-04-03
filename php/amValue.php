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

    $sqlImage = "select * from attraction";
    $imageResult = mysqli_query($conn, $sqlImage);

    echo "".$attractValue;

    if (mysqli_num_rows($imageResult) > 0)
    {
	while($row = mysqli_fetch_assoc($imageResult))
	{
	    echo "";
	}
    }
    else { echo "No Results Found"; }

    mysqli_close($conn);
?>

