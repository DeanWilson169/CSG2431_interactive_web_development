<?php 
    include("../../Database/DBConnection.php");
    include("../../Login/AdminCheck.php");
    

    $band_id = $_GET['band_id'];


    $querySelectBand = $db->prepare('SELECT band.band_id, concert.band_id FROM band INNER JOIN concert ON concert.band_id = band.band_id WHERE band.band_id=? AND concert.band_id=?');
    $querySelectBand->bind_param('ii', $band_id, $band_id);
    $querySelectBand->execute();
    $selectResults = $querySelectBand->get_result();

    $bands =  $selectResults->fetch_assoc();
    if($bands['band_id'] == NULL)
    {
        $queryBand = $db->prepare('DELETE FROM band WHERE band_id=?;');
        $queryBand->bind_param('i', $band_id);
        $queryBand->execute();
        $selectResults = $queryBand->get_result();
        if($queryBand){
            ?>
            <script>
            alert('Band successfully deleted!');
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
    else{
        ?>
        <script>
        alert('Band cannot be deleted as there is a concert planned for it');
        window.location='./bands.php'
        </script>
        <?php
    }
?>