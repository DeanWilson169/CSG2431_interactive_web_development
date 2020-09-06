<?php 
    include("DBConnection.php");

    $newVenueName = $_POST['newVenueName'];
    $queryConcert = "INSERT INTO venue VALUES (NULL, '$newVenueName')";

    $result = $db->query($queryConcert);

    
    if($result){
        ?>
            <script> alert('Concert Added to Database');</script>
        <?php 
        }
        else{
        ?>
            <script> alert('Error inserting details. Error message:\n<?php echo $db->error ?>');</script>
           
        <?php
        }

    header('Location: venues.php');
?>
