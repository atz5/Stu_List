<?php session_start(); ?>
<?php 
if (!isset($_SESSION['valid'])) {
	header("location:home");
}
 ?>
<?php 
define('query',TRUE);
require 'query.php';
$query=new query();
if (isset($_POST['register'])) {
	$name=$query->escape_string($_POST['name']);
	$email=$query->escape_string($_POST['email']);
	$user=$query->escape_string($_POST['username']);
	$pass=$query->escape_string($_POST['password']);

	$enpass=base64_encode($pass);

	$filename=$_FILES['img']['name'];
	$tmpname=$_FILES['img']['tmp_name'];
	$ext=pathinfo($filename,PATHINFO_EXTENSION);
	$photoname=time();
	$folder="profile/$photoname.$ext";

	$chk_email=$query->email($_POST['email']);

	$ext_email=$query->getdata("SELECT * FROM login WHERE email='$chk_email' ");
	$ext_user=$query->getdata("SELECT * FROM login WHERE username='$user' ");

	if (!$chk_email) {
		echo "Invalid Email!!!";
		echo "<br><a href='javascript:self.history.back()'>Go Back</a>";
	}

	elseif (count($ext_email)==1) {
		echo "Email is already register!!!";
		echo "<br><a href='javascript:self.history.back()'>Go Back</a>";
		}

	elseif (count($ext_user)==1) {
		echo "UserName is already exists!!!";
		echo "<br><a href='javascript:self.history.back()'>Go Back</a>";

	}
	else{

	move_uploaded_file($tmpname,'../'.$folder);
	$result=$query->execute("INSERT INTO login(name,username,email,password,photo)
		VALUES('$name','$user','$email','$enpass','$folder')");
	echo "<script type='text/javascript'>alert('Register Successfully!!!');window.location='index.php'</script>";

	}
}else{

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<body>
<p><font size="+2"><b>Register For User</b></font></p>
	<form method="post" action="" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Name:</td>
				<td><input type="text" name="name" required=""></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><input type="text" name="email" required=""></td>
			</tr>
			<tr>
				<td>UserName:</td>
				<td><input type="text" name="username" required=""></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="password" required=""></td>
			</tr>
			<tr>
				<td>Profile Picture:</td>
				<td><input type="file" name="img" required=""></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="register" value="Register"><button class="style"><a class="style" href="home">Cancel</a></button></td>
			</tr>
		</table>
		

	</form>

	
</form>
</body>
</html>
<?php 
}
 ?>