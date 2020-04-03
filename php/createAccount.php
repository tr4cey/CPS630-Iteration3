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
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    $addr = $_POST['address'];
    $tel = $_POST['phoneNum'];

    $pwdHash = password_hash($pwd, PASSWORD_DEFAULT);

    $sqlCount = "select count(*) from account where email = '$email';";
    $countResult = mysqli_query($conn, $sqlCount);

    $count = 0;

    if(mysqli_num_rows($countResult) > 0)
    {
        while($row = mysqli_fetch_assoc($countResult))
	    {
            $count = $row['count(*)'];
	    }
    }
    
    if($count > 0)
    {
        echo "<p>Account with Email already exists.</p>";
    }
    else
    {
        $sqlInsert = "insert into account values('$email', '$pwdHash', '$fname', '$lname', '$addr', '$tel');";
        if(mysqli_query($conn,$sqlInsert))
        {
            echo "<p>Account Created Successfully</p>";
        }
        else
        {
            echo "<p>Error: Could not create account at this time</p>";
        }
    }

    //echo "<p>$fname<br/>$lname<br/>$email<br/>$pwdHash<br/>$addr<br/>$tel<br/></p>";
    mysqli_close($conn);
?>