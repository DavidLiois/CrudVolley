<?php 
    include "koneksi.php";

    $StaffId = $_POST['StaffId'];
    $Datang = $_POST['Datang'];
    $JamDatang = $_POST['JamDatang'];
    $Terlambat = $_POST['Terlambat'];
    $JamTerlambat = $_POST['JamTerlambat'];
    $AlasanTerlambat = $_POST['AlasanTerlambat'];
    $Istirahat = $_POST['Istirahat'];
    $MulaiIstirahat = $_POST['MulaiIstirahat'];
    $SelesaiIstirahat = $_POST['SelesaiIstirahat'];
    $Pulang = $_POST['Pulang'];
    $JamPulang = $_POST['JamPulang'];
    $Absen = $_POST['Absen'];
    $AlasanAbsen = $_POST['AlasanAbsen'];
    $BuktiAbsen = $_POST['BuktiAbsen'];
    $Longtitude = $_POST['Longtitude'];
    $Latitude = $_POST['Latitude'];

    $sql = "INSERT INTO presensi(
                StaffId,
                Datang,
                JamDatang,
                Terlambat,
                JamTerlambat,
                AlasanTerlambat,
                Istirahat,
                MulaiIstirahat,
                SelesaiIstirahat,
                Pulang,
                JamPulang,
                Absen,
                AlasanAbsen,
                BuktiAbsen,
                Longtitude,
                Latitude,
                CreatedDate
                )
                VALUES (
                '$StaffId',
                '$Datang',
                '$JamDatang',
                '$Terlambat',
                '$JamTerlambat',
                '$AlasanTerlambat',
                '$Istirahat',
                '$MulaiIstirahat',
                '$SelesaiIstirahat',
                '$Pulang',
                '$JamPulang',
                '$Absen',
                '$AlasanAbsen',
                '$BuktiAbsen',
                '$Longtitude',
                '$Latitude',
                CURRENT_DATE
            )";
    try {
        $conn->query($sql);
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
    } catch (\Throwable $th) {
        echo "Error: " . $conn->error;
    }

    $conn->close();
?>