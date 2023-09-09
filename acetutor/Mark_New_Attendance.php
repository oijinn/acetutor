<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>New Attendance - ACE Tutor</title>
    <script type="text/javascript" src="acetutor.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="stylea.css" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>

<div class="sidenav">
	<div class="sidebar" style="height: 768px">
	<h2>ACE Tutor</h2>
	
	<?php $id=$_SESSION['id']; $thisMonth = intVal(date("m")); $date=date("Y-m-d");?>
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
        <div class="header"> Mark New Attendance </div>
        <div class="info">                 
                 <form action="Mark_New_Attendance_int.php" method="post">       
                 	<br><br>             
                    <label for="ClassID">Class ID: </label><input type="text" name="classID" required="required" placeholder="Eg: C001"><br><br>
                    <label for="Date">Date:</label><input type="date" name="date" required="required" value="<?php echo $date; ?>"><br><br>
                    <label for="time">Time:</label><input type="text" name="time" required="required" placeholder="00:00"><br><br>
                    <input type="submit" name="submit" value="Mark Attendance">
 
                    </form>

                <style>                    
                    label {
					font-weight: bold;
					margin-left:80px;
					font-size:large;
					}

                    input[type=text]{
					height:25px;
					width: 260px;
					margin-left:20px;
					margin-bottom:40px;
					}

					
                    input[type=date]{
					height:25px;
					width: 260px;
					margin-left:56px;
					margin-bottom:40px;
					}
					
					
                    input[name=time]{
					height:25px;
					width: 260px;
					margin-left:56px;
					margin-bottom:40px;
					}

                    input[type=submit]{
                        background-color: #DFDFFF;
                        height: 35px;
                        width: 300px;
                        font-weight: bold;
                        font-size: medium;
                        letter-spacing: 1px;
                        margin-right:150px;
                        margin-left:120px;
                    }
        
                </style>
        </div>
    </div>
</body>

</html>