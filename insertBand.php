<?php 
    include("DBConnection.php");
    include("AdminCheck.php");

    $newBandName = $_POST['newBandName'];
    $queryBand = "INSERT INTO band VALUES (NULL, '$newBandName')";

    $result = $db->query($queryBand);

    
    if($result){
        ?>
            <script> alert('Band Added to Database');</script>
        <?php
        header('Location: bands.php'); 
        }
        else{
        ?>
            <script> alert('Error inserting details. Error message:\n<?php echo $db->error ?>');</script>
           
        <?php
        }

?>
