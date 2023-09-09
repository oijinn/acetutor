<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Search Attendance - ACE Tutor</title>
<script type="text/javascript" src="acetutor.js"></script>
<link rel="stylesheet" href="stylea.css"/>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>

<div class="sidenav">
	<div class="sidebar" style="height: 768px">
	<h2>ACE Tutor</h2>
	
	<?php $id=$_SESSION['id']; $thisMonth = intVal(date("m"));?>
	<a href="Dashboard_Teacher.php"><i class="fas fa-home"></i>Dashboard</a> <!-- a for webpage, i for image-->
	<a href="Timetable.php"><i class="fas fa-table"></i>Timetable</a>
	<a href="Attendance_int.php"><i class="far fa-list-alt"></i>Attendance</a>
	<a href="Notification_teacher.php?month=<?php echo $thisMonth; ?>"><i class="far fa-bell"></i>Notification</a>
	
	<div class="report">
	<a href="#"><i class="far fa-file-alt"></i>Report<i class="fas fa-angle-down"></i></a>
		<div class="report_content">
		<ul>
		<li><a href="Class_report_teacher.php">Class Attendance Report (Daily)</a></li>
		<li><a href="Monthly_Class_Report_Teacher.php">Class Attendance Report (Monthly)</a></li>
		</ul>
		</div>
	</div>

	<div class="logout">
		<a onclick="logout()"><i class="fas fa-lock-open"></i>Logout</a>
	</div>
	<script>
	function logout() {
      Swal.fire({
	  title: 'Do you want to exit?',
	  icon: 'question',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	}).then((result) => {
	  if (result.isConfirmed) {
	  	Swal.fire({
	    title: 'Logout Successful!',
	    icon: 'success',
		}).then((result) => {
	  		if (result.isConfirmed) {
	  			window.location.href='login.php';
	  }
	})}})}
	</script>
	</div>	
</div>
	
<div class="main">
		<?php
		include("conn.php");
		
		$sid = $_POST['sid'];
		$classID = $_POST['cid'];
		$status = $_POST['status'];
		$date = $_POST['date'];
		
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
		echo "window.location.href='Modify_attendance_int.php?classID=$classID&date=$date';}";
		echo "else if (result.isDismissed) {";
    	echo "window.location.href='edit_attendance.php?classID=$classID&date=$date&sid=$sid';}})";
		echo "</script>";	
		}	
		
		if(isset($_POST['update']) ? $_POST['update'] : ''){	
		$sql1= "UPDATE attendance SET status='$status' WHERE sid='$sid' AND cid='$classID' AND date='$date';";

		if (!mysqli_query($con, $sql1)){
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Attendance is not updated!',";
		echo "text: 'Please try again.',";
	    echo "icon: 'error'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.href='edit_attendance.php?classID=$classID&date=$date&sid=$sid';}})";
		echo "</script>";	
		}	
		else{
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Attendance is updated successfully!',";
	    echo "icon: 'success'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.href='Modify_attendance_int.php?classID=$classID&date=$date';}})";
		echo "</script>";
		}
		}
		mysqli_close($con); 
		?>
</div>
</body>
</html>