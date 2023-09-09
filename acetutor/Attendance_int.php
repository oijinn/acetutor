<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Attendance - ACE Tutor</title>
    <script type="text/javascript" src="acetutor.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="stylea.css" />
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
        <div class="header"> Attendance </div>
        <div class="info">
            <button id="markattendance" onclick="window.location.href='Mark_New_Attendance.php'"> +   Mark New Attendance</button>

             <form action="Modify_attendance_int.php" method="post">
             <h2>Search Existing Attendance</h2><br>
             <fieldset style="width:450px">     
             <label>Class ID: </label>
                    
             <?php 
             include("conn.php");
             $result = mysqli_query($con, "SELECT cid FROM class WHERE fid='$id';"); //only retrieve classID taught 
             echo "<select name=\"classID\">";
             echo "<option>-- Class ID --</option>";
		
			while($row = mysqli_fetch_array($result)){
			echo "<option>" .$row['cid']. "</option>";
			}
			
			echo "</select><br>";
			echo "<label>Date: </label>";
			echo "<select id=\"slcDate\" name=\"date\">";
			echo "<option>-- Date --</option>";
			
			//retrieve available date for the class chosen
			$result = mysqli_query($con, "SELECT a.date FROM attendance a INNER JOIN class c ON a.cid=c.cid WHERE fid='ST00001' GROUP BY date ORDER BY date ASC;");
	
			while($row = mysqli_fetch_array($result)){
			echo "<option>" .$row['date']. "</option>";
			}
	
			echo "</select>";
			echo "<input type=\"submit\" name=\"submit\" value=\"Search\"></form>";
			mysqli_close($con);
			?>
            </fieldset> </form>
            
            <style>		
            h2{
			margin-bottom:20px;
			}
			
			label {
			display:inline-block;
			font-weight: bold;
			margin-top: 30px;
			margin-left:50px;
			}
	
			select{
			height:28px;
			width: 205px;
			margin-left:20px;
			margin-top:10px;
			margin-bottom:40px;
			}
			
			#slcDate{
			margin-left:55px;
			}

            input[type=submit] {
            display:block;
            background-color: #DFDFFF;
            height: 35px;
            width: 150px;
            font-weight: bold;
            font-size: medium;
            letter-spacing: 1px;
            margin-left:150px;
            margin-top:30px;
            margin-bottom:50px;
            }
                    
	        #markattendance{
			background-color: #DFDFFF;
	        height: 50px;
	        width: 300px;
	        font-weight: bold;
			font-size: large;
	        letter-spacing: 1px;
	        margin-bottom:90px;
			margin-top:50px;
			}
	                    
	        </style>
        </div>
    </div>
</body>

</html>