<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Edit Attendance - ACE Tutor</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
	<div class="header"> Edit Attendance </div>
	<div class="info">

    <?php
		include("conn.php");
		$classID = $_GET['classID'];
		$date = $_GET['date'];
		$sid = $_GET['sid'];

        $result = mysqli_query($con, "SELECT s.name, a.status FROM attendance a INNER JOIN student s ON s.SID = a.SID WHERE a.SID = '$sid' AND a.CID='$classID' AND a.date='$date';");
		echo $con->error;	
		while($row = mysqli_fetch_array($result)){
        echo "<form action=\"u_attendance.php\" method=\"post\">";
        echo "<label>Student ID:</label> <input type=\"text\" disabled name=\"studentID\" value='$sid'><br>";
        echo "<label>Name:</label> <input type=\"text\" disabled name=\"name\" value=\"" .$row['name']. "\"><br>";
 		echo"<label>Status:</label><select name='status'>";
 		
 		if ($row['status'] == "Present"){
        echo "<option value='Present' selected='selected'>Present</option>";
        echo "<option value='Absent'>Absent</option>";
        echo "<option value='Late'>Late</option>";
        } else if ($row['status'] == "Absent"){
        echo "<option value='Present'>Present</option>";
        echo "<option value='Absent' selected='selected'>Absent</option>";
        echo "<option value='Late'>Late</option>";
        } else if ($row['status'] == "Late"){
        echo "<option value='Present'>Present</option>";
        echo "<option value='Absent'>Absent</option>";
        echo "<option value='Late' selected='selected'>Late</option>";
        } else {
        echo "<option value='Present'>Present</option>";
        echo "<option value='Absent'>Absent</option>";
        echo "<option value='Late'>Late</option>";
		echo "<option value='Absent with Reason' selected='selected'>Absent with Reason</option>";
        }
        echo "</select>";
        }
        echo "<br><br>";

         echo "<input type=\"submit\" value=\"Update\" name=\"update\">";
         echo "<input type=\"submit\" value=\"Cancel\" name=\"cancel\">";
         echo "<input type=\"hidden\" value=\"$id\" name=\"id\">";
         echo "<input type=\"hidden\" value=\"$sid\" name=\"sid\">";
         echo "<input type=\"hidden\" value=\"$classID\" name=\"cid\">";
         echo "<input type=\"hidden\" value=\"$date\" name=\"date\">";
   		 echo "</form>";
         mysqli_close($con);
         ?>
         </div>
        
        <style>                    
        label {
        display:inline-block;
		font-weight: bold;
		margin-left:80px;
		font-size:large;
		}
		
		input[name=name] {
        height: 30px;
        width: 230px;
        margin-bottom: 50px;
        margin-left:50px;
        }
        
        input[name=studentID] {
        height: 30px;
        width: 230px;
        margin-bottom: 50px;
        margin-left:10px;
        }

        select {
        height: 30px;
        width: 230px;
        margin-bottom: 50px;
        margin-left:50px;
        }

        input[type=submit] ,#btnCancel {
        background-color: #DFDFFF;
        height: 35px;
        width: 150px;
        font-weight: bold;
        font-size: medium;
        letter-spacing: 1px;
        margin-left:80px;
        margin-right:20px;
        }
        </style>
</div>
</body>

</html>
