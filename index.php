<!DOCTYPE html>
<?php 
	session_start();
	$category_id='';
	$cid=0;
	if(isset($_GET['cid'])){
		$category_id=$_GET['cid'];
		$cid=1;
	}
	$link = mysqli_connect('localhost:3306', 'root', '', 'project');
	if (!$link) {
		echo 'Could not connect to mysql';
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
		<title>Category Page</title>

		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<!--font awesome file-->
		<link rel="stylesheet" href="css/font-awesome.css" type="text/css" >
	
</head>
<body id="textBody" >
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
					<li class="active"><a href="index.php">Home</a></li>
				<?php 
						$sql    = "select category_id,category_name from tbl_categories";
						$result = mysqli_query($link, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							$ac='';
							
							if($category_id==$row['category_id']){
								$ac='active';
							}
							echo '<li class="'.$ac.'"><a href="category_page.php?cid='.$row['category_id'].'">'.$row['category_name'].'</a></li>';
						}
					?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="">
					<?php 
						if(isset($_SESSION['userLogin'])){
							if($_SESSION['userLogin'] == 'LoggedIn'){ ?>
								<a href="logout.php">Logout <span class="sr-only">(current)</span></a></li>
							<?php }else{
							?>
							<a href="login.php">Login <span class="sr-only">(current)</span></a></li>
						<?php 
							}
						}else{ ?>
								<a href="login.php">Login <span class="sr-only">(current)</span></a></li>
						<?php 
						}
					?>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
    </nav>
	<header class="intro-header" style="margin-top:-20px; background-image: url('http://blackrockdigital.github.io/startbootstrap-clean-blog/img/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Holiday Destination</h1>
                        <hr class="small">
                        <span class="subheading">Book Domestic & International Holiday packages</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
	<div class="container">
		<div class="row">
			<center>
				<div class="box">
					<hr>
					<h2 class="text-center">Make Your  
						<strong>Holiday Awesome!!!</strong>
					</h2>
					<hr>
				</div>
			</center>		
			<div class="col-md-12">
				<div class="text-head">Create a personalised plan for your next holiday.</div>
			</div> 
			<div class="col-md-12">
				<div class="text-head">A huge thanks to Skilladda for allowing us to use the beautiful photos that make this template really come to life. When using this template, make sure your photos are decent. Also make sure that the file size on your photos is kept to a minumum to keep load times to a minimum.</div>
			</div> 
			<div class="col-md-12 mb-50"> 
				<div class="text-head">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc placerat diam quis nisl vestibulum dignissim. In hac habitasse platea dictumst. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</div>
			</div>
		</div>			
	</div>	
	<?php 
			$i=0;
			$sql    = "select category_id,category_name,description from tbl_categories limit 0,4";
			$result = mysqli_query($link, $sql);
			while($row = mysqli_fetch_assoc($result)) {
				if($i==0){
					$i=1;
					$bgC='background-color:#000;';
					$nm='txt_white';
					
				}else{
					$i=0;
					$bgC='';
					$nm='';
				}
				?>
				<header class="intro-header" style="<?php echo $bgC;?>">
					<div class="container">
						<div class="row">
							<center style="padding-top:15px;">
								<div class="box">
									<h2 class="text-center"><strong class="<?php echo $nm; ?>"><?php echo $row['category_name']; ?></strong>
									</h2>
									<h5 class="text-center"><span class="<?php echo $nm; ?>"><?php echo $row['description']; ?></span>
									</h5>
								</div>
							</center>		
							<center>
								<div class="box-btn">
									<a href="<?php echo 'category_page.php?cid='.$row['category_id'];?>" class="detail-btn">Know More <i class="fa fa-arrow-right"></i></a>
								</div> 
							</center>
						</div>
					</div>
				</header>
			<?php
			}
		?>
	
	<!--<header class="intro-header" style="background-color:#fff;">
        <div class="container">
            <div class="row">
				<center style="padding-top:15px;">
					<div class="box">
						<h2 class="text-center"><strong>Times of India</strong>
						</h2>
						<h5 class="text-center"><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc placerat diam quis nisl vestibulum dignissim. In hac habitasse platea dictumst. Interdum et malesuada fames ac ante ipsum primis in faucibus.</span>
						</h5>
					</div>
				</center>		
				<center>
					<div class="box-btn">
						<a href="" class="detail-btn">Know More <i class="fa fa-arrow-right"></i></a>
					</div> 
				</center>
			</div>
        </div>
    </header> 
	<header class="intro-header" style="background-color:#000;">
        <div class="container">
            <div class="row">
				<center style="padding-top:15px;">
					<div class="box">
						<h2 class="text-center"><strong class="txt_white">Hills</strong>
						</h2>
						<h5 class="text-center"><span class="txt_white">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc placerat diam quis nisl vestibulum dignissim. In hac habitasse platea dictumst. Interdum et malesuada fames ac ante ipsum primis in faucibus.</span>
						</h5>
					</div>
				</center>		
				<center>
					<div class="box-btn">
						<a href="" class="detail-btn">Know More <i class="fa fa-arrow-right"></i></a>
					</div> 
				</center>
			</div>
        </div>
    </header>
	<header class="intro-header" style="background-color:#fff;">
        <div class="container">
            <div class="row">
				<center style="padding-top:15px;">
					<div class="box">
						<h2 class="text-center"><strong>Times of India</strong>
						</h2>
						<h5 class="text-center"><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc placerat diam quis nisl vestibulum dignissim. In hac habitasse platea dictumst. Interdum et malesuada fames ac ante ipsum primis in faucibus.</span>
						</h5>
					</div>
				</center>		
				<center>
					<div class="box-btn">
						<a href="" class="detail-btn">Know More <i class="fa fa-arrow-right"></i></a>
					</div> 
				</center>
			</div>
        </div>
    </header> -->
</body>
</html>
