<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Class Attendance Report - ACE Tutor</title>
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
	<div class="header">Class Attendance Report (Monthly) </div>
	<div class="info">
		<div>
		<?php 		
		echo "<form action=\"Monthly_Class_Report_Teacher.php\" method=\"post\" id=\"frmReport\">";
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
		echo "<input type=\"hidden\" value=\"" .$id. "\" name=\"fid\">";
		echo "</form><br>";

       include("conn.php");
       if (isset($_POST['search']) ? $_POST['search'] : ''){
       
       echo "<script>document.getElementById(\"frmReport\").innerHTML = \"\";</script>";
       
       $month = $_POST['month'];
       $year = $_POST['year'];
       $fid = $_POST['fid'];
       
       $isLunarYear = $year % 4;      // check if year is lunar year
       $remainder = intVal($month) % 2;  // check if the month is odd or even
		
		if ($remainder == 1){
		$sql = "SELECT c.CID, c.JID, s.Name,s.form, COUNT(*) AS Total_Class, tblpre.presence AS Total_Presence, tbllate.late AS Total_Late FROM attendance a INNER JOIN class c ON c.cid=a.CID LEFT JOIN (SELECT c.CID ,COUNT(*) AS late FROM attendance a INNER JOIN class c ON c.cid=a.CID INNER JOIN subject s ON s.JID=c.JID WHERE a.STATUS='late' AND c.fid='$fid' AND a.date BETWEEN '$year-$month-01' AND '$year-$month-31' GROUP BY cid) AS tbllate ON c.CID=tbllate.cid INNER JOIN (SELECT c.CID,COUNT(*) AS presence FROM attendance a INNER JOIN class c ON c.cid=a.CID INNER JOIN subject s ON s.JID=c.JID WHERE STATUS='present' AND c.fid='$fid' AND a.date BETWEEN '$year-$month-01' AND '$year-$month-31' GROUP BY cid) AS tblpre ON tblpre.cid=c.CID INNER JOIN subject s ON s.JID=c.JID WHERE c.fid='$fid' AND a.date BETWEEN '$year-$month-01' AND '$year-$month-31' GROUP BY cid ORDER BY form;";
        } else if ($remainder == 0 && $month == 2 && $isLunarYear == 0){
		$sql = "SELECT c.CID, c.JID, s.Name,s.form, COUNT(*) AS Total_Class, tblpre.presence AS Total_Presence, tbllate.late AS Total_Late FROM attendance a INNER JOIN class c ON c.cid=a.CID LEFT JOIN (SELECT c.CID ,COUNT(*) AS late FROM attendance a INNER JOIN class c ON c.cid=a.CID INNER JOIN subject s ON s.JID=c.JID WHERE a.STATUS='late' AND c.fid='$fid' AND a.date BETWEEN '$year-$month-01' AND '$year-$month-29' GROUP BY cid) AS tbllate ON c.CID=tbllate.cid INNER JOIN (SELECT c.CID,COUNT(*) AS presence FROM attendance a INNER JOIN class c ON c.cid=a.CID INNER JOIN subject s ON s.JID=c.JID WHERE STATUS='present' AND c.fid='$fid' AND a.date BETWEEN '$year-$month-01' AND '$year-$month-29' GROUP BY cid) AS tblpre ON tblpre.cid=c.CID INNER JOIN subject s ON s.JID=c.JID WHERE c.fid='$fid' AND a.date BETWEEN '$year-$month-01' AND '$year-$month-29' GROUP BY cid ORDER BY form;";
     	} else if ($remainder == 0 && $month == 2){
		$sql = "SELECT c.CID, c.JID, s.Name,s.form, COUNT(*) AS Total_Class, tblpre.presence AS Total_Presence, tbllate.late AS Total_Late FROM attendance a INNER JOIN class c ON c.cid=a.CID LEFT JOIN (SELECT c.CID ,COUNT(*) AS late FROM attendance a INNER JOIN class c ON c.cid=a.CID INNER JOIN subject s ON s.JID=c.JID WHERE a.STATUS='late' AND c.fid='$fid' AND a.date BETWEEN '$year-$month-01' AND '$year-$month-28' GROUP BY cid) AS tbllate ON c.CID=tbllate.cid INNER JOIN (SELECT c.CID,COUNT(*) AS presence FROM attendance a INNER JOIN class c ON c.cid=a.CID INNER JOIN subject s ON s.JID=c.JID WHERE STATUS='present' AND c.fid='$fid' AND a.date BETWEEN '$year-$month-01' AND '$year-$month-28' GROUP BY cid) AS tblpre ON tblpre.cid=c.CID INNER JOIN subject s ON s.JID=c.JID WHERE c.fid='$fid' AND a.date BETWEEN '$year-$month-01' AND '$year-$month-28' GROUP BY cid ORDER BY form;";
		} else{
		$sql = "SELECT c.CID, c.JID, s.Name,s.form, COUNT(*) AS Total_Class, tblpre.presence AS Total_Presence, tbllate.late AS Total_Late FROM attendance a INNER JOIN class c ON c.cid=a.CID LEFT JOIN (SELECT c.CID ,COUNT(*) AS late FROM attendance a INNER JOIN class c ON c.cid=a.CID INNER JOIN subject s ON s.JID=c.JID WHERE a.STATUS='late' AND c.fid='$fid' AND a.date BETWEEN '$year-$month-01' AND '$year-$month-30' GROUP BY cid) AS tbllate ON c.CID=tbllate.cid INNER JOIN (SELECT c.CID,COUNT(*) AS presence FROM attendance a INNER JOIN class c ON c.cid=a.CID INNER JOIN subject s ON s.JID=c.JID WHERE STATUS='present' AND c.fid='$fid' AND a.date BETWEEN '$year-$month-01' AND '$year-$month-30' GROUP BY cid) AS tblpre ON tblpre.cid=c.CID INNER JOIN subject s ON s.JID=c.JID WHERE c.fid='$fid' AND a.date BETWEEN '$year-$month-01' AND '$year-$month-30' GROUP BY cid ORDER BY form;";
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
		echo "window.location.href='Monthly_Class_Report_Teacher.php';}})";
		echo "</script>";
       }
       else {
       echo "<div class=\"Report\" style=\"border:thin solid black\">";
       echo "<h1>ACE TUTOR</h1>";
       echo "<h3>Class Attendance Report for " .$month. " " . $year. "</h3><hr>";
		
		echo "<h4>Attendance Statistics of Each Class</h4>";
       echo "<table border=\"1\" style=\"text-align:center\">";
       echo "<tr>";
       echo "<th>Class ID</th>";
       echo "<th>Subject ID</th>";
       echo "<th>Subject Name</th>";
       echo "<th>Form</th>";
       echo "<th>Total Presence</th>";
       echo "<th>Total Absence</th>";
       echo "<th>Total Late</th>";
       echo "<th>Percentage Rate (%)</th>";
       echo "</tr>";
       
       while ($row = mysqli_fetch_array($result)){
       echo "<tr>";
       echo "<td>";
       echo $row['CID'];
       echo "</td>";
       echo "<td>";
       echo $row['JID'];
       echo "</td>";
       echo "<td>";
       echo $row['Name'];
       echo "</td>";
       echo "<td>";
       echo $row['form'];
       echo "</td>";
       echo "<td>";
       echo $row['Total_Presence'];
       echo "</td>";
       echo "<td>";
       echo intval($row['Total_Class']) - intval($row['Total_Presence']) - intval($row['Total_Late']);
       echo "</td>";
       echo "<td>";
       echo intval($row['Total_Late']);
       echo "</td>";
  	   echo "<td>";
       echo number_format(intval($row['Total_Presence'])/intval($row['Total_Class'])*100, 2);
       echo "</td>";
       echo "</tr>";
       }
       echo "</table>";       
      	echo "<br><br></div>";
		echo "<button id=\"btnCancel\" onclick=\"window.location.href='Monthly_Class_Report_Teacher.php'\">Cancel</button>";
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