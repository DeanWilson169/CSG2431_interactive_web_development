<html>

<head>
    <?php 
    include("DBConnection.php");
    include("AdminCheck.php");
    ?>

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
                    <h3>Current Bands</h3>
                        <table>
                        <form method="get">
                        <?php

                            $select_bands = "SELECT * FROM band";
                            $results = $db->query($select_bands);

                            for($i=0; $i < $results->num_rows; $i++)
                            {
                                echo '<tr>';
                                $band_row = $results->fetch_assoc();
                                echo '<td>'.$band_row['band_name'].'</td>';
                                echo '<td><a href="editBand.php?band_id='.$band_row['band_id'].'"> Edit </a></td>';
                                echo '<td><a onClick="return confirmDelete();" href="deleteBand.php?band_id='.$band_row['band_id'].'"> Delete </a></td>';
                                echo '</tr>';
                            }
                        ?>
                        </form>
                        </table>

                        <h3>Add New Band:</h3>
                        <form action="insertBand.php" method="post">
                            <p>Name:
                                <input type="text" name="newBandName" id="newBandName">
                                <input type="submit" value="Add Band">
                            </p>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>