<?php
	include('DBConnection.php');
	include('AttendeeCheck.php');
?>

<!DOCTYPE html>
<html>
<head>
</head>

<body>
<?php
	$concert_id = $_GET['concert_id'];
	
	$error_message = '';
	
	$mobile_query = "SELECT * FROM booking WHERE mobile_phone = '".$_SESSION['mobile_phone']."' AND concert_id = '$concert_id'";
	$mobile_results = $db->query($mobile_query);	
	
	if ($mobile_results->num_rows > 0)
	{
		$error_message = 'You have already made a booking for this concert';
	}
	
	if ($error_message != '')
	{
		echo 'Error: '.$error_message.' <a href="javascript: history.back();">Go Back</a>.';
		echo '</body></html>';
		exit;
	}
	else
	{
		$query = "INSERT INTO booking VALUES (NULL, '".$_SESSION['mobile_phone']."', '$concert_id')";
		
		$result = $db->query($query);
		
		if ($result)
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
