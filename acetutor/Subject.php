<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Subject - ACE Tutor</title>
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
	<div class="header"> Subject </div>
	<div class="info">
		<div class="addNew">
		
		<form action="Subject.php" method="post">
		<h2>Add New Subject</h2>
		<input type="submit" name="addSub" value="+">
		</form>
		<br><br><br><br>
		
		<?php
		if(isset($_POST['addSub']) ? $_POST['addSub'] : ''){
		header('Location: add_subject.php');
		}
		?>
		</div>
		
		<div>
		<h2>Existing Subject</h2>
		<form action="Subject.php" method="post">
		<input type="text" name="search" placeholder="Enter Subject ID or Name">
		<input type="submit" value="Search">
		</form>
		
		
		<?php
       include("conn.php");
       $search = isset($_POST['search']) ? $_POST['search'] : '';
       
       if ($search == NULL){
       	echo "No search key";
       } else{
       $sql = "SELECT jid, name, form, year FROM subject WHERE jid ='$search' OR name='$search';";
       $result = mysqli_query($con, $sql);
       $resultrow = mysqli_num_rows($result);
       
       if ($resultrow == 0){
       echo "<script>Swal.fire('Invalid Subject ID or Name', '', 'error')</script>";
       }
       else {
       echo "<table border=\"1\" style=\"text-align:center\">";
       echo "<tr>";
       echo "<th>ID</th>";
       echo "<th>Name</th>";
       echo "<th>Form</th>";
       echo "<th>Year</th>";
       echo "<th>Edit</th>";
       echo "<th>Delete</th>";
       echo "</tr>";
       
       while ($row = mysqli_fetch_array($result)){
       echo "<tr>";
       echo "<td>";
       echo $row['jid'];
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
       echo "<td><a href=\"edit_subject.php?id=";
       echo $row['jid'];
       echo "\"><i class=\"fas fa-pen\"></i></a></td>";
       echo "<td><a href=\"delete_subject.php?id=";
       echo $row['jid'];
       echo "\"><i class=\"fas fa-trash-alt\"></i></a></td></tr>";
       }
       echo "</table>";
       }}
       mysqli_close($con);
       ?>
       
		<style>
		.main .info .addNew h2{
		display:inline-block;
		}
		
		.main .info .addNew input{
		display:inline-block;
		margin-left:20px;
		width:35px;
		height:35px;
		}
		
		input[type=text]{
		height:25px;
		width: 450px;
		margin-bottom:100px;
		margin-left:150px;
		margin-right:60px;
		margin-top:20px;
		}
		
		input[type=submit] {
		background-color:#DFDFFF;
		height: 30px;
		width: 100px;
		font-weight:bold;
		font-size:medium;
		letter-spacing:1px;	
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
	</div>
</body>

</html>
