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
    $attraction = $_POST['attractionValue'];
    $aType = $_POST['attractionType'];

    if($aType=="Name"){
   	$sqlImage = "select * from attraction where attraction_id=".$attraction;
    }
    else{
	$sqlImage = "select * from label where attraction_id=".$attraction." and label_name='".$aType."'";
    }

    $imageResult = mysqli_query($conn, $sqlImage);

    if (mysqli_num_rows($imageResult) > 0)
    {
	while($row = mysqli_fetch_assoc($imageResult))
	{
	    if($aType=="Name"){
		echo "<br>".$row['attraction_name']." <button id='edit'>Edit</button>";
	    }
	    else{
	    	echo "<br>".$row['label']." <button id='edit'>Edit</button>  <button id='remove' onclick='setID(".$row['label_id'].")'>Remove</button>";
	    }    
	}
    }
    else { echo "<br>No results found."; }

	if($aType!="Name"){
		echo "<br><input type='text' id='inputVal' placeholder='Add a new value...'>  <button id='add'>Add</button>".$_SESSION['labelID'];
	}

    mysqli_close($conn);
?>

