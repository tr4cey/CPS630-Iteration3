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

    $email = $_POST['email'];
    $pwd = $_POST['password'];

    session_start();

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)
    {
        //redirect to account page?
    }

    $sqlLogin = "select email, password from account where email = '$email';";
    $accResult = mysqli_query($conn, $sqlLogin);

    if(mysqli_num_rows($accResult) > 0 )
    { 
        while($row = mysqli_fetch_assoc($accResult))
	    {
            $pwdHash = $row['password'];
            if(password_verify($pwd,$pwdHash))
            {
                $_SESSION["loggedin"] = true; 
                $_SESSION["email"] = $email;
                echo "true";
            }
            else
            {
                echo "false";
            }
	    }
    }
    else
    {
        echo "false";
    }

    mysqli_close($conn);
?>