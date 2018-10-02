<?php
	
	include('database/connection.php');

	if (isset($_GET['reg']) && is_numeric($_GET['reg'])) {
		
		$reg = htmlspecialchars($_GET['reg']);
		$reg_sql = "UPDATE students SET Status = 'Registered', Date = NOW() WHERE ID = '$reg'";
		$reg_res = mysqli_query($conn, $reg_sql);
		header("location: dashboard.php");
	}

	else if (isset($_GET['unreg']) && is_numeric($_GET['unreg'])) {
		
		$unreg = htmlspecialchars($_GET['unreg']);
		$unreg_sql = "UPDATE students SET Status = 'Unregistered' WHERE ID = '$unreg'";
		$unreg_res = mysqli_query($conn, $unreg_sql);
		header("location: dashboard.php");
	}

	if (isset($_GET['logout']) && is_numeric($_GET['logout'])) {
		
		$logout = htmlspecialchars($_GET['logout']);
		$logout_sql = "UPDATE students SET Status = 'Logout', Date = NOW() WHERE ID = '$logout'";
		$logout_res = mysqli_query($conn, $logout_sql);
		header("location: dashboard.php");
	}
?>