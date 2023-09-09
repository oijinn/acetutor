<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Change Password - ACE Tutor</title>
<script type="text/javascript" src="acetutor.js"></script>
</head>

<body>
		<h1>Change Password </h1>
		
		<form action="updatePassword.php" method="post">
		<?php $id=$_SESSION['id']; $user = $_GET['user'];?>
		
		<fieldset>
		<label>Username:</label> <input type="text" name="txtUsername"  required="required" value="<?php echo "$id"; ?>">
		<br><br>
		<label>Old Password:</label> <input type="password" name="oldPassword">
		<br><br>
		<label>New Password:</label> <input type="password" name="newPassword">
		<br><br>
		
		<input type="submit" value="Change Password" name="submit">
		<input type="hidden" value="<?php echo "$user"; ?>" name="user">
		</fieldset>
		</form>
				
		<style>
		body{
		background: #f3f5f9;
		}

		h1{
		margin-bottom:50px;
		margin-top:50px;
		margin-left:50px;
		}
		
		fieldset{
		width:650px;
		border-style:solid;
		border-color:gray;
		margin-left:50px;
		}

		
		form{ letter-spacing:0.5px; }
		
		label {
		display:inline-block;
		font-weight: bold;
		margin-bottom: 10px;
		margin-left:80px;
		font-size:19px;
		}

		input[type=text] {
		height:30px;
		width: 250px;
		margin-bottom: 40px;
		margin-top:40px;
		margin-left: 50px;
		font-size:19px;
		font-family: 'Source Sans Pro', sans-serif;
		}
		
		input[type=password]{
		height:30px;
		width: 250px;
		margin-bottom: 40px;
		margin-left: 20px;
		font-size:19px;
		font-family: 'Source Sans Pro', sans-serif;
		}
				
		input[type=submit] {
		margin-left: 200px;
		background-color:#DFDFFF;
		height: 40px;
		width: 250px;
		font-weight:bold;
		font-size:medium;
		text-transform:uppercase;	
		letter-spacing:2px;	
		margin-bottom:50px;
		}
		</style>

</body>

</html>
