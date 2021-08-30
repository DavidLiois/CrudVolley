<?php 
    include "koneksi.php";

    $StaffId = isset($_POST['StaffId']) ? $_POST['StaffId'] : '';
    $AlasanIzinCuti = isset($_POST['AlasanIzinCuti']) ? $_POST['AlasanIzinCuti'] : '';
    $MulaiCuti = isset($_POST['MulaiCuti']) ? $_POST['MulaiCuti'] : '';
    $SelesaiCuti = isset($_POST['SelesaiCuti']) ? $_POST['SelesaiCuti'] : '';
    $total = (int)isset($_POST['total']) ? $_POST['total'] : '';
    
    if($total == 0){
        $total += 1;
    }
    
    try {
        $MulaiCutiFormat = DateTime::createFromFormat('d/m/Y', $MulaiCuti)->format('Y-m-d');
        $SelesaiCutiFormat = DateTime::createFromFormat('d/m/Y', $SelesaiCuti)->format('Y-m-d');

        $sql = "INSERT INTO cuti(
                StaffId,
                IzinCuti,
                AlasanIzinCuti,
                MulaiCuti,
                SelesaiCuti
                )
                VALUES (
                '$StaffId',
                1,
                '$AlasanIzinCuti',
                '$MulaiCutiFormat',
                '$SelesaiCutiFormat'
            )";
            
        $sql_update = "UPDATE staff SET JatahCuti = JatahCuti-$total WHERE StaffId = '$StaffId'";
        
        $conn->query($sql);
        if ($conn->affected_rows > 0) {
            $conn->query($sql_update);
            $response["success"] = "1";
            $response["message"] = "Leaves Request created successfully";
            echo json_encode($response);
        } else {
            $response["success"] = "0";
            $response["message"] = "Failed to Add Leaves Request";
            echo json_encode($response);
        }
    } catch (\Throwable $th) {
        echo "Error :" . $th;
    }
    $conn->close();
?>