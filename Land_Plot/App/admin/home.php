<?php
	require "../db_connect.php";
	require "verify_admin.php";
	require "header_admin.php";
?>

<html>
	<head>
		<title>Welcome</title>
		<link rel="stylesheet" type="text/css" href="css/home_style.css" />
	</head>
	<body>
		<div id="allTheThings">
			<a href="pending_plot_req.php">
				<input type="button" value="Pending Plot Registrations" />
			</a><br />
			
		</div>
	</body>
</html>