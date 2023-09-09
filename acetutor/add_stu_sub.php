<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Add Student Subject - ACE Tutor</title>
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
	<div class="header"> Add New Student Subject</div>
	<div class="info">
		
		<?php
		$id = $_SESSION['id'];
				
		echo "<form action=\"update_stu_sub.php\" method=\"post\">";
		echo "<label>Student ID:</label> <input type=\"text\" name=\"id\" value=\"" .$id. "\">";
		echo "<label>Subject ID:</label> <input type=\"text\" name=\"jid\" placeholder=\"Eg: PH04-21\" required=\"required\">";
		echo "<br><br>";

		echo "<input type=\"submit\" value=\"Submit\" name=\"submit\">";
		echo "<input type=\"reset\" value=\"Reset\">";
		echo "<input type=\"button\" value=\"Cancel\" onclick=\"window.location.href = 'edit_stu.php'\">";
		echo "<input type=\"hidden\" name=\"sid\" value=\"" .$id. "\">";
		echo "</form>";
		?>

		
		<style>
		h2{color:#0000CC;}
		form{ letter-spacing:0.5px; }

		label {
		display:block;
		font-weight: bold;
		margin-bottom: 10px;
		}

		input[type=text],[type=number]{
		height:30px;
		width: 350px;
		margin-bottom: 40px;
		}
		
		input[type=reset], [type=submit],[type=button]{
		background-color:#DFDFFF;
		margin-right: 50px;
		height: 40px;
		width: 150px;
		font-weight:bold;
		font-size:medium;
		text-transform:uppercase;
		letter-spacing:2px;
		text-decoration:none;
		}

		</style>
	</div>
</div>
</body>

</html>
