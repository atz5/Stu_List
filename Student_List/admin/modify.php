<?php session_start(); ?>
<?php 
if (!isset($_SESSION['valid'])) {
	header("location:admin-login");
}
?>
<?php 
define('query',TRUE);
require 'query.php';
$query=new query();
if (isset($_POST['modify'])) {
	$id=$_POST['id'];

	$name=$query->escape_string($_POST['name']);
	$pass=$query->escape_string($_POST['password']);
	$email=$query->escape_string($_POST['email']);
	$chk_email=$query->email($_POST['email']);

	$final=$query->escape($name);

	$en_pass=base64_encode($pass);
	if (!$chk_email) {
		echo "Invalid Email!!!";
		echo "<br><a href='javascript:self.history.back()'>Go Back</a>";
	}else{


	$result=$query->execute("UPDATE login SET name='$final',email='$chk_email',password='$en_pass' WHERE id=$id");
	header("location:home");
}

}else{

 ?>

<?php 
$id=$_GET['id'];
$result=$query->getdata("SELECT * FROM login WHERE id='$id' ");
foreach ($result as $key => $value) {
	$user=$value['username'];
	$name=$value['name'];
	$email=$value['email'];
	$pass=$value['password'];

}

 ?><h3>Update User</h3>
<a href="home">Home</a>
	<form action="" method="post">
		<table width="25%" border="0">
		<tr>
			<td>Username:</td>
			<td><?php echo $user; ?></td>

		</tr>
		
		<tr>
			<td>Name:</td>
			<td><input type="text" name="name" value="<?php echo $name; ?>"></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type="text" name="email" value="<?php echo $email; ?>"></td>

		</tr>
		<tr>
			<td>Password:</td>
			<td><input type="text" name="password" value="<?php echo base64_decode($pass); ?>"></td>

		</tr>
		<tr>
			<td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
			<td><input type="submit" name="modify" value="Update"><button class="style"><a class="style" href="home">Cancel</a></button></td>
		</tr>
		</table>
		
	</form>

<?php  
}
?>






