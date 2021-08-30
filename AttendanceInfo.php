<?php
	include "koneksi.php";

    $id = isset($_GET['data']) ? $_GET['data'] : '';
    
    $sql = "SELECT * 
            FROM presensi             
            WHERE StaffId = '$id'
            AND MONTH(presensi.CreatedDate)=MONTH(now())
            ORDER BY CreatedDate ASC";

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