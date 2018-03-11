<?php
    session_start();
    
    require_once('connectvars.php');
    
    require_once('header.php');
    
    require('navMenu.php');
    
    require_once('functions.php');
?>
<!-- This is where the profile information will be displayed, along with the information for the user's exercises -->
<?php
    // double check to be sure the person is logged in
    if (isset($_SESSION['user_id'])) {
        
        // get the info we need for this page from the database
        // two sets of data - one is the user's personal information, the other is the exercises they've logged
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                or die('Error connecting to MySQL server.');
        
        $id = $_SESSION['user_id'];
        
        $query = "SELECT * FROM EXERCISE_USER WHERE id = '$id'";
        
        $data = mysqli_query($dbc, $query)
                or die("There was an error querying the database.");
        
        $row = mysqli_fetch_array($data);
        
    ?>
    <div class="row">
        <div id="profile-information" class="col">
            <span>Your Information</span>
            <table class="table table-striped">
                <tr><th>First Name</th><td><?php echo $row['firstname'] ?></td></tr>
                <tr><th>Last Name</th><td><?php echo $row['lastname'] ?></td></tr>
                <tr><th>Gender</th><td><?php echo $row['gender'] ?></td></tr>
                <tr><th>Weight</th><td><?php echo $row['weight'] ?></td></tr>
            </table>
        </div>
        <div id="recent-exercises" class="col">
            <span>Your Recent Entries</span>
        
        <?php
            
            // clear out the query variable, put in a new query string
            $query = '';
            $query = "SELECT * FROM EXERCISE_LOG WHERE EXERCISE_USER_id = '$id' LIMIT 15";
            
            $data = mysqli_query($dbc, $query)
                    or die("Error querying database.");
            
            echo "Calories burned for this exercise: " . round(calculate_calorie_burn(37, 'male', 162, 121, 41));
                    
        ?>
            <table class="table table-striped">
                <tr><th class="thead-dark">Date</th><th>Duration</th><th>Heart Rate</th><th>Calories</th><th>Type of Exercise</th><th>Delete</th></tr>
            <?php 
                // get the results a row at a time
                while ($row = mysqli_fetch_array($data))
                {
            ?>
                <tr>
                  <td><?php echo $row['date'];; ?></td>
                  <td><?php echo $row['time_in_minutes']; ?> mins</td>
                  <td><?php echo $row['heartrate'];?> bpm</td>
                  <td><?php echo $row['calories'];?></td>
                  <td><?php echo $row['type'];?></td>
                  <td><a href="deleteexercise.php?id=<?php echo $row['id']; ?>"> <i class="fa fa-trash-o fa-lg"></i></a></td>
                </tr>
            <?php
                }
            ?>
            </table>
            
            <?php
                mysqli_close($dbc);
            ?>
        </div>
    </div>
<?php
} else
    {
        // user is not logged in, show an appropriate message
        echo "Whoops! You must be logged in to view this. ";
        echo '<a href="login.php">Log in.</a>';
    }
?>
<!-- the the footer menu, which is the same as the header menu -->
<?php
    require('navMenu.php');
    
    require_once('footer.php');
?>