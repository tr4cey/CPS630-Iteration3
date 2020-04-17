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
    else if($aType=="Image"){
	$sqlImage = "select * from image where attraction_id=".$attraction;
    }
    else{
	$sqlImage = "select * from label where attraction_id=".$attraction." and label_name='".$aType."'";
    }

    $imageResult = mysqli_query($conn, $sqlImage);

    if (mysqli_num_rows($imageResult) > 0)
    {
	    echo "<br><input type='text' id='newValue' placeholder='Updated value...'></input>";
	while($row = mysqli_fetch_assoc($imageResult))
	{
	    if($aType=="Name"){
		echo "<br>Current Value: ".$row['attraction_name']." <button onclick=\"editID(".$row['attraction_id'].", 'name')\">Update</button>";
	    }
	    else if($aType=="Image"){
		    echo "<br><img src='".$row['url']."' width=300px><br>Current Value: ".$row['url']." <button onclick=\"editID(".$row['image_id'].", 'image')\">Update</button>  <button onclick='removeID(".$row['image_id'].")'>Remove</button>";
		    if($row['type'] == "home"){
			    echo "<span>  (MAIN)</span>";
		    }
	    }
	    else{
	    	echo "<br>Current Value: ".$row['label']." <button onclick=\"editID(".$row['label_id'].", 'label')\">Update</button>  <button onclick='removeID(".$row['label_id'].")'>Remove</button>";
	    }    
	}
    }
    else { echo "<br>No results found."; }

	if($aType!="Name"){
		echo "<br><input type='text' id='inputVal' placeholder='Add a new value...'>  <button id='add'>Add</button>";
	}

    mysqli_close($conn);
?>

