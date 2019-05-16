<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
<body bgcolor="black">
	<font color="green">

	<h3>Welcome To My Page!!!</h3>

	<?php  
	define('query',TRUE);
	require 'query.php';
	if (isset($_SESSION['auth'])) {
	?>
	Welcome "<i><b><a href="info"><?php echo $_SESSION['name']; ?></a>"</i>!!!</b><br>
	<a href="dashboard">View and Add Student</a><br>
	<a href="logout">Logout</a>
<?php  
	}else{
		echo "<br>You must be logged in to view this page.<br>";
		echo "<a href='user-login'>Login</a>";

	}
?>
<br>
<br>
<div>

<?php 
define('footer',true);
require 'footer.php'; ?>
</div>
</font>
</body>
</html>
