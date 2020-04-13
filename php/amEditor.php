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
    $new = $_POST['newVal'];
    $type = $_POST['aType'];

    if($type == 'label'){
    	$sqlImage = "update label set label='".$new."' where label_id=".$id;
    }
    if($type == 'name'){
	$sqlImage = "update attraction set attraction_name='".$new."' where attraction_id=".$id;
    }
    if($type == 'image'){
	$sqlImage = "update image set url='".$new."' where image_id=".$id;
    }

    mysqli_query($conn, $sqlImage);

    mysqli_close($conn);
?>

