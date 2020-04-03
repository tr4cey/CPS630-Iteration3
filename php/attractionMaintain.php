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
    $sqlImage = "select * from attraction";
    $imageResult = mysqli_query($conn, $sqlImage);

    echo "<br><div>Attraction:</div>";
    echo "<select id='attraction-select'>";

    if (mysqli_num_rows($imageResult) > 0)
    {
	while($row = mysqli_fetch_assoc($imageResult))
	{
	    echo "<option value='".$row['attraction_name']."'>".$row['attraction_name']."</option>";
	}
    }
    else { echo "No Results Found."; }

	echo "</select><br><br><div>Operation:</div>";
	echo "<select id='attraction-operation'>
	<option value='add'>Add</option>
	<option value='remove'>Remove</option>
	<option value='edit'>Edit</option>
	</select>";
    	echo "  <select id='attraction-type'>
	<option value='none'>Select a value...</option>
        <option value='name'>Name</option>
        <option value='image'>Image</option>
	<option value='address'>Address</option>
	<option value='description'>Description</option>
	<option value='distance'>Distance</option>
	<option value='area'>Area</option>
	<option value='price'>Price</option>
	<option value='invoices'>Invoices</option>
	<option value='user-accounts'>User Accounts</option>
	<option value='user-feedback'>User Feedback</option>
	<option value='user-rankings'>User Rankings</option>
	<option value='latitude'>Latitude</option>
	<option value='longitude'>Longitude</option>
        </select>";

    mysqli_close($conn);
?>

