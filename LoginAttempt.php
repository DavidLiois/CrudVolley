<?php
    include "koneksi.php";
    
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $ipnumber = isset($_POST['ipnumber']) ? $_POST['ipnumber'] : '';
    $lat = isset($_POST['lat']) ? $_POST['lat'] : '';
    $long = isset($_POST['long']) ? $_POST['long'] : '';

    $sql = "INSERT INTO loginattempt(
                Username,
                Password,
                IPNumber,
                Longitude,
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