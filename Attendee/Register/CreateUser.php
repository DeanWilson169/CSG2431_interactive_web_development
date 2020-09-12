<!DOCTYPE html>
<html>
<head>
</head>

<body>
<?php
	// connect to the database
	include('../../Database/DBConnection.php');
	
	//create short variable names from the data received from the form
	$firstname = $_POST['firstname'];
	$surname = $_POST['surname'];
	$mobile_phone = $_POST['mobile_phone'];
	$DOB = $_POST['DOB'];
	$password = $_POST['password']; 
	$confirmPassword = $_POST['confirmPassword'];
	
	$error_message = '';
	
	if (empty($firstname) || empty($surname) || empty($mobile_phone) || empty($DOB) || empty($password) || empty($confirmPassword))
	{
		$error_message = 'A field has been left blank.';
	}
	else if (!preg_match("/^\+\d{2}\s\d{3}\s\d{3}\s\d{3}$/", $mobile_phone))
	{
		$error_message = 'Mobile phone is the wrong format';
	}
	else if ($DOB > date("Y-m-d"))
	{
		$error_message = 'Date of birth is invalid';
	}
	elseif (strlen($password) < 5)
	{
		$error_message = 'Your password is not long enough.';
	}
	elseif ($password != $confirmPassword)
	{
		$error_message = 'Your passwords do not match.';
	}
	
	$mobile_stmt = $db->prepare("SELECT mobile_phone FROM attendee WHERE mobile_phone = ?");
	$mobile_stmt->bind_param('s', $mobile_phone);
	
	$mobile_stmt->execute();
	
	$mobile_results = $mobile_stmt->get_result();
	
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
		$insert_stmt = "INSERT INTO attendee VALUES (?, ?, ?, ?, ?)";
		$insert_stmt->bind_param('sssss', $mobile_phone, $firstname, $surname, $DOB, $password);
		
		$insert_stmt->execute();
		
		$insert_results = $insert_stmt->get_result();
		
		if ($results)
		{
			$_SESSION['mobile_phone'] = $mobile_phone;
			header('Location: ../Bookings/Bookings.php');
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
