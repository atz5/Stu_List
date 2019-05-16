<?php session_start(); ?>
<?php 
if (!isset($_SESSION['valid'])) {
	header("location:home");
}
 ?>
 <?php 
require '../query.php';
$query=new query();
$id=$_GET['id'];
$result=$query->admin_delete($id,"login");
header("location:home");

  ?>