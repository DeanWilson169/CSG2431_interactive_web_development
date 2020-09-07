
<html>
<head>
    <?php 
        include("DBConnection.php");
        $band_id = $_GET['band_id'];
        $band_select_query = 'SELECT band_name FROM band WHERE band_id='.$band_id;
        $band_results = $db->query($band_select_query);
        $band_row = $band_results->fetch_assoc();
    ?>
</head>
<body>
<form action="updateBand.php" method="post">
    <?php echo '<input type="hidden" value="'.$band_id.'" name="band_id" id="band_id">'?>
    <?php echo '<input type="text" value="'.$band_row['band_name'].'" name="newBandName" id="newBandName">'?>
    <input type="submit" value="OK">
</form>
</body>
</html>
