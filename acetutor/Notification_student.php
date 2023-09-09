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
	<div class="header"> Notification </div>
	<div class="info">
		<select id="slcMonth" onchange="change()"> 
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
		window.location.href="Notification_student.php?&month=" + month;
		}
		</script>

		<h2>Absence Notification</h2> <br>
		<fieldset><br>
		
		<?php
		include("conn.php");
		
		$selectedMonth = intval($_GET['month']);	
		$thisYear = date("Y");
		$isLunarYear = $thisYear % 4;      // check if this year is lunar year
		$remainder = $selectedMonth % 2;  // check if the month is odd or even
		
		if ($remainder == 1){
		$sql = "SELECT date, time, cid FROM attendance WHERE status='absent' AND sid='$id' AND date BETWEEN '$thisYear-$selectedMonth-01' AND '$thisYear-$selectedMonth-31';";
        } else if ($remainder == 0 && $selectedMonth == 2 && $isLunarYear == 0){
		$sql = "SELECT date, time, cid FROM attendance WHERE status='absent' AND sid='$id' AND date BETWEEN '$thisYear-$selectedMonth-01' AND '$thisYear-$selectedMonth-29';";
     	} else if ($remainder == 0 && $selectedMonth == 2){
		$sql = "SELECT date, time, cid FROM attendance WHERE status='absent' AND sid='$id' AND date BETWEEN '$thisYear-$selectedMonth-01' AND '$thisYear-$selectedMonth-28';";
		} else{
		$sql = "SELECT date, time, cid FROM attendance WHERE status='absent' AND sid='$id' AND date BETWEEN '$thisYear-$selectedMonth-01' AND '$thisYear-$selectedMonth-30';";
		}
		
		$result = mysqli_query($con, $sql);
		if (mysqli_num_rows($result) == 0){ 
		echo "<label>No Absence Record.</label>";
		}
		else {
		while ($row = mysqli_fetch_array($result)){
		echo "<label>Date: " .$row['date']. "</label>";
		echo "<label>Time: " .$row['time']. "</label>";
		echo "<label>Class ID: " .$row['cid']. "</label>";
		echo "<label>Status: Absent</label>";
		}}
		mysqli_close($con);
		?>
		</fieldset>
		
		<br><hr><br>
		
		<h2>Report Notification</h2>
		<br>
		<fieldset><br>
		
		<?php
		if ($selectedMonth < $thisMonth){
		if ($remainder == 1){
		echo "<label>Monthly Attendance Report is generated.</label>";
		echo "<label>Report Period: 1-$selectedMonth-$thisYear to 31-$selectedMonth-$thisYear</label>";
		echo "<label>Remarks: Monthly attendance report</label>";
		} else if ($remainder == 0 && $selectedMonth == 2 && $isLunarYear == 0){
		echo "<label>Monthly Attendance Report is generated.</label>";
		echo "<label>Report Period: 1-$selectedMonth-$thisYear to 29-$selectedMonth-$thisYear</label>";
		echo "<label>Remarks: Monthly attendance report</label>";
		} else if ($remainder == 0 && $selectedMonth == 2){
		echo "<label>Monthly Attendance Report is generated.</label>";
		echo "<label>Report Period: 1-$selectedMonth-$thisYear to 28-$selectedMonth-$thisYear</label>";
		echo "<label>Remarks: Monthly attendance report</label>";
		} else {
		echo "<label>Monthly Attendance Report is generated.</label>";
		echo "<label>Report Period: 1-$selectedMonth-$thisYear to 30-$selectedMonth-$thisYear</label>";
		echo "<label>Remarks: Monthly attendance report</label>";
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
		margin-bottom: 20px;
		margin-left:10px;
		font-weight:bold;
		font-size:large;
		}
		
		button{
		 background-color: #DFDFFF;
         height: 35px;
         width: 250px;
         font-weight: bold;
         font-size: medium;
         letter-spacing: 1px;
		margin:10px;
		}

		</style>
</div>
</div>
</body>

</html>
