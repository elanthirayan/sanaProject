<!DOCTYPE html>
<?php
include("db.php");
	session_start();
	if($_SESSION['userLogin'] != 'LoggedIn'){
		header('Location: login.php');
	}
	if(isset($_POST['add_category'])){
			 $categoryName = "";

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
			  $categoryName = $_POST["category_name"];
			  $category_description = $_POST["category_description"];
			  $category_description=str_replace("'","\\'",str_replace("\\","\\\\",($category_description)));
			}
			$i=0;
			$sql    = "insert into tbl_categories(category_id,category_name,description) values(uuid(),'".$categoryName."','".$category_description."');";
			$result = mysqli_query($link,$sql);

			if (!$result) {
				echo "DB Error, could not query the database\n";
				echo 'MySQL Error: ' . mysqli_error();
			}else{
				$i=1;
				echo "<script>alert('Added Successfully');</script>";
				header('Refresh: 10; Location: '.$_SERVER['PHP_SELF']);
			}
	}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Category</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/font-awesome.css" />
	<style>
		.btn{background-color: #0A2B3D;color:#fff;}
		.navbar-fixed-top { position: relative;}
	</style>
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
				<a class="navbar-brand" href="index.php">SANA COLLEGE</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
				<ul class="nav navbar-nav">
					<li class="active"><a href="javascript:void(0)">Add Category</a></li>
					<li><a href="add_product.php">Add Product</a></li>	
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="">
					<?php 
						if($_SESSION['userLogin'] == 'LoggedIn'){ ?>
							<a href="logout.php">Logout <span class="sr-only">(current)</span></a></li>
						<?php }else{
						?>
						<a href="login.php">Login <span class="sr-only">(current)</span></a></li>
					<?php 
						}
					?>
				</ul>
			</div>
		</div>
    </nav> 
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="clearfix"></div>
				<form class="form-horizontal" action="" enctype="multipart/form-data" role="form"  method="POST">
					<input type="hidden" value="0" name="submit_type" id="submit_type"/>
					<small class="pull-right">Fields marked with <span class="form-man">*</span> are mandatory</small><br/>
					<div class="form-group" id="title_email_template_name">
						<label for="email_template" class="col-md-2 col-sm-3 control-label">
							Category Name<span class="form-man">*</span>
						</label>
						<div class="col-md-6 col-sm-6">
							<input type="text" class="form-control entity-form" name="category_name" required/>
						</div>
					</div>
					<div class="form-group" id="title_email_template_name">
						<label for="email_template" class="col-md-2 col-sm-3 control-label">
							Category Description<span class="form-man">*</span>
						</label>
						<div class="col-md-6 col-sm-6">
							<textarea class="form-control entity-form" name="category_description" required></textarea>
						</div>
					</div>
					<div class="form-group" id="title_parameters_name">
						<label for="parameters" class="col-md-5 col-sm-5 control-label">
						
						</label>
						<div class="col-md-3 col-sm-4">
							<input type="submit" class="form-control entity-form btn btn-submit" name="add_category" value="Add Category"/>
						</div>
					</div>
					
				</form>
			</div>
		</div>
	</div>
					
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
