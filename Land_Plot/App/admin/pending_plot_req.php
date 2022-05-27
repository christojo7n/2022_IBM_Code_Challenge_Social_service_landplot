<?php
	require "../db_connect.php";
	require "../message_display.php";
	require "verify_admin.php";
	require "header_admin.php";
?>

<html>
	<head>
		<title>Pending Plot Requests</title>
		<link rel="stylesheet" type="text/css" href="../css/global_styles.css">
		<link rel="stylesheet" type="text/css" href="../css/custom_checkbox_style.css">
		<link rel="stylesheet" type="text/css" href="css/pending_book_requests_style.css">
	</head>
	<body>
		<?php
			$query = $con->prepare("SELECT * FROM plot_upd_req;");
			$query->execute();
			$result = $query->get_result();;
			$rows = mysqli_num_rows($result);
			if($rows == 0)
				echo "<h2 align='center'>No requests pending</h2>";
			else
			{
				echo "<form class='cd-form' method='POST' action='#'>";
				echo "<legend>Pending Plot Update  requests</legend>";
				echo "<div class='error-message' id='error-message'>
						<p id='error'></p>
					</div>";
				echo "<table width='100%' cellpadding=10 cellspacing=10>
						<tr>
							<th></th>
							<th>Time Stamp<hr></th>
							<th>Req ID<hr></th>
							<th>Username<hr></th>
							<th>First Name<hr></th>
							<th>Last Name<hr></th>
							<th>Email<hr></th>
							<th>Aadhaar No.<hr></th>
							<th>Phone No<hr></th>
							<th>Plot ID<hr></th>
							
						</tr>";
				for($i=0; $i<$rows; $i++)
				{
					$row = mysqli_fetch_array($result);
					echo "<tr>";
					echo "<td>
							<label class='control control--checkbox'>
								<input type='checkbox' name='cb_".$i."' value='".$row[1]."' />
								<div class='control__indicator'></div>
							</label>
						</td>";
					for($j=0; $j<9; $j++)
						echo "<td>".$row[$j]."</td>";
					
					echo "</tr>";
				}
				echo "</table>";
				echo "<br /><br /><div style='float: right;'>";
				echo "<input type='submit' value='Reject selected' name='l_reject' />&nbsp;&nbsp;&nbsp;&nbsp;";
				echo "<input type='submit' value='Grant selected' name='l_grant'/>";
				echo "</div>";
				echo "</form>";
			}
			
			$header = 'From: <noreply@landdept.com>' . "\r\n";
			
			if(isset($_POST['l_grant']))
			{
				$requests = 0;
				for($i=0; $i<$rows; $i++)
				{
					if(isset($_POST['cb_'.$i]))
					{
						$request_id =  $_POST['cb_'.$i];
						$query = $con->prepare("SELECT id, fname, plotno ,username FROM plot_upd_req WHERE id = ?;");
						$query->bind_param("d", $request_id);
						$query->execute();
						$resultRow = mysqli_fetch_array($query->get_result());
						$name = $resultRow[1];
						$plno = $resultRow[2];
						$reqid =$resultRow[0];
						$user = $resultRow[3];
						$query = $con->prepare("INSERT INTO plot_updated(req_id, fname,plotno,username) VALUES(?, ?,?,?);");
						$query->bind_param("dsds",$reqid, $name, $plno,$user);
						if(!$query->execute())
							die(error_without_field("ERROR: Couldn\'t issue book"));
						$requests++;
						
						$query = $con->prepare("SELECT email FROM member WHERE username = ?;");
						$query->bind_param("s", $member);
						$query->execute();
						$to = mysqli_fetch_array($query->get_result());
						$subject = "Plot ".$reqid."Request Successfully issued";
						
						
						$message = "The LAND REQ '".$reqid."' with Plot NO ".$plno." has been Granted.";

						$query = $con->prepare("DELETE FROM plot_upd_req WHERE id = ?");
						$query->bind_param("d", $request_id);
						if(!$query->execute())
							die(error_without_field("ERROR: Couldn\'t delete values"));
						
						
						/*mail($to, $subject, $message, $header);*/
					}
				}
				if($requests > 0)
					echo success("Successfully granted ".$requests." requests");
				else
					echo error_without_field("No request selected");
			}
			
			if(isset($_POST['l_reject']))
			{
				$requests = 0;
				for($i=0; $i<$rows; $i++)
				{
					if(isset($_POST['cb_'.$i]))
					{
						$requests++;
						$request_id =  $_POST['cb_'.$i];
						
						$request_id =  $_POST['cb_'.$i];
						$query = $con->prepare("SELECT id, fname, plotno FROM plot_upd_req WHERE id = ?;");
						$query->bind_param("d", $request_id);
						$query->execute();
						$resultRow = mysqli_fetch_array($query->get_result());
						$name = $resultRow[1];
						$plno = $resultRow[2];
						$reqid =$resultRow[0];

						$subject = "Book issue rejected";
						
						$message = "Your request for Plot Updation '".$reqid."' with Plot ID ".$plno." has been rejected. You can request the book again or visit a librarian for further information.";
						
						$query = $con->prepare("DELETE FROM plot_upd_req WHERE id = ?");
						$query->bind_param("d", $request_id);
						if(!$query->execute())
							die(error_without_field("ERROR: Couldn\'t delete values"));
						
						
					}
				}
				if($requests > 0)
					echo success("Successfully deleted ".$requests." requests");
				else
					echo error_without_field("No request selected");
			}