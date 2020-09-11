<!DOCTYPE html>
<html>
<head>
</head>

<body>
<?php
	// connect to the database
	include('DBConnection.php');
	
	//create short variable names from the data received from the form
	$firstname = $_POST['firstname'];
	$surname = $_POST['surname'];
	$mobilePhone = $_POST['mobile_phone'];
	$DOB = $_POST['DOB'];
	$password = $_POST['password']; 
	$confirmPassword = $_POST['confirmPassword'];
	
	$error_message = '';
	
	if (empty($firstname) || empty($surname) || empty($mobilePhone) || empty($password) || empty($confirmPassword))
	{
		$error_message = 'A field has been left blank.';
	}
	elseif (strlen($password) < 5)
	{
		$error_message = 'Your password is not long enough.';
	}
	elseif ($password != $confirmPassword)
	{
		$error_message = 'Your passwords do not match.';
	}
	
	$mobile_query = "SELECT mobile_phone FROM attendee WHERE mobile_phone = '$mobilePhone'";
	$mobile_results = $db->query($mobile_query);	
	
	if ($mobile_results->num_rows > 0)
	{
		$error_message = 'An account is already linked with that mobile number.';
	}
	
	if ($error_message != '')
	{
		echo 'Error: '.$error_message.' <a href="javascript: history.back();">Go Back</a>.';
		echo '</body></html>';
		exit;
	}
	else
	{
		$query = "INSERT INTO attendee VALUES ('$mobilePhone', '$firstname', '$surname', '$DOB', '$password')";
		
		$result = $db->query($query);
		
		if ($result)
		{
			$_SESSION['mobile_phone'] = $mobilePhone;
			header('Location: Bookings.php');
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
