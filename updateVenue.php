<?php 
    include("DBConnection.php");
    include("AdminCheck.php");

    $newVenueName = $_POST['newVenueName'];
    $venue_id = $_POST['venue_id'];
    $queryVenue = 'UPDATE venue SET venue_name="'.$newVenueName.'" WHERE venue_id='.$venue_id.';';
    $result = $db->query($queryVenue);
    if($result){
        echo 'Venue name successfully changed';
        header('Location: venues.php');
    }
    else{
        echo 'Error inserting details. Error message: '.$db->error;
    }  
?>