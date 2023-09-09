<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Edit Student Details - ACE Tutor</title>
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
	<div class="header"> Edit User Info </div>
	<div class="info">
		<h2>Student</h2> <br>
		
		<?php
		include("conn.php");
		$id = $_SESSION['id'];
		$result = mysqli_query($con, "SELECT s.name, s.gender, s.ic, s.contact, s.email, s.address, s.dob, p.parent_name, p.parent_contact, p.parent_email, p.relationship,s.form, s.year FROM student s INNER JOIN parent p ON s.SID = p.SID WHERE s.SID ='$id';");
		
		while($row = mysqli_fetch_array($result)){
		
 		echo "<form action=\"update_stu.php\" method=\"post\">";
 		echo "<label>Student ID:</label> <input type=\"text\" disabled=\"disabled\" name=\"sid\" value=" .$id. ">";
		echo "<label>Name:</label> <input type=\"text\" name=\"name\" required=\"required\" value=\"" .$row['name']. "\">";
		echo "<label>Gender:</label>";
		
		if ($row['gender'] == "Male") {
		echo "<input type=\"radio\" name=\"gender\" value=\"Male\" required=\"required\" checked=\"checked\"> Male";
		echo "<input type=\"radio\" name=\"gender\" value=\"Female\" required=\"required\"> Female";
		} else {
		echo "<input type=\"radio\" name=\"gender\" value=\"Male\" required=\"required\"> Male";
		echo "<input type=\"radio\" name=\"gender\" value=\"Female\" required=\"required\" checked=\"checked\"> Female";
		}
		
		echo "<label>NRIC:</label><input type=\"text\" name=\"ic\" required=\"required\" value=" .$row['ic']. ">";		
		echo "<label>Contact No:</label><input type=\"tel\" name=\"contact\" required=\"required\" value=" .$row['contact']. ">";
		echo "<label>Email:</label><input type=\"email\" name=\"email\" required=\"required\" value=" .$row['email']. ">";	
		echo "<label>Address:</label> <textarea name=\"address\" required=\"required\">" .$row['address']. "</textarea>";
		echo "<label>Date of Birth:</label><input type=\"text\" name=\"dob\" required=\"required\" value=" .$row['dob']. ">";
		
		echo "<hr><br><h2>Parent / Guardian</h2><br>";
		
		echo "<label>Name:</label><input type=\"text\" name=\"parentname\" required=\"required\" value=\"" .$row['parent_name']. "\">";
		echo "<label>Contact No:</label><input type=\"tel\" name=\"parentcontact\" required=\"required\" value=" .$row['parent_contact']. ">";
		echo "<label>Email:</label><input type=\"email\" name=\"parentemail\" required=\"required\" value=" .$row['parent_email']. ">";
		echo "<label>Relationship:</label><select name=\"relationship\">";
		echo "<option value=\"\">-- Please Select --</option>";
		
		if ($row['relationship'] == "Father") {
		echo "<option value=\"Father\" selected=\"selected\">Father</option>";
		echo "<option value=\"Mother\">Mother</option>";
		echo "<option value=\"Guardian\">Guardian</option>";
		echo "<option value=\"Other\">Other</option>";
		} else if ($row['relationship'] == "Mother") {
		echo "<option value=\"Father\">Father</option>";
		echo "<option value=\"Mother\" selected=\"selected\">Mother</option>";
		echo "<option value=\"Guardian\">Guardian</option>";
		echo "<option value=\"Other\">Other</option>";
		} else if ($row['relationship'] == "Guardian") {
		echo "<option value=\"Father\">Father</option>";
		echo "<option value=\"Mother\">Mother</option>";
		echo "<option value=\"Guardian\" selected=\"selected\">Guardian</option>";
		echo "<option value=\"Other\">Other</option>";
		} else {
		echo "<option value=\"Father\">Father</option>";
		echo "<option value=\"Mother\">Mother</option>";
		echo "<option value=\"Guardian\">Guardian</option>";
		echo "<option value=\"Other\" selected=\"selected\">Other</option>";
		}
		
		echo "</select><hr><br>";
		echo "<label>Form:</label><input type=\"number\" name=\"form\" required=\"required\"  value=" .$row['form']. ">";
		echo "<label> For Year:</label><input type=\"number\" name=\"year\" required=\"required\"  value=" .$row['year']. ">";
		}
		
		$result = mysqli_query($con, "SELECT ss.jid, s.name, s.form, s.year FROM student_subject ss INNER JOIN subject s ON ss.jid=s.jid WHERE ss.sid ='$id';");
		
		echo "<label>Subject:</label><br><input type=\"button\" value=\"+ Add New\" onclick=\"window.location.href = 'add_stu_sub.php'\"><br>";
		echo "<table border=\"1\" style=\"text-align:center\">";
       echo "<tr>";
       echo "<th>Subject ID</th>";
       echo "<th>Name</th>";
       echo "<th>Form</th>";
       echo "<th>Year</th>";
       echo "<th>Delete</th>";
       echo "</tr>";

		while($row = mysqli_fetch_array($result)){
		$jid = $row['jid'];
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
       echo "<td><a href=\"delete_stu_sub.php?jid=$jid\"><i class=\"fas fa-trash-alt\"></i></a></td></tr>";
       }
		
		echo "</table>";		
		
		echo "<br><br><input type=\"submit\" value=\"Update\" name=\"update\">";
		echo "<input type=\"reset\" value=\"Reset\">";
		echo "<input type=\"submit\" value=\"Cancel\" name=\"cancel\">";
		echo "<input type=\"hidden\" name=\"id\" value=" .$id. ">";					
		echo "</form>";		
		
		mysqli_close($con); 
		?>

		<style>
		h2{color:#0000CC;}
		form{ letter-spacing:0.5px; }
		form h2{ letter-spacing:0; }

		label {
		display:block;
		font-weight: bold;
		margin-bottom: 10px;
		}

		input[type=text],[type=email],[type=tel], [type=number],select{
		height:30px;
		width: 350px;
		margin-bottom: 40px;
		}
		
		input[type=radio], [type=checkbox]{
		margin-left:30px;
		margin-bottom: 40px;
		}
			
		textarea{
		width:350px;
		height:100px;
		margin-bottom: 40px;
		}
		
		input[type=reset], [type=submit]{
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
		
		input[type=button]{
		background-color:#DFDFFF;
		margin-right: 50px;
		margin-bottom:30px;
		height: 40px;
		width: 250px;
		font-weight:bold;
		font-size:medium;
		text-transform:uppercase;
		letter-spacing:2px;
		text-decoration:none;
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
</body>

</html>
