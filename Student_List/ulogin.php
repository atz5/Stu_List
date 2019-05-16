<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript" src="action.js"></script>
	<style type="text/css">
		input{
			background: black;
			color: red;
			font-weight: bold;
		}
	</style>
</head>
<body bgcolor="black">
	<font color="green">
<a href="home">Home</a>
	 <p><font size="+2">User-Login</font></p>
	 <b><div id="result" style="color: red;"></div></b>
	 <form method="post">
	 	<table width="75%" border="0">
	 		<tr>
	 			<td width="10%">Username</td>
	 			<td><input type="text" name="username" id="username" value=""></td>
	 		</tr>
	 		<tr>
	 			<td>Password</td>
	 			<td><input type="password" name="password" id="password" value=""></td>
	 		</tr>
	 		<tr>
	 			<td></td>
	 			<td><input type="checkbox" name="remember" id="remember_me">Remember Me</td>
	 		</tr>
	 		<tr>
	 			<td></td>
	 			<td><input type="submit" name="login" id="login" value="Login"></td>
	 		</tr>
	 	</table>
	 	
	 </form>
	 <br>
Created by <i><b>'/ATZ/' &copy; 2019.</b></i>