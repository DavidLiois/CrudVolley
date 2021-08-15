<?php 
	include "koneksi.php";

	$StaffId = $_POST['staffid'];
    $password = $_POST['password'];
    $passwordQ = $_POST['passwordq'];
    $passwordA = $_POST['passworda'];

	$password_hash = password_hash($password, PASSWORD_DEFAULT);	

	$sql = "UPDATE password SET                 
                PasswordAnswer = '$passwordA',
                PasswordQuestion = '$passwordQ',
				Password = '$password_hash',
                ModifiedDate = CURRENT_TIMESTAMP
            WHERE StaffId='$StaffId'
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