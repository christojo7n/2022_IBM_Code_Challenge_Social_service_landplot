<?php
	require "../db_connect.php";
	require "../message_display.php";
	require "verify_member.php";
	require "header_member.php";
?>

<html>
	<head>
		<title>Applied Services</title>
		<link rel="stylesheet" type="text/css" href="../css/global_styles.css">
		<link rel="stylesheet" type="text/css" href="../css/custom_checkbox_style.css">
		<link rel="stylesheet" type="text/css" href="css/my_books_style.css">
	</head>
	<body>
	
		<?php
			$query = $con->prepare("SELECT  timestamp, req_id,fname,plotno FROM plot_updated WHERE username = ?;");
			$query->bind_param("s", $_SESSION['username']);
			$query->execute();
			$result = $query->get_result();
			$rows = mysqli_num_rows($result);
			if($rows == 0)
				echo "<h2 align='center'>No Sevices Requested</h2>";
			else
			{
				echo "<form class='cd-form' method='POST' action='#'>";
				echo "<legend>Approved</legend>";
				echo "<div class='success-message' id='success-message'>
						<p id='success'></p>
					</div>";
				echo "<div class='error-message' id='error-message'>
						<p id='error'></p>
					</div>";
				echo"<table width='100%' cellpadding='10' cellspacing='10'>
						<tr>
							
							<th>Time Stamp<hr></th>
							<th>Req ID<hr></th>
							<th>Fname<hr></th>
							<th>Plot NO.<hr></th>
							<th>Status<hr></th>
						</tr>";
						for($i=0; $i<$rows; $i++)
						{
							$row = mysqli_fetch_array($result);
							echo "<tr>";
							
							for($j=0; $j<4; $j++)
								echo "<td>".$row[$j]."</td>";
								echo "<td>Completed</td>";
							echo "</tr>";
							
						}
				echo "</table><br />";
				
				echo "</form>";
			}
			$query = $con->prepare("SELECT  timestamp, id,fname,plotno FROM plot_upd_req WHERE username = ?;");
			$query->bind_param("s", $_SESSION['username']);
			$query->execute();
			$result = $query->get_result();
			$rows = mysqli_num_rows($result);
			if($rows == 0)
				{
				echo "<form class='cd-form' method='POST' action='#'>";
				echo "<legend>Pending</legend>";
				echo "<h2 align='center'>No Sevices Requested</h2>";
				
				}
			else
			{
				echo "<form class='cd-form' method='POST' action='#'>";
				echo "<legend>Pending</legend>";
				echo "<div class='success-message' id='success-message'>
						<p id='success'></p>
					</div>";
				echo "<div class='error-message' id='error-message'>
						<p id='error'></p>
					</div>";
				echo"<table width='100%' cellpadding='10' cellspacing='10'>
						<tr>
							
							<th>Time Stamp<hr></th>
							<th>Req ID<hr></th>
							<th>Fname<hr></th>
							<th>Plot NO.<hr></th>
							<th>Status<hr></th>
						</tr>";
						for($i=0; $i<$rows; $i++)
						{
							$row = mysqli_fetch_array($result);
							echo "<tr>";
							
							for($j=0; $j<4; $j++)
								echo "<td>".$row[$j]."</td>";
								echo "<td>Pending</td>";
							echo "</tr>";
							
						}
				echo "</table><br />";
				
				echo "</form>";
			}
			/*
			if(isset($_POST['b_return']))
			{
				$books = 0;
				for($i=0; $i<$rows; $i++)
					if(isset($_POST['cb_book'.$i]))
					{
						$query = $con->prepare("SELECT due_date FROM book_issue_log WHERE member = ? AND book_isbn = ?;");
						$query->bind_param("ss", $_SESSION['username'], $_POST['cb_book'.$i]);
						$query->execute();
						$due_date = mysqli_fetch_array($query->get_result())[0];
						
						$query = $con->prepare("SELECT DATEDIFF(CURRENT_DATE, ?);");
						$query->bind_param("s", $due_date);
						$query->execute();
						$days = (int)mysqli_fetch_array($query->get_result())[0];
						
						$query = $con->prepare("DELETE FROM book_issue_log WHERE member = ? AND book_isbn = ?;");
						$query->bind_param("ss", $_SESSION['username'], $_POST['cb_book'.$i]);
						if(!$query->execute())
							die(error_without_field("ERROR: Couldn\'t cancel the service"));
						
						if($days > 0)
						{
							$penalty = 5*$days;
							$query = $con->prepare("SELECT price FROM book WHERE isbn = ?;");
							$query->bind_param("s", $_POST['cb_book'.$i]);
							$query->execute();
							$price = mysqli_fetch_array($query->get_result())[0];
							if($price < $penalty)
								$penalty = $price;
							$query = $con->prepare("UPDATE member SET balance = balance - ? WHERE username = ?;");
							$query->bind_param("ds", $penalty, $_SESSION['username']);
							$query->execute();
							echo '<script>
									document.getElementById("error").innerHTML += "A penalty of Rs. '.$penalty.' was charged for keeping book '.$_POST['cb_book'.$i].' for '.$days.' days after the due date.<br />";
									document.getElementById("error-message").style.display = "block";
								</script>';
						}
						$books++;
					}
				if($books > 0)
				{
					echo '<script>
							document.getElementById("success").innerHTML = "You have cancelled '.$books.' Sercices";
							document.getElementById("success-message").style.display = "block";
						</script>';
					$query = $con->prepare("SELECT balance FROM member WHERE username = ?;");
					$query->bind_param("s", $_SESSION['username']);
					$query->execute();
					
					$balance = (int)mysqli_fetch_array($query->get_result())[0];
					if($balance < 0)
						header("Location: ../logout.php");
				}
				else
					echo error_without_field("Please select a service to cancel");
			}
			*/
		?>
		
	</body>
</html>