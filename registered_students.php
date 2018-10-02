<!DOCTYPE html>
<?php
	include('database/connection.php');
	include('function.php');
?>
<html>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="CCS Online Registration">
	<title>CCS Online Registration</title>
	<link rel="icon" href="logo/CCSLogo.png">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/mdb.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body class="teal lighten-4">
	<nav class="navbar navbar-expand-lg navbar-light fixed-top mdb-color darken-4">
        <a class="navbar-brand" href="#"><img src="logo/CCSLogo.png" height="30" width="30"></a>
        <button class="navbar-toggler teal darken-2" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" ara-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggler-icon text-white"></span>
        </button>
        <div class="navbar-collapse collpase" id="navbar">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="home.php"><span class="fa fa-home"></span> Home<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav><br><br><br>
<div class="container">
	<div class="page-header">
		<h1 class="text-center">College of Computer Studies</h1>
		<h3>List of Registered CCS Students</h3>
		<h5>Number of Students Enrolled: <?php echo htmlspecialchars($count); ?><br>Students Registered: <?php echo htmlspecialchars($reg_count); ?><br>IT Students: <?php echo htmlspecialchars($it_count); ?><br>CS Students: <?php echo htmlspecialchars($cs_count); ?><br>DMIA Students: <?php echo htmlspecialchars($dmia_count); ?><br>IS Students: <?php echo htmlspecialchars($is_count); ?><br>LIS Students: <?php echo htmlspecialchars($lis_count); ?>
		</h5>
		<hr class="divider">
		<p>Sarch for Name or Press Ctrl + F</p>
		<div class="form-group">
			<div class="input-group col-lg-10">
				<input class="form-control" type="text" name="search" id="stud_search" onkeyup="filterSearch()">
				<button class="btn btn-primary" type="submit" name="btn_search"><span class="fa fa-search"></span> Search</button>
			</div>
		</div>
		<form action="export_students.php" method="post">
			<button type="submit" class="btn btn-primary" name="export" id="export"><span class="fa fa-download"></span> Export</button>
		</form>
	</div>
	<div class="table-responsive" id="students_table">
		<table class="table table-hover">
			<thead class="thead-inverse">
				<tr>
					<th>ID</th>
					<th>ID Number</th>
					<th>Name</th>
					<th>Course</th>
					<th>Year</th>
					<th>Status</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody id="stud_table">
				<?php
					$stud_disp = "SELECT * FROM students WHERE Status = 'Registered' ORDER BY Date ASC";
					$stud_res = mysqli_query($conn, $stud_disp);
					$stud_count = mysqli_num_rows($stud_res);

					if ($stud_count > 0) {
						while ($stud_row = mysqli_fetch_assoc($stud_res)) {
						echo "<tr>
							<td>".htmlspecialchars($stud_row['ID'])."</td>
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
			?>
			</tbody>
		</table>
	</div>
</div>
<script>
function filterSearch() {
  	var input, filter, table, tr, td, i, j;
  	input = document.getElementById("stud_search");
  	filter = input.value.toUpperCase();
  	table = document.getElementById("stud_table");
  	tr = table.getElementsByTagName("tr");

  	for (i = 0; i < tr.length; i++) {
    		td = tr[i].getElementsByTagName("td")[2];
    		if (td) {
      			if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        			tr[i].style.display = "";
      			} else {
        		tr[i].style.display = "none";
      		}
    	}       
  	}
 }
</script>
<script src="js/jquery.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/mdb.min.js"></script>
</body>
</html>