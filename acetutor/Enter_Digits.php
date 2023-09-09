<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Enter Digits - ACE Tutor</title>
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
	<div class="header"> Enter Digits </div>
	<div class="info">
		<form action="Enter_Digits.php" method="post">
		<input type="number" name="OTP1">
		<input type="number" name="OTP2">
		<input type="number" name="OTP3">
		<input type="submit" name="submit" value="Submit">
		</form> 
		
		<?php
		include("conn.php");
		
		if(isset($_POST['submit']) ? $_POST['submit'] : ''){
		$OTP = $_POST['OTP1']. $_POST['OTP2']. $_POST['OTP3'];
		
		$sql= "SELECT c.CID,c.Time,c.OTP FROM class c INNER JOIN student_class sc ON sc.cid=c.cid WHERE sc.sid='$id';";
		$result = mysqli_query($con,$sql);
		$flag = 0;
		
		while($row = mysqli_fetch_array($result)){
		if ($row['OTP'] == $OTP) {
		$flag = 1;
		$cid = $row['CID'];
		$date = date('Y-m-d');
		$time = $row['Time'];
		}}
		
		if ($flag == 1){
		$sql1="UPDATE attendance SET status='Present' WHERE cid='$cid' AND date='$date' AND time='$time' AND sid='$id';";
		
		if (!mysqli_query($con, $sql1)){
		echo "<script>Swal.fire('Attendance is not updated!', 'Please try again.', 'error')</script>";
		} else{		
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Attendance is updated successfully!',";
	    echo "icon: 'success'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.href='Dashboard_Student.php';}})";
		echo "</script>";
		}} else {
		echo "<script>Swal.fire('Invalid OTP', 'Please try again', 'error')</script>";
		}	
		}
		mysqli_close($con); 
		?>
		
		<style>
		input[type=number]{
		height: 80px;
		width: 80px;
		margin-left: 50px;
		font-size:75px;
		text-align:center;
		}
		
		input[type=submit] {
		text-align: center;
		background-color:#DFDFFF;
		height: 40px;
		width: 150px;
		font-weight:bold;
		font-size:medium;
		text-transform:uppercase;
		letter-spacing:2px;
		text-decoration:none;
		margin-left:100px;
		margin-top:50px;
		}

		</style>
	</div>
</div>
</body>

</html>
