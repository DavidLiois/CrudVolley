<?php 
    include "koneksi.php";
    
    $key = isset($_POST['key']) ? $_POST['key'] : '';

    $StaffId = isset($_POST['StaffId']) ? $_POST['StaffId'] : '';
    $JamDatang = isset($_POST['JamDatang']) ? $_POST['JamDatang'] : '';
    $JamTerlambat = isset($_POST['JamTerlambat']) ? $_POST['JamTerlambat']: '';
    $AlasanTerlambat = isset($_POST['AlasanTerlambat']) ? $_POST['AlasanTerlambat'] : '';
    $Longtitude = isset($_POST['Longtitude']) ? $_POST['Longtitude'] : '';
    $Latitude = isset($_POST['Latitude']) ? $_POST['Latitude'] : '';
    
    $sql_search = "SELECT 
                        PresensiId, CreatedDate 
                    FROM presensi 
                    WHERE StaffId = '$StaffId' 
                    ORDER BY CreatedDate 
                    DESC LIMIT 1";
    
    $sql = "INSERT INTO presensi(
                StaffId,
                Datang,
                JamDatang,
                Longtitude,
                Latitude,
                CreatedDate
                )
                VALUES (
                '$StaffId',
                1,
                '$JamDatang',
                '$Longtitude',
                '$Latitude',
                CURRENT_DATE
            )";
            
    $sql_terlambat = "INSERT INTO presensi(
                StaffId,
                Terlambat,
                JamTerlambat,
                AlasanTerlambat,
                Longtitude,
                Latitude,
                CreatedDate
                )
                VALUES (
                '$StaffId',
                1,
                '$JamTerlambat',
                '$AlasanTerlambat',
                '$Longtitude',
                '$Latitude',
                CURRENT_DATE
            )";
            
    try{
        $search = $conn->query($sql_search);
        $row = $search->fetch_assoc();
        
        $date_for_today=date_create(date("Y-m-d"));
        
        $date=date_create(date("Y-m-d"));
        date_sub($date,date_interval_create_from_date_string("1 days"));
        
        if($search->num_rows > 0){
            if(date_format($date,"Y-m-d") == $row["CreatedDate"]){
                if($key == "masuk"){
                    $conn->query($sql);
                }
                else{
                    $conn->query($sql_terlambat);
                }
                
                if ($conn->affected_rows > 0) {
                    $response["success"] = "1";
                    $response["message"] = "Adding presensi data success";
                    echo json_encode($response);
                } 
                else {
                    $response["success"] = "0";
                    $response["message"] = "Failed to add new presensi data";
                    echo json_encode($response);
                }
            }
            else if(date_format($date_for_today,"Y-m-d") == $row["CreatedDate"]){
                $response["success"] = "0";
                $response["message"] = "Failed to add new presensi data";
                echo json_encode($response);
            }
            else{
                $date_today=date_create(date("Y-m-d"));
                $d1 = new DateTime (date_format($date_today,"Y-m-d"));
                $d2 = new DateTime ($row["CreatedDate"]);
                $d3 =  $d1->diff($d2)->format("%d");
                
                $date2=date_create($row["CreatedDate"]);
                
                for($i = 1; $i < $d3; $i++){
                    date_add($date2,date_interval_create_from_date_string("1 days"));
                    $date3 = date_format($date2,"Y-m-d");
                    
                    $sql_absen = "INSERT INTO presensi(StaffId, Absen, CreatedDate) VALUES ('$StaffId', 1, '$date3')";
                    
                    $conn->query($sql_absen);
                    
                    $sql_update = "UPDATE staff SET JatahCuti = JatahCuti-1 WHERE StaffId = '$StaffId'";
                
                    $conn->query($sql_update);
                }
                
                if($key == "masuk"){
                    $conn->query($sql);
                }
                else{
                    $conn->query($sql_terlambat);
                }
                
                if ($conn->affected_rows > 0) {
                    $response["success"] = "1";
                    $response["message"] = "Adding presensi data success";
                    echo json_encode($response);
                } 
                else {
                    $response["success"] = "0";
                    $response["message"] = "Failed to add new presensi data";
                    echo json_encode($response);
                }
            }
        }
        else{
            if($key == "masuk"){
                $conn->query($sql);
            }
            else{
                $conn->query($sql_terlambat);
            }
            
            if ($conn->affected_rows > 0) {
                $response["success"] = "1";
                $response["message"] = "Adding presensi data success";
                echo json_encode($response);
            } 
            else {
                $response["success"] = "0";
                $response["message"] = "Failed to add new presensi data";
                echo json_encode($response);
            }
        }
    }
    catch(\Throwable $th){
        Echo $th;
    }

    $conn->close();
?>