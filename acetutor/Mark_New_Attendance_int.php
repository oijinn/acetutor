<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Mark New Attendance - ACE Tutor</title>
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
	<div class="header"></div>
	<div class="info">
		<div>
		
		<fieldset name="Mark New Attendance" style="width: 460px"> <!--https://www.w3schools.com/tags/tag_fieldset.asp -->

		<?php
		include 'conn.php';
		if(isset($_POST['submit']) ? $_POST['submit'] : ''){
		$Num = 1;
		$ClassID = $_POST['classID'];
		$Date = $_POST['date'];
		$Time = $_POST['time'];
		$value = rand(100,999);
		
		$sql = "UPDATE class SET OTP='$value' WHERE CID ='$ClassID' AND date='$Date' AND time ='$Time';";
		$result = mysqli_query($con,$sql);
		
		if ($con->affected_rows == 0){
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Invalid Input!',";
		echo "text: 'Please select valid inputs!',";
	    echo "icon: 'error'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.href='Mark_New_Attendance.php';}})";
		echo "</script>";	
		}	
		else{
		$sql1 = "SELECT sid FROM student_class sc INNER JOIN class c ON sc.cid=c.cid WHERE c.cid='$ClassID';"; 
		$result = mysqli_query($con,$sql1);
		
		if (mysqli_num_rows($result) == 0){ 
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'There is no student in the class!',";
	    echo "icon: 'error'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.href='Mark_New_Attendance.php';}})";
		echo "</script>";
        }
        else {
		while($row = mysqli_fetch_array($result)){
		$sid = $row['sid'];
		$sql2 = "INSERT INTO attendance (cid,sid,date,time,status) VALUES ('$ClassID','$sid','$Date','$Time','Absent');";
		
		if (!mysqli_query($con, $sql2)){
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Class attendance record exists!',";
		echo "text: 'Please select different inputs!',";
	    echo "icon: 'error'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.href='Mark_New_Attendance.php';}})";
		echo "</script>";
		}}

		echo "<b><label id='Class_ID' style='font-size: 20px'>Class ID: ".$ClassID."</label></b><br><br>";
				
		echo "<label id='Date'>Date: ".$Date." </label><br><br>";
				
		echo "<label id='Time'>Time: ".$Time."</label><br><br>";?>
		
		<br><br>
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
		&nbsp; &nbsp;	
		
		<label id="Attendance_code " style="font-size: 50px"><b><?php echo $value; ?></b></label>
		
		<br><br><br>
		<button onclick="location.href='Attendance_int.php'" id="doneBtn">Done</button>
		</fieldset>
		
		<?php }}} mysqli_close($con);  ?>
		

		<style>		
		
		#Class_ID{
		font-size: large;
		}
				
		#doneBtn {
		background-color:#DFDFFF;
		height: 30px;
		width: 100px;
		font-weight:bold;
		font-size:medium;
		letter-spacing:1px;	
		margin-bottom:30px;
		margin-left:190px;
		}
		
		</style>

		</div>		
		</div>
	</div>
</body>
</html>
