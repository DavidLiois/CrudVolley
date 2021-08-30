<?php
	include "koneksi.php";

    $id = isset($_GET['data']) ? $_GET['data'] : '';

    $sql = "SELECT * 
            FROM presensi             
            WHERE StaffId = '$id' AND presensi.CreatedDate = CURDATE()";

    try {
        $result = $conn->query($sql);
        
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $response = $row;
            $response["success"] = "1";
            echo json_encode($response);
        }
        else{
            $response["success"] = "0";
            echo json_encode($response);
        }    
    } catch (\Throwable $th) {
        echo "Error : ".$th;
    }

	$conn->close();
?>