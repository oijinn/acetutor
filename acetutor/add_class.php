<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Class Assignation - ACE Tutor</title>
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
	<div class="header"> Assign New Class </div>
	<div class="info">
	
	<?php
		include("conn.php");
		$sql="SELECT cid FROM class ORDER BY cid DESC LIMIT 1;"; //https://stackoverflow.com/questions/3411092/how-do-i-fetch-the-last-record-in-a-mysql-database-table-using-php
		$result = mysqli_query($con, $sql);
		
		if (!$result){
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Something is wrong with the database!',";
	    echo "icon: 'warning'})";
		echo "</script>"; 
		} 
		else {
		while ($row = mysqli_fetch_array($result)){
		$latestID = (isset ($row['cid']) ? $row['cid'] : '');
		}
		
		// combine the integer element in array and convert to int
		
		$newid = intval($latestID[1]. $latestID[2]. $latestID[3]) + 1;

		if ($newid > 99 AND $newid <= 999){
		$cid = "C" . $newid; }
		else if ($newid > 9 AND $newid <= 99){
		$cid = "C0" . $newid; }
		else {
		$cid = "C00" . $newid; }
		} 
		
		?>

	<form action="add_class.php" method="post" id="frmClass">

		<label>Class ID:</label>   <input type="text" name="cid"     value=" <?php echo $cid; ?>">
		<label>Staff ID:</label>   <input type="text" name="fid"     required="required" placeholder="ST99999">
		<label>Subject ID:</label> <input type="text" name="jid"     required="required" placeholder="AA99-99">
		<label>Date:</label>       <input type="text" name="date"    required="required" placeholder="YYYY-MM-DD">
		<label>Time:</label>       <input type="text" name="time"    required="required" placeholder="00:00">
		<label>Venue:</label>      <input type="text" name="venue"   required="required">
		
		<br><br>

		<input type="submit" value="Update" name="update">
		<input type="reset" value="Reset">
		<button onclick="window.location.href='ClassAssign.php'">Cancel</button>

	</form>

<?php
		if(isset(  $_POST['update']) ? $_POST['update'] : ''){
		$fid =     $_POST['fid'];
		$jid =     $_POST['jid']; 
		$date =    $_POST['date'];
		$time =    $_POST['time'];
		$venue =   $_POST['venue'];
		
		$sql1="INSERT INTO class (cid, fid, jid, date, time, venue) VALUES('$cid', '$fid', '$jid', '$date', '$time', '$venue');";
		
		if (!mysqli_query($con, $sql1)){
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Invalid Staff ID or Subject ID!',";
	    echo "icon: 'warning'})";
		echo "</script>"; 
		}
		else{	
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Class record is added successfully!',";
	    echo "icon: 'success'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "document.getElementById(\"frmClass\").innerHTML = \"\";}})";
		echo "</script>";
			
		echo "<h2>Student List</h2><br>";		
		$sql2="SELECT s.sid, s.name, s.form, s.year FROM student s INNER JOIN student_subject ss ON ss.sid=s.sid WHERE ss.jid='$jid';";
		
		$result = mysqli_query($con, $sql2);
       
       if (mysqli_num_rows($result) == 0){ 
       echo "No Student Records<br><br>";
       echo "<button id=\"btnBack\" onclick=\"window.location.href='ClassAssign.php'\">Done</button>";
       }
       else {
       echo "<form action=\"add_class.php\" method=\"post\">";
       echo "<table border=\"1\" style=\"text-align:center\">";
       echo "<tr>";
       echo "<th> </th>";
       echo "<th>ID</th>";
       echo "<th>Name</th>";
       echo "<th>Form</th>";
       echo "<th>Year</th>";
       echo "</tr>";
       
       while ($row = mysqli_fetch_array($result)){
       echo "<tr>";
       echo "<td>";
       echo "<input type=\"checkbox\" name=\"students[]\" checked=\"checked\" value=\"" .$row['sid']. "\">";
       echo "</td>";
       echo "<td>";
       echo $row['sid'];
       echo "</td>";
		echo "<td>";
       echo $row['name'];
       echo "</td>";
       echo "<td>";
       echo $row['form'];
       echo "</td>";
       echo "<td>";
       echo $row['year'];
       echo "</td>";
       echo "</tr>";
       }
       echo "</table><br><br>";
		
		echo "<input type=\"submit\" value=\"Add Student\" name=\"submit\">";
		echo "<input type=\"reset\" value=\"Reset\">";
		echo "</form>";
		}}}
		
		if(isset($_POST['submit']) ? $_POST['submit'] : ''){
		$student = $_POST['students'];
						
		foreach ($student as $sid){
		
		$sql3="INSERT INTO student_class (cid, sid) VALUES('$latestID', '$sid');";
		
		if (!mysqli_query($con, $sql3)){
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Student is not added to class!',";
		echo "text: 'Please try again.',";
	    echo "icon: 'warning'})";
		echo "</script>"; 
		}
		}
		echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'Student is added to class successfully!',";
	    echo "icon: 'success'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.href='ClassAssign.php';}})";
		echo "</script>";	
		}
		mysqli_close($con);
?>		

		<style>
		label {
		display:block;
		font-weight: bold;
		margin-bottom: 10px;
		}

		input[type=text],select{
		height:30px;
		width: 350px;
		margin-bottom: 40px;
		}
							
		input[type=submit]{
		margin-right: 40px;
		background-color:#DFDFFF;
		height: 40px;
		width: 190px;
		font-weight:bold;
		font-size:large;
		text-transform:uppercase;	
		letter-spacing:2px;	
		}
		
		input[type=reset], button{
		margin-right: 40px;
		background-color:#DFDFFF;
		height: 40px;
		width: 120px;
		font-weight:bold;
		font-size:large;
		text-transform:uppercase;
		letter-spacing:2px;
		}
		
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
		</style>
	</div>
</div>
</body>

</html>
