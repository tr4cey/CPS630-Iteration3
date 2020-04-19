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

    $postdata = file_get_contents("php://input");
    $attractName = json_decode($postdata);

    $sql = "select * from attraction where attraction_name = '$attractName';";
    $accResult = mysqli_query($conn, $sql);
    $id = 0;
    if(mysqli_num_rows($accResult) > 0 )
    {
        $row = mysqli_fetch_assoc($accResult);
        echo "<h3>$attractName</h3>";
        echo "<p>";
        echo '<b>Country:</b> '.$row['country'].'<br/>';
        echo '<b>City:</b> '.$row['city'].'<br/>';
        $id = $row['attraction_id'];
    }
    $sql2 = "select * from label where attraction_id = '$id';";
    $labResult = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($labResult) > 0)
    {
        while($row = mysqli_fetch_assoc($labResult))
        {
            if($row['label_name'] == "Address")
            {
                echo '<b>'.$row['label_name'].': </b><span id=\'address\'>'.$row['label'].'</span><br>';
            }
            else 
            {
                echo '<b>'.$row['label_name'].': </b><span>'.$row['label'].'</span><br>';
            }
        }
    }

    echo "</p>";
?>