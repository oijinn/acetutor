<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Update Student Details - ACE Tutor</title>
<script type="text/javascript" src="acetutor.js"></script>
<link rel="stylesheet" href="stylea.css"/>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>

<div class="sidenav">
	<div class="sidebar">
	<h2>ACE Tutor</h2>
	<?php $thisMonth = intVal(date("m"));?>

	<a href="AdminNotification.php?month=<?php echo $thisMonth; ?>"><i class="fas fa-bell"></i>Notification</a><!-- a for webpage, i for icon-->
	<a><i class="fas fa-user-plus"></i>Registration</a>
		<ul>
		<li><a href="RegStu.php"><i class="fas fa-user"></i>Student</a></li>
		<li><a href="RegTea.php"><i class="fas fa-user-tie"></i>Staff</a></li>
		</ul>
	<a><i class="fas fa-user-edit"></i>Info</a>
		<ul>
		<li><a href="InfoStu.php"><i class="fas fa-user"></i>Student</a></li>
		<li><a href="InfoTea.php"><i class="fas fa-user-tie"></i>Staff</a></li>
		</ul>

	<a href="ClassAssign.php"><i class="fas fa-chalkboard-teacher"></i>Class Assignation</a>
	<a href="Attendance.php"><i class="fas fa-calendar-alt"></i>Attendance</a>
	<a href="Subject.php"><i class="far fa-list-alt"></i>Subject</a>
	
	<div class="report">
	<a href="#"><i class="far fa-file-alt"></i>Report<i class="fas fa-angle-down"></i></a>
		<div class="report_content">
		<ul>
		<li><a href="Report.php">Student Attendance Report</a></li>
		<li><a href="Class_Report.php">Class Attendance Report</a></li>
		</ul>
		</div>
	</div>
	<div class="logout">
		<a href="login.php"><i class="fas fa-lock-open"></i>Logout</a>
	</div>
	</div>
	
</div>

<div class="main">
		<?php
		include("conn.php");

		if(isset($_POST['cancel']) ? $_POST['cancel'] : ''){
		echo "<script>";
		echo "Swal.fire({";
		echo "title: 'Do you want to exit the page?',";
		echo "text: 'The changes will NOT be saved.',";
	    echo "icon: 'question',";
	    echo "showCancelButton: true,";
	    echo "confirmButtonColor: '#3085d6', cancelButtonColor: '#d33',}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.href='InfoStu.php';}";
		echo "else if (result.isDismissed) {";
    	echo "window.location.href='edit_stu.php';}})";
		echo "</script>";		
		}	
		
		if(isset($_POST['update']) ? $_POST['update'] : ''){
		$sid = $_POST['id'];
		$name = $_POST['name'];
		$gender = $_POST['gender'];
		$ic = $_POST['ic']; 
		$contact = $_POST['contact'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$dob = $_POST['dob'];
		$parentName = $_POST['parentname'];
		$parentContact = $_POST['parentcontact'];
		$parentEmail = $_POST['parentemail'];
		$relationship = $_POST['relationship'];
		$year = $_POST['year'];
		$form = $_POST['form'];
		
		$sql1= "UPDATE student SET name='$name', gender='$gender', ic='$ic', contact='$contact', email='$email', address='$address', dob='$dob', year='$year',form='$form' WHERE sid='$sid';";
		
		if (!mysqli_query($con, $sql1)){
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Student record is not updated!',";
		echo "text: 'Please try again.',";
	    echo "icon: 'error'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.href='edit_stu.php';}})";
		echo "</script>";		}		
		else{
		$sql2="UPDATE parent SET Parent_name='$parentName', Parent_contact='$parentContact', Parent_email='$parentEmail', relationship='$relationship' WHERE sid='$sid';";
				
		if (!mysqli_query($con, $sql2)){
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Student record is not updated!',";
		echo "text: 'Please try again.',";
	    echo "icon: 'error'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.href='edit_stu.php';}})";
		echo "</script>";		
		}
		else{
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Student record is updated successfully!',";
	    echo "icon: 'success'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.href='InfoStu.php';}})";
		echo "</script>";
		}	
		}	
		}
		mysqli_close($con); 
		
		?>
</div>
</body>

</html>
