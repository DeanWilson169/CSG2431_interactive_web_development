<?php include('../Database/DBConnection.php')?>
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
  <link rel="stylesheet" href=".././style.css">
</head>

<body class="body">
	<div class="AttendeeBox">
<form name="ULogin" method="post" onsubmit="return validateLogIn();">
<table style="border: 1px solid black">
<tr style="background-color: #cccccc; border: 1px solid black">
	<td style="text-align: center; border: 1px solid black" colspan="2"><h1 class="WebpageTitle">Welcome to Free-Gigs, the Free Concert Website</h1></td>
</tr>
<tr style="border: 1px solid black">
	<td style="border: 1px solid black; text-align: right;">
		Mobile number: <input name="mobile_phone" type="text" maxlength="15" /></br>
		Password: <input name="password" type="password" /></br>
		<input type="submit" name="logIn" value="Login"  /></br>
		<?php
			// if the "mobile_phone" session variable is set and not empty, redirect to the menu page
			if (isset($_SESSION['mobile_phone']) && $_SESSION['mobile_phone'] != '' )
			{
				header('Location: ../Attendee/Booking/Bookings.php');
				exit;
			}
			
			if (isset($_POST['mobile_phone']) && isset($_POST['password']))
			{
				$mobile_phone = $_POST['mobile_phone'];
				$password = $_POST['password'];
				
				$stmt = $db->prepare("SELECT * FROM attendee WHERE mobile_phone = ? AND password = ?");
				$stmt->bind_param('ss', $mobile_phone, $password);
				$stmt->execute();
				
				$results = $stmt->get_result();
				
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
					header('Location: ../Attendee/Booking/Bookings.php');
					exit;
				}
			}
		?>
		Click <a href="../Attendee/Register/Register.php">here</a> to register.</br>
		<a href="AdminLogin.php">Admin Login</a>
	</td>
	<td style="border: 1px solid black"><h3>Upcoming Concerts:</h3>
	  <table>
		<tr>
		  <td style="text-align: center">Date</td>
		  <td style="text-align: center">Venue</td>
		  <td style="text-align: center">Band</td>
		</tr>
		<?php
			$today = date("Y-m-d H:i:s");
			$pos_query = "SELECT * FROM concert JOIN venue ON concert.venue_id = venue.venue_id JOIN band ON concert.band_id = band.band_id WHERE concert_date >= '$today' ORDER BY concert_date";
			$pos_results = $db->query($pos_query);
			
			for ($i=0 ; $i < $pos_results->num_rows ; $i++ )
			{
				$pos_row = $pos_results->fetch_assoc();
				echo '<tr>';
				echo '<td style="text-align: center">';
				echo '&#8226 '.$pos_row['concert_date'];
				echo '</td>';
				echo '<td style="text-align: center">';
				echo $pos_row['venue_name'];
				echo '</td>';
				echo '<td style="text-align: center">';
				echo $pos_row['band_name'];
				echo '</td>';
				echo '</tr>';
			}
		?>
	  </table>
	</td>
</tr>
</table>
</form>
</div>
</body>
</html>