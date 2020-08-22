<html>

<head>
    <source src="blegh.js"></source>
    <?php include("DBConnection.php")?>
</head>

    <body>
        <div>
            <h1>Welcome to Free-Gigs, the Free Concert Website!</h1>
            <table>
                <tr>
                    <td>
                        <h5><em>Admin Area: </em></h5>
                        <h5><a href="">Manage Bands</a></h5>
                        <h5><a href="">Manage Venues</a></h5>
                        <h5><a href="">Add Concert</a></h5>
                        <h5><a href="">Logout</a></h5>
                    </td>
                    <td>
                    <h3>Current Bands</h3>
                        <ul>
                        <?php

                            $pos_query = "SELECT * FROM band";
                            $pos_results = $db->query($pos_query);

                            for($i=0; $i < $pos_results->num_rows; $i++)
                            {
                                $pos_row = $pos_results->fetch_assoc();
                                
                                echo '<li>'.$pos_row['band_name'].' - <a href=" add edit band query here'.'">Edit</a> - <a href=" add delete band query here"> Delete</a></li>';
                            }
                        ?>
                        </ul>

                        <h3>Add New Band:</h3>
                        <p>Name:
                        <input type="text" name="addNewBand" id="">
                        <input type="button" value="Add Band">
                        </p>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>