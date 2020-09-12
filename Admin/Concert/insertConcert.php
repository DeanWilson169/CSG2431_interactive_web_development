<?php 
    include("../../Database/DBConnection.php");
    include("../../Login/AdminCheck.php");

    $selectedBand = $_POST['selectedBand'];
    $selectedVenue = $_POST['selectedVenue'];
    $selectedDate = $_POST['selectedDate'];
    $selectedTime = $_POST['selectedTime'];


    $selectedDateTime = $selectedDate.' '.$selectedTime;

    $queryConcert = $db->prepare("INSERT INTO concert VALUES (NULL, ?, ?, ?)");

    $queryConcert->bind_param('sss', $selectedBand, $selectedVenue, $selectedDateTime);
    $queryConcert->execute();

    $selectResults = $queryConcert->get_result();

    if($queryConcert){
        ?>
            <script> alert('Concert Added to Database');</script>
        <?php 
            header('Location: concerts.php');
        }
        else{
        ?>
            <script> alert('Error inserting details. Error message:\n<?php echo $db->error ?>');</script>
        <?php
        }

   
?>
