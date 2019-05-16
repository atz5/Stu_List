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
if (isset($_POST['update'])) {
	$new=$query->escape_string($_POST['new']);
	$con=$query->escape_string($_POST['con']);
	$name=$query->escape_string($_POST['name']);

	$ennew=base64_encode($new);

	if ($new==$con) {
		$result=$query->execute("UPDATE login SET name='$name',password='$ennew' WHERE id=\"$_SESSION[id]\"");
		echo "<script type='text/javascript'>alert('Successfully Changed!!!');window.location='logout';</script>";
	
	}else{
		echo "<script type='text/javascript'>alert('Password and Confirm-Password does not match!!!');window.location='info';</script>";
	}

}else{
	$data=$query->getdata("SELECT * FROM login WHERE id=\"$_SESSION[id]\"");
	foreach ($data as $key => $value) {
		$name=$value['name'];
		$email=$value['email'];
		$pic=$value['photo'];
	}

  ?>
  <style type="text/css">
  	.style{
  		text-decoration: none;
  		background: black;
  		color: red;
  	}
  	input{
  		background: black;
  		color: red;
  	}
  </style>
  <body bgcolor="silver">
	<form action="" method="post">
		<table width="75%" border="0">
			<font color="green">
			<tr>
				<td width="10%">Profile:</td>
				<?php echo "<td><a href='$value[photo]'><img width='100' height='120' src='".$pic."'></a></td>"; ?>
			</tr>
			<tr>
				<td>UserName:</td>
				<td><b>"<?php echo $name; ?>"</b></td>
			</tr>
			<tr>
				<td>Name:</td>
				<td><input type="text" name="name" value="<?php echo $name; ?>"></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><?php echo $email; ?></td>
			</tr>
			<tr>
				<td>New Password:</td>
				<td><input type="password" name="new" placeholder="New Password" required=""></td>
			</tr>
			<tr>
				<td>Confirm-Password:</td>
				<td><input type="password" name="con" placeholder="Confirm-Password" required=""></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="update" value="Change">
				<button class="style"><a class="style" href="home">Cancel</a></button></td>
			</tr>
				<a href="home">Home</a>
		</table>
	</form>
  </body>
	<?php 

}
	 ?>
