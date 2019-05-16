<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
</head>
<body bgcolor ="silver">
<?php 
	define('query',true);
	if (isset($_SESSION['valid'])) {
		header("location:home");
	}
	
	require 'query.php';
	$query=new query();
	if (isset($_POST['admin-login'])) {
		$user=$query->escape_string($_POST['username']);
		$pass=$query->escape_string($_POST['password']);

		if ($user=="" || $pass=="") {
			echo "Either username or password field is empty.";
        	echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
		}else{
			if (isset($_POST['remember'])) {
				setcookie('user',$user,time()+5000);
				setcookie('pass',$pass,time()+5000);
			$result=$query->adminauth("SELECT * FROM admin_login WHERE username='$user' AND password='$pass' ");
			}else{
				setcookie('user',"");
				setcookie('pass',"");
			$result=$query->adminauth("SELECT * FROM admin_login WHERE username='$user' AND password='$pass' ");
			}
		}

	}else{
?>
	 <p><font size="+2"><b>Admin-Login</b></font></p>
	 <form method="post" action="">
	 	<table width="75%" border="0">
	 		<tr>
	 			<td width="10%">Username</td>
	 			<td><input type="text" name="username" value="<?php if(isset($_COOKIE['user'])){
	 				echo $_COOKIE['user'];
	 			} ?>"></td>
	 		</tr>
	 		<tr>
	 			<td>Password</td>
	 			<td><input type="password" name="password" value="<?php if(isset($_COOKIE['pass'])){
	 				echo $_COOKIE['pass'];
	 			} ?>"></td>
	 		</tr>
	 		<tr>
	 			<td></td>
	 			<td><input type="checkbox" name="remember" >Remember Me</td>
	 		</tr>
	 		<tr>
	 			<td></td>
	 			<td><input type="submit" name="admin-login" value="Login" ></td>
	 		</tr>
	 	</table>
	 	
	 </form>
<br>
</body>
</html>
<?php 
define('footer', true);

require '../footer.php';
}
 ?>