<?php include('DBConnection.php');
	include('AttendeeCheck.php');

	$booking_id = $_GET['booking_id'];
	
	$delete = "DELETE FROM booking WHERE booking_id = '$booking_id'";
	
	$del_results = $db->query($delete);
	
	header('Location: Bookings.php');
?>