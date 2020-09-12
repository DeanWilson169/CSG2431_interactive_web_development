<?php 
    include("../../Database/DBConnection.php");
    include("../../Login/AdminCheck.php");

    $newBandName = $_POST['newBandName'];
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
        $queryInsertBand = $db->prepare("INSERT INTO band VALUES (NULL, ?)");
        $queryInsertBand->bind_param('s', $newBandName);
        $queryInsertBand->execute();
        $insertResults = $queryInsertBand->get_result();
        if($queryInsertBand){
            ?>
            <script>
            alert('Band Added to Database');
            window.location='./bands.php'
            </script>
            
            <?php
            //header('Location: bands.php'); 
        }
        else{
        ?>
            <script>
            alert('Error inserting details. Error message:\n<?php echo $db->error ?>');
            window.location='./bands.php';
            </script>
            
        <?php
        }
    }
?>
