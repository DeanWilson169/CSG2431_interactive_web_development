<?php 
    include("../../Database/DBConnection.php");
    include("../../Login/AdminCheck.php");

    $newVenueName = $_POST['newVenueName'];
    $querySelectVenue = $db->prepare('SELECT venue_name FROM venue WHERE venue_name=?');
    $querySelectVenue->bind_param('s', $newVenueName);
    $querySelectVenue->execute();
    $selectResults = $querySelectVenue->get_result();

    $venues =  $selectResults->fetch_assoc();
    if($venues['venue_name'] == $newVenueName)
    {
        ?>
        <script>
            alert('Band already in Database');
            window.location='./venues.php';
        </script>
        <?php
    }
    else{
        $queryInsertVenue = $db->prepare("INSERT INTO venue VALUES (NULL, ?)");
        $queryInsertVenue->bind_param('s', $newVenueName);
        $queryInsertVenue->execute();

        $insertResults = $queryInsertVenue->get_result();
        
        if($queryInsertVenue){
        ?>
            <script> alert('Venue Added to Database');
            window.location='./venues.php';
            </script>
        <?php 
        }
        else{
        ?>
            <script> alert('Error inserting details. Error message:\n<?php echo $db->error ?>');</script>
        <?php
        }
    }
?>