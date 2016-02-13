<!DOCTYPE html>
<?php
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
		  if (!$link = mysqli_connect('localhost:3306', 'root', '','project')) {
				echo 'Could not connect to mysql';
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
	<title>Add Product</title>
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
                	<h1 class="page-title">Add Product<span class="pull-right"><a href="logout.php">Logout</a></span></h1>
					<hr class="hr-grey-title"></hr>
                	<div class="clearfix"></div>
                	<div class="row">
						<div class="row">
							<div class="col-md-12">
							<div class="clearfix"></div>
							<form class="form-horizontal" action="" enctype="multipart/form-data" role="form"  method="POST">
								<input type="hidden" value="0" name="submit_type" id="submit_type"/>
								<small class="pull-right">Fields marked with <span class="form-man">*</span> are mandatory</small><br/>
								<div class="form-group" id="title_parameters_name">
									<label for="parameters" class="col-md-2 control-label">
										Category<span class="form-man">*</span>
									</label>
									<div class="col-md-8">
										<select style="width:100%;" name="category" required>
										<?php 
										
											if (!$link = mysqli_connect('localhost:3306', 'root', '','project')) {
												echo 'Could not connect to mysql';
											}
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
									<label for="email_template" class="col-md-2 control-label">
										Product Name<span class="form-man">*</span>
									</label>
									<div class="col-md-8">
										<input type="text" class="form-control entity-form" name="product_name" required/>
									</div>
								</div>
								<div class="form-group" id="title_email_body_name">
									<label for="email_body" class="col-md-2 control-label">
										Short Description <span class="form-man">*</span>
									</label>
									<div class="col-md-8">
										<textarea type="text" rows="5" class="form-control entity-form" name="short_description" id="short_description" required></textarea>
										<div class="text-danger" id="email_body_error"></div>
									</div>
								</div>
								<div class="form-group" id="title_email_body_name">
									<label for="email_body" class="col-md-2 control-label">
										Detail Description <span class="form-man">*</span>
									</label>
									<div class="col-md-8">
										<textarea type="text" rows="5" class="form-control entity-form" name="full_description" id="full_description" required></textarea>
										<div class="text-danger" id="email_body_error"></div>
									</div>
								</div>
								<div class="form-group" id="title_parameters_name">
									<label for="parameters" class="col-md-2 control-label">
										Cover Image<span class="form-man">*</span>
									</label>
									<div class="col-md-8">
										<input type="file" class="form-control entity-form" name="image" id="image" required/>
									</div>
								</div>
								<div class="form-group" id="title_parameters_name">
									<label for="parameters" class="col-md-2 control-label">
										Detail Page Image<span class="form-man">*</span>
									</label>
									<div class="col-md-8">
										<input type="file" class="form-control entity-form" name="dp_image" id="dp_image"/>
									</div>
								</div>
								<div class="form-group" id="title_parameters_name">
									<label for="parameters" class="col-md-2 control-label">
										Video File<span class="form-man">*</span>
									</label>
									<div class="col-md-8">
										<input type="file" class="form-control entity-form" name="video" id="video"/>
									</div>
								</div>
								<div class="form-group" id="title_parameters_name">
									<label for="parameters" class="col-md-2 control-label">
									
									</label>
									<div class="col-md-8">
										<input type="submit" class="form-control entity-form btn btn-submit" name="add_product" value="Add Product"/>
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
	<script>
		
		$("#sign_in").click(function(){
			$(".text-danger").html('');
			var error=0;
			var userName =$("#username").val();
			var userPassword =$("#password").val();
			if(userName==''){
				$("#username_error").html("Please enter user name");
				error++;
			}
			if(userPassword==''){
				$("#password_error").html("Please enter password");
				error++;
			}
			if(error==0){
				
			}
		});
	</script>
</body>
</html>
