<?php
	include "koneksi.php";

    $id = isset($_GET['data']) ? $_GET['data'] : '';

    $sql = "SELECT *
            FROM staff 
            WHERE StaffId = '$id'";
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