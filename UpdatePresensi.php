<?php 
    include "koneksi.php";
    
    $key = isset($_POST['key']) ? $_POST['key'] : '';

    $StaffId = isset($_POST['StaffId']) ? $_POST['StaffId'] : '';
    $mulaiistirahat = isset($_POST['mulaiistirahat']) ? $_POST['mulaiistirahat'] : '';
    $selesaiistirahat = isset($_POST['selesaiistirahat']) ? $_POST['selesaiistirahat'] : '';
    $jampulang = isset($_POST['jampulang']) ? $_POST['jampulang'] : '';
    
    $date_today=date("Y-m-d");
    
    $sql_istirahat_mulai = "UPDATE presensi 
	        SET Istirahat = 1,
	            MulaiIstirahat = '$mulaiistirahat'
	        WHERE StaffId = '$StaffId' AND CreatedDate = '$date_today'
	        ";
	        
	$sql_istirahat_selesai = "UPDATE presensi 
	        SET SelesaiIstirahat = '$selesaiistirahat'
	        WHERE StaffId = '$StaffId' AND CreatedDate = '$date_today'
	        ";
        
    $sql_pulang = "UPDATE presensi 
        SET Pulang = 1,
            JamPulang = '$jampulang'
        WHERE StaffId = '$StaffId' AND CreatedDate = '$date_today'
        ";
        
    try{
        if( $key == "istirahat_mulai"){
            $conn->query($sql_istirahat_mulai);
        }
        else if( $key == "istirahat_selesai"){
            $conn->query($sql_istirahat_selesai);
        }
        else{
            $conn->query($sql_pulang);
        }
        
        if ($conn->affected_rows > 0) {
            $response["success"] = "1";
            $response["message"] = "Adding presensi data success";
            echo json_encode($response);
        } 
        else {
            $response["success"] = "0";
            $response["message"] = "Failed to update presensi data";
            echo json_encode($response);
        }
    }
    catch(\Throwable $th){
        echo $th;
    }

    $conn->close();
?>