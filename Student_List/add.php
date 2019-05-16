<?php session_start(); ?>
<?php 
if (!isset($_SESSION['auth'])) {
	header("location:user-login");
}

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Add Student</title>
 	<style type="text/css">
 		input{

 			font-weight: bold;
 		}
 	</style>
 </head>

 <body bgcolor="black">
 	<font color="green">

 	<a href="home">Home</a> | <a href="dashboard">View Student List</a> | <a href="logout">Logout</a>
 	<br><br>
 	<?php  
	define('query',TRUE);
 	require 'query.php';
 	$query=new query();
 	$data=$query->getdata("SELECT * FROM login WHERE id=\"$_SESSION[id]\" ");
 	if (count($data)==0) {
		echo "<script type='text/javascript'>alert('Login Again!!!');window.location='logout'</script>";
 	}
 	if (isset($_POST['add'])) {
 		$name=$query->escape_string($_POST['name']);
 		$age=$query->escape_string($_POST['age']);
 		$ph=$query->escape_string($_POST['phone']);
 		$loginid=$_SESSION['id'];

 		$final=$query->escape($name);

 		$filename=$_FILES['img']['name'];
 		$tmpname=$_FILES['img']['tmp_name'];
 		$ext=pathinfo($filename,PATHINFO_EXTENSION);
 		$photoname=time();
		$folder="stupic/$photoname.$ext";


 		move_uploaded_file($tmpname, $folder);
 		$result=$query->execute("INSERT INTO student(name,age,ph,photo,login_id)
 			VALUES('$final','$age','$ph','$folder','$loginid')");
 		header("location:dashboard");


 	}
 	else{
 	?>
 	<form method="post" action="" enctype="multipart/form-data">
 		<table width="75%" border="0">
 			<tr>
 				<td width="10%">Name:</td>
 				<td><input type="text" name="name" id="name" required=""></td>
 			</tr>
 			<tr>
 				<td>Age:</td>
 				<td><input type="number" name="age" id="age" required=""></td>
 			</tr>
 			<tr>
 				<td>Phone:</td>
 				<td><input type="text" name="phone" id="phone" value="+95 " required=""></td>
 			</tr>
 			<tr>
 				<td>Photo:</td>
 				<td><input type="file" name="img" required=""></td>
 			</tr>
 			<tr>
 				<td></td>
 				<td><input type="submit" name="add" id="add" value="Add Student"></td>
 			</tr>
 			
 		</table>
 	</form>

 	<?php 
 	}
 	 ?>	
	</font>
 
 </body>
 </html>