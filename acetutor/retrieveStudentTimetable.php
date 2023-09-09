<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<body>
<div>
<?php
include "conn.php";
$output = "";

if(isset($_GET['weekday'])){
    $weekday = $_GET['weekday'];
    $id = $_SESSION['id'];
    $date=new DateTime($_GET['weekDate']);
    $selectedDate = $date->format('Y-m-d');
    $weekNextDate = date_add($date, date_interval_create_from_date_string("7 days"));
    $interval = 7-$weekday;
    $weekClassDate = date_add($weekNextDate,date_interval_create_from_date_string("-$interval days"));
    $weekClass = $weekClassDate->format('Y-m-d');
    $selectedNextDate = $weekNextDate->format('Y-m-d'); 

    $sql = "SELECT s.name, s.jid, c.cid, c.time, c.venue, st.name AS staff_name FROM class c INNER JOIN subject s ON c.jid=s.jid INNER JOIN student_class sc ON sc.cid=c.cid INNER JOIN staff st ON st.fid=c.fid WHERE sc.sid ='$id' AND WEEKDAY(Date)= '$weekday' AND Date >='$selectedDate' AND Date <='$selectedNextDate' ORDER BY time ASC;";
    $result = mysqli_query($con,$sql);
 
    echo $con->error;
    $rowCount = mysqli_num_rows($result);
    
    $output .= "<h4 style='font-size:x-large'><strong>$weekClass</strong></h4>";
    if ($rowCount == 0){
        $output .= "<hr>No Class Today!";
    } else {
        while ($row = $result->fetch_assoc()){
		$name = $row['name'];
		$jid = $row['jid'];
		$cid = $row['cid'];
		$time = $row['time'];
		$venue = $row['venue'];
		$stname = $row['staff_name'];
		$output .= "
		
		 <hr><br><label style='color:blue'><strong>$name ($jid)</strong></label><br><br> 
         <label>Class ID: $cid</label><br><br>             
         <label>Time: $time (2 hours)</label><br><br>            
         <label>Venue: $venue</label><br><br>  
         <label>Teacher: $stname</label><br>"; 
        }
    }
}

echo $output;
?>
		</div>
</body>
</html>
