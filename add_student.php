<?php
	/*
		Add Students
	*/

	include('database/connection.php');

	if (isset($_POST['add_student'])) {
		
		//define student info variables
		$idnum = mysqli_real_escape_string($conn, $_POST['idnum']);
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$course = mysqli_real_escape_string($conn, $_POST['course']);
		$year = mysqli_real_escape_string($conn, $_POST['year']);

		//prevent in ID Number duplication
		$check_idnum = mysqli_query($conn, "SELECT * FROM students WHERE IDNumber = '$idnum'");
		$count_idnum = mysqli_num_rows($check_idnum);

		if ($count_idnum > 0) {
			
			echo "<script>
				alert('ID Number is already existing');
			</script>";

		} else {
		//adding query start
		$add_sql = "INSERT INTO students (IDNumber, Name, Course, Year, Status, Date) 
		VALUES ('$idnum', '$name', '$course', '$year', 'Registered', NOW())";
		$add_res = mysqli_query($conn, $add_sql);

		if ($add_res) {
			echo "<script>
				alert('Added Successfully');
			</script>
            <meta http-equiv='refresh' content='0; url=dashboard.php'>";
			} else {
			echo "<script>
				alert('Failure in adding');
				window.open('dashboard.php', '_self');
			</script>";
			}
		}
	}
?>