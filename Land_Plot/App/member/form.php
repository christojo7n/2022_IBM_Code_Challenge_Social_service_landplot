<?php
	require "../db_connect.php";
	require "../message_display.php";
	require "verify_member.php";
	require "header_member.php";
?>
<html>
	<head>
		<title>Register</title>
		<link rel="stylesheet" type="text/css" href="../css/global_styles.css">
		<link rel="stylesheet" type="text/css" href="../css/form_styles.css">
		<link rel="stylesheet" href="css/register_style.css">
	</head>
	<body>
		<form class="cd-form" method="POST" action="#">
			<legend>Enter your details</legend>
			
				<div class="error-message" id="error-message">
					<p id="error"></p>
				</div>
				
				<div class="icon">
					<input class="fnmae" type="text" name="fname" id="fname" placeholder="First Name" required />
				</div>
				
				<div class="icon">
					<input class="lname" type="text" name="lname" placeholder="Last Name" required />
				</div>
				
				<div class="icon">
					<input class="adhno" type="number" name="adhno" placeholder="Aadhaar No." required />
				</div>

				<div class="icon">
					<input class="phno" type="number" name="phno" placeholder="Phone Number" required />
				</div>
				
				<div class="icon">
					<input class="email" type="email" name="email" id="email" placeholder="Email" required />
				</div>
				
				<div class="icon">
					<input class="plotid" type="number" name="plotid" id="plotid" placeholder="Plot ID" required />
				</div>
				
				<br />
				<input type="submit" name="plot_upd_req" value="Register" />
		</form>
	</body>
	
	<?php
		if(isset($_POST['plot_upd_req']))
		{

			$query = $con->prepare("INSERT INTO plot_upd_req(username, fname, lname, email, adhno, phno , plotno) VALUES(?, ?, ?, ?, ?, ?, ?);");
			/*$query->bind_param("ssssd", $username, $row[1], $row[2], $row[3], $row[4]);*/

			/*$query = $con->prepare("INSERT INTO pending_registrations(username, password, name, email, balance) VALUES(?, ?, ?, ?, ?);");*/
			$query->bind_param("ssssddd", $_SESSION['username'], $_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['adhno'], $_POST['phno'], $_POST['plotid']); 
			if($query->execute())
				echo success("Successfully Registered");
			else
				echo error_without_field("Couldn\'t record details. Please try again later");
		}

			
	
	?>
	
</html>