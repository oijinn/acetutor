<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Timetable - ACE Tutor</title>
<script type="text/javascript" src="acetutor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
	<div class="header"> Timetable </div>
	<div class="info">
		<div>
		
		<?php 
		$thisweek = date('Y-m-d', strtotime("monday -1 week")); //https://www.geeksforgeeks.org/how-to-get-first-day-of-week-in-php/
		$nextweek = date('Y-m-d', strtotime("monday 0 week"));
		
		
		echo "<select id='dateOption' name =\"Date\">";
		echo "<option value = \"$thisweek\">$thisweek</option>";
		echo "<option value = \"$nextweek\">$nextweek</option>";
		echo "</select>";
		?>
		<br>
		
		<div class="tab"> <!--https://www.w3schools.com/howto/howto_js_tabs.asp -->
		<button class="tablinks">Monday</button>
		<button class="tablinks">Tuesday</button>
		<button class="tablinks">Wednesday</button>
		<button class="tablinks">Thursday</button>
		<button class="tablinks">Friday</button>
		</div>		

		<div class="tabcontent">
		</div>
		
		<script>
		$(document).ready(function () {
			$('.tablinks').click(function () {
				$(".tabcontent").css("display", "block");
				var date = $("#dateOption").val();
				console.log(date);
				var weekday = $(this).text();
				var weekNum;
				switch (weekday) {
					case "Monday":
						weekNum = 0;
						break;
					case "Tuesday":
						weekNum = 1;
						break;
					case "Wednesday":
						weekNum = 2;
						break;
					case "Thursday":
						weekNum = 3;
						break;
					case "Friday":
						weekNum = 4;
						break;
					}
				$.ajax({
					type: "GET",
					url: "retrieveClassByDate.php",
					data: {
						weekday: weekNum,
						weekDate: date,
					},
					success: function (response) {
						$(".tabcontent").html(response)
					}
				});
			})
		});
		</script>

   
		<style>	
		
		select{
		height:28px;
		width: 205px;
		margin-bottom:40px;
		margin-top:30px;
		}

		.tab{
		overflow:hidden;
		border:1px solid #ccc;
		background-color: #f1f1f1;
		}	
		
		input{
		background-color: transparent;
		outline: none;
		border: none;
		}
		
		.tab button{
		background-color:inherit;
		float:left;
		border:none;
		outline:none;
		cursor:pointer;
		padding: 14px 16px;
		/*transition: 0.3s;*/
		font-size: 17px;
		}
		
		.tab button:hover {
		background-color: #ddd;
		}
		
		.tab button.active {
		background-color: #ccc;
		}
		
		.tabcontent {
		display: none;
		padding: 6px 12px;
		border: 1px solid #ccc;
		border-top: none;
		}
		</style>
		</div>	
		</div>
	</div>
</body>
</html>
