<?php
		if(session_id() == ''){
			session_start();
		}
		
		// connect to the database
		@ $db = new mysqli('localhost', 'root', '', 'concertplannerdb');
	
		if (mysqli_connect_error())
		{ //display the details of any connection errors
			echo 'Error connecting to database:<br />'.mysqli_connect_error();
			exit;
		}
?>