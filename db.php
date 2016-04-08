<?php
define('DB_SERVER','localhost:3306');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_SCHEMA','project');
$link = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_SCHEMA);
if (!$link) {
	echo 'Could not connect to mysql';
}
 
 ?>