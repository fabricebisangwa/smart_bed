<?php 
session_start();
	session_destroy();
	if ($_SESSION['names']) {
	header("location: ../home_login.php");
}
 ?>