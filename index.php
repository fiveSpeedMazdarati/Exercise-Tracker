<?php
    session_start();
    
    require_once('connectvars.php');
    require_once('header.php');
    require('navMenu.php');
?>

<!-- a whole bunch of stuff to display each of the recent exercises -->
<?php
            
            // clear out the query variable, put in a new query string
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                or die('Error connecting to MySQL server.');

        $query = "SELECT * FROM EXERCISE_LOG ORDER BY id DESC LIMIT 15";
            
        $data = mysqli_query($dbc, $query)
                or die("Error querying database.");
                    
        ?>
        <h2>Recent Exercise Logs</h2>
            <table class="table table-striped">
                <tr><th class="thead-dark">Date</th><th>Duration</th><th>Heart Rate</th><th>Calories</th><th>Type of Exercise</th></tr>
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
                </tr>
            <?php
                }
            ?>
            </table>
            
            <?php
                mysqli_close($dbc);
            ?>
<!-- the the footer menu, which is the same as the header menu -->
<?php
    require('navMenu.php');
    
    require_once('footer.php');
?>