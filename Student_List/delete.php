<?php session_start(); ?>
<?php 
if (!isset($_SESSION['auth'])) {
	header("location:user-login");
}
 ?>
<?php 
define('query',TRUE);
require 'query.php';
$query=new query();
$data=$query->getdata("SELECT * FROM login WHERE id=\"$_SESSION[id]\" ");
 	if (count($data)==0) {
		echo "<script type='text/javascript'>alert('Login Again!!!');window.location='logout'</script>";
 	}
$id=$_GET['id'];
$result=$query->delete($id,"student");
header("location:dashboard");

 ?>