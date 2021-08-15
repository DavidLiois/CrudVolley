<?php 
	include "koneksi.php";

    $StaffId    = $_POST['staffid'] ? $_POST['staffid'] : '';
    $jabatan = $_POST['jabatan'] ? $_POST['jabatan'] : '';
    $divisi = $_POST['divisi'] ? $_POST['divisi'] : '';
    $username = $_POST['username'] ? $_POST['username'] : '';
    $fullname = $_POST['fullname'] ? $_POST['fullname'] : '';
    $jeniskelamin = $_POST['jeniskelamin'] ? $_POST['jeniskelamin'] : '';
    $pob = $_POST['pob'] ? $_POST['pob'] : '';
    $dob = $_POST['dob'] ? $_POST['dob'] : '';
    $alamat = $_POST['alamat'] ? $_POST['alamat'] : '';
    $email = $_POST['email'] ? $_POST['email'] : '';
    $phonenumber = $_POST['phonenumber'] ? $_POST['phonenumber'] : '';    
    $usernote = $_POST['usernote'] ? $_POST['usernote'] : '';        

    $photo = addslashes(file_get_contents($_FILES['image']['tmp_name']));     

    $dob_format = date('YYYY-mm-dd', strtotime($dob));

    if($jabatan == "admin"){
        $sql = "UPDATE staff SET 
                    Jabatan = '$jabatan',
                    Divisi = '$divisi',
                    Username = '$username',
                    Fullname = '$fullname',
                    JenisKelamin = '$jeniskelamin',
                    PlaceOfBirth = '$pob',
                    DateOfBirth = '$dob_format',
                    Alamat = '$alamat',
                    Email = '$email',
                    PhoneNumber = '$phonenumber',
                    UserNote = '$usernote',
                    Photo = '$photo',
                    ModifiedDate = CURRENT_TIMESTAMP()
                WHERE StaffId = '$StaffId'";
    }
    else{
        $sql = "UPDATE staff SET 
                    Fullname = '$fullname',
                    UserNote = '$usernote',
                    Photo = '$photo',                    
                    Email = '$Email',
                    PhoneNumber = '$PhoneNumber',
                    ModifiedDate = CURRENT_TIMESTAMP()
                WHERE StaffId = '$StaffId'";
    }

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