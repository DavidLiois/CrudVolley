<?php 
	include "koneksi.php";

	$username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

	$password_hash = password_hash($password, PASSWORD_DEFAULT);	

	$sql = "UPDATE password 
	        JOIN staff ON password.StaffId = staff.StaffId 
	        SET password.Password = '$password_hash',
	            password.ModifiedDate = CURRENT_TIMESTAMP
	        WHERE staff.Username = '$username';
            ";	
	try {
		$conn->query($sql);
		if ($conn->affected_rows > 0) {
			$response["success"] = "1";
			$response["message"] = "Update password success";
			echo json_encode($response);			
		} 
		else {
			$response["success"] = "0";
			$response["message"] = "Error updating password";
			echo json_encode($response);
		}
	} catch (\Throwable $th) {
		echo "Error : ".$th;
	}

	$conn->close();
?>