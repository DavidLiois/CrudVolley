<?php
	include "koneksi.php";    
	
	$id = isset($_GET['id']) ? $_GET['id'] : '';

    $sql = "SELECT 
                count(case when cuti.IzinCuti = 1 then 1 end) AS 'IzinCuti' 
            FROM cuti JOIN staff ON staff.StaffId = cuti.StaffId 
            WHERE staff.StaffId = '$id'";

    try {
        $result = $conn->query($sql);
        
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $response = $row;
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