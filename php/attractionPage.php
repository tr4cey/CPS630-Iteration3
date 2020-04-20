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

    $sqlImage = "select * from image where attraction_id = '$attractValue' and type='alt';";
    $imageResult = mysqli_query($conn, $sqlImage);

    echo "<div class='attraction-top'>";
    echo "<div class='attraction-preview'>";

    if (mysqli_num_rows($imageResult) > 0)
    {
	while($row = mysqli_fetch_assoc($imageResult))
	{
	    echo "<img src='".$row['url']."' height=200 width=350><br><br>";
	}
    }
    else { echo "No Results Found."; }

    echo "</div>";

    $sqlName = "select * from attraction where attraction_id = '$attractValue';";
    $nameResult = mysqli_query($conn, $sqlName);

    echo "<div class='attraction-details'>";

    if (mysqli_num_rows($nameResult) > 0)
    {
	while($row = mysqli_fetch_assoc($nameResult))
	{
	    echo "<h1>".$row['attraction_name']."</h1>";
	    echo "<h2>".$row['city'].", ".$row['country']."</h2>";
	}
    }
    else { echo "No Results Found."; }

    $sql = "select * from label where attraction_id = '$attractValue';";
    $qResult = mysqli_query($conn, $sql);

    if (mysqli_num_rows($qResult) > 0)
    {
        while($row = mysqli_fetch_assoc($qResult))
        {
            echo '<b>'.$row['label_name'].': </b><span>'.$row['label'].'</span><br><br>';
        }
    }
    else { echo "No Results Found."; }

    echo "</div>";
    echo "</div>";
    echo "<div class='attraction-reviews'>";
    echo "<h1 class='review-title'>Reviews</h1>";

    $sqlReview = "select * from review where attraction_id = '$attractValue';";
    $reviewResult = mysqli_query($conn, $sqlReview);

    if (mysqli_num_rows($reviewResult) > 0)
    {
        while($row = mysqli_fetch_assoc($reviewResult))
        {
            echo "<div class='review'>
            <div class='review-header'>
                <div>".$row['first_name']." ".$row['last_name']."</div><div>(".$row['time_posted'].")</div></div>
                <p>".$row['review']."</p>
            <p>".$row['rating']."</p></div>";
        }
    }
    else { echo "No Results Found."; }
    mysqli_close($conn);
?>

