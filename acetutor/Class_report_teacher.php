<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Class Attendance Report - ACE Tutor</title>
<script type="text/javascript" src="acetutor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
	<div class="header">Class Attendance Report (Daily)</div>
	<div class="info">
		<?php 
		include("conn.php");
		$result = mysqli_query($con, "SELECT cid FROM class WHERE fid='$id';"); //only retrieve classID taught 
		
		if (mysqli_num_rows($result) == 0){
		echo "No Class Record";
       	} 
       	else {
       	echo "<form action=\"Class_report_teacher.php?id=" .$id. "\" method=\"post\" id=\"frmReport\">";
		echo "<br><br><label>Select a Class: </label>";
		echo "<select name=\"ClassID\">";
		echo "<option>-- Class ID --</option>";
		
		while($row = mysqli_fetch_array($result)){
		echo "<option>" .$row['cid']. "</option>";
		}
		
		echo "</select><br>";
		echo "<label>Select a Date: </label>";
		echo "<select id=\"slcDate\" name=\"Date\">";
		echo "<option>-- Date --</option>";
		
		//retrieve available date for the class chosen
		$result = mysqli_query($con, "SELECT a.date FROM attendance a INNER JOIN class c ON a.cid=c.cid WHERE fid='ST00001' GROUP BY date ORDER BY date ASC;");

		while($row = mysqli_fetch_array($result)){
		echo "<option>" .$row['date']. "</option>";
		}

		echo "</select>";
		echo "<input type=\"submit\" name=\"search\" value=\"Search\"></form>";
		}
		
		if (isset($_POST['search']) ? $_POST['search'] : ''){
			echo "<script>document.getElementById(\"frmReport\").innerHTML = \"\";</script>";
			$ClassID = $_POST['ClassID'];
			$Date = $_POST['Date'];
			$sql = "SELECT c.jid, s.name, a.time FROM staff s INNER JOIN class c ON c.FID =s.fid INNER JOIN attendance a ON a.cid=c.cid WHERE a.CID ='$ClassID' AND a.Date = '$Date' GROUP BY jid;";
		
		$result = mysqli_query($con, $sql);
       
       if (mysqli_num_rows($result) == 0){ 
        echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'No Results!',";
		echo "text: 'Please enter a valid month and year!',";
	    echo "icon: 'warning'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.href='Class_report_teacher.php';}})";
		echo "</script>";
       }
       else {
       echo "<div class=\"Report\" style=\"border:thin solid black\">";
       echo "<h1>ACE TUTOR</h1>";
       echo "<h3>Daily Class Attendance Report</h3><hr>";

       while ($row = mysqli_fetch_array($result)){
		echo "<b><label>Class ID: " . $ClassID . "</label></b><br><br>";
		echo "<b><label>Subject ID: " . $row['jid'] . "</label></b><br><br>";
		echo "<b><label>Staff Name: " . $row['name'] . "</label></b><br><br>";
		echo "<label>Date: " . $Date . " </label><br><br>";
		echo "<label>Time: " . $row['time']. "</label><br><br>";
		}
		
		$sql = "SELECT s.sid, s.name, a.status FROM attendance a INNER JOIN student s ON s.SID = a.SID WHERE a.CID = '$ClassID' AND a.Date = '$Date';";
		$result = mysqli_query($con, $sql);
		$Num = 1;

		echo "<table border=\"1\" style=\"text-align:center\">";
		echo "<tr>";
		echo "<th>No</th>";
		echo "<th>Student ID</th>";
		echo "<th>Name</th>";
		echo "<th>Status</th>";
		echo "</tr>";

		while ($row = mysqli_fetch_array($result)) {
		echo "<tr>";
		echo "<td>";
		echo $Num;
		$Num += 1;
		echo "</td>";
		echo "<td>";
		echo $row['sid'];
		echo "</td>";
		echo "<td>";
		echo $row['name'];
		echo "</td>";
		echo "<td>";
		echo $row['status'];
		echo "</td>";
		echo "</tr>";
		}
		echo "</table>";				
		echo "<br><br></div>";
		echo "<button id=\"btnCancel\" onclick=\"window.location.href='Class_report_teacher.php'\">Cancel</button>";
		echo "<button id=\"btnPrint\" onclick=\"print()\"><i class=\"fas fa-print\"></i></button>";
        }}
		mysqli_close($con);
		?>
	
		<style>		
		label {
		display:inline-block;
		font-weight: bold;
		margin-top: 10px;
		margin-left:50px;
		}

		select{
		height:28px;
		width: 205px;
		margin-left:30px;
		margin-top:10px;
		margin-bottom:40px;
		}
		
		#slcDate{
		margin-left:40px;
		}
		
		input[type=submit] {
		background-color:#DFDFFF;
		height: 30px;
		width: 100px;
		font-weight:bold;
		font-size:medium;
		letter-spacing:1px;	
		margin-left: 50px;
		}

		
		#btnCancel {
		 background-color: #DFDFFF;
         height: 35px;
         width: 150px;
         font-weight: bold;
         font-size: medium;
         letter-spacing: 1px;
		margin-left:100px;
		display:inline-block;
		}
		
		#btnBack {
		 background-color: #DFDFFF;
         height: 35px;
         width: 150px;
         font-weight: bold;
         font-size: medium;
         letter-spacing: 1px;
		}
		
		#btnPrint {
		width: 90px;
		color:white;
		background-color:#9966FF;
		font-weight:bold;
		font-size:medium;
		letter-spacing:1px;	
		margin-left:700px;
		}				
		
		table {
		width: 900px;
		margin-left:50px;
		margin-top:50px;
		}

		table th {
		background-color: #CCCCCC;
		padding: 10px;
		}

		table td {
		padding: 10px;
		}
		
		.Report{
		margin-left:100px;
		width:1000px;
		}
		
		.Report h1, h3 {
		text-align:center;
		}
		
		.Report hr{
		width:700px;
		}
		</style>
		</div>
	</div>
</body>
</html>
