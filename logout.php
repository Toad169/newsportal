<?php 

	session_start();
	
	// Destroy frontend session
	unset($_SESSION['frontend_user_id']);
	unset($_SESSION['frontend_username']);
	unset($_SESSION['frontend_nama']);
	unset($_SESSION['frontend_email']);
	
	session_destroy();
	
	header("location: index.php?page=beranda");

 ?>
