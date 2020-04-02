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
    $selection = $_POST['selection'];
    $query = $_POST['sqlQuery'];
    $table = $_POST['table'];

    if($selection == 'insert')
    {
        if(mysqli_query($conn,$query))
        {
            echo "Inserted Successfully";
        }
        else
        {
            echo "Error: " . $sql . "" . mysqli_error($conn);
        }
    }
    else if($selection == 'delete')
    {
        if(mysqli_query($conn,$query))
        {
            echo "Deleted Successfully";
        }
        else
        {
            echo "Error: " . $sql . "" . mysqli_error($conn);
        }
    }
    else if($selection == 'select')
    {
        $sql2 = "SHOW COLUMNS FROM $table";
        $res = mysqli_query($conn,$sql2);

        while($row = mysqli_fetch_assoc($res))
        {
            $columns[] = $row['Field'];
        }
        echo "<table id='selectTable'><tr>";
        foreach($res as $column) 
        {
            echo '<th>'.$column['Field'].'</th>';
        }
        echo "</tr>";
        $selResults = mysqli_query($conn,$query);
        if (mysqli_num_rows($selResults) > 0)
        {
            while($row = mysqli_fetch_assoc($selResults))
            {
                echo "<tr>"; 
                foreach($res as $column) 
                {
                    $columnName = $column['Field'];
                    echo '<td>'.$row[$columnName].'</td>';
                }
                echo "</tr>";
            }
        }
        else { echo "No Results Found"; }

    }
    else if($selection == 'update')
    {
        if(mysqli_query($conn,$query))
        {
            echo "Updated Successfully";
        }
        else
        {
            echo "Error: " . $sql . "" . mysqli_error($conn);
        }
    }

    mysqli_close($conn)
?>
