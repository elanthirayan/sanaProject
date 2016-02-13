<!DOCTYPE html>
<?php
	session_start();
?>
<html>
<head>
	<title>News Feeder</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="css/bootstrap.css" />
	<link rel="stylesheet" href="css/font-awesome.css" />
</head>
<body>
	<div class="row">
		<div class="col-md-4">
		</div>
		<div class="col-md-4">
			<form class="form-horizontal" action="" method="POST" action="#" role="login" id="login_form">
					<div class="pd-10 text-center"><h2>News Feed</h2></div>
			</form>
		</div>
		<div class="col-md-4">
		</div>
	</div>
	<div class="row">
		<?php 
			if (!$link = mysqli_connect('us-cdbr-iron-east-03.cleardb.net:3306', 'be5f730e58f54c', '67f3f3ca','ad_0789913ab89fe55')) {
				echo 'Could not connect to mysql';
			}
			$sql    = "select id,headline,description,imagelink from tbl_news order by dateTime desc;";
			$result = mysqli_query($link,$sql);
			while($row = mysqli_fetch_assoc($result)) {
				?><div class='col-md-4 row-border'>
						<img class="img-responsive" src='images/<?php echo $row['imagelink'];?>'/><br>
						<h2><?php echo $row['headline'];?><h2><br>
						<p><?php echo $row['description'];?></p><br>
					</div>
			<?php
				}
		?>
	</div>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
</body>
</html>
