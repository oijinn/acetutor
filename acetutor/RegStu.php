<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Register Student - ACE Tutor</title>
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
			
		<?php
		include("conn.php");
		
		$sql="SELECT sid FROM student ORDER BY sid DESC LIMIT 1;"; //https://stackoverflow.com/questions/3411092/how-do-i-fetch-the-last-record-in-a-mysql-database-table-using-php
		$result = mysqli_query($con, $sql);
		
		if (!$result){
		echo "<script>Swal.fire('There's something wrong with the database!', 'Please try again', 'error')</script>";		
		} 
		else {
		while ($row = mysqli_fetch_array($result)){
		$latestID = (isset ($row['sid']) ? $row['sid'] : '');
		}
		
		// combine the integer element in array and convert to int
		
		$newid = intval($latestID[2]. $latestID[3]. $latestID[4].$latestID[5]. $latestID[6]) + 1;
				
		if ($newid > 9999 AND $newid < 99999){
		$sid = "TP" . $newid; }
		else if ($newid > 999 AND $newid <= 9999){
		$sid = "TP0" . $newid; }
		else if ($newid > 99 AND $newid <= 999){
		$sid = "TP00" . $newid; }
		else if ($newid > 9 AND $newid <= 99){
		$sid = "TP000" . $newid; }
		else {
		$sid = "TP0000" . $newid; }
		} 
		?>
		
			
		<form action="RegStu.php" method="post" id="frmStudent">
		<h2>Student</h2> <br>
		<label>Student ID:</label> <input type="text" name="sid" value=" <?php echo $sid; ?>">
		<label>Name:</label> <input type="text" name="name" required="required">
		<label>Gender:</label> <input type="radio" name="gender" value="Male" required="required"> Male
		<input type="radio" name="gender" value="Female" required="required"> Female		
		<label>NRIC:</label><input type="text" name="ic" required="required" placeholder="999999-99-9999">	
		<label>Contact No:</label><input type="tel" name="contact" required="required" placeholder="xxx-xxxxxxx">
		<label>Email:</label><input type="email" name="email" required="required">
		<label>Address:</label> <textarea name="address" required="required"></textarea>
		<label>Date of Birth:</label><input type="text" name="dob" required="required" placeholder="YYYY-MM-DD">
		
		<hr><br>
		
		<h2>Parent / Guardian</h2><br>
		
		<label>Name:</label><input type="text" name="parentname" required="required">
		<label>Contact No:</label><input type="tel" name="parentcontact" required="required" placeholder="xxx-xxxxxxx">		
		<label>Email:</label><input type="email" name="parentemail" required="required">
		<label>Relationship:</label><select name="relationship">
		<option value="">-- Please Select --</option>
		<option value="Father">Father</option>
		<option value="Mother">Mother</option>
		<option value="Guardian">Guardian</option>
		<option value="Other">Other</option>
		</select><hr><br>
		
		<label>Form:</label><input type="number" name="form" required="required" placeholder="Eg: 4">
		<label> For Year:</label><input type="number" name="year" required="required" placeholder="Eg: 2021">

		<br><br>

		<input type="submit" value="Next" name="next">
		<input type="reset" value="Reset">
		
		</form>

		<?php
		if(isset($_POST['next']) ? $_POST['next'] : ''){
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
		$form = $_POST['form'];
		$year = $_POST['year'];
		
		$sql1="INSERT INTO student (sid, name, gender, ic, contact, email, address, dob, form, year, password) VALUES('$sid', '$name', '$gender', '$ic', '$contact', '$email', '$address', '$dob', '$form', '$year', '$sid');";
		
		if (!mysqli_query($con, $sql1)){
		echo "<script>Swal.fire('Record is not updated!', 'There's something wrong with the database!', 'error')</script>";
		}
		
		$sql2="INSERT INTO parent (sid, Parent_name, Parent_contact, Parent_email, relationship) VALUES('$sid', '$parentName', '$parentContact', '$parentEmail', '$relationship');";
		
		if (!mysqli_query($con, $sql2)){
		echo "<script>Swal.fire('Record is not updated!', 'There's something wrong with the database!', 'error')</script>";
		}
		else{		
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Student is registered successfully!',";
	    echo "icon: 'success'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "document.getElementById(\"frmStudent\").innerHTML = \"\";}})";
		echo "</script>";
		
		echo "<h2>Subject</h2><br>";
		
		$sql2="SELECT jid, name FROM subject WHERE form='$form' AND year='$year';";
		
		$result = mysqli_query($con, $sql2);
       
       if (mysqli_num_rows($result) == 0){ 
       echo "No Results";
       }
       else {
       echo "<form action=\"RegStu.php\" method=\"post\">";
       echo "<table border=\"1\" style=\"text-align:center\">";
       echo "<tr>";
       echo "<th> </th>";
       echo "<th>ID</th>";
       echo "<th>Name</th>";
       echo "</tr>";
       
       while ($row = mysqli_fetch_array($result)){
       echo "<tr>";
       echo "<td>";
       echo "<input type=\"checkbox\" name=\"subjects[]\" value=\"" .$row['jid']. "\">";
       echo "</td>";
       echo "<td>";
       echo $row['jid'];
       echo "</td>";
		echo "<td>";
       echo $row['name'];
       echo "</td>";
       echo "</tr>";
       }
       echo "</table><br><br>";
		
		echo "<input type=\"submit\" value=\"Add Subject\" name=\"submit\">";
		echo "<input type=\"reset\" value=\"Reset\">";
		echo "</form>";
		}}}
		
		if(isset($_POST['submit']) ? $_POST['submit'] : ''){
		$subject = $_POST['subjects'];
						
		foreach ($subject as $jid){
		
		$sql3="INSERT INTO student_subject (sid, jid) VALUES('$latestID', '$jid');";
		
		if (!mysqli_query($con, $sql3)){
		echo "<script>Swal.fire('Record is not updated!', 'There's something wrong with the database!', 'error')</script>";
		}
		}
		
		mysqli_close($con);
		
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Subject is added successfully!',";
	    echo "icon: 'success'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.replace('RegStu.php');}})";
		echo "</script>";
		} ?>


		<style>
		h2 {color:#0000CC;}
		form { letter-spacing:0.5px; }
		form h2{ letter-spacing:0; }

		label {
		display:block;
		font-weight: bold;
		margin-bottom: 10px;
		}

		input[type=text],[type=email],[type=tel], [type=number], select{
		height:30px;
		width: 350px;
		margin-bottom: 40px;
		}
		
		input[type=radio], [type=checkbox]{
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
		
		table{
		width:500px;
		}
		
		table th{
		background-color:#CCCCCC;
		padding:10px;
		}
		
		table td{
		padding:10px;
		}
		</style>
	</div>
</div>
</body>

</html>
