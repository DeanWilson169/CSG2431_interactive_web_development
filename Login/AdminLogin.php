<?php include('../Database/DBConnection.php')?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href=".././style.css">
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

<body class="body">
	<div class="ContentBox">
<form name="ALogin" method="post" onsubmit="return validateAdminLogIn();">
<div class="box">
<h3>Admin Login</h3>
		<div class="AdminLoginForm">
			<div style="min-width: 250px; ">
				<div style="display: flex; justify-content: flex-end;">
					<div>Username: </div>
						<div><input name="username" type="text" maxlength="15" /></div>
					</div>
					<div style="display: flex; justify-content: flex-end;">
						<div>Password: </div>
						<div><input name="password" type="password" /></div>
					</div>
				</div>
				<input style=" margin: 10px 0px 8px 0px" type="submit" name="AdminlogIn" value="Login"  /></br>
			</div>
		<?php
			// if the "username" session variable is set and not empty, redirect to the menu page
			if (isset($_SESSION['username']) && $_SESSION['username'] != '' )
			{
				header('Location: ../Admin/Band/bands.php');
				exit;
			}
			
			if (isset($_POST['username']) && isset($_POST['password']))
			{
				$username = $_POST['username'];
				$password = $_POST['password'];
				
				$stmt = $db->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
				$stmt->bind_param('ss', $username, $password);
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
					$_SESSION['username'] = $login['username'];
					$_SESSION['password'] = $login['password'];
					header('Location: ../Admin/Band/bands.php');
					exit;
				}
			}
		?>
			<div style="text-align:center;">
			Return to the login page <a href="Login.php">here</a>.
			</div>
		<div>
</table>
</form>
</div>
</body>
</html>