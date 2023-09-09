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
	<div class="sidebar">
	<h2>ACE Tutor</h2>
	
	<?php $id=$_SESSION['id']; $thisMonth = intVal(date("m"));?>
	<a href="Dashboard_Student.php"><i class="fas fa-home"></i>Dashboard</a>
	<a href="Timetable_Student.php"><i class="fas fa-table"></i>Timetable</a>
	<a href="Attendance_student.php"><i class="far fa-list-alt"></i>Attendance</a>
	<a href="Student_Report.php"><i class="far fa-file-alt"></i>Report</a>
	<a href="Notification_student.php?month=<?php echo $thisMonth; ?>"><i class="far fa-bell"></i>Notification</a>

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
		
		$result = mysqli_query($con, "SELECT name FROM student WHERE sid ='$id';");
				
		while($row = mysqli_fetch_array($result)){
		echo "<label>Student ID:" .$id. "</label>";
		echo "<label>Name:" .$row['name']. "</label>";
		}
		
		echo "<button id=\"chgpass\" onclick=\"window.location.href='changePassword.php?user=student'\">Change Password</button>";
		echo "<button id=\"markattendance\" onclick=\"window.location.href='Enter_Digits.php'\">Mark Attendance</button>";
		echo "</div><br>";		
		
		echo "<h2>Timetable</h2>";
		
		$date = date("Y-m-d");   //https://www.w3schools.com/php/php_date.asp
		$result = mysqli_query($con, "SELECT s.name, s.jid, c.cid, c.time, c.venue, st.name AS staff_name FROM class c INNER JOIN subject s ON c.jid=s.jid INNER JOIN student_class sc ON sc.cid=c.cid INNER JOIN staff st ON st.fid=c.fid WHERE sc.sid ='$id' AND c.date='$date' ORDER BY time ASC;");
		
		if (mysqli_num_rows($result) == 0){
		echo "<fieldset>"; 
       	echo "<span><label>Hooray! No class today!</label></span>";
       	echo "<br></fieldset>";
       	} 
       	else {
		while($row = mysqli_fetch_array($result)){
		echo "<fieldset>";
		echo "<span><h3><strong>" .$row['name']. " (" .$row['jid']. ")</strong></h3></span>";
		echo "<span><label>Class ID: " .$row['cid']. "</label></span>";
		echo "<span><label>Time: <strong>" .$row['time']. " (2 hours)</strong></label></span>";
		echo "<span><label>Venue: " .$row['venue']. "</label></span>";
		echo "<span><label>Teacher: " .$row['staff_name']. "</label></span>";
		echo "<br></fieldset>";
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
	
	button {
		display:block;
		text-align: center;
		background-color:#DFDFFF;
		height: 40px;
		width: 250px;
		font-weight:bold;
		font-size:medium;
		text-transform:uppercase;
		letter-spacing:2px;
		text-decoration:none;
		margin-bottom:30px;
		margin-left:0px;
	}
	
	#chgpass{
		margin-top:50px;
	}
	
	#markattendance{
		margin-bottom:80px;
	}
	</style>
	</div>
	</div>
</body>

</html>
