 
    <div class="navbar">
    <?php 
        include('../../Database/DBConnection.php');
        $username = $_SESSION['username'];
        $selectAdmin = "SELECT first_name, surname FROM admin WHERE username = '$username'";
        
        $result = $db->query($selectAdmin);
        if($result){
            $adminName = $result->fetch_assoc();
            echo '<p>'.$adminName['first_name'].' '.$adminName['surname'];
            echo '<br><a href="../../Login/logout.php">Logout</a></p>';
        }
        else{
            ?>
             <script> alert('Error inserting details. Error message:\n<?php echo $db->error ?>');</script>
             <?php
        }
    ?>
    
    <h5><em>Admin Area: </em></h5>
    <h5><a href="../Band/bands.php">Manage Bands</a></h5>
    <h5><a href="../Venue/venues.php">Manage Venues</a></h5>
    <h5><a href="../Concert/concerts.php">Add Concert</a></h5>
    </div>