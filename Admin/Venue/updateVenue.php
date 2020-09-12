<?php 
    include("../../Database/DBConnection.php");
    include("../../Login/AdminCheck.php");   
    
    $newVenueName = $_POST['newVenueName'];
    $venue_id = $_POST['venue_id'];


    $venue_select_query = $db->prepare('SELECT venue_name FROM venue WHERE venue_name=?');
    $venue_select_query->bind_param('s', $newVenueName);
    $venue_select_query->execute();
    $selectResults = $venue_select_query->get_result();

    $venues =  $selectResults->fetch_assoc();

    if($venues['venue_name'] == $newVenueName)
    {
        ?>
        <script>
            alert('Venue already in Database');
            window.location='./venues.php'
        </script>
        <?php
    }
    else{
        $queryVenue = $db->prepare('UPDATE venue SET venue_name=? WHERE venue_id=?');
        $queryVenue->bind_param('si', $newVenueName, $venue_id);
        $queryVenue->execute();
        $selectResults = $queryVenue->get_result();
        if($queryVenue){
            ?>
            <script>
            alert('Venue name successfully changed');
            window.location='./venues.php'
            </script>
            <?php
        }
        else{
            echo  'Error message: '.$db->error;
            ?>
            <script>
            alert('Error inserting details.');
            window.location='./venues.php'
            </script>
            <?php
        } 
    }


?>