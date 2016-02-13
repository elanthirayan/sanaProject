<!DOCTYPE html>
<?php
	session_start();
	if(isset($_SESSION['userLogin'])){
		if($_SESSION['userLogin'] == 'LoggedIn'){
			header('Location: add_category.php');
		}
	}
	if(isset($_POST['sign_in'])){
		$i=0;
		$username=$_POST['username'];
		$password=$_POST['password'];
		$link = mysqli_connect('localhost:3306', 'root', '', 'project');
		if (!$link) {
			echo 'Could not connect to mysql';
		}
		$sql    = "select id,username,password from tbl_login";
		$result = mysqli_query($link, $sql);
		while($row = mysqli_fetch_assoc($result)) {
			if($row['username']==$username && $row['password']==$password){
				$i=1;
				$_SESSION['userLogin'] = "LoggedIn";
				header('Location: add_category.php');
			}
		}
		if($i==0){
			echo "authentication failed";
		}
	}
?>
<html>
<head>
	<title>News Login</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/font-awesome.css" />
</head>
<body>
	<!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php"><img src="http://www.skilladda.com/assets/images/skilladda_logo180.png" style="width:110px;" /></a>
			</div>
			
		</div>
    </nav>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
			</div>
			<div class="col-md-4">
				<form class="form-horizontal" action="" method="POST" action="#" role="login" id="login_form">
						<div class="pd-10 text-center"><h2>Login</h2></div>
						<center><h2></h2><div class="text-danger pl-50" id="login_error"></div></center>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon" style="border-radius:0;"><i class="fa fa-user"></i></div>
								<input type="text" class="form-control" id="username" name="username" placeholder="Email" required>
							</div>
							<div class="text-danger pl-50" id="username_error"></div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon" style="border-radius:0;"><i class="fa fa-key"></i></div>
								<input type="password" class="form-control entity-form" name="password" id="password" placeholder="Password" required/>
							</div>
							<div class="text-danger pl-50" id="password_error"></div>
						</div>
						<div class="form-group">
							<input type="submit" name="sign_in" style="background-color:#32A7B3 !important;" class="btn btn-lg bg_dark_purple btn-launch" id="sign_in" value="Login">
						</div>
						<!--<div class="form-group">
							<a href="javascript:void(0);" id="show_forgot_password">Forgot Password ?</a> Click here to reset password
						</div>-->
				</form>
			</div>
			<div class="col-md-4">
			</div>
		</div>
	</div>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
</body>
</html>
