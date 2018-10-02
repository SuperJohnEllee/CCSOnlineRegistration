<?php
		/*
		
		Function php file
		all actions are here
		
		*/

		function addStudents(){

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
		}

		function login(){

			session_start();
			include('database/connection.php');

			if (isset($_POST['login'])) {

				$password = stripslashes($_POST['password']);
				$pass = mysqli_real_escape_string($conn, $password);

				$check_pass = mysqli_query($conn, "SELECT * FROM compstud");
				$check_row = mysqli_fetch_assoc($check_pass);

				$res_pass = $check_row['Password'];
				$res_name = $check_row['Name'];

				if ($res_pass == $pass) {
				
					$_SESSION['name'] = $res_name;
					header("location: dashboard.php");
				} else {

					echo "<script>
						alert('Incorrect Password');
					</script>";
				}
			}
		}

		function displayStudents(){

			include('database/connection.php');

			$stud_disp = "SELECT * FROM students ORDER BY Name ASC";
            $stud_res = mysqli_query($conn, $stud_disp);
            $stud_count = mysqli_num_rows($stud_res);

            if ($stud_count > 0) {
                while ($stud_row = mysqli_fetch_assoc($stud_res)) {
                    echo "<tr>
                           	<td>".htmlspecialchars($stud_row['IDNumber'])."</td>
                            <td>".htmlspecialchars($stud_row['Name'])."</td>
                            <td>".htmlspecialchars($stud_row['Course'])."</td>
                            <td>".htmlspecialchars($stud_row['Year'])."</td>
                            <td class='font-weight-bold'>".htmlspecialchars($stud_row['Status'])."</td>
                            <td>".htmlspecialchars($stud_row['Date'])."</td>
                            <td><a class='btn btn-info' href='registered.php?reg=".$stud_row['ID']."'><span class='fa fa-sign-in'></span> Login</a></td>
                            <tr>";
                    }
                } else {
                        echo "<tr><td colspan='7'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-warning'></span> Students Not Found</h3></td></tr>";
                }
		}

		function loginStudents(){

			include('database/connection.php');

			   $stud_disp = "SELECT * FROM students WHERE Status = 'Registered' ORDER BY Date DESC";
                    $stud_res = mysqli_query($conn, $stud_disp);
                    $stud_count = mysqli_num_rows($stud_res);

                    if ($stud_count > 0) {
                        while ($stud_row = mysqli_fetch_assoc($stud_res)) {
                        echo "<tr>
                            <td>".htmlspecialchars($stud_row['IDNumber'])."</td>
                            <td>".htmlspecialchars($stud_row['Name'])."</td>
                            <td>".htmlspecialchars($stud_row['Course'])."</td>
                            <td>".htmlspecialchars($stud_row['Year'])."</td>
                            <td class='font-weight-bold'>".htmlspecialchars($stud_row['Status'])."</td>
                            <td>".htmlspecialchars($stud_row['Date'])."</td>
                            <td><a class='btn btn-info' href='registered.php?logout=".$stud_row['ID']."'><span class='fa fa-sign-in'></span> Logout</a></td>
                            <tr>";
                    }
                } else {
                        echo "<tr><td colspan='7'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-warning'></span> Students Not Found</h3></td></tr>";
                }
		}

		function logoutStudents(){

			include('database/connection.php');

			$stud_disp = "SELECT * FROM students WHERE Status = 'Logout' ORDER BY Date DESC";
            $stud_res = mysqli_query($conn, $stud_disp);
            $stud_count = mysqli_num_rows($stud_res);

                if ($stud_count > 0) {
                   	while ($stud_row = mysqli_fetch_assoc($stud_res)) {
                        echo "<tr>
                            <td>".htmlspecialchars($stud_row['IDNumber'])."</td>
                            <td>".htmlspecialchars($stud_row['Name'])."</td>
                            <td>".htmlspecialchars($stud_row['Course'])."</td>
                            <td>".htmlspecialchars($stud_row['Year'])."</td>
                            <td class='font-weight-bold'>".htmlspecialchars($stud_row['Status'])."</td>
                            <td>".htmlspecialchars($stud_row['Date'])."</td>
                            <tr>";
                    }
                } else {
                        echo "<tr><td colspan='7'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-warning'></span> Students Not Found</h3></td></tr>";
                }
		}

	//count all the students
	$sql = mysqli_query($conn,"SELECT ID FROM students");
	$count = mysqli_num_rows($sql);


	//Count all Courses

	//count all IT Students
	$disp_it = mysqli_query($conn, "SELECT * FROM students WHERE Course = 'BSIT'");
	$count_it = mysqli_num_rows($disp_it);

	//count all CS Students
	$disp_cs = mysqli_query($conn, "SELECT * FROM students WHERE Course = 'BSCS'");
	$count_cs = mysqli_num_rows($disp_cs);

	//count all DMIA Students
	$disp_dmia = mysqli_query($conn, "SELECT * FROM students WHERE Course = 'BSDMIA'");
	$count_dmia = mysqli_num_rows($disp_dmia);


	//count all IS Students
	$disp_is = mysqli_query($conn, "SELECT * FROM students WHERE Course = 'BSIS'");
	$count_is = mysqli_num_rows($disp_is);
	
	//count all LIS Students
	$disp_lis = mysqli_query($conn, "SELECT * FROM students WHERE Course = 'BLIS'");
	$count_lis = mysqli_num_rows($disp_lis);

	//End

	//count registered students
	$reg_sql = mysqli_query($conn, "SELECT * FROM students WHERE Status = 'Registered'");
	$reg_count = mysqli_num_rows($reg_sql);

	//count unregistered students
	$unreg_sql = mysqli_query($conn, "SELECT * FROM students WHERE Status = 'Unregistered'");
	$unreg_count = mysqli_num_rows($unreg_sql);


	//Count all registered students based on their own course
	//count IT Students registered
	$it_sql = mysqli_query($conn, "SELECT ID FROM students WHERE Course = 'BSIT' AND Status = 'Registered'");
	$it_count = mysqli_num_rows($it_sql);

	//count CS Students registered
	$cs_sql = mysqli_query($conn, "SELECT ID FROM students WHERE Course = 'BSCS' AND Status = 'Registered'");
	$cs_count = mysqli_num_rows($cs_sql);

	//count DMIA Students registered
	$dmia_sql = mysqli_query($conn, "SELECT ID FROM students WHERE Course = 'BSDMIA' AND Status = 'Registered'");
	$dmia_count = mysqli_num_rows($dmia_sql);

	//count IS Students registered
	$is_sql = mysqli_query($conn, "SELECT ID FROM students WHERE Course = 'BSIS' AND Status = 'Registered'");
	$is_count = mysqli_num_rows($is_sql);
	
	//count LIS Students registered
	$lis_sql = mysqli_query($conn, "SELECT ID FROM students WHERE Course = 'BLIS' AND Status = 'Registered'");
	$lis_count = mysqli_num_rows($lis_sql);


	//count all unregistered students based on there own course
	//count IT Students Unregistered
	$it_sql_unreg = mysqli_query($conn, "SELECT ID FROM students WHERE Course = 'BSIT' AND Status = 'Unregistered'");
	$it_count_unreg = mysqli_num_rows($it_sql_unreg);

	//count CS Students Unregistered
	$cs_sql_unreg = mysqli_query($conn, "SELECT ID FROM students WHERE Course = 'BSCS' AND Status = 'Unregistered'");
	$cs_count_unreg = mysqli_num_rows($cs_sql_unreg);

	//count DMIA Students Unregistered
	$dmia_sql_unreg = mysqli_query($conn, "SELECT ID FROM students WHERE Course = 'BSDMIA' AND Status = 'Unregistered'");
	$dmia_count_unreg = mysqli_num_rows($dmia_sql_unreg);


	//count IS Students Unregistered
	$is_sql_unreg = mysqli_query($conn, "SELECT ID FROM students WHERE Course = 'BSIS' AND Status = 'Unegistered'");
	$is_count_unreg = mysqli_num_rows($is_sql_unreg);
	
	//count LIS Students Unregistered
	$lis_sql_unreg = mysqli_query($conn, "SELECT ID FROM students WHERE Course = 'BLIS' AND Status = 'Unregistered'");
	$lis_count_unreg = mysqli_num_rows($lis_sql_unreg);

	//count all students Logout
	$logout_sql = mysqli_query($conn, "SELECT ID FROM students WHERE Status = 'Logout'");
	$logout_count = mysqli_num_rows($logout_sql);

?>