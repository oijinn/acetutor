<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Register Staff - ACE Tutor</title>
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
	<div class="header"> Registration Form </div>
	<div class="info">
		<h2>Staff</h2> <br>
		
		<?php
		include("conn.php");
		$sql="SELECT fid FROM staff ORDER BY fid DESC LIMIT 1;"; //https://stackoverflow.com/questions/3411092/how-do-i-fetch-the-last-record-in-a-mysql-database-table-using-php
		$result = mysqli_query($con, $sql);
		
		if (!$result){
		echo "<script>Swal.fire('There's something wrong with the database!', 'Please try again', 'error')</script>";	
		} 
		else {
		while ($row = mysqli_fetch_array($result)){
		$latestID = (isset ($row['fid']) ? $row['fid'] : '');
		}
		
		// combine the integer element in array and convert to int
		
		$newid = intval($latestID[2]. $latestID[3]. $latestID[4].$latestID[5]. $latestID[6]) + 1;

		if ($newid > 9999 AND $newid < 99999){
		$fid = "ST" . $newid; }
		else if ($newid > 999 AND $newid <= 9999){
		$fid = "ST0" . $newid; }
		else if ($newid > 99 AND $newid <= 999){
		$fid = "ST00" . $newid; }
		else if ($newid > 9 AND $newid <= 99){
		$fid = "ST000" . $newid; }
		else {
		$fid = "ST0000" . $newid; }
		} 
		
		?>

		<form action="RegTea.php" method="post">
		<label>Staff ID:</label> <input type="text" name="fid" value=" <?php echo $fid; ?>">
		<label>Name:</label> <input type="text" name="name" required="required">
		<label>Gender:</label> <input type="radio" name="gender" value="Male" required="required"> Male
		<input type="radio" name="gender" value="Female" required="required"> Female
		<label>NRIC:</label><input type="text" name="ic" required="required" placeholder="999999-99-9999">		
		<label>Contact No:</label><input type="tel" name="contact" required="required" placeholder="xxx-xxxxxxx">
		<label>Email:</label><input type="email" name="email" required="required">
		<label>Address:</label> <textarea name="address" required="required"></textarea>
		<label>Date of Birth:</label><input type="text" name="dob" required="required" placeholder="YYYY-MM-DD">
		
		<br><br>

		<input type="submit" value="Submit" name="submit">
		<input type="reset" value="Reset">
		
		</form>
		
		<?php		
		if(isset($_POST['submit']) ? $_POST['submit'] : ''){
		$name = $_POST['name'];
		$gender = $_POST['gender'];
		$ic = $_POST['ic']; 
		$contact = $_POST['contact'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$dob = $_POST['dob'];

		$sql1 = "INSERT INTO staff (fid, name, gender, ic, contact, email, address, dob, password) VALUES('$fid', '$name', '$gender', '$ic', '$contact', '$email', '$address', '$dob', '$fid');";
		
		if (!mysqli_query($con, $sql1)){
		echo "<script>Swal.fire('Record is not updated!', 'There's something wrong with the database!', 'error')</script>";
		}
		else{
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Staff is registered successfully!',";
	    echo "icon: 'success'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.replace('RegTea.php');}})";
		echo "</script>";
		}
		mysqli_close($con);		
		}?>
		
				
		<style>
		h2{color:#0000CC;}
		form{ letter-spacing:0.5px; }
		
		label {
		display:block;
		font-weight: bold;
		margin-bottom: 10px;
		}

		input[type=text],[type=email],[type=tel]{
		height:30px;
		width: 350px;
		margin-bottom: 40px;
		}
		
		input[type=radio]{
		margin-left:30px;
		margin-bottom: 40px;
		}
			
		textarea{
		width:350px;
		height:100px;
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
