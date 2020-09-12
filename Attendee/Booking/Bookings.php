<?php 
	include('../../Database/DBConnection.php');
	include('../../Login/AttendeeCheck.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Booking page</title>
	<script>
		function confirmDelete()
		{
			return confirm('Are you sure you want to add/delete that entry?');
		}
	</script>
</head>

<body>
<form name="booking" method="get">
<table style="border: 1px solid black">
<tr style="background-color: #cccccc; border: 1px solid black">
  <td style="text-align: center; border: 1px solid black" colspan="2">Free-Gigs Bookings Page</td>
</tr>
<tr style="border: 1px solid black">
  <td style="border: 1px solid black; text-align: center;">
	You are logged in as
	<?php
		$att_query = "SELECT first_name, surname FROM attendee WHERE mobile_phone = '".$_SESSION['mobile_phone']."'";
		
		$att_results = $db->query($att_query);
		$att_row = $att_results->fetch_assoc();
		
		echo $att_row['first_name']." ".$att_row['surname'];
	?>
	</br>
	<a href="../../Login/logout.php">Log out</a>
  </td>
  <td style="border: 1px solid black">Upcomming Concerts:</br>
	<table>
	  <tr style="text-align: center;">
		<td>Date</td>
		<td>Venue</td>
		<td>Band</td>
	  </tr>
	<?php	
		$today = date("Y-m-d H:i:s");
		$book_link_check = true;
		
		$query_concerts = "SELECT * FROM concert AS c JOIN venue AS v ON c.venue_id = v.venue_id JOIN band as b ON c.band_id = b.band_id WHERE concert_date >= '$today'";
		$query_bookings = "SELECT * FROM booking AS b JOIN concert AS c ON b.concert_id = c.concert_id WHERE concert_date >= '$today' AND mobile_phone = '".$_SESSION['mobile_phone']."' ORDER BY concert_date";
		
		$results_concerts= $db->query($query_concerts);
		$results_bookings= $db->query($query_bookings);
		
		for ($i=0 ; $i < $results_concerts->num_rows ; $i++ )
		{
			$row_concerts = $results_concerts->fetch_assoc();
			
			echo '<tr style="text-align: center;">';
			echo '<td>';
			echo '&#8226 '.$row_concerts['concert_date'];
			echo '</td>';
			echo '<td>';
			echo $row_concerts['venue_name'];
			echo '</td>';
			echo '<td>';
			echo $row_concerts['band_name'];
			echo '</td>';
			for ($x=0 ; $x < $results_bookings->num_rows ; $x++ )
			{
				$row_bookings = $results_bookings->fetch_assoc();
				
				if ($row_concerts['concert_id'] == $row_bookings['concert_id'])
				{
					$book_link_check = false;
				}
			}
			
			if ($book_link_check)
			{
				echo '<td> <a href="CreateBooking.php?concert_id='.$row_concerts['concert_id'].'">Book</a></td>';
			}
			$book_link_check = true;
			echo '</tr>';
			$results_bookings->data_seek(0);
		}
		
		$book_query = "SELECT * FROM booking AS b RIGHT JOIN concert AS c ON b.concert_id = c.concert_id JOIN venue AS v ON c.venue_id = v.venue_id JOIN band ON c.band_id = band.band_id WHERE concert_date >= '$today' AND b.mobile_phone = '".$_SESSION['mobile_phone']."' ORDER BY concert_date";
		
		$book_results = $db->query($book_query);
		
		if ($book_results->num_rows > 0)
		{
			echo '<tr><td>Booked Concerts:</br></tr></td>';
		
			for ($x=0 ; $x < $book_results->num_rows ; $x++ )
			{
				$book_row = $book_results->fetch_assoc();
				
				echo '<tr>';
				echo '<td>';
				echo '&#8226 '.$book_row['concert_date'];
				echo '</td>';
				echo '<td>';
				echo $book_row['venue_name'];
				echo '</td>';
				echo '<td>';
				echo $book_row['band_name'];
				echo '</td>';
				echo '<td>';
				echo '<a href="CancelBooking.php?booking_id='.$book_row['booking_id'].'" onClick="return confirmDelete();">Cancel</a>';
				echo '</td>';
				echo '</tr>';
			}
		}
    ?>
  </td>
</tr>
</table>
</form>
</body>
</html>