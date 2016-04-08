<!DOCTYPE html>
<?php
	include("db.php");
	session_start();
	if($_SESSION['userLogin'] != 'LoggedIn'){
		header('Location: login.php');
	}
	if(isset($_POST['add_product'])){
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		  $product_name = $_POST["product_name"];
		  $short_description = $_POST["short_description"];
		  $category = $_POST["category"];
		  $full_description = $_POST["full_description"];
		  $full_description=str_replace("'","\\'",str_replace("\\","\\\\",($full_description)));
		  $short_description=str_replace("'","\\'",str_replace("\\","\\\\",($short_description)));
		  $imageUrl = '';
		  $videoUrl = '';
		  $dp_imageUrl = '';
		  if(isset($_FILES['image'])){
			   $errors= array();
			  $file_name = $_FILES['image']['name'];
			  $file_size =$_FILES['image']['size'];
			  $file_tmp =$_FILES['image']['tmp_name'];
			  $file_type=$_FILES['image']['type'];
			  $img_name = explode('.',$_FILES['image']['name']);
			  $file_ext=strtolower(end($img_name));
			  $expensions= array("jpeg","jpg","png");
			  
			  if(in_array($file_ext,$expensions)=== false){
				 $errors[]="extension not allowed, please choose a JPEG or PNG file.";
			  }
			  
			  if($file_size > 20097152){
				 $errors[]='File size must be excately 2 MB';
			  }
			  if(empty($errors)==true){
				 move_uploaded_file($file_tmp,"images/".$file_name);
				 $imageUrl = $file_name;
			  }else{
				  echo "Image Not Uploaded";
			  }
		  }
		  if(isset($_FILES['dp_image'])){
			   $errors= array();
			  $file_name = $_FILES['dp_image']['name'];
			  $file_size =$_FILES['dp_image']['size'];
			  $file_tmp =$_FILES['dp_image']['tmp_name'];
			  $file_type=$_FILES['dp_image']['type'];
			  $img_name = explode('.',$_FILES['dp_image']['name']);
			  $file_ext=strtolower(end($img_name));
			  $expensions= array("jpeg","jpg","png");
			  
			  if(in_array($file_ext,$expensions)=== false){
				 $errors[]="extension not allowed, please choose a JPEG or PNG file.";
			  }
			  
			  if($file_size > 20097152){
				 $errors[]='File size must be excately 20 MB';
			  }
			  if(empty($errors)==true){
				 move_uploaded_file($file_tmp,"images/".$file_name);
				 $dp_imageUrl = $file_name;
			  }else{
				  echo "Detail Image Not Uploaded";
			  }
		  }
		  if(isset($_FILES['video'])){
			   $errors= array();
			  $file_name = $_FILES['video']['name'];
			  $file_size =$_FILES['video']['size'];
			  $file_tmp =$_FILES['video']['tmp_name'];
			  $file_type=$_FILES['video']['type'];
			  $img_name = explode('.',$_FILES['video']['name']);
			  $file_ext=strtolower(end($img_name));
			  $extensions= array("mp4","mpeg","3gp");
			  
			  if(in_array($file_ext,$extensions)=== false){
				 $errors[]="extension not allowed, please choose a mp4 or 3gp file.";
			  }
			  
			  if($file_size > 20097152){
				 $errors[]='File size must be excately 2 MB';
			  }
			  if(empty($errors)==true){
				 move_uploaded_file($file_tmp,"video/".$file_name);
				 $videoUrl = $file_name;
			  }else{
				  echo "Video Not Uploaded";
			  }
		  }
			$sql    = "insert into tbl_product(product_id,product_name,product_short_desc,product_full_desc,image_url,dp_imageUrl,video_url,category_id) values(uuid(),'".$product_name."','".$short_description."','".$full_description."','".$imageUrl."','".$dp_imageUrl."','".$videoUrl."','".$category."');";
			$result = mysqli_query($link,$sql);

			if (!$result) {
				echo "DB Error, could not query the database\n";
				echo 'MySQL Error: ' . mysqli_error();
			}else{
				echo "<script>alert('Added Successfully');</script>";
				header('Refresh: 10; Location: '.$_SERVER['PHP_SELF']);
			}
		}
	}

?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Product</title>
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
					<li><a href="add_category.php">Add Category</a></li>
					<li class="active"><a href="javascript:void(0)">Add Product</a></li>	
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
					<div class="form-group" id="title_parameters_name">
						<label for="parameters" class="col-md-3 col-sm-4 control-label">
							Category<span class="form-man">*</span>
						</label>
						<div class="col-md-6 col-sm-7">
							<select style="width:100%;" name="category" required>
							<?php 
							
								$sql    = "select category_id,category_name from tbl_categories;";
								$result = mysqli_query($link,$sql);
								while($row = mysqli_fetch_assoc($result)) {
									echo "<option value='".$row['category_id']."'>".$row['category_name']."</option>";
								}
								mysqli_close();
							?>
								
							</select>
						</div>
					</div>
					<div class="form-group" id="title_email_template_name">
						<label for="email_template" class="col-md-3 col-sm-4 control-label">
							Product Name<span class="form-man">*</span>
						</label>
						<div class="col-md-6 col-sm-7">
							<input type="text" class="form-control entity-form" name="product_name" required/>
						</div>
					</div>
					<div class="form-group" id="title_email_body_name">
						<label for="email_body" class="col-md-3 col-sm-4 control-label">
							Short Description <span class="form-man">*</span>
						</label>
						<div class="col-md-6 col-sm-7">
							<textarea type="text" rows="5" class="form-control entity-form" name="short_description" id="short_description" required></textarea>
							<div class="text-danger" id="email_body_error"></div>
						</div>
					</div>
					<div class="form-group" id="title_email_body_name">
						<label for="email_body" class="col-md-3 col-sm-4 control-label">
							Detail Description <span class="form-man">*</span>
						</label>
						<div class="col-md-6 col-sm-7">
							<textarea type="text" rows="5" class="form-control entity-form" name="full_description" id="full_description" required></textarea>
							<div class="text-danger" id="email_body_error"></div>
						</div>
					</div>
					<div class="form-group" id="title_parameters_name">
						<label for="parameters" class="col-md-3 col-sm-4 control-label">
							Cover Image<span class="form-man">*</span>
						</label>
						<div class="col-md-6 col-sm-7">
							<input type="file" class="form-control entity-form" name="image" id="image" required/>
						</div>
					</div>
					<div class="form-group" id="title_parameters_name">
						<label for="parameters" class="col-md-3 col-sm-4 control-label">
							Detail Page Image<span class="form-man">*</span>
						</label>
						<div class="col-md-6 col-sm-7">
							<input type="file" class="form-control entity-form" name="dp_image" id="dp_image"/>
						</div>
					</div>
					<div class="form-group" id="title_parameters_name">
						<label for="parameters" class="col-md-3 col-sm-4 control-label">
							Video File<span class="form-man">*</span>
						</label>
						<div class="col-md-6 col-sm-7">
							<input type="file" class="form-control entity-form" name="video" id="video"/>
						</div>
					</div>
					<div class="form-group" id="title_parameters_name">
						<label for="parameters" class="col-md-6 col-sm-7 control-label">
						
						</label>
						<div class="col-md-3 col-sm-4">
							<input type="submit" class="form-control entity-form btn btn-submit" name="add_product" value="Add Product"/>
						</div>
					</div>
					
				</form>
			</div>
		</div>
	</div>
	
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
</body>
</html>
