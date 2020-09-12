
<html>
<head>
    <?php 
        include("../../Database/DBConnection.php");
        include("../../Login/AdminCheck.php");

        $venue_id = $_GET['venue_id'];
        $venue_select_query = $db->prepare('SELECT venue_name FROM venue WHERE venue_id=?');
        $venue_select_query->bind_param('i', $band_id);
        $venue_select_query->execute();
        $selectResults = $venue_select_query->get_result();
    
        $venue_row = $selectResults->fetch_assoc();
    ?>
</head>
<body>
<form action="updateVenue.php" method="post">
    <?php echo '<input type="hidden" value="'.$venue_id.'" name="venue_id" id="venue_id">'?>
    <?php echo '<input type="text" value="'.$venue_row['venue_name'].'" name="newVenueName" id="newVenueName">'?>
    <button type="cancel" onclock="javascript:window.location='./venues.php';">Cancel</button>
    <input type="submit" value="OK">
</form>
</body>
</html>
