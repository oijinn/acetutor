<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<body>
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
    
    $sql = "SELECT * FROM class c LEFT JOIN staff s ON c.FID = s.FID WHERE c.FID='$id' AND WEEKDAY(Date)= '$weekday' AND Date >='$selectedDate' AND Date <='$selectedNextDate' ORDER BY time ASC;";
    $result = mysqli_query($con,$sql);
    
    echo $con->error;
    $rowCount = mysqli_num_rows($result);
    
    $output .= "<h4><strong>$weekClass</strong></h4>";
    if ($rowCount == 0){
        $output .= "<hr>No Class Today!";
    } else {
        while ($row = $result->fetch_assoc()){
            $date = $row['Date'];
            $JID = $row['JID'];
            $time = $row['Time'];
            $CID = $row['CID'];
            $staffName = $row['Name'];
            $venue =  $row['Venue'];
            $output .= "
            
            <form action='Mark_New_Attendance_int.php?id=$id' method='POST'>     
            <hr><label style='color:blue'><strong>$JID</strong></label><br><br> 
            <label>Class ID: $CID</label> <br><br>             
            <label>Time: $time (2 hours)</label><br><br>   
            <label>Venue: $venue</label>       
                                    
            <input type='submit' value='Mark Attendance' name='submit'>
            <input readonly name='classID' type='hidden' value=$CID></input>
            <input readonly name ='date' type='hidden' value=$weekClass></input>
            <input readonly name ='time' type='hidden' value=$time></input></form>";
        }
    }
}

echo $output;
?>

		<style>
		h4{
		font-size:x-large;
		}
		
		label, input{
		font-size:18px;
		margin-bottom:20px;
		}
		
		input[type=submit] {
		background-color:#DFDFFF;
		height: 30px;
		width: 200px;
		font-weight:bold;
		font-size:medium;
		letter-spacing:1px;	
		margin-left:400px;
		border-style:solid;
		}

		</style>
	
</body>
</html>