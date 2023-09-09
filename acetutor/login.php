<?php
session_unset(); 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Login Page</title>
<script type="text/javascript" src="acetutor.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
	<h1> Sign In </h1> <!-- https://www.w3schools.com/css/css_tooltip.asp -->
		
		<form action="login.php" method="post">
		<fieldset>
		<legend>Please Enter The Credidentials</legend>
		
		<span><label>Username:</label> <input type="text" name="username"  required="required"></span>
		<br><br>
		<span><label>Password:</label> <input type="password" name="password"></span>
		<br><br>

		<span><input type="submit" value="Sign In" name="submit"></span>
		</fieldset>
		</form>
		
		<?php				
		include("conn.php");
		
		if(isset($_POST['submit']) ? $_POST['submit'] : ''){
		$_SESSION['id'] = $_POST['username'];
		$id = $_SESSION['id'];
		$password=  $_POST['password'];
	
		$sql = "SELECT sid, password FROM Student WHERE sid='$id' AND password='$password';";
		$result = mysqli_query($con, $sql);
		
		if (mysqli_num_rows($result) == 0){
		
		$sql1 = "SELECT fid, password FROM staff WHERE fid='$id' AND password='$password';";
		$result = mysqli_query($con, $sql1);
		
		if (mysqli_num_rows($result) == 0){
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Invalid username or password!!',";
	    echo "icon: 'warning'})";
		echo "</script>"; 
		}
		else {
		if ($id == "SA99999"){
		$month = intVal(date("m"));
		
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Login Successful!',";
	    echo "icon: 'success'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.href='AdminNotification.php?month=$month';}})";
		echo "</script>"; 
		}
		else{ // if is teacher
		// urge user to change password if password is default password
		
		if ($id == $password){  
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Login Successful!',";
		echo "text: 'Please change your password for security purpose!',";
	    echo "icon: 'info'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.href='changePassword.php?user=staff';}})";
		echo "</script>";
		} else {
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Login Successful!',";
	    echo "icon: 'success'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.href='Dashboard_Teacher.php';}})";
		echo "</script>";
		}
		}}}
		else{ // if is student
		if ($id == $password){  
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Login Successful!',";
		echo "text: 'Please change your password for security purpose!',";
	    echo "icon: 'info'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.href='changePassword.php?user=student';}})";
		echo "</script>";
		} else {
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Login Successful!',";
	    echo "icon: 'success'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.href='Dashboard_Student.php';}})";
		echo "</script>";
		}}
		mysqli_close($con);		
		}
				
		?>
		
				
		<style>
		body{
		background: #f3f5f9;
		}

		h1{
		color:black;
		text-align:center;
		font-size:50px;
		}
		
		form{ letter-spacing:0.5px; }
				
		fieldset{
		margin-left: 430px;
		margin-top: 100px;
		width:600px;
		border-color:#CCCCCC;
		border-style:solid;
		display:block;
		}
		
		legend{
		font-weight: bold;
		margin-bottom: 50px;
		margin-top: 100px;
		font-size:20px;
		}
		
		label {
		display:inline-block;
		font-weight: bold;
		margin-bottom: 10px;
		margin-left:110px;
		font-size:19px;
		}

		input[type=text],[type=password]{
		height:30px;
		width: 250px;
		margin-bottom: 40px;
		margin-left: 20px;
		font-size:19px;
		font-family: 'Source Sans Pro', sans-serif;
		}
				
		input[type=submit] {
		margin-left: 230px;
		background-color:#DFDFFF;
		height: 40px;
		width: 250px;
		font-weight:bold;
		font-size:medium;
		text-transform:uppercase;	
		letter-spacing:2px;	
		margin-bottom:50px;
		}
		</style>
</body>

</html>
