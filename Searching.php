<?php
	include "koneksi.php";

    $sql = "SELECT * FROM staff WHERE Fullname LIKE '%".$_GET['search_query']."%' OR Jabatan LIKE '%".$_GET['search_query']."%' OR Divisi LIKE '%".$_GET['search_query']."%' OR Username LIKE '%".$_GET['search_query']."%' ORDER BY Fullname ASC";
            
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