<?php
	/*
		Export students
	*/
	include ('database/connection.php');

	$output = '';
	if (isset($_POST['export'])) {

		$sql = "SELECT *  FROM students WHERE Status = 'Registered' ORDER BY ID ASC";
		$res = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($res);
		if ($count > 0) {
				
			$output .= '<table class="table table-border">
						<tr>
							<th>ID</th>
							<th>ID Number</th>
							<th>Name</th>
							<th>Course</th>
							<th>Year</th>
							<th>Status</th>
							<th>Date</th>
						</tr>';
						while ($row = mysqli_fetch_array($res)) {
							
							$output .= '
							<tr>
								<td>'.htmlspecialchars($row['ID']).'</td>
								<td>'.htmlspecialchars($row['IDNumber']).'</td>
								<td>'.htmlspecialchars($row['Name']).'</td>
								<td>'.htmlspecialchars($row['Course']).'</td>
								<td>'.htmlspecialchars($row['Year']).'</td>
								<td>'.htmlspecialchars($row['Status']).'</td>
								<td>'.htmlspecialchars($row['Date']).'</td>
							</tr>';
						}

						$output .= '</table>';
						header("Content-Type: application/xls");
						header("Content-Disposition: attachment; filename=registered_students.xls");
						echo $output;
			}
		}
?>