<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Search Attendance - ACE Tutor</title>
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
	<div class="header">Search Attendance</div>
	<div class="info">
		<div>
		<?php
		include 'conn.php';
		$Num = 1;
		if(isset($_POST['submit']) ? $_POST['submit'] : ''){
		$ClassID = $_POST['classID'];
		$Date = $_POST['date'];
		} else {
		$ClassID = $_GET['classID'];
		$Date = $_GET['date'];
		}
		$sql = "SELECT c.jid, a.time FROM attendance a INNER JOIN class c ON c.cid=a.cid WHERE a.CID = '$ClassID' AND a.date = '$Date' GROUP BY jid;";
		$result = mysqli_query($con, $sql);
       
       if (mysqli_num_rows($result) == 0){ //https://stackoverflow.com/questions/8417192/how-would-i-check-if-values-returned-from-an-sql-php-query-are-empty/8417230
        echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'No Results!',";
		echo "text: 'Please enter a valid class and date!',";
	    echo "icon: 'warning'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.href='Attendance_int.php';}})";
		echo "</script>";
       }
       else {
       while ($row = mysqli_fetch_array($result)){
       echo "<b><label>Class ID: ".$ClassID."</label></b><br><br>";		
       echo "<label>Subject ID: ".$row['jid']."</label><br><br>";
       echo "<label>Date: ".$Date." </label><br><br>";		
       echo "<label>Time: ".$row['time']."</label><br><br>";
       }
       
       $sql = "SELECT * FROM attendance INNER JOIN student ON student.SID = attendance.SID WHERE CID = '$ClassID' AND Date = '$Date';";
       $result = mysqli_query($con, $sql);

       echo "<table border=\"1\" style=\"text-align:center\">";
       echo "<tr>";
       echo "<th>No</th>";
       echo "<th>Name</th>";
	   echo "<th>Student ID</th>";
       echo "<th>Status</th>";
	   echo "<th>Edit</th>";
       echo "</tr>";
       
       while ($row = mysqli_fetch_array($result)){
       $sid = $row['SID'];
       echo "<tr>";
       echo "<td>";
       echo $Num;
       $Num +=1;
       echo "</td>";
        echo "<td>";
		echo $row['SID'];
	   echo "</td>";
       echo "<td>";
       echo $row['Name'];
       echo "</td>";
	   echo "<td>";
       echo $row['Status'];
       echo "</td>";
	   echo "<td><a href=edit_attendance.php?classID=$ClassID&date=$Date&sid=$sid>";
       echo "<i class='fas fa-pen'></i></a></td>";
       echo "</tr>";
       }
       echo "</table>";
       echo "<button id=\"btnDone\" onclick=\"window.location.href='Attendance_int.php'\">Done</button>";
       }
	   mysqli_close($con);
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
		
		select{
		height:25px;
		width: 450px;
		margin-bottom:100px;
		margin-left:150px;
		margin-right:60px;
		margin-top:20px;
		}
				
		#btnDone{
		background-color:#DFDFFF;
		height: 40px;
		width: 120px;
		font-weight:bold;
		font-size:medium;
		letter-spacing:1px;	
		margin-left:780px;
		margin-top:50px;
		}
		
		#btnBack{
		display:block;
		background-color:#DFDFFF;
		height: 40px;
		width: 120px;
		font-weight:bold;
		font-size:medium;
		letter-spacing:1px;	
		margin-top:50px;
		}
		</style>
		</div>		
		</div>
	</div>
</body>
</html>
