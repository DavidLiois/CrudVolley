<?php
	$server = "localhost";
	$user = "id17368317_admin";
	$password = "!Adm1n12569878";
	$database = "id17368317_mobile_attendance";

	$conn = new mysqli($server,$user,$password,$database);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}	
?>