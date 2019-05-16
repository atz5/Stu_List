<?php 
/**
 * 
 */
if (!defined('query')) {
	header("location:error.html");
}
require 'config/connection.php';
class query extends con
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function execute($query){
		$result=$this->con->query($query);
		if (!$result) {
			echo "Error:Cannot Execute Command!!!";
		}
		return $this->con;
	}
	public function getdata($query){
		$result=$this->con->query($query);
		if (!$result) {
			echo "Error:Cannot Execute Command!!!";
		}
		$rows=array();
		while ($row=$result->fetch_array()) {
			$rows[]=$row;
		}
		return $rows;
	}
	public function delete($id,$table){
		$data=$this->con->query("SELECT * FROM $table WHERE id=$id");
		while ($row=$data->fetch_array()) {
			$img=$row['photo'];
		}
		unlink($img);
		$query="DELETE FROM $table WHERE id=$id";
		$result=$this->con->query($query);
		if(!$result) {
			echo "Error:Cannot Execute Command!!!";
		}
		return $this->con;
	}
	public function admin_delete($id,$table){
		$data=$this->con->query("SELECT * FROM $table WHERE id=$id");
		while ($row=$data->fetch_array()) {
			$img='../'.$row['photo'];
		}
		unlink($img);
		$query="DELETE FROM $table WHERE id=$id";
		$result=$this->con->query($query);
		if(!$result) {
			echo "Error:Cannot Execute Command!!!";
		}
		return $this->con;
	}



	public function auth($query){
		$result=$this->con->query($query);
		if (!$result) {
			echo "Error:Cannot Execute Command!!!";
		}
		$row=$result->fetch_array();
		if (is_array($row) && !empty($row)) {
			$authuser=$row['username'];
			$_SESSION['auth']=$authuser;
			$_SESSION['name']=$row['name'];
			$_SESSION['id']=$row['id'];
		}else{
			echo "Invalid Username or Password.<br>";

		}
		if (isset($_SESSION['auth'])) {
	echo "<script type='text/javascript'>window.location='home'</script>";

		}
	}
	public function escape_string($value){
		return $this->con->real_escape_string($value);
	}

	public function escape($value){
		return htmlspecialchars($value,ENT_QUOTES,'utf-8');
	}
	public function email($email){
		if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
			return $email;
		}
		return false;

	}
	public function adminauth($query){
		$result=$this->con->query($query);
		if (!$result) {
			echo "Error:Cannot Execute Command";
		}
		$row=$result->fetch_array();
		if (is_array($row) && !empty($row)) {
			$authuser=$row['username'];
			$_SESSION['valid']=$authuser;
			$_SESSION['name']=$row['name'];
			$_SESSION['id']=$row['id'];
		}else{
			echo "Invalid User or Password<br>";
			echo "<a href='admin-login'>Go Back</a>";
		}
		if (isset($_SESSION['valid'])) {
	echo "<script type='text/javascript'>window.location='student/'</script>";

		}
	}

}

 ?>
<script type="text/javascript">
var url=location.pathname+"/../logout";
setTimeout(function(){
	location=url;
alert("User Session Expired Login Again");
}, 86400000);//24 hours or 1 day
</script>
