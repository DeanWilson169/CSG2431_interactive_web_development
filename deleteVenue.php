<?php 
    include("DBConnection.php");

    $venue_id = $_GET['venue_id'];
    $queryVenue = 'DELETE FROM venue WHERE venue_id='.$venue_id.';';
    $result = $db->query($queryVenue);
    if($result){
        echo 'Venue name successfully changed';
        header('Location: venues.php');
    }
    else{
        echo 'Error inserting details. Error message: '.$db->error;
    }  
?>