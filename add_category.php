<!DOCTYPE html>
<?php
	session_start();
	if($_SESSION['userLogin'] != 'LoggedIn'){
		header('Location: login.php');
	}
	if(isset($_POST['add_category'])){
			 $categoryName = "";

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
			  $categoryName = $_POST["category_name"];
			}
			$i=0;
			if (!$link = mysqli_connect('localhost:3306', 'root', '','project')) {
				echo 'Could not connect to mysql';
			}
			$sql    = "insert into tbl_categories(category_id,category_name) values(uuid(),'".$categoryName."');";
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
	<title>Add Category</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="css/bootstrap.css" />
	<link rel="stylesheet" href="css/font-awesome.css" />
	<style>
		.body-container{margin-top:0px !important;}
		.btn{background-color: #0A2B3D;color:#fff;}
	</style>
</head>
<body>
	 <section>
        <!-- body content start-->
        <div class="body-content" >
			<div class="body-container">
                	<h1 class="page-title">Add Category<span class="pull-right"><a href="logout.php">Logout</a></span></h1>
					<hr ></hr>
                	<div class="clearfix"></div>
                	<div class="row">
						<div class="row">
							<div class="col-md-12">
							<div class="clearfix"></div>
							<form class="form-horizontal" action="" enctype="multipart/form-data" role="form"  method="POST">
								<input type="hidden" value="0" name="submit_type" id="submit_type"/>
								<small class="pull-right">Fields marked with <span class="form-man">*</span> are mandatory</small><br/>
								<div class="form-group" id="title_email_template_name">
									<label for="email_template" class="col-md-2 control-label">
										Category Name<span class="form-man">*</span>
									</label>
									<div class="col-md-8">
										<input type="text" class="form-control entity-form" name="category_name" required/>
									</div>
								</div>
								<div class="form-group" id="title_parameters_name">
									<label for="parameters" class="col-md-2 control-label">
									
									</label>
									<div class="col-md-8">
										<input type="submit" class="form-control entity-form btn btn-submit" name="add_category" value="Add Category"/>
									</div>
								</div>
								
							</form>
                		</div>
						</div>
					</div>
					
                </div><!-- col end -->
                </div><!-- row end -->
        </div>
        <!-- body content end-->
    </section>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
</body>
</html>
