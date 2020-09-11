<?php 
    include("DBConnection.php");
    include("AdminCheck.php");

    $newBandName = $_POST['newBandName'];
    $band_id = $_POST['band_id'];
    $queryBand = 'UPDATE band SET band_name="'.$newBandName.'" WHERE band_id='.$band_id.';';
    $result = $db->query($queryBand);
    if($result){
        echo 'Band name successfully changed';
        header('Location: bands.php');
    }
    else{
        echo 'Error inserting details. Error message: '.$db->error;
    }  
?>