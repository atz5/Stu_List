
<?php session_start(); ?>
<?php 
if (!isset($_SESSION['auth'])) {
	header("location:user-login");
}
 ?>
 <!DOCTYPE html>
<html>
<head>
	<title>Result</title>
	<style type="text/css">
		.border{
			border-spacing: 0;
			border-color: green;
		}
		input{
 			background: black;
 			color: red;
 		}
	</style>
</head>
<body bgcolor="black">
	<font color="green">
<a href="home">Home</a> | <a href="dashboard">View Student List</a> | <a href="logout">Logout</a><br><br>
 	<form action="result" action="GET">
 		<input type="text" name="search" placeholder="Search...">
 		<input type="submit" name="submit" value="Search" hidden="">
 	</form>
 	<table width='80%' border='1' class='border'>
		<tr bgcolor='#CCCCCC' >
			<td>Photo</td>
			<td>Name</td>
			<td>Age</td>
			<td>Phone</td>
			<td>Update</td>
		</tr>

<?php
define('query',TRUE);
require 'query.php';
$query=new query();
$data=$query->getdata("SELECT * FROM login WHERE id=\"$_SESSION[id]\" ");
 	if (count($data)==0) {
		echo "<script type='text/javascript'>alert('Login Again!!!');window.location='logout'</script>";
 	}
if (isset($_GET['submit'])) {
	$q=$_GET['search'];
	$final=$query->escape($q);
	$output='';
	$result=$query->getdata("SELECT * FROM `student` WHERE login_id=\"$_SESSION[id]\" AND CONCAT(`name`,`age`,`ph`)  LIKE '%".$final."%'");
	if (count($result)=='0') {
		$output="<h3>No search found for <font color='red'><i>'".$final."'</i></font> in table.</h3>";
	}
	if ($final=="") {
		$output="<h3>No search found !!!</h3>";

	}else{

		foreach ($result as $key => $value) {

			$name=$value['name'];
			$age=$value['age'];
			$phone=$value['ph'];
			$pic=$value['photo'];

		echo "<tr>";
		echo "<td><a href='$value[photo]'><img width='100' height='100' src='".$pic."'></a></td>";
		echo "<td>".$name."</td>";
		echo "<td>".$age."</td>";
		echo "<td>".$phone."</td>";
		echo "<td><a href='update.php?id=$value[id]'>Update</a> | <a href='delete.php?id=$value[id]' onclick=\"return confirm('Are you sure want to delete?');\">Delete</a></td>";
		echo "</tr>";
			}

		echo "</table>";
		echo $output;
	}
}
  ?>


	</font>

</body>
</html>













