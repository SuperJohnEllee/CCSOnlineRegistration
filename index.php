<!DOCTYPE html>
<?php
	include('database/connection.php');
	include('function.php');

	login();
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
<body class="cyan lighten-5">
	<div class="container py-5 mt-5">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-6 mx-auto">
						<div class="card rounded-0 cyan darken-5">
							<div class="card-body">
								<form class="form" method="post" role="form" autocomplete="off" id="formLogin">
									<div class="md-form">
                                        <i class="fa fa-lock prefix text-white"></i>
										<input class="form-control form-control-lg rounded-0" type="password" name="password" id="admin_pass" required autocomplete="new-password">
                                        <label class="text-white" for="password">Password</label>
									</div>
									<button class="btn btn-success btn-lg float-right" type="submit" name="login" id="btnLogin"><i class="fa fa-sign-in"></i> Login
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<script src="js/jquery.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/mdb.min.js"></script>
</body>
</html>