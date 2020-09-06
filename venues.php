<html>

<head>
    <?php include("DBConnection.php")?>
    <link rel="stylesheet" href="style.css">
</head>

    <body>
        <div>
            <h1>Welcome to Free-Gigs, the Free Concert Website!</h1>
            <table>
                <tr>
                <td class="navbar">
                        <h5><em>Admin Area: </em></h5>
                        <h5><a href="./bands.php">Manage Bands</a></h5>
                        <h5><a href="venues.php">Manage Venues</a></h5>
                        <h5><a href="./concerts.php">Add Concert</a></h5>
                        <h5><a href="">Logout</a></h5>
                    </td>
                    <td>
                    <form action="">
                        <h3>Current Venues</h3>
                            <table>
                            <?php
                                $pos_query = "SELECT * FROM venue";
                                $pos_results = $db->query($pos_query);

                                for($i=0; $i < $pos_results->num_rows; $i++)
                                {
                                    echo '<tr>';
                                    $pos_row = $pos_results->fetch_assoc();
                                    $edit_venue = "UPDATE";

                                    echo '<td>'.$pos_row['venue_name'].'</td>';
                                    echo '<td><a href="editVenue.php"> Edit </a></td>';
                                    echo '<td><a href=" add delete band query here"> Delete </a></td>';
                                    echo '<tr>';
                                }
                            ?>
                            </table>

                            <h3>Add New Venue:</h3>
                            <p>Name:
                                <input type="text" name="newVenueName" id="">
                                <input type="button" value="Add Venue">
                            </p>
                        </td>
                    </form>
                </tr>
            </table>
        </div>
    </body>
</html>