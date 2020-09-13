<html>
<head>
    <?php 
    include("../../Database/DBConnection.php");
	if (!isset($_SESSION['username']))
	{
		header("Location: ../../Login/Login.php");
		exit;
	}
	elseif (isset($_SESSION['mobile_phone']))
	{
		header("Location: ../../Attendee/Booking/Bookings.php");
		exit;
	}
    ?>
    <link rel="stylesheet" href="../.././style.css">
    <script>
    const confirmDelete = () => {

        return confirm("Are you sure you want to delete this band");
    }
    </script>
</head>

    <body class="body">
        <div class="AttendeeBox">
            <h1 class="WebpageTitle">Welcome to Free-Gigs, the Free Concert Website!</h1>
            <div class="PageTable">
            <?php include("../navbar.php")?>
            <table>
                <tr>
                    <td>
                        <h3>Current Venues</h3>
                        <table class="bandsTable">
                        <form method="get">
                        <?php
                            $venue_query = "SELECT * FROM venue";
                            $venue_results = $db->query($venue_query);

                            for($i=0; $i < $venue_results->num_rows; $i++)
                            {
                                echo '<tr>';
                                $venue_row = $venue_results->fetch_assoc();
                                $edit_venue = "UPDATE";

                                echo '<td>'.$venue_row['venue_name'].'</td>';
                                echo '<td><a href="editVenue.php?venue_id='.$venue_row['venue_id'].'"> Edit </a></td>';
                                echo '<td><a onClick="return confirmDelete();" href="deleteVenue.php?venue_id='.$venue_row['venue_id'].'"> Delete </a></td>';
                                echo '<tr>';
                            }
                        ?>
                        </form>
                        </table>
                        </div>
                        <h3>Add New Venue:</h3>
                        <form action="insertVenue.php" method="post">
                            <p>Name:
                                <input type="text" name="newVenueName" id="newVenueName">
                                <input type="submit" value="Add Venue">
                            </p>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>