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

    session_start();
    $email = $_SESSION["email"];

    $sql = "select * from account where email = '$email';";
    $accResult = mysqli_query($conn, $sql);

    if(mysqli_num_rows($accResult) > 0 )
    {
        $row = mysqli_fetch_assoc($accResult);
        $fName = $row['first_name'];
        $lName = $row['last_name'];
        $address = $row['address'];
        $tel = $row['telephone_num'];

        $return_arr[] = array("email" => $email,
                    "firstName" => $fName,
                    "lastName" => $lName,
                    "address" => $address,
                    "telNum" => $tel);
    }

    echo json_encode($return_arr);
?>