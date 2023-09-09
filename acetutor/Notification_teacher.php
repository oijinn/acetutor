<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Notification - ACE Tutor</title>
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
	<div class="header"> Notification </div>
	<div class="info">	
		<select id="slcMonth" onchange="change()">  <!--https://www.w3schools.com/jsref/event_onchange.asp-->
		<option value="" selected="selected">--- Month ---</option>
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
		
		<script>
		function change(){
		var month = document.getElementById("slcMonth").value;
		window.location.href="Notification_teacher.php?month=" + month;
		}
		</script>
		
		<h2>Report Notification</h2>
		<br>
		<fieldset><br>
		<?php
		$selectedMonth = intval($_GET['month']);	
		$thisYear = date("Y");
		$isLunarYear = $thisYear % 4;      // check if this year is lunar year
		$remainder = $selectedMonth % 2;  // check if the month is odd or even
		
		if ($selectedMonth < $thisMonth){
		if ($remainder == 1){
		echo "<label>Monthly Class Attendance Report is generated.</label>";
		echo "<label>Report Period: 1-$selectedMonth-$thisYear to 31-$selectedMonth-$thisYear</label>";
		echo "<label>Remarks: Class attendance report</label>";
		} else if ($remainder == 0 && $selectedMonth == 2 && $isLunarYear == 0){
		echo "<label>Monthly Class Attendance Report is generated.</label>";
		echo "<label>Report Period: 1-$selectedMonth-$thisYear to 29-$selectedMonth-$thisYear</label>";
		echo "<label>Remarks: Class attendance report</label>";
		} else if ($remainder == 0 && $selectedMonth == 2){
		echo "<label>Monthly Class Attendance Report is generated.</label>";
		echo "<label>Report Period: 1-$selectedMonth-$thisYear to 28-$selectedMonth-$thisYear</label>";
		echo "<label>Remarks: Class attendance report</label>";
		} else {
		echo "<label>Monthly Class Attendance Report is generated.</label>";
		echo "<label>Report Period: 1-$selectedMonth-$thisYear to 30-$selectedMonth-$thisYear</label>";
		echo "<label>Remarks: Class attendance report</label>";
		}
		} else {
		echo "<label>No Report Record.</label>";
		}
		?>
		</fieldset>
	
		<style>
		h2 {color:#0000CC;}
		
		fieldset{
		width: 500px;
		border-style:groove;
		}
		
		select{
		height:28px;
		width: 205px;
		margin-bottom:40px;
		margin-top:30px;
		}

		label {
		display:block;
		margin-bottom: 30px;
		margin-left:30px;
		font-weight:bold;
		font-size:large;
		}
		</style>
		</div>		
		</div>
</body>

</html>