<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Attendance - ACE Tutor</title>
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
	<div class="header"> Attendance </div>
	<div class="info">
	<div>
	<?php
	include("conn.php");
	
	echo "<button id=\"markattendance\" onclick=\"window.location.href='Enter_Digits.php'\">Mark Attendance</button>";
    
    $sql = "SELECT c.jid, s.name, st.name AS staff_name, COUNT(*) AS total_class, tblPre.presence FROM attendance a LEFT JOIN (SELECT COUNT(*) AS presence, cid FROM attendance WHERE status='Present' AND sid='$id' GROUP BY cid) AS tblPre ON a.cid=tblPre.cid INNER JOIN class c ON c.CID=a.CID INNER JOIN subject s ON s.JID=c.JID INNER JOIN staff st ON st.FID=c.FID WHERE sid = '$id' GROUP BY jid;";
    $result = mysqli_query($con,$sql);

	while($row = mysqli_fetch_array($result)){
	$percentage = number_format($row['presence']/$row['total_class']*100, 2);
	
	echo "<fieldset>";
	echo "<span><h3><strong>" .$row['name']. " (" .$row['jid']. ")</strong></h3><span>";
	echo "<span><label>Staff Name: " .$row['staff_name']."</label><span>";
	echo "<span><label>Total Class: " .$row['presence']."/" .$row['total_class']. "  <strong>($percentage%)</strong></label><span>";
	echo "</fieldset><br>";
	}
	mysqli_close($con); 
	?>
	
	</div>
	</div>
	
	<style type="text/css">
	h3{
	color:#3333CC;
	}
	
	button {
		display:block;
		text-align: center;
		background-color:#DFDFFF;
		height: 40px;
		width: 250px;
		font-weight:bold;
		font-size:medium;
		text-transform:uppercase;
		letter-spacing:2px;
		text-decoration:none;
		margin-bottom:50px;
		margin-top:50px;
	}

	fieldset{
	width:900px;
	border-style:solid;
	border-color:gray;
	}
	
	span {
	display:block;
	margin-top:30px;
	}	
	</style>

</div>
</body>

</html>
