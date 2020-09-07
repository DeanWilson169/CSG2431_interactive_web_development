<?php 
    include("DBConnection.php");

    $newVenueName = $_POST['newVenueName'];
    $queryVenue = "INSERT INTO venue VALUES (NULL, '$newVenueName')";

    $result = $db->query($queryVenue);
    
    if($result){
    ?>
        <script> alert('Venue Added to Database');</script>
        
    <?php 
        header('Location: venues.php');
    }
    else{
    ?>
        <script> alert('Error inserting details. Error message:\n<?php echo $db->error ?>');</script>
    <?php
    }
?>