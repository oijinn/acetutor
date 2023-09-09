<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Student Monthly Attendance Report - ACE Tutor</title>
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
	<div class="header"> Student Monthly Attendance Report </div>
	<div class="info">
		<div>
		<?php 		
		echo "<form action=\"Student_Report.php\" method=\"post\" id=\"frmReport\">";
		?>
		<br><br>
		<label>Select a Month:</label><select name="month">
		<option value="">--- Month ---</option>
		<option value="01">January</option>
		<option value="02">February</option>
		<option value="03">March</option>
		<option value="04">April</option>
		<option value="05">May</option>
		<option value="06">June</option>
		<option value="07">July</option>
		<option value="08">August</option>
		<option value="09">September</option>
		<option value="10">October</option>
		<option value="11">November</option>
		<option value="12">December</option>
		</select><br>
		
		<label> Enter a Year:</label><input type="number" name="year" required="required" placeholder="Eg: 2021">
		
		<input type="submit" value="Search" name="search">

		<?php
		echo "<input type=\"hidden\" value=\"" .$id. "\" name=\"sid\">";
		echo "</form><br>";

       include("conn.php");
       if (isset($_POST['search']) ? $_POST['search'] : ''){
       
       echo "<script>document.getElementById(\"frmReport\").innerHTML = \"\";</script>";
       
       $month = $_POST['month'];
       $year = $_POST['year'];
       $sid = $_POST['sid'];
       
       $presence = 0;
       $late = 0;
       $absence = 0;
       $total = 0;
       
       $isLunarYear = $year % 4;      // check if year is lunar year
       $remainder = intVal($month) % 2;  // check if the month is odd or even
		
		if ($remainder == 1){
		$sql = "SELECT a.SID, a.CID, s.Name, a.Date, a.Time, a.Status, a.Reason FROM attendance a INNER JOIN student s ON s.sid=a.SID WHERE s.sid='$id'AND a.date BETWEEN '$year-$month-01' AND '$year-$month-31' ;";
        } else if ($remainder == 0 && $month == 2 && $isLunarYear == 0){
		$sql = "SELECT a.SID, a.CID, s.Name, a.Date, a.Time, a.Status, a.Reason FROM attendance a INNER JOIN student s ON s.sid=a.SID WHERE s.sid='$id'AND a.date BETWEEN '$year-$month-01' AND '$year-$month-29' ;";
     	} else if ($remainder == 0 && $month == 2){
     	$sql = "SELECT a.SID, a.CID, s.Name, a.Date, a.Time, a.Status, a.Reason FROM attendance a INNER JOIN student s ON s.sid=a.SID WHERE s.sid='$id'AND a.date BETWEEN '$year-$month-01' AND '$year-$month-28' ;";
		} else{
		$sql = "SELECT a.SID, a.CID, s.Name, a.Date, a.Time, a.Status, a.Reason FROM attendance a INNER JOIN student s ON s.sid=a.SID WHERE s.sid='$id'AND a.date BETWEEN '$year-$month-01' AND '$year-$month-30' ;";
		}
              
       $result = mysqli_query($con, $sql);
       
       if (mysqli_num_rows($result) == 0){ 
       echo "<script type=\"text/javascript\">";
		echo "Swal.fire({";
		echo "title: 'No Results!',";
		echo "text: 'Please enter a valid month and year!',";
	    echo "icon: 'warning'}).";
	    echo "then((result) => {";
	  	echo "if (result.isConfirmed) {";
		echo "window.location.href='Student_Report.php';}})";
		echo "</script>";
       }
       else {
       echo "<div class=\"Report\" style=\"border:thin solid black\">";
       echo "<h1>ACE TUTOR</h1>";
       echo "<h3>Student Monthly Attendance Report for " .$sid. " in " .$month. " " . $year. "</h3><hr>";

	   echo "<h4>Attendance Overview</h4>";
       echo "<table border=\"1\" style=\"text-align:center\">";
       echo "<tr>";
       echo "<th>Class ID</th>";
       echo "<th>Date</th>";
       echo "<th>Time</th>";
       echo "<th>Status</th>";
       echo "<th>Reason</th>";
       echo "</tr>";
       
       while ($row = mysqli_fetch_array($result)){
       
       $total++;                               //total class
       if ($row['Status'] == "Present"){
       $presence ++;                           //total presence
       } else if ($row['Status'] == "Late"){
       $late++;                                //total late
       } else {
       $absence++;                            //total absence
       }
       
       echo "<tr>";
       echo "<td>";
       echo $row['CID'];
       echo "</td>";
       echo "<td>";
       echo $row['Date'];
       echo "</td>";
       echo "<td>";
       echo $row['Time'];
       echo "</td>";       
	   echo "<td>";
       echo $row['Status'];
       echo "</td>";
       echo "<td>";
       echo $row['Reason'];
       echo "</td>";
       echo "</tr>";
       }
       echo "</table>";       
       echo "<br><br>";
       
       $percentage = $presence/$total*100;
       
       echo "<table border=\"1\" style=\"text-align:center\" id=\"tbl\">";
       echo "<tr><th>Total Class</th>";
       echo "<td>$total</td></tr>";
       echo "<tr><th>Total Presence</th>";
       echo "<td>$presence</td></tr>";
       echo "<tr><th>Total Absence</th>";
       echo "<td>$absence</td></tr>";
       echo "<tr><th>Total Late</th>";
       echo "<td>$late</td></tr>";
       echo "<tr><th>Percentage Rate (%)</th>";
       echo "<td><strong>" .number_format($percentage, 2). "</strong></td></tr>";
       echo "</table><br><br></div>";
       
       echo "<button id=\"btnCancel\" onclick=\"window.location.href='Student_Report.php'\">Cancel</button>";
       echo "<button id=\"btnPrint\" onclick=\"print()\"><i class=\"fas fa-print\"></i></button>";
       }}
       mysqli_close($con);
       ?>

		<style>
		table{
		width:900px;
		margin-left:40px;
		}
		
		table th{
		background-color:#CCCCCC;
		padding:10px;
		}
		
		table td{
		padding:10px;
		}
		
		#tbl{
		width:330px;
		margin-left:40px;
		}
		
		#tbl th{
		background-color:#DBDBDB;
		padding:10px;
		width:200px;
		}
		
		#tbl td{
		padding:10px;
		width:130px;
		}
		
		label {
		display:inline-block;
		font-weight: bold;
		margin-bottom: 10px;
		margin-left:50px;
		}

		select[name=month]{
		height:28px;
		width: 205px;
		margin-left:30px;
		margin-bottom:40px;
		}
		
		select[name=form]{
		height:28px;
		width: 205px;
		margin-left:39px;
		margin-bottom:40px;
		}

		input[type=number]{
		height:25px;
		width: 200px;
		margin-left:50px;
		margin-bottom:40px;
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
		
		.Report h4{
		margin-left:40px;
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
		</style>
		</div>		
		</div>
	</div>
</body>

</html>




