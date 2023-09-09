<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Subject - ACE Tutor</title>
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
		
		$jid = $_POST['id'];
		$name = $_POST['name'];
		$form = $_POST['form'];
		$year = $_POST['year'];
		
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
		echo "window.location.href='Subject.php';}";
		echo "else if (result.isDismissed) {";
    	echo "window.location.href='edit_subject.php?id=$jid';}})";
		echo "</script>";	
		}		
		
		if(isset($_POST['update']) ? $_POST['update'] : ''){ 
		
		$sql1= "UPDATE subject SET name='$name', form='$form', year='$year'WHERE jid='$jid';";
		
		if (!mysqli_query($con, $sql1)){
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Subject record is not updated!',";
		echo "text: 'Please try again.',";
	    echo "icon: 'error'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.href='edit_subject.php?id=$jid';}})";
		echo "</script>";			
		}	
		else{	
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Subject record is updated successfully!',";
	    echo "icon: 'success'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.href='Subject.php';}})";
		echo "</script>";
		}
		}
			
		mysqli_close($con); 
		
		?>
</div>
</body>

</html>
