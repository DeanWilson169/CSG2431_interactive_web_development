<?php include('DBConnection.php') ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1></h1>
<?php
	if (isset($_SESSION['mobile_phone']) || isset($_SESSION['username']))
	{
		$_SESSION = array();
		session_destroy();
	}
	header('Location: Login.php');
	exit;
?>
</body>
</html>