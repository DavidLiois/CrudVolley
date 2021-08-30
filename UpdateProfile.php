<?php 
	include "koneksi.php";

    $jabatan = isset($_POST['jabatan']) ? $_POST['jabatan'] : '';
    $divisi = isset($_POST['divisi']) ? $_POST['divisi'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
    $pob = isset($_POST['pob']) ? $_POST['pob'] : '';
    $dob = isset($_POST['dob']) ? $_POST['dob'] : '';
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phonenumber = isset($_POST['phonenumber']) ? $_POST['phonenumber'] : '';
    
    $dob_final = "";
    $format1 = 'Y-m-d';
    $format2 = 'd/m/Y';
    
    if (DateTime::createFromFormat($format1, $dob)){
        $dob_final = $dob;
    }
    else if(DateTime::createFromFormat($format2, $dob)){
        $dob_final = DateTime::createFromFormat($format2, $dob)->format($format1);
    }
    
    $sql = "UPDATE staff SET 
                    Jabatan = '$jabatan',
                    Divisi = '$divisi',
                    Fullname = '$fullname',
                    PlaceOfBirth = '$pob',
                    DateOfBirth = '$dob_final',
                    Alamat = '$alamat',
                    Email = '$email',
                    PhoneNumber = '$phonenumber',
                    ModifiedDate = CURRENT_TIMESTAMP
                WHERE Username = '$username'";

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