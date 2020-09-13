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

    const ValidateBand = () => {
        const name = document.AddBandForm.newBandName.value;
        if(name == ''){
            alert('Please enter a band name');
            return false;
        }
        return true;
    }

    </script>
</head>

    <body class="body">
        <div  class="ContentBox">
            <h1 class="WebpageTitle">Welcome to Free-Gigs, the Free Concert Website!</h1>
            <div class="PageTable">
            <?php include("../navbar.php")?>
            <table>
                <tr>
                    <td>
                    <h3>Current Bands</h3>
                        <table class="bandsTable">
                        <form method="get">
                        <?php

                            $select_bands = "SELECT * FROM band";
                            $results = $db->query($select_bands);

                            for($i=0; $i < $results->num_rows; $i++)
                            {
                                echo '<tr>';
                                $band_row = $results->fetch_assoc();
                                echo '<td class="bandName">'.$band_row['band_name'].'</td>';
                                echo '<td><a href="editBand.php?band_id='.$band_row['band_id'].'"> Edit </a></td>';
                                echo '<td><a onClick="return confirmDelete();" href="deleteBand.php?band_id='.$band_row['band_id'].'"> Delete </a></td>';
                                echo '</tr>';
                            }
                        ?>
                        </form>
                        </table>
                    </td>
                </tr>
                
            </table>
            </div>
            <h3>Add New Band:</h3>
                <form name="AddBandForm" action="insertBand.php" method="post">
                <p>Name:
                    <input type="text" name="newBandName" id="newBandName">
                    <input type="submit" value="Add Band" onclick="return ValidateBand();">
                </p>
            </form>
        </div>

    </body>
</html>