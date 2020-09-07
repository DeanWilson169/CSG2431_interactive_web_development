<html>
<head>
    <?php include("DBConnection.php")?>
    <link rel="stylesheet" href="style.css">
    <script>
    const confirmDelete = () => {

        return confirm("Are you sure you want to delete this band");
    }
    </script>
</head>

    <body>
        <div>
            <h1>Welcome to Free-Gigs, the Free Concert Website!</h1>
            <table>
                <tr>
                    <?php include("navbar.php")?>
                    <td>
                        <h3>Current Venues</h3>
                        <table>
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