<html>
<head>
    <?php include("DBConnection.php");?>
    <?php include("AdminCheck.php"); ?>
    <script> 
    import navigationbar from "navigationBar"
    </script>
    <link rel="stylesheet" href="style.css">

    <script>

    const ValidateDate = () => {
        const date = document.AddConcertForm.selectedDate.value;
        const today = new Date();

        const day = today.getDate();
        let month = today.getMonth() + 1;
        const year = today.getFullYear();

        if (month < 10){
            month = "0" + month;
        }
        todayFormatted = year + "-" + month + "-" + day;

        if(date < todayFormatted){
            alert("Please enter a date in the future");
            return false;
        }
        return true;
    }

    const ValidateTime = () => {
        const time = document.AddConcertForm.selectedTime.value;
        const today = new Date();

        let hour = today.getHours();
        let minute = today.getMinutes();

        if(hour < 10){
            hour = "0" + hour;
        }
        if(minute < 10){
            minute = "0" + minute;
        }

        const todayFormatted = hour + ":" + minute;

        if(time < todayFormatted){
            alert("Please enter a time that is in the future");
            return false;
        }
        return true;
    }
    const ValidateForm = () => {
        if(ValidateDate() && ValidateTime()){
            return true
        }
        return false;
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
                    <table>
                    
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
                            echo '<input type="time" name="selectedTime" id="selectedTime" min="'.$currentTime.'" value="'.$currentTime.'">';
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