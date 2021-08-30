<?php
  include "koneksi.php";

  $username = isset($_POST['username']) ? $_POST['username'] : '';

  $sql = "DELETE FROM staff WHERE Username = '$username'";

  try {
    $conn->query($sql);  
    if ($conn->affected_rows > 0) {
      $response["success"] = "1";
      $response["message"] = "Record deleted successfully";
      echo json_encode($response);    
    } 
    else {
      $response["success"] = "0";
      $response["message"] = "Delete Record Failed";
      echo json_encode($response);
    } 
  } catch (\Throwable $th) {
    echo "Error : ". $th;
  }

  $conn->close();
?>