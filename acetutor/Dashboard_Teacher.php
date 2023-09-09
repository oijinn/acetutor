<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Dashboard - ACE Tutor</title>
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
	<div class="header"> Dashboard</div>
	<div class="info">
		<div class="profile">
		<h2>Profile</h2>
		<h1><i class="fas fa-user"></i></h1>
		
		<?php
		include("conn.php");
				
		$result = mysqli_query($con, "SELECT name FROM staff WHERE fid ='$id';");
				
		while($row = mysqli_fetch_array($result)){
		echo "<label>Staff ID:" .$id. "</label>";
		echo "<label>Name:" .$row['name']. "</label>";
		}
		
		echo "<button id=\"chgpass\" onclick=\"window.location.href='changePassword.php?user=staff'\">Change Password</button>";
		echo "</div><br>";		
		
		echo "<h2>Timetable</h2>";
		
		$date = date("Y-m-d");
		$result = mysqli_query($con, "SELECT s.name, s.jid, c.cid, c.time, c.venue FROM class c INNER JOIN subject s ON c.jid=s.jid INNER JOIN staff st ON st.fid=c.fid WHERE c.fid ='$id' AND c.date='$date' ORDER BY time ASC;");
		
		if (mysqli_num_rows($result) == 0){
		echo "<fieldset>"; 
       	echo "<span><label>Hooray! No class today!</label></span>";
       	echo "<br></fieldset>";
       	} 
       	else {
		while($row = mysqli_fetch_array($result)){
		$cid = $row['cid'];
		$time = $row['time'];
		
		echo "<fieldset>";
		echo "<span><h3><strong>" .$row['name']. " (" .$row['jid']. ")</strong></h3></span>";
		echo "<span><label>Class ID: $cid</label></span>";
		echo "<span><label>Time: <strong>$time (2 hours)</strong></label></span>";
		echo "<span><label>Venue: " .$row['venue']. "</label></span>";
		
		echo "<form action='Mark_New_Attendance_int.php' method='post'>";
		echo "<input type='submit' name='submit' value='Mark Attendance'>";
		echo "<input type='hidden' name='classID' value='$cid'>";
		echo "<input type='hidden' name='date' value='$date'>";
		echo "<input type='hidden' name='time' value='$time'>";
		echo "<br></form></fieldset>";
		}}
		mysqli_close($con);
		?>
	</div>

<style type="text/css">
	h2{
	margin-top:50px;
	margin-bottom:50px;
	}
	
	h3{
	color:#3333CC;
	}

	.profile i{
	margin-bottom: 20px;
	margin-left:40px;
	color:#BD9DFF;
	}
	
	.profile label{
	display:block;
	margin-bottom:30px;
	}
	
	fieldset{
	width:900px;
	border-style:solid;
	border-color:gray;
	}
	
	span {
		display:block;
		margin-top:30px;
		margin-left:30px;
	}
	
	button, input[type=submit] {
		display:inline-block;
		text-align: center;
		background-color:#DFDFFF;
		height: 40px;
		width: 250px;
		font-weight:bold;
		font-size:medium;
		text-transform:uppercase;
		letter-spacing:2px;
		text-decoration:none;
		margin-left:600px;
		margin-bottom:20px;
	}
	
	#chgpass{
		margin-top: 30px;
		margin-left:0px;
	}
</style>

</div>
</body>

</html>
