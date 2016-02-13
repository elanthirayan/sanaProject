<!DOCTYPE html>
<?php 
session_start();
$product_id=$_GET['pid'];
$link = mysqli_connect('localhost:3306', 'root', '', 'project');
if (!$link) {
	echo 'Could not connect to mysql';
}
$sql    = "select product_id,product_name,product_short_desc,product_full_desc,image_url,dp_imageUrl,video_url,category_id from tbl_product where product_id='".$product_id."'";
$result = mysqli_query($link, $sql);
while($row = mysqli_fetch_assoc($result)) {
	$product_name=$row['product_name'];
	$product_full_desc=$row['product_full_desc'];
	$image_url=$row['image_url'];
	$dp_imageUrl=$row['dp_imageUrl'];
	$video_url=$row['video_url'];
}
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		
		<title>Category Detail Page</title>

		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<!--font awesome file-->
		<link rel="stylesheet" href="css/font-awesome.css" type="text/css" >
		
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
			<div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
				<ul class="nav navbar-nav">
					<?php 
						$sql    = "select category_id,category_name from tbl_categories";
						$result = mysqli_query($link, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo '<li><a href="category_page.php?cid='.$row['category_id'].'">'.$row['category_name'].'</a></li>';
						}
					?>
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
			</div><!--/.nav-collapse -->
		</div>
    </nav>

    <div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">	
				<div class="category-name"><?php echo $product_name; ?></div>
				<hr class="br-grey mt-5"></hr>
			</div>
			<div class="col-md-5 col-sm-6 col-xs-12">
				<?php 
					if(isset($dp_imageUrl)){
						?>
						<img src="images/<?php echo $dp_imageUrl; ?>" class="product-img mb-10" style="height:auto" />
					<?php
					}else{
				?>
				
				<video class="mb-10" style="width:100%; height:auto;" controls>
					<source src="<?php echo "video/".$video_url;?>" type="video/mp4">
					Your browser does not support the video tag.
				</video>
				<?php 
					}
				?>
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12">	
						<a href="thank_you.php" class="mt-10 mb-10 detail-btn">Buy <i class="fa fa-shopping-cart"></i></a>
					</div>
				</div>
			<!--	https://www.youtube.com/watch?v=dwH34mR6ZG8		-->
			</div>
			<div class="col-md-7 col-sm-6 col-xs-12">
				<div class="text-head">
						<?php echo $product_full_desc;?>
				</div>
			</div>
		</div>
      
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  

	</body>
</html>