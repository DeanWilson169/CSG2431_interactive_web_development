<?php 
    include("DBConnection.php");

    $band_id = $_GET['band_id'];
    $queryBand = 'DELETE FROM band WHERE band_id='.$band_id.';';
    $result = $db->query($queryBand);
    if($result){
        echo 'Band name successfully deleted';
        header('Location: bands.php');
    }
    else{
        echo 'Error inserting details. Error message: '.$db->error;
    }  
?>