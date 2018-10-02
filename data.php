<?php

	header("Content-Type: application/json");

	require_once ('database/connection.php');

	$sql = "SELECT * FROM students WHERE Status = 'Registered' ORDER BY ID ASC";
	$res = mysqli_query($conn, $sql);

	$data = array();
	foreach ($res as $row) {
		$data[] = $row;
	}

	mysqli_close($conn);

	echo json_encode($data);
?>