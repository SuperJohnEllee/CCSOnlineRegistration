<!DOCTYPE html>
<?php
	include('database/connection.php');
	include('function.php');

    session_start();
    $name = htmlspecialchars($_SESSION['name']);

    if (!isset($_SESSION['name'])) {
        header("location: index.php");
    }

    addStudents();


?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="CCS Online Registration">
	<title>CCS Online Registration</title>
	<link rel="icon" href="logo/CCSLogo.png">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/mdb.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="teal lighten-4">
	 <nav class="navbar navbar-expand-lg navbar-light fixed-top mdb-color darken-4">
        <a class="navbar-brand" href="#"><img src="logo/CCSLogo.png" height="30" width="30"></a>
        <button class="navbar-toggler teal darken-2" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" ara-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggler-icon text-white"></span>
        </button>
        <div class="navbar-collapse collpase" id="navbar">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php"><span class="fa fa-home"></span> Home<span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="logout.php"><span class="fa fa-sign-out"></span> Logout</a>
                </li>
            </ul>
        </div>
    </nav><br><br><br>
<div class="container">
	<div class="page-header">
		<h1 class="text-center">College of Computer Studies Online Registration System<br>
        <span style="font-size: 15px;">Develop by Ellee Solutions &copy; 2018. All Rights Reserved</span></h1><br>
        <h3>Welcome, <?php echo htmlspecialchars($name); ?></h3><br>
		<h5>Number of 4th Year Students Enrolled: <?php echo htmlspecialchars($count); ?><span class="pull-right">IT Students: <?php echo htmlspecialchars($it_count); ?> out of <?php echo htmlspecialchars($count_it); ?></span><br>Students Registered: <?php echo htmlspecialchars($reg_count); ?><span class="pull-right">CS Students: <?php echo htmlspecialchars($cs_count); ?> out of <?php echo htmlspecialchars($count_cs); ?></span> <br>Students Not Registered: <?php echo htmlspecialchars($unreg_count); ?>
		<span class="pull-right">DMIA Students: <?php echo htmlspecialchars($dmia_count); ?> out of <?php echo htmlspecialchars($count_dmia); ?></span> <br><span class="pull-right">IS Students: <?php echo htmlspecialchars($is_count); ?> out of <?php echo htmlspecialchars($count_is); ?></span>Students Logout: <?php echo htmlspecialchars($logout_count); ?>  
		<br><span class="pull-right">LIS Students: <?php echo htmlspecialchars($lis_count); ?> out of <?php echo htmlspecialchars($count_lis); ?> </span><br>
		</h5>
    </div>
		<hr class="divider">
		<form class="ml-4" action="import.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <input class="form-control col-lg-3" type="file" name="file">
                    <button class="btn btn-primary" type="submit" name="btn_import"><span class="fa fa-cloud-upload"></span> Import</button>
                    <button class="btn btn-dark" type="submit" name="export"><span class="fa fa-cloud-download"></span> Export</button>
					<button class="btn btn-success" type="submit" onclick="return confirm('Unregistered all students?');" name="unreg_all">Unregistered All Students</button>
                </div>
        </form><br>
        <ul class="nav nav-tabs mdb-color darken-4 md-tabs nav-justified">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#login_students"><span class="fa fa-users"></span> View Students</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#logout_students" role="tab"><span class="fa fa-sign-in"></span> Login Students</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#logout" role="tab"><span class="fa fa-sign-out"></span> Logout Students</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#add_students" role="tab"><span class="fa fa-user-plus"></span> Add Students</a>
            </li>
        </ul><br><br>
        <p>Sarch for Name or Press CTRL+F</p>
		<div class="form-group">
			<div class="input-group col-lg-10">
				<input class="form-control" type="text" name="search" id="stud_search" onkeyup="filterSearch()">
				<button type="submit" class="btn btn-primary" name="btn_search"><span class="fa fa-search"></span> Search</button>
			</div>
		</div>
		<!--<a class="btn btn-info" href="registered_students.php"><span class="fa fa-users"></span> Registered Students</a>
		<a class="btn btn-primary" data-toggle="modal" data-target="#addModal" href=""><span class="fa fa-plus" role="button" aria-expanded="false" aria-controls="collapse"></span> Add Students</a> -->
	<div class="tab-content card">
        <div class="tab-pane fade in show active" id="login_students" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-hover" id="stud_table">
                    <thead class="thead-inverse">
                        <tr>
                            <th>ID Number</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Year</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th colspan="3" class="text-center">Action</th>
                        </tr>
                    </thead>
            <tbody>
                <?php
                    displayStudents();
                ?>
            </tbody>
        </table>
    </div>
        </div>
        <div class="tab-pane fade" id="add_students">
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="row">   
                        <div class="form-group col-md-6">
                            <label for="idnum" class="cols-sm-2 control-label">ID Number</label>
                            <div class="cols-sm-10">
                                    <input type="text" class="form-control" name="idnum" id="idnum" placeholder="ID Number" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastname" class="cols-sm-2 control-label">Name</label>
                            <div class="cols-sm-10">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="course" class="cols-sm-2 control-label">Course</label>
                            <div class="cols-sm-10">
                                    <input type="text" class="form-control" name="course" id="course" placeholder="Course" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="year" class="cols-sm-2 control-label">Year</label>
                            <div class="cols-sm-10">
                                <input class="form-control" type="text" name="year" id="year" placeholder="Year">
                            </div>
                        </div>
                        <div class="form-group mx-auto col-md-6">
                            <button class="btn btn-success btn-lg col-md-10"  name="add_student" id="add_students">Add Students</button>
                        </div>
                    </div>
            </form>
    </div>
    <div class="tab-pane fade" id="logout_students" role="tabpanel">
        <div class="table-responsive">
                <table class="table table-hover" id="stud_table">
                    <thead class="thead-inverse">
                        <tr>
                            <th>ID Number</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Year</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th colspan="3" class="text-center">Action</th>
                        </tr>
                    </thead>
            <tbody>
                <?php
                    loginStudents(); 
                ?>
            </tbody>
        </table>
    </div>
    </div>
    <div class="tab-pane fade" id="logout" role="tabpanel">
        <div class="table-responsive">
                <table class="table table-hover" id="stud_table">
                    <thead class="thead-inverse">
                        <tr>
                            <th>ID Number</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Year</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
            <tbody>
                <?php
                    logoutStudents();    
                ?>
            </tbody>
        </table>
    </div>
    </div>
    </div>
</div>

	<!--<div style="padding:  15px 0;" class="mdb-color darken-4 text-white text-center">
		<h5 class="col-lg-12">Develop by Ellee Solutions &copy; 2018. All Rights Reserved</h5>
	</div> -->
<script>
function filterSearch() {
  	var input, filter, table, tr, td, i, j;
  	input = document.getElementById("stud_search");
  	filter = input.value.toUpperCase();
  	table = document.getElementById("stud_table");
  	tr = table.getElementsByTagName("tr");

  	for (i = 0; i < tr.length; i++) {
    		td = tr[i].getElementsByTagName("td")[1]; //Name
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