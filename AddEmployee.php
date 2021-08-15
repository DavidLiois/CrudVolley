<?php 
	include "koneksi.php";

	$jabatan = $_POST['jabatan'];
	$divisi = $_POST['divisi'];
	$username = $_POST['username'];
	$fullname = $_POST['fullname'];
	$jeniskelamin = $_POST['jeniskelamin'];
	$pob = $_POST['pob'];
	$dob = $_POST['dob'];
	$alamat = $_POST['alamat'];
	$email = $_POST['email'];
	$phonenumber = $_POST['phonenumber'];
	$password = $_POST['password'];

	$password_hash = password_hash($password, PASSWORD_DEFAULT);
	$dob_format = DateTime::createFromFormat('d/m/Y', $dob)->format('Y-m-d');
		
	$sql_search = "SELECT Username,PhoneNumber,Email FROM staff WHERE staff.Username = '$username' OR staff.Email = '$email' OR staff.PhoneNumber = '$phonenumber'";

	$sql = "CALL sign_up(
				'$jabatan',
				'$divisi',
				'$username', 
				'$fullname',
				'$jeniskelamin',
				'$pob',
				'$dob_format', 
				'$alamat',
				'$email',
				'$phonenumber',
				'$password_hash');";
	
	try {
		$search = $conn->query($sql_search);
		if($search->num_rows > 0){						
			while($row=mysqli_fetch_array($search)){				
				if($username == $row["Username"]){					
					$response["success"] = "2";
					$response["message"] = "User Already Exist";					
					echo json_encode($response);
				}
				if($phonenumber == $row["PhoneNumber"]){					
					$response["success"] = "3";
					$response["message"] = "Phonenumber Already Exist";					
					echo json_encode($response);
				}
				if($email == $row["Email"]){					
					$response["success"] = "4";
					$response["message"] = "Email Already Exist";
					echo json_encode($response);	
				}
			}
		}
		else{
			$conn->query($sql);
			if ($conn->affected_rows > 0) {
				$response["success"] = "1";
				$response["message"] = "New employee profile created successfully";
				echo json_encode($response);
			} else {
				$response["success"] = "0";
				$response["message"] = "Failed to add new employee data";
				echo json_encode($response);
			}
		}
	} catch (\Throwable $th) {
		echo "Error: " . $th;
	}

	$conn->close();
?>