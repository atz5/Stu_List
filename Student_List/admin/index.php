<?php session_start(); ?>
<?php 
if (!isset($_SESSION['valid'])) {
	header("location:admin-login");
}
define('query',TRUE);
require 'query.php';
$query=new query();
$result=$query->getdata("SELECT * FROM login");

?>
<body bgcolor="silver">
	<style type="text/css">
		.none{
			text-decoration: none;
		}
	</style>
	
<table width="80%" border="1" class="border">
		<b>
		<h2><a href="logout" class="none">"Admin Panel"</a></h2>
 		<a href="admin-register">Register For User</a>
		<p>Logout To Click "Admin Panel"</p>
		</b>

		<tr bgcolor='#CCCCCC'>
			<td>ID</td>
			<td>Photo</td>
			<td>Username</td>
			<td>Name</td>
			<td>Email</td>
			<td>Password</td>
			<td>Modify</td>
		</tr>
			<?php 
			foreach ($result as $key => $value) {
				echo "<tr>";
				echo "<td>".$value['id']."</td>";
				echo "<td><a href='../$value[photo]'><img width='100' height='100' src='../".$value['photo']."'></a></td>";
				echo "<td>".$value['username']."</td>";
				echo "<td>".$value['name']."</td>";
				echo "<td>".$value['email']."</td>";
				echo "<td>".$value['password']."</td>";
				echo "<td><a href='modify.php?id=$value[id]'>Update</a> | <a href='admin-delete.php?id=$value[id]' onclick=\"return confirm('Are you sure want to delete?')\">Delete</a></td>";
				echo "</tr>";
			}

			 ?>
			 
 	</table>
<?php 

 ?>

</body>
