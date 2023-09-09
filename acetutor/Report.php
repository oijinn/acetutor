<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Student Attendance Report - ACE Tutor</title>
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
	<div class="header"> Student Attendance Report </div>
	<div class="info">
		<div>
		<br><br>
		<form action="Report.php" method="post" id="frmReport">
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
		
		<label> Enter a Year:</label><input type="number" name="year" required="required" placeholder="Eg: 2021"><br>
		
		<label>Select a Form:</label><select name="form">
		<option value="">--- Form ---</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		</select>

		<input type="submit" value="Search" name="search">
		</form>
		
		
		<?php
       include("conn.php");
       if (isset($_POST['search']) ? $_POST['search'] : ''){
       
       echo "<script>document.getElementById(\"frmReport\").innerHTML = \"\";</script>";

       $month = $_POST['month'];
       $year = $_POST['year'];
       $form = $_POST['form'];
       
       $isLunarYear = $year % 4;      // check if year is lunar year
       $remainder = intVal($month) % 2;  // check if the month is odd or even
		
		if ($remainder == 1){
		$sql = "SELECT a.sid, s.name, COUNT(*) AS Total_Class, tblpre.presence AS Total_Presence, tbllate.late AS Total_Late FROM attendance a LEFT JOIN (SELECT a.sid,COUNT(*) AS late FROM attendance a INNER JOIN student s ON a.sid=s.sid INNER JOIN class c ON c.cid=a.CID WHERE a.STATUS='late' AND s.Form=$form AND a.date BETWEEN '$year-$month-01' AND '$year-$month-31' GROUP BY sid) AS tbllate ON a.SID=tbllate.sid INNER JOIN (SELECT a.sid,COUNT(*) AS presence FROM attendance a INNER JOIN student s ON a.sid=s.sid INNER JOIN class c ON c.cid=a.CID WHERE STATUS='present' AND s.Form=$form AND a.date BETWEEN '$year-$month-01' AND '$year-$month-31' GROUP BY sid) AS tblpre ON tblpre.SID=a.sid INNER JOIN student s ON s.SID=a.SID INNER JOIN class c ON c.cid=a.CID WHERE s.Form=$form AND a.date BETWEEN '$year-$month-01' AND '$year-$month-31' GROUP BY sid;";
        } else if ($remainder == 0 && $month == 2 && $isLunarYear == 0){
		$sql = "SELECT a.sid, s.name, COUNT(*) AS Total_Class, tblpre.presence AS Total_Presence, tbllate.late AS Total_Late FROM attendance a LEFT JOIN (SELECT a.sid,COUNT(*) AS late FROM attendance a INNER JOIN student s ON a.sid=s.sid INNER JOIN class c ON c.cid=a.CID WHERE a.STATUS='late' AND s.Form=$form AND a.date BETWEEN '$year-$month-01' AND '$year-$month-29' GROUP BY sid) AS tbllate ON a.SID=tbllate.sid INNER JOIN (SELECT a.sid,COUNT(*) AS presence FROM attendance a INNER JOIN student s ON a.sid=s.sid INNER JOIN class c ON c.cid=a.CID WHERE STATUS='present' AND s.Form=$form AND a.date BETWEEN '$year-$month-01' AND '$year-$month-29' GROUP BY sid) AS tblpre ON tblpre.SID=a.sid INNER JOIN student s ON s.SID=a.SID INNER JOIN class c ON c.cid=a.CID WHERE s.Form=$form AND a.date BETWEEN '$year-$month-01' AND '$year-$month-29' GROUP BY sid;";
     	} else if ($remainder == 0 && $month == 2){
		$sql = "SELECT a.sid, s.name, COUNT(*) AS Total_Class, tblpre.presence AS Total_Presence, tbllate.late AS Total_Late FROM attendance a LEFT JOIN (SELECT a.sid,COUNT(*) AS late FROM attendance a INNER JOIN student s ON a.sid=s.sid INNER JOIN class c ON c.cid=a.CID WHERE a.STATUS='late' AND s.Form=$form AND a.date BETWEEN '$year-$month-01' AND '$year-$month-28' GROUP BY sid) AS tbllate ON a.SID=tbllate.sid INNER JOIN (SELECT a.sid,COUNT(*) AS presence FROM attendance a INNER JOIN student s ON a.sid=s.sid INNER JOIN class c ON c.cid=a.CID WHERE STATUS='present' AND s.Form=$form AND a.date BETWEEN '$year-$month-01' AND '$year-$month-28' GROUP BY sid) AS tblpre ON tblpre.SID=a.sid INNER JOIN student s ON s.SID=a.SID INNER JOIN class c ON c.cid=a.CID WHERE s.Form=$form AND a.date BETWEEN '$year-$month-01' AND '$year-$month-28' GROUP BY sid;";
		} else{
		$sql = "SELECT a.sid, s.name, COUNT(*) AS Total_Class, tblpre.presence AS Total_Presence, tbllate.late AS Total_Late FROM attendance a LEFT JOIN (SELECT a.sid,COUNT(*) AS late FROM attendance a INNER JOIN student s ON a.sid=s.sid INNER JOIN class c ON c.cid=a.CID WHERE a.STATUS='late' AND s.Form=$form AND a.date BETWEEN '$year-$month-01' AND '$year-$month-30' GROUP BY sid) AS tbllate ON a.SID=tbllate.sid INNER JOIN (SELECT a.sid,COUNT(*) AS presence FROM attendance a INNER JOIN student s ON a.sid=s.sid INNER JOIN class c ON c.cid=a.CID WHERE STATUS='present' AND s.Form=$form AND a.date BETWEEN '$year-$month-01' AND '$year-$month-30' GROUP BY sid) AS tblpre ON tblpre.SID=a.sid INNER JOIN student s ON s.SID=a.SID INNER JOIN class c ON c.cid=a.CID WHERE s.Form=$form AND a.date BETWEEN '$year-$month-01' AND '$year-$month-30' GROUP BY sid;";
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
		echo "window.location.href='Report.php';}})";
		echo "</script>";
       }
       else {
       echo "<div class=\"Report\" style=\"border:thin solid black\">";
       echo "<h1>ACE TUTOR</h1>";
       echo "<h3>Student Attendance Report for Form $form in " .$month. " " . $year. "</h3><hr>";
		
		echo "<h4>Attendance Statistics of Each Student</h4>";
       echo "<table border=\"1\" style=\"text-align:center\">";
       echo "<tr>";
       echo "<th>ID</th>";
       echo "<th>Name</th>";
       echo "<th>Total Presence</th>";
       echo "<th>Total Absence</th>";
       echo "<th>Total Late</th>";
       echo "<th>Percentage Rate (%)</th>";
       echo "</tr>";
       
       while ($row = mysqli_fetch_array($result)){
       echo "<tr>";
       echo "<td>";
       echo $row['sid'];
       echo "</td>";
		echo "<td>";
       echo $row['name'];
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
		echo "<button id=\"btnCancel\" onclick=\"window.location.href='Report.php'\">Cancel</button>";
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
