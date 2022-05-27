<?php
	require "../db_connect.php";
	require "../message_display.php";
	require "verify_member.php";
	require "header_member.php";
?>

<html>
	<head>
		<title>Welcome</title>

		<link rel="stylesheet" type="text/css" href="../css/global_styles.css">
		<link rel="stylesheet" type="text/css" href="css/home_style.css">
		<link rel="stylesheet" type="text/css" href="../css/custom_radio_button_style.css">
		</head>
	<body >
		
		<div  id="allTheThings" >
			<a href="form.php">
				<input type="button" value=" Plot Update Service" >
			</a><br />
			<a href="pending_book_requests.php">
				<input type="button" value="Land Transfer" />
			</a><br />
		</div>
	</body>
</html>