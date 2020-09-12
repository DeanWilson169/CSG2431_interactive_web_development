
<html>
<head>
    <?php 
    include("../../Database/DBConnection.php");
    include("../../Login/AdminCheck.php");
    $band_id = $_GET['band_id'];
    $band_select_query = $db->prepare('SELECT band_name FROM band WHERE band_id=?');
    $band_select_query->bind_param('i', $band_id);
    $band_select_query->execute();
    $selectResults = $band_select_query->get_result();

    $band_row = $selectResults->fetch_assoc();
    ?>
</head>
<body>
<form action="updateBand.php" method="post">
    <?php echo '<input type="hidden" value="'.$band_id.'" name="band_id" id="band_id">'?>
    <?php echo '<input type="text" value="'.$band_row['band_name'].'" name="newBandName" id="newBandName">'?>
    <button type="cancel" onclock="javascript:window.location='./bands.php';">Cancel</button>
    <input type="submit" value="OK">
</form>
</body>
</html>
