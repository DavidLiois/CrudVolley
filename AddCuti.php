<?php 
    include "koneksi.php";

    $StaffId = isset($_POST['StaffId']) ? $_POST['StaffId'] : '';
    $JatahCuti = isset($_POST['JatahCuti']) ? $_POST['JatahCuti'] : '';
    $IzinCuti = isset($_POST['IzinCuti']) ? $_POST['IzinCuti'] : '';
    $AlasanIzinCuti = isset($_POST['AlasanIzinCuti']) ? $_POST['AlasanIzinCuti'] : '';
    $BuktiIzinCuti = isset($_POST['BuktiIzinCuti']) ? $_POST['BuktiIzinCuti'] : '';
    $MulaiCuti = isset($_POST['MulaiCuti']) ? $_POST['MulaiCuti'] : '';
    $SelesaiCuti = isset($_POST['SelesaiCuti']) ? $_POST['SelesaiCuti'] : '';

    $MulaiCutiFormat = date('YYYY-mm-dd', strtotime($MulaiCuti));
    $SelesaiCutiFormat = date('YYYY-mm-dd', strtotime($SelesaiCuti));

    $sql = "INSERT INTO cuti(
                StaffId,
                JatahCuti,
                IzinCuti,
                AlasanIzinCuti,
                BuktiIzinCuti,
                MulaiCuti,
                SelesaiCuti 
                )
                VALUES (
                '$StaffId',
                '$JatahCuti',
                '$IzinCuti',
                '$AlasanIzinCuti',
                '$BuktiIzinCuti',
                '$MulaiCutiFormat',
                '$SelesaiCutiFormat'
            )";

    try {
        $conn->query($sql);
        if ($conn->affected_rows > 0) {
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