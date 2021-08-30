<?php 
	include "koneksi.php";

	$jabatan = isset($_POST['jabatan']) ? $_POST['jabatan'] : '';
	$divisi = isset($_POST['divisi']) ? $_POST['divisi'] : '';
	$username = isset($_POST['username']) ? $_POST['username'] : '';
	$fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
	$jeniskelamin = isset($_POST['jeniskelamin']) ? $_POST['jeniskelamin'] : '';
	$pob = isset($_POST['pob']) ? $_POST['pob'] : '';
	$dob = isset($_POST['dob']) ? $_POST['dob'] : '';
	$alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
	$email = isset($_POST['email']) ? $_POST['email'] : '';
	$phonenumber = isset($_POST['phonenumber']) ? $_POST['phonenumber'] : '';
	$password = isset($_POST['password']) ? $_POST['password'] : '';

	$password_hash = password_hash($password, PASSWORD_DEFAULT);
	$dob_format = DateTime::createFromFormat('d/m/Y', $dob)->format('Y-m-d');
		
	$sql_search = "SELECT 
						Username,PhoneNumber,Email 
					FROM staff 
					WHERE staff.Username = '$username' 
					OR staff.Email = '$email' 
					OR staff.PhoneNumber = '$phonenumber'";

	$sql = "INSERT INTO staff(
				Jabatan,
				Divisi,
				Username,
				Fullname,
				JenisKelamin,
				PlaceOfBirth,
				DateOfBirth,
				Alamat,
				Email,
				PhoneNumber,
				ModifiedDate
			) VALUES(
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
				CURRENT_TIMESTAMP
			)";
			
	$sql_password = "INSERT INTO password(
        				StaffId,
        				Password,
        				ModifiedDate
        			) VALUES (
        				(SELECT StaffId FROM staff WHERE Username = '$username'),
        				'$password_hash',
        				CURRENT_TIMESTAMP
        			)";
	
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
			    $conn->query($sql_password);
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