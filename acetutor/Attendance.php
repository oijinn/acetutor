<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Attendance - ACE Tutor</title>
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
	<div class="header"> Attendance </div>
	<div class="info">
		<div>
		<form action="Attendance.php" method="post">
		<label>Student ID or IC:</label><input type="text" name="sid" required="required"><br>
		<label>Filter By (optional): </label><select name="slcFilter">
		<option value="">-- Please Select --</option>
		<option value="cid">Class ID</option>
		<option value="jid">Subject ID</option>
		<option value="date">Date</option>
		</select>
		<input type="text" name="txtFilter">
		<input type="submit" name="submit" value="Search">
		</form>
		
		
		<?php
       include("conn.php");
       if(isset($_POST['submit']) ? $_POST['submit'] : ''){
       
       $sid = $_POST['sid'];
       $slcFilter = $_POST['slcFilter'];
       $filter = $_POST['txtFilter'];
       
       switch($slcFilter){
       case "": $sql = "SELECT s.sid, s.name, c.cid, c.jid, a.date, c.time, a.status FROM student s INNER JOIN attendance a ON s.sid=a.sid INNER JOIN class c ON c.cid=a.cid WHERE s.sid ='$sid' OR s.ic='$sid';"; break;
       case "cid": $sql = "SELECT s.sid, s.name, c.cid, c.jid, a.date, c.time, a.status FROM student s INNER JOIN attendance a ON s.sid=a.sid INNER JOIN class c ON c.cid=a.cid WHERE a.cid='$filter' AND s.sid ='$sid' OR s.ic='$sid';"; break;
       case "jid": $sql = "SELECT s.sid, s.name, c.cid, c.jid, a.date, c.time, a.status FROM student s INNER JOIN attendance a ON s.sid=a.sid INNER JOIN class c ON c.cid=a.cid WHERE c.jid='$filter' AND s.sid ='$sid' OR s.ic='$sid';"; break;
       case "date": $sql = "SELECT s.sid, s.name, c.cid, c.jid, a.date, c.time, a.status FROM student s INNER JOIN attendance a ON s.sid=a.sid INNER JOIN class c ON c.cid=a.cid WHERE a.date='$filter' AND s.sid ='$sid' OR s.ic='$sid';"; break;
       }
       
       $result = mysqli_query($con, $sql);
       
       if (mysqli_num_rows($result) == 0){ //https://stackoverflow.com/questions/8417192/how-would-i-check-if-values-returned-from-an-sql-php-query-are-empty/8417230
       echo "<script>Swal.fire('Invalid Student ID', 'Record Not Found', 'error')</script>";
       }
       else {
       echo "<table border=\"1\" style=\"text-align:center\">";
       echo "<tr>";
       echo "<th>ID</th>";
       echo "<th>Name</th>";
       echo "<th>Class ID</th>";
       echo "<th>Subject ID</th>";
       echo "<th>Date</th>";
       echo "<th>Time</th>";
       echo "<th>Status</th>";
       echo "<th>Edit</th>";
       echo "</tr>";
       
       while ($row = mysqli_fetch_array($result)){
       echo "<tr>";
       echo "<td>";
       echo $row['sid'];
       echo "</td>";
		echo "<td>";
       echo $row['name'];
       echo "</td>";
       echo "<td>";
       echo $row['cid'];
       echo "</td>";
       echo "<td>";
       echo $row['jid'];
       echo "</td>";
  	   echo "<td>";
       echo $row['date'];
       echo "</td>";
       echo "<td>";
       echo $row['time'];
       echo "</td>";
       echo "<td>";
       echo $row['status'];
       echo "</td>";
       echo "<td><a href=\"mc.php?sid=";
       echo $row['sid'];
       echo "&cid=";
       echo $row['cid'];
       echo "&date=";
       echo $row['date'];
       echo "\"><i class=\"fas fa-pen\"></i></a></td>";
       echo "</tr>";
       }
       echo "</table>";
       }
       mysqli_close($con);
       }
       ?>
       
		<style>
		table{
		width:900px;
		}

		table th{
		background-color:#CCCCCC;
		padding:10px;
		}
		
		table td{
		padding:10px;
		}
		
		label {
		font-weight: bold;
		margin-bottom: 10px;
		margin-left:30px;
		}

		input[type=text]{
		height:25px;
		width: 150px;
		margin-bottom:30px;
		margin-left:50px;
		margin-top:20px;
		}
		
		select{
		height:30px;
		width: 150px;
		margin-bottom:150px;
		margin-left:28px;
		}
		
		input[type=submit] {
		background-color:#DFDFFF;
		height: 30px;
		width: 100px;
		font-weight:bold;
		font-size:medium;
		letter-spacing:1px;	
		margin-left:60px;
		}
		</style>
		</div>		
		</div>
	</div>
</body>

</html>
