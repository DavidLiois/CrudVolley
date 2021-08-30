<?php 
	include "koneksi.php";

    $staffid = isset($_POST['staffid']) ? $_POST['staffid'] : '';
    $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phonenumber = isset($_POST['phonenumber']) ? $_POST['phonenumber'] : '';
    $usernote = isset($_POST['usernote']) ? $_POST['usernote'] : '';
    $photo = isset($_POST['photo']) ? $_POST['photo'] : '';
    
    $sql = "UPDATE staff SET 
            Fullname = '$fullname',
            UserNote = '$usernote',
            Alamat = '$alamat',                    
            Email = '$email',
            PhoneNumber = '$phonenumber',
            ModifiedDate = CURRENT_TIMESTAMP
        WHERE StaffId = '$staffid'";
    
    try {
        $conn->query($sql);
        if ($conn->affected_rows > 0) {
            $response["success"] = "1";
			$response["message"] = "Update profile success";
			echo json_encode($response);		
        } 
        else {
            $response["success"] = "0";
			$response["message"] = "Error updating profile";
			echo json_encode($response);
        }        
    } catch (\Throwable $th) {
        echo "Error : ".$th;
    }
    
	$conn->close();
?>