<?php
  include "koneksi.php";

  $StaffId = isset($_POST['StaffId']);

  $sql = "DELETE staff, presensi, cuti, password
          FROM staff
          JOIN presensi ON staff.StaffId = presensi.StaffId
          JOIN cuti ON staff.StaffId = cuti.StaffId
          JOIN password ON staff.StaffId = password.StaffId
          WHERE staff.StaffId = 5;          
          ";

  try {
    $conn->query($sql);
    if ($conn->affected_rows > 0) {
      $response["success"] = "1";
      $response["message"] = "Record deleted successfully";
      echo json_encode($response);    
    } 
    else {
      $response["success"] = "0";
      $response["message"] = "Error deleting record";
      echo json_encode($response);      
    } 
  } catch (\Throwable $th) {
    echo "Error : ". $th;
  }

  $conn->close();
?>