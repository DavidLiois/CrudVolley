<?php
	include "koneksi.php";

    $StaffId = isset($_POST['StaffId']) ? $_POST['StaffId'] : '';

    $sql = "SELECT * 
            FROM presensi             
            WHERE StaffId = '$StaffId' AND CreatedDate = CURRENT_DATE";

    try {
        $result = $conn->query($sql);
        $response = array();
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $response[] = $row;
            }
            echo json_encode($response);
        }
        else{
            echo "No Data";
        }    
    } catch (\Throwable $th) {
        echo "Error : ".$th;
    }

	$conn->close();
?>