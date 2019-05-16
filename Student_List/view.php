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
 	$result=$query->getdata("SELECT * FROM student WHERE login_id=\"$_SESSION[id]\" ORDER BY id DESC");
 	$data=$query->getdata("SELECT * FROM login WHERE id=\"$_SESSION[id]\" ");
 	if (count($data)==0) {
		echo "<script type='text/javascript'>alert('Login Again!!!');window.location='logout'</script>";
 	}

 	 ?>
 	 
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Student Lists</title>
 	<style type="text/css">
 		.border{
 			border-spacing: 0;
 			color: green;
 			border-color: green;
 		}
 		input{
 			background: black;
 			color: red;
 		}
 		.mgb{
 			margin-bottom: 0;
 		}
 	</style>
 </head>
 <body bgcolor="black">
 	<font color="red">
 	<a href="home">Home</a> | <a href="add-student">Add New Student</a> | <a href="logout">Logout</a><br><br>
 	</font>
 	<form action="result" action="GET" class="mgb">
 		<input type="text" name="search" placeholder="Search...">
 		<input type="submit" name="submit" value="Search" hidden="">
 	</form>
	<table width="80%" border="1" class="border">
		<b>
		<tr bgcolor='#CCCCCC'>
			<td>Photo</td>
			<td>Name</td>
			<td>Age</td>
			<td>Phone</td>
			<td>Update</td>
		</tr>
			<?php 
			foreach ($result as $key => $value) {
				echo "<tr>";
				echo "<td><a href='$value[photo]'><img width='100' height='100' src='".$value['photo']."'></a></td>";
				echo "<td>".$value['name']."</td>";
				echo "<td>".$value['age']."</td>";
				echo "<td>".$value['ph']."</td>";
				echo "<td><a href='update.php?id=$value[id]'>Update</a> | <a href='delete.php?id=$value[id]' onclick=\"return confirm('Are you sure want to delete?')\">Delete</a></td>";
				echo "</tr>";
			}

			 ?>
			 
 	</table>

 </body>
 </html>

