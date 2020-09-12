<?php
	if (!isset($_SESSION['mobile_phone']))
	{
		header("Location: Login.php");
		exit;
	}
	elseif (isset($_SESSION['username']))
	{
		header("Location: ../Admin/Band/bands.php");
		exit;
	}
?>