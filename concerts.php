<html>

<head>
    <?php include("DBConnection.php")?>
    <script> 
    import navigationbar from "navigationBar"
    </script>
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
                    <table>
                    
                    <h3>Current Venues</h3>
                                <?php
                                    $pos_query = "SELECT concert_id, band.band_id, venue.venue_id, venue.venue_name, band.band_name, concert_date FROM ((concert INNER JOIN venue ON concert.venue_id = venue.venue_id) INNER JOIN band ON concert.band_id = band.band_id) ORDER BY concert_id";
                                    $pos_results = $db->query($pos_query);

                                    for($i=0; $i < $pos_results->num_rows; $i++)
                                    {
                                        echo '<tr>';
                                        $pos_row = $pos_results->fetch_assoc();
                                        //TODO convert date to better format
                                        $dateTime = DateTime::createFromFormat('YmdHi', $pos_row['concert_date']);

                                        echo '<td>'.$pos_row['band_name'].'</td>';
                                        echo '<td>'.$pos_row['venue_name'].'</td>';
                                        echo '<td>'.$pos_row['concert_date'].'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                   
                    </table>
                    <form action="insertConcert.php" method="post">
                        <h3>Add Concert</h3>
                        <p>
                            Band:
                            <select name="selectedBand" id="selectedBand">
                            <?php
                                $queryBands = "SELECT * FROM band";
                                $resultsBands = $db->query($queryBands);

                                for($i=0; $i < $resultsBands->num_rows; $i++)
                                {
                                    $band = $resultsBands->fetch_assoc(); 
                                    echo '<option value="'.$band["band_id"].'">'.$band["band_name"].'</option>';
                                }
                            ?>
                            </select>
                        </p>
                        <p>
                        Venue:
                        <select name="selectedVenue" id="selectedVenue">
                            <?php
                                $queryVenues = "SELECT * FROM venue";
                                $resultsVenues = $db->query($queryVenues);

                                for($i=0; $i < $resultsVenues->num_rows; $i++)
                                {
                                    $venue = $resultsVenues->fetch_assoc();
                                
                                    echo '<option value="'.$venue["venue_id"].'">'.$venue["venue_name"].'</option>';
                                }
                            ?>
                        </select>
                        </p>
                        <p>
                            Date:
                            <input type="text" name="selectedDateTime" id="selectedDateTime"> 
                            (YYYY-MM-DD HH:MM format)
                        </p>
                        
                        <input type="submit" value="Add Concert">
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>