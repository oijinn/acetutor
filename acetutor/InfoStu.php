<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Student Info - ACE Tutor</title>
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
	<div class="header"> Student Info </div>
	<div class="info">
		<div>
		<form action="InfoStu.php" method="post">
		<input type="text" name="searchkey" placeholder="Enter Student ID or IC">
		<input type="submit" value="Search">
		</form>
		
		<?php
       include("conn.php");
       $search = isset($_POST['searchkey']) ? $_POST['searchkey'] : '';
       
       if ($search == NULL){
       	echo "No search key";
       } else{
       $sql = "SELECT s.sid, s.name, s.gender, s.ic, s.contact, s.email, s.address, s.dob, p.parent_name, p.parent_contact, p.parent_email FROM student s INNER JOIN parent p ON s.SID = p.SID WHERE s.SID ='$search' OR s.ic='$search';";
       $result = mysqli_query($con, $sql);
       
       if (mysqli_num_rows($result) == 0){ //https://stackoverflow.com/questions/8417192/how-would-i-check-if-values-returned-from-an-sql-php-query-are-empty/8417230
       	echo "<script>Swal.fire('Invalid Student ID', '', 'error')</script>";
       }
       else {
       while ($row = mysqli_fetch_array($result)){
       echo "<table border=\"1\" style=\"text-align:center\">";
       echo "<tr>";
       echo "<th>ID</th>";
       echo "<th>Name</th>";
       echo "<th>Gender</th>";
       echo "<th>NRIC</th>";
       echo "<th>Contact</th>";
       echo "<th>Email</th>";
       echo "<th>Address</th>";
       echo "<th>D.O.B</th>";
       echo "<th>Parent Name</th>";
       echo "<th>Parent Contact</th>";
       echo "<th>Parent Email</th>";
       echo "<th>Edit</th>";
       echo "<th>Delete</th>";
       echo "</tr>";

       echo "<tr>";
       echo "<td>";
       echo $row['sid'];
       echo "</td>";
		echo "<td>";
       echo $row['name'];
       echo "</td>";
       echo "<td>";
       echo $row['gender'];
       echo "</td>";
       echo "<td>";
       echo $row['ic'];
       echo "</td>";
  	   echo "<td>";
       echo $row['contact'];
       echo "</td>";
       echo "<td>";
       echo $row['email'];
       echo "</td>";
       echo "<td>";
       echo $row['address'];
       echo "</td>";
       echo "<td>";
       echo $row['dob'];
       echo "</td>";
       echo "<td>";
       echo $row['parent_name'];
       echo "</td>";
       echo "<td>";
       echo $row['parent_contact'];
       echo "</td>";
       echo "<td>";
       echo $row['parent_email'];
       echo "</td>";
       echo "<td><a href=\"edit_stu.php\"><i class=\"fas fa-pen\"></i></a></td>";
       echo "<td><a onClick=\"Delete()\"><i class=\"fas fa-trash-alt\"></i></a></td></tr></table>";
       $_SESSION['id'] = $row['sid'];
       }
       }}
       mysqli_close($con);
       ?>
		
		<script>
			function Delete() {
		      Swal.fire({
			  title: 'Do you want to delete the student?',
			  icon: 'question',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			}).then((result) => {
			  if (result.isConfirmed) {
	  			window.location.href='delete_stu.php';
			  }
			})}
		</script>

		<style>
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
