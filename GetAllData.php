<?php
	include "koneksi.php";

    $sql = "SELECT 
                StaffId,
                Jabatan,
                Divisi,
                Fullname,
                Username,
                JenisKelamin,
                UserNote,
                PlaceOfBirth,
                DateOfBirth,
                Alamat,
                Email,
                PhoneNumber,
                JatahCuti,
                Active
            FROM staff";
    
	try {
		$result = $conn->query($sql);
		$response = array();

		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()) {
			    $response[]=$row;
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