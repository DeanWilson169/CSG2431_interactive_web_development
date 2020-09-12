<?php include('../../Database/DBConnection.php');
	include('../../Login/AttendeeCheck.php');

	$booking_id = $_GET['booking_id'];
	$mobile_phone = $_SESSION['mobile_phone'];
	$today = date('Y-m-d');
	$base_stmt = "SELECT * FROM booking AS b JOIN concert AS c ON b.concert_id = c.concert_id JOIN attendee AS a ON b.mobile_phone = a.mobile_phone WHERE booking_id = ?";
	
	$booking_stmt = $db->prepare($base_stmt);
	$booking_stmt->bind_param('i', $booking_id);
	$booking_stmt->execute();
	$booking_stmt_results = $booking_stmt->get_result();
	
	$mobile_stmt = $db->prepare($base_stmt." AND b.mobile_phone = ?");
	$mobile_stmt->bind_param('is', $booking_id, $mobile_phone);
	$mobile_stmt->execute();
	$mobile_stmt_results = $mobile_stmt->get_result();
	
	$time_stmt = $db->prepare($base_stmt." AND b.mobile_phone = ? AND concert_date > ?");
	$time_stmt->bind_param('iss', $booking_id, $mobile_phone, $today);
	$time_stmt->execute();
	$time_stmt_results = $time_stmt->get_result();
	
	if ($booking_stmt_results->num_rows == 0)
	{
		echo 'No booking with this id exists <a href="javascript: history.back();">Go Back</a>.';
		exit;
	}
	else if ($mobile_stmt_results->num_rows == 0)
	{
		echo 'This booking was made by a different account <a href="javascript: history.back();">Go Back</a>.';
		exit;
	}
	else if ($time_stmt_results->num_rows == 0)
	{
		echo 'The booking you are trying to delete has already happened <a href="javascript: history.back();">Go Back</a>.';
		exit;
	}
	else
	{	
		$delete_stmt = $db->prepare("DELETE FROM booking WHERE booking_id = ?");
		$delete_stmt->bind_param('s', $booking_id);
		$delete_stmt->execute();
		$delete_stmt_results = $delete_stmt->get_result($delete);
	}
	
	header('Location: Bookings.php');
?>