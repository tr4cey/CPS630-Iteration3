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
    echo "<select id='attraction-select'>
	<option value='' selected disabled hidden>Select an attraction...</option>";

    if (mysqli_num_rows($imageResult) > 0)
    {
	while($row = mysqli_fetch_assoc($imageResult))
	{
	    echo "<option value='".$row['attraction_id']."'>".$row['attraction_name']."</option>";
	}
    }
    else { echo "No Results Found."; }

	echo "</select><br><br><div>Attribute:</div>";
    	echo "  <select id='attraction-type'>
	<option value='' selected disabled hidden>Select an attribute...</option>
        <option value='Name'>Name</option>
        <option value='Image' disabled>Image</option>
	<option value='Address'>Address</option>
	<option value='Description'>Description</option>
	<option value='Distance'>Distance</option>
	<option value='Area'>Area</option>
	<option value='Price'>Price</option>
	<option value='Invoices'>Invoices</option>
	<option value='User-accounts' disabled>User Accounts</option>
	<option value='User-feedback' disabled>User Feedback</option>
	<option value='User-rankings' disabled>User Rankings</option>
	<option value='Coordinates'>Coordinates</option>
	<option value='Owner'>Owner</option>
	<option value='Other'>Other...</option>
	</select>  ";
	echo "<button id='adv'>Search</button>";

    mysqli_close($conn);
?>

