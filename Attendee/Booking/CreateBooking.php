<?php
	include('../../Database/DBConnection.php');
	include('../../Login/AttendeeCheck.php');
?>

<!DOCTYPE html>
<html>
<head>
</head>

<body>
<?php
	$concert_id = $_GET['concert_id'];
	$today = date('Y-m-d');
	
	$error_message = '';
	
	$mobile_stmt = $db->prepare("SELECT * FROM booking WHERE mobile_phone = ? AND concert_id = ?");
	$mobile_stmt->bind_param('si', $_SESSION['mobile_phone'], $concert_id);
	$mobile_stmt->execute();
	
	$mobile_results = $mobile_stmt->get_result();	
	
	if ($mobile_results->num_rows > 0)
	{
		$error_message = 'You have already made a booking for this concert';
	}
	
	$time_stmt = $db->prepare("SELECT * FROM concert WHERE concert_id = ? AND concert_date > ?");
	$time_stmt->bind_param('is', $concert_id, $today);
	$time_stmt->execute();
	
	$time_results = $time_stmt->get_result();
	
	if ($time_results->num_rows == 0)
	{
		$error_message = 'It is too late to book this concert';
	}
	
	if ($error_message != '')
	{
		echo 'Error: '.$error_message.' <a href="javascript: history.back();">Go Back</a>.';
		echo '</body></html>';
		exit;
	}
	else
	{
		$insert_stmt = $db->prepare("INSERT INTO booking VALUES (NULL, ?, ?)");
		$insert_stmt->bind_param('si', $_SESSION['mobile_phone'], $concert_id);
		$insert_stmt->execute();
		
		$insert_results = $insert_stmt->get_result();
		
		if ($insert_stmt)
		{
			echo '<p>Booking has been made made</p>';
			echo '<p>Return to the bookings page <a href="Bookings.php">here</a></p>';
		}
		else
		{
			echo '<p>Error inserting details. Error message:</p>';
			echo '<p>'.$db->error.'</p>';
		}
	}
?>
</body>
</html>
