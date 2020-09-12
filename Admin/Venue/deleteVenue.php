<?php 
    include("../../Database/DBConnection.php");
    include("../../Login/AdminCheck.php");

    $venue_id = $_GET['venue_id'];


    $querySelectVenue = $db->prepare('SELECT venue.venue_id, concert.venue_id FROM venue INNER JOIN concert ON concert.venue_id = venue.venue_id WHERE venue.venue_id=? AND concert.venue_id=? ');
    $querySelectVenue->bind_param('ii', $venue_id, $venue_id);
    $querySelectVenue->execute();
    $selectResults = $querySelectVenue->get_result();

    $venues =  $selectResults->fetch_assoc();
    if($venues['venue_id'] == NULL)
    {
        $queryVenue = $db->prepare('DELETE FROM venue WHERE venue_id=?;');
        $queryVenue->bind_param('i', $venue_id);
        $queryVenue->execute();
        $selectResults = $queryVenue->get_result();
        if($queryVenue){
            ?>
            <script>
            alert('Venue successfully deleted!');
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
    else{
        ?>
        <script>
        alert('Venue cannot be deleted as there is a concert planned for it');
        window.location='./venues.php'
        </script>
        <?php
    }

    
?>