<?php
	if (!isset($_SESSION['username']))
	{
		header("Location: Login.php");
		exit;
	}
	elseif (isset($_SESSION['mobile_phone']))
	{
		header("Location: ../Attendee/Booking/Bookings.php");
		exit;
	}
?>