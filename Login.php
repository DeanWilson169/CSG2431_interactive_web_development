<?php include('DBConnection.php')?>
<!DOCTYPE html>
<html>
<head>
  <title>Login page</title>
  <script>
	function validateLogIn()
	{
		start = document.ULogin;
		
		if (start.mobile_phone.value == '')
		{
			alert('No mobile number has been entered');
			start.mobile_phone.focus();
			return false;
		}
		else if (start.mobile_phone.value.length < 10)
		{
			alert('Invalid phone number');
			start.mobile_phone.focus();
			return false;
		}
		else if (start.password_txt.value == '')
		{
			alert('Invalid password');
			start.password_txt.focus();
			return false;
		}
	}
  </script>
</head>

<body>
<form name="ULogin" method="post" onsubmit="return validateLogIn();">
<table style="border: 1px solid black">
<tr style="background-color: #cccccc; border: 1px solid black">
	<td style="text-align: center; border: 1px solid black" colspan="2">Welcome to Free-Gigs, the Free Concert Website</td>
</tr>
<tr style="border: 1px solid black">
	<td style="border: 1px solid black; text-align: right;">
		Mobile number: <input name="mobile_phone" type="text" maxlength="15" /></br>
		Password: <input name="password" type="text" /></br>
		<input type="submit" name="logIn" value="Login"  /></br>
		<?php
			// if the "mobile_phone" session variable is set and not empty, redirect to the menu page
			if (isset($_SESSION['mobile_phone']) && $_SESSION['mobile_phone'] != '' )
			{
				header('Location: Bookings.php');
				exit;
			}
			
			if (isset($_POST['mobile_phone']) && isset($_POST['password']))
			{
				$mobileNum = $_POST['mobile_phone'];
				$password = $_POST['password'];
				
				$query = "SELECT * FROM attendee WHERE mobile_phone = '$mobileNum' AND password = '$password'";
				$results = $db->query($query);
				
				if ($results->num_rows == 0)
				{
					echo '<div style="color: red;">Invalid login. Try again.</div>';
				}
				else
				{
					// log the user in
					$login = $results->fetch_assoc();
					
					// set session variables then redirect to menu page
					$_SESSION['mobile_phone'] = $login['mobile_phone'];
					$_SESSION['password'] = $login['password'];
					header('Location: Bookings.php');
					exit;
				}
			}
		?>
		Click <a href="Register.php">here</a> to register.</br>
		<a href="AdminLogin.php">Admin Login</a>
	</td>
	<td style="border: 1px solid black">Upcomming Concerts:</br>
	<ul style="margin: 0px">
	<?php
		$today = date("Y-m-d H:i:s");
		$pos_query = "SELECT * FROM concert JOIN venue ON concert.venue_id = venue.venue_id WHERE concert_date >= '$today' ORDER BY concert_date";
		$pos_results = $db->query($pos_query);
		
		for ($i=0 ; $i < $pos_results->num_rows ; $i++ )
		{
			$pos_row = $pos_results->fetch_assoc();
			echo '<li>'.$pos_row['concert_date'].', '.$pos_row['venue_name'].'</li>';
		}
    ?>
	</ul>
	</td>
</tr>
</table>
</form>
</body>
</html>