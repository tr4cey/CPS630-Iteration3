<?php 
    $host = 'cps630-assignment1.cvidkwrcsjty.us-east-1.rds.amazonaws.com';
    $user = 'admin';
    $pass = 'cps630team10';
    $dbname = 'assignment1';
    $conn = mysqli_connect($host, $user, $pass, $dbname);
    if(! $conn )
    {
	    die('Could not connect to instance: ' . mysqli_error($conn));
    }

    $searchItem = $_POST["searchItem"];

    $sql = "select * from attraction where attraction_name like '%$searchItem%' or country like '%$searchItem%' or city like '%$searchItem%';";
    $qResult = mysqli_query($conn, $sql);

    
    if (mysqli_num_rows($qResult) > 0)
    {
        echo "<table id='searchResults'>";
        echo "<th>Select</th><th>Country</th><th>City</th><th>Attraction</th>";
        while($row = mysqli_fetch_assoc($qResult))
	    {
            echo "<tr>";
            echo '<td><input class=\'limit\' type=\'checkbox\' value=\''.$row['attraction_name'].'\'></td>';
            echo '<td>'.$row['country'].'</td>';
            echo '<td>'.$row['city'].'</td>';
	        echo '<td>'.$row['attraction_name'].'</td>';
	        echo "</tr>";
        }
        echo "</table>";
    }
    else { echo "<p>No Results Found</p>"; }
    mysqli_close($conn);
?>
