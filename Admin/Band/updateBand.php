<?php 
    include("../../Database/DBConnection.php");
    include("../../Login/AdminCheck.php");

    $newBandName = $_POST['newBandName'];
    $band_id = $_POST['band_id'];


    $querySelectBand = $db->prepare('SELECT band_name FROM band WHERE band_name=?');
    $querySelectBand->bind_param('s', $newBandName);
    $querySelectBand->execute();
    $selectResults = $querySelectBand->get_result();

    $bands =  $selectResults->fetch_assoc();

    if($bands['band_name'] == $newBandName)
    {
        ?>
        <script>
            alert('Band already in Database');
            window.location='./bands.php'
        </script>
        <?php
    }
    else{
        $queryBand = $db->prepare('UPDATE band SET band_name=? WHERE band_id=?');
        $queryBand->bind_param('si', $newBandName, $band_id);
        $queryBand->execute();
        $selectResults = $queryBand->get_result();
        if($queryBand){
            ?>
            <script>
            alert('Band name successfully changed');
            window.location='./bands.php'
            </script>
            <?php
        }
        else{
            echo  'Error message: '.$db->error;
            ?>
            <script>
            alert('Error inserting details.');
            window.location='./bands.php'
            </script>
            <?php
        } 
    }
?>