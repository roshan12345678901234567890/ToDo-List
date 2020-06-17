<?php
include_once('db_config.php');

    $conn = new mysqli($server, $user, $password);

    mysqli_set_charset($conn, 'utf8');

    $query="SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s',$database);
    $stmt->execute();
    $stmt->bind_result($data);
    if($stmt->fetch())
    {

    }
    else
    {
        $sql = "CREATE DATABASE $database";
        if (mysqli_query($conn,$sql)) {
        }else 
            {
            echo "Error creating database: " . $conn->error;
        }
    }
    
?>