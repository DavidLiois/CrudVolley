<?php
	include "koneksi.php";

    $sql = "SELECT 
                staff.StaffId,
                staff.Fullname,
                staff.Username,
                staff.Divisi,
                staff.Jabatan,
                count(case when presensi.Datang = 1 then 1 end) AS 'Datang',
                count(case when presensi.Terlambat = 1 then 1 end) AS 'Terlambat',
                count(case when presensi.Pulang = 1 then 1 end) AS 'Pulang',
                count(case when presensi.Istirahat = 1 then 1 end) AS 'Istirahat',
                count(case when presensi.Absen = 1 then 1 end) AS 'Absen',
                staff.JatahCuti 'JatahCuti'
            FROM presensi 
            JOIN staff ON staff.StaffId = presensi.StaffId 
            WHERE MONTH(presensi.CreatedDate)=MONTH(now()) 
            AND (staff.Fullname LIKE '%".$_GET['search_query']."%' OR staff.Jabatan LIKE '%".$_GET['search_query']."%' OR staff.Divisi LIKE '%".$_GET['search_query']."%' OR staff.Username LIKE '%".$_GET['search_query']."%')
            GROUP BY staff.Fullname
            ORDER BY staff.Fullname ASC";
            
	try {
	    $result = $conn->query($sql);	
        $response = array();

		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()) {
    			$id = $row['StaffId'];
                
                $sql_cuti = "SELECT count(case when cuti.IzinCuti = 1 then 1 end) AS 'IzinCuti' FROM cuti JOIN staff ON staff.StaffId = cuti.StaffId WHERE staff.StaffId = '$id'";
                
                $res = $conn->query($sql_cuti);
                $rows = $res->fetch_assoc();
                
                $response[] = $row + $rows;
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