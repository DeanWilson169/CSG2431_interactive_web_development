
<html>
<head>
    <?php 
        include("DBConnection.php");
        $venue_id = $_GET['venue_id'];
        $venue_select_query = 'SELECT venue_name FROM venue WHERE venue_id='.$venue_id;
        $venue_results = $db->query($venue_select_query);
        $venue_row = $venue_results->fetch_assoc();
    ?>
</head>
<body>
<form action="updateVenue.php" method="post">
    <?php echo '<input type="hidden" value="'.$venue_id.'" name="venue_id" id="venue_id">'?>
    <?php echo '<input type="text" value="'.$venue_row['venue_name'].'" name="newVenueName" id="newVenueName">'?>
    <input type="submit" value="OK">
</form>
</body>
</html>
