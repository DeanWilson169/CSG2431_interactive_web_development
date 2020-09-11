<?php 
    include("DBConnection.php");
    include("AdminCheck.php");

    $selectedBand = $_POST['selectedBand'];
    $selectedVenue = $_POST['selectedVenue'];
    $selectedDateTime = $_POST['selectedDateTime'];
    $queryConcert = "INSERT INTO concert VALUES (NULL, '$selectedBand', '$selectedVenue', '$selectedDateTime')";

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

    header('Location: concerts.php');
?>
