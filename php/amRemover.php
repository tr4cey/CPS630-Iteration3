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
    $id = $_POST['labelID'];
    $aType = $_POST['attractionType'];

    if($aType=="Image"){
	$sqlImage = "delete from image where image_id=".$id;
    }
    else{
    	$sqlImage = "delete from label where label_id=".$id;
    }

    mysqli_query($conn, $sqlImage);

    mysqli_close($conn);
?>

