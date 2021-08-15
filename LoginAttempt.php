<?php
    include "koneksi.php";

    $username = $_POST['username'] ? $_POST['username'] : '';
    $password = $_POST['password'] ? $_POST['password'] : '';
    $ipnumber = $_POST['ipnumber'] ? $_POST['ipnumber'] : '';
    $long = $_POST['long'] ? $_POST['long'] : '';
    $lat = $_POST['lat'] ? $_POST['lat'] : '';

    $sql = "INSERT INTO loginattempt(
                Username,
                Password,
                IPNumber,
                Longtitude,
                Latitude
            ) 
            VALUES (
                '$username',
                '$password',
                '$ipnumber',
                '$long',
                '$lat'
            )";
    try {
        $conn->query($sql);        
    } catch (\Throwable $th) {
        echo "Error : ".$th;
    }
    
    $conn->close();
?>