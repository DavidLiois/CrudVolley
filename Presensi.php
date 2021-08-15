<?php
	include "koneksi.php";    

    $sql = "SELECT 
                staff.FullName AS 'Fullname',
                count(case when presensi.Datang = 1 then 1 end) AS 'Datang',
                count(case when presensi.Terlambat = 1 then 1 end) AS 'Terlambat',
                count(case when presensi.Pulang = 1 then 1 end) AS 'Pulang',
                count(case when presensi.Istirahat = 1 then 1 end) AS 'Istirahat',
                count(case when presensi.Absen = 1 then 1 end) AS 'Absen',
                count(case when cuti.IzinCuti = 1 then 1 end) AS 'Izin Cuti',
                staff.JatahCuti 'Jatah Cuti'
            FROM presensi 
            JOIN staff ON (staff.StaffId = presensi.StaffId)
            JOIN cuti ON (cuti.StaffId = presensi.StaffId)
            WHERE MONTH(presensi.CreatedDate)=MONTH(now())
            GROUP BY staff.Fullname;";

    try {
        $result = $conn->query($sql);	
        $response = array();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $response[] = $row;
            }
            echo json_encode($response);
        }
        else{
            echo "No Data";
        }    
    } catch (\Throwable $th) {
        echo "Error : ".$th;
    }

	$conn->close();
?>