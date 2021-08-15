<?php
	include "koneksi.php";    

    $username = $_POST['username'];
    $password = $_POST['password'];

    // $username = 'admin';
    // $password = 'admin123';

    $sql = "SELECT staff.*, Password 
            FROM staff 
            JOIN password 
            ON staff.StaffId = password.StaffId 
            WHERE staff.Username = '$username';";
    
    try {
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();            
            if ($row['Username'] == $username && password_verify($password, $row['Password'])){
                $response = $row;
                $response["success"]="1";                
                $response["message"]="Login Success";
                echo json_encode($response);
            }
            else {                                                
                $response["success"]="2";
                $response["message"]="Username or Password didn't match";
                echo json_encode($response);
            }
        }
        else{
            $response["success"]="0";
            $response["message"]="Login Failed";
            echo json_encode($response);
        }    
    } catch (\Throwable $th) {
        echo "Error : ".$th;
    }

    $conn->close();    
?>