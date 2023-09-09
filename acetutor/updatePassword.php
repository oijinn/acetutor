<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Change Password - ACE Tutor</title>
<script type="text/javascript" src="acetutor.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
		<?php				
		include("conn.php");
		
		if(isset($_POST['submit']) ? $_POST['submit'] : ''){
		$username = $_SESSION['id'];
		$oldPassword=  $_POST['oldPassword'];
		$newPassword=  $_POST['newPassword'];
		$user = $_POST['user'];
		
		if ($user == "student"){
		$sql = "SELECT sid, password FROM Student WHERE sid='$username' AND password='$oldPassword';";
		$result = mysqli_query($con, $sql);
		
		if (mysqli_num_rows($result) == 0){             // check if old password is correct
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Invalid password!',";
		echo "text: 'Please enter a valid old password!',";
	    echo "icon: 'warning'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.href='changePassword.php?user=student';}})";
		echo "</script>";
		} else {                                       // if old password is correct, update new password
		$sql1 = "UPDATE student SET password='$newPassword' WHERE sid='$username';";
		
		if (!mysqli_query($con, $sql1)){
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Something is wrong with the database!',";
	    echo "icon: 'warning'})";
		echo "</script>"; 
		}
		else{
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Password is updated successfully!',";
	    echo "icon: 'success'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.href='Dashboard_Student.php';}})";
		echo "</script>";
		}}	
		} else {		
		$sql = "SELECT fid, password FROM staff WHERE fid='$username' AND password='$oldPassword';";
		$result = mysqli_query($con, $sql);
		
		if (mysqli_num_rows($result) == 0){             // check if old password is correct
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Invalid password!',";
		echo "text: 'Please enter a valid old password!',";
	    echo "icon: 'warning'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.href='changePassword.php?user=staff';}})";
		echo "</script>";
		} else {                                       // if old password is correct, update new password
		$sql1 = "UPDATE staff SET password='$newPassword' WHERE fid='$username';";
		
		if (!mysqli_query($con, $sql1)){
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Something is wrong with the database!',";
	    echo "icon: 'warning'})";
		echo "</script>"; 
		}
		else{
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Password is updated successfully!',";
	    echo "icon: 'success'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.href='Dashboard_Teacher.php';}})";
		echo "</script>";
		}}
		}
		mysqli_close($con);	
		} ?>
		
</body>

</html>
