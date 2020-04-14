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
    $val = $_POST['inputVal'];
    $id = $_POST['attractionId'];
    $aType = $_POST['attractionType'];

    if($aType == "Image"){
	$sqlImage = "insert into image (attraction_id, url, type) values (".$id.", '".$val."', 'alt')";
    }
    else{
    	$sqlImage = "insert into label (attraction_id, label_name, label) values (".$id.", '".$aType."', '".$val."')";
    }
    mysqli_query($conn, $sqlImage);

    mysqli_close($conn);
?>

