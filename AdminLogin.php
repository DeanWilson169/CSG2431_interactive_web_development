<?php include('DBConnection.php')?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Login page</title>
	<script>
		function validateAdminLogIn()
		{
			if (start.username_txt.value == '')
			{
				alert('No mobile number has been entered');
				start.username_txt.focus();
				return false;
			}
			else if (start.username_txt.value.length > 10)
			{
				alert('Invalid username');
				start.username_txt.focus();
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
<form name="ALogin" method="post" onsubmit="return validateAdminLogIn();">
<table style="border: 1px solid black">
<tr style="background-color: #cccccc; border: 1px solid black">
	<td style="text-align: center; border: 1px solid black">Admin Login</td>
</tr>
<tr style="border: 1px solid black">
	<td style="border: 1px solid black; text-align: right;">
		Username: <input name="username" type="text" maxlength="15" /></br>
		Password: <input name="password" type="text" /></br>
		<input type="submit" name="AdminlogIn" value="Login"  /></br>
		<?php
			// if the "username" session variable is set and not empty, redirect to the menu page
			if (isset($_SESSION['username']) && $_SESSION['username'] != '' )
			{
				header('Location: bands.php');
				exit;
			}
			
			if (isset($_POST['username']) && isset($_POST['password']))
			{
				$username = $_POST['username'];
				$password = $_POST['password'];
				
				$query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
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
					$_SESSION['username'] = $login['username'];
					$_SESSION['password'] = $login['password'];
					header('Location: bands.php');
					exit;
				}
			}
		?>
		Return to the login page <a href="Login.php">here</a>.
	</td>
</tr>
</table>
</form>
</body>
</html>