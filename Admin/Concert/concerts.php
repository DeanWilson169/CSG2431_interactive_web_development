<html>
<head>
    <?php include("../../Database/DBConnection.php");
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
    <script> 
    import navigationbar from "navigationBar"
    </script>
    <link rel="stylesheet" href="../.././style.css">
    <script>

    const ValidateDateTime = () => {

        const date = document.AddConcertForm.selectedDate.value;
        const time = document.AddConcertForm.selectedTime.value;
        const today = new Date();
        const day = today.getDate();
        let month = today.getMonth() + 1;
        const year = today.getFullYear();
        const hour = today.getHours();
        const minute = today.getMinutes();

        if(hour < 10){
            hour = "0" + hour;
        }
        if(minute < 10){
            minute = "0" + minute;
        }
        if (month < 10){
            month = "0" + month;
        }
        const todayDateFormatted = year + "-" + month + "-" + day;
        const todayTimeFormatted = hour + ":" + minute;
        console.log("Date: ");
        if(date < todayDateFormatted){
            alert("The entered Date has already passed");
            return false;
        }
        else if(date == todayDateFormatted && time < todayTimeFormatted){
            alert("The entered time has already passed");
            return false;
        }
        return true;
    }

    const ValidateForm = () => {

        if(ValidateDateTime()){
            return true;
        }
        return false;
    }
    </script>
</head>
    <body class="body">
    
        <div class="ContentBox">
            <h1 class="WebpageTitle">Welcome to Free-Gigs, the Free Concert Website!</h1>
            <div class="PageTable">
            <?php include("../navbar.php")?>
            <table>
                <tr>
                    <td>
                    <table class="concertTable">
                    <h3>Current Venues</h3>
                                <?php
                                    $pos_query = "SELECT concert_id, band.band_id, venue.venue_id, venue.venue_name, band.band_name, concert_date FROM ((concert INNER JOIN venue ON concert.venue_id = venue.venue_id) INNER JOIN band ON concert.band_id = band.band_id) ORDER BY concert_id";
                                    $pos_results = $db->query($pos_query);

                                    for($i=0; $i < $pos_results->num_rows; $i++)
                                    {
                                        echo '<tr>';
                                        $pos_row = $pos_results->fetch_assoc();
                                        $dateTime = DateTime::createFromFormat('YmdHi', $pos_row['concert_date']);

                                        echo '<td>'.$pos_row['band_name'].'</td>';
                                        echo '<td>'.$pos_row['venue_name'].'</td>';
                                        echo '<td>'.$pos_row['concert_date'].'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                   
                    </table>
                    </div>
                    <form name="AddConcertForm" action="insertConcert.php" method="post">
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
                            <?php 
                            $today = date("Y-m-d");
                            echo '<input type="date" name="selectedDate" id="selectedDate" min="'.$today.'" value="'.$today.'">';
                            
                             ?>
                            Time:
                            <?php 
                            $currentTime = date("H:i");
                            echo '<input type="time" name="selectedTime" id="selectedTime" value="'.$currentTime.'">';
                             ?>

                        </p>
                        
                        <input type="submit" value="Add Concert" onclick="return ValidateForm();">
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>