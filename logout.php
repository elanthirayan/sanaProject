<!DOCTYPE html>
<?php
	session_start();
	$_SESSION['userLogin'] = '';
	header('Location: login.php');
?>