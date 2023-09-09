<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Absent Attendance - ACE Tutor</title>
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
		<a onclick="logout()"><i class="fas fa-lock-open"></i>Logout</a>
	</div>
	<script>
	function logout() {
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
	<div class="header"> Absent Attendance </div>
	<div class="info">

<?php

        include("conn.php");
		$sid = $_GET['sid'];
		$cid = $_GET['cid'];
		$date = $_GET['date'];
		$result = mysqli_query($con, "SELECT c.jid, a.date, c.time, a.status, a.reason FROM class c INNER JOIN attendance a ON c.cid=a.cid WHERE a.sid ='$sid' AND c.cid='$cid' AND a.date='$date';");
				
		while($row = mysqli_fetch_array($result)){
		
 		echo "<form action=\"update_mc.php\" method=\"post\">";

		echo "<label>Student ID:</label>   <input type=\"text\"  disabled=\"disabled\"  name=\"sid\"    value=" .$sid. ">";
		echo "<label>Class ID:</label>     <input type=\"text\"  disabled=\"disabled\"  name=\"cid\"    value=\"" .$cid. "\">";	
		echo "<label>Subject ID:</label>   <input type=\"text\"  disabled=\"disabled\"  name=\"jid\"    value=\"" .$row['jid']. "\">";
		echo "<label>Date:</label>         <input type=\"date\"  disabled=\"disabled\"  name=\"date\"   placeholder=\"YYYY-MM-DD\" value=\"" .$row['date']. "\">"; 
		echo "<label>Time:</label>         <input type=\"text\"  disabled=\"disabled\"  name=\"time\"   value=\"" .$row['time']. "\">";
		echo "<label>Status:</label>	   <select name=\"status\">";
		
		if ($row['status'] == "Present") {
		echo "<option value=\"Present\" selected=\"selected\">Present</option>";
		echo "<option value=\"Absent\">Absent</option>";
		echo "<option value=\"Absent with Reason\">Absent with Reason</option>";
		echo "<option value=\"Late\">Late</option>";
		
		} else if ($row['status'] == "Absent") {
		echo "<option value=\"Present\">Present</option>";
		echo "<option value=\"Absent\" selected=\"selected\">Absent</option>";
		echo "<option value=\"Absent with Reason\">Absent with Reason</option>";
		echo "<option value=\"Late\">Late</option>";
		
		} else if ($row['status'] == "Late") {
		echo "<option value=\"Present\">Present</option>";
		echo "<option value=\"Absent\">Absent</option>";
		echo "<option value=\"Absent with Reason\">Absent with Reason</option>";
		echo "<option value=\"Late\" selected=\"selected\">Late</option>";

		} else {
		echo "<option value=\"Present\">Present</option>";
		echo "<option value=\"Absent\">Absent</option>";
		echo "<option value=\"Absent with Reason\" selected=\"selected\">Absent with Reason</option>";
		echo "<option value=\"Late\">Late</option>";
		}
		
		echo "</select><hr><br>";
		echo "<label>Reason:</label>  <input type=\"text\" name=\"reason\" value=\"" .$row['reason']. "\">";
		
		echo "<br><br>";

     	echo "<input type=\"submit\" value=\"Update\" name=\"update\">";
		echo "<input type=\"reset\"  value=\"Reset\">";
		echo "<input type=\"hidden\" name=\"SID\" value=" .$sid. ">";
		echo "<input type=\"hidden\" name=\"CID\" value=" .$cid. ">";
		echo "<input type=\"hidden\" name=\"DATE\" value=" .$date. ">";
		echo "</form>"; 
		
		} 
		mysqli_close($con); 
?>

		<style>
		label {
		display:block;
		font-weight: bold;
		margin-bottom: 10px;
		}

		input[type=text],[type=date],select{
		height:30px;
		width: 350px;
		margin-bottom: 40px;
		}
							
		input[type=submit] {
		margin-right: 40px;
		background-color:#DFDFFF;
		height: 40px;
		width: 190px;
		font-weight:bold;
		font-size:large;
		text-transform:uppercase;	
		letter-spacing:2px;	
		}
		
		input[type=reset] {
		background-color:#DFDFFF;
		height: 40px;
		width: 120px;
		font-weight:bold;
		font-size:large;
		text-transform:uppercase;
		letter-spacing:2px;
		}

		</style>
	</div>
</div>
</body>

</html>