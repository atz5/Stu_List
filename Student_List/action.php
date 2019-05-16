<?php session_start(); ?>
	<?php 
	if (isset($_SESSION['auth'])) {
		header("location:home");
	}else{
		if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
		{
	define('query',TRUE);
	require 'query.php';
	$query=new query();

		$user=$query->escape_string($_POST['username']);
		$pass=$query->escape_string($_POST['password']);
		$enpass=base64_encode($pass);

		$result=$query->auth("SELECT * FROM login WHERE username='$user' AND password='$enpass' ");

	}else{
		header("location:user-login");
	}
}
	 ?>
	 
	

