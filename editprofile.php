<?php
    session_start();
    
    require_once('connectvars.php');
    
    require_once('header.php');
    
    require('navMenu.php');
    
    $successMessage = "Information Updated.";
?>
<!-- This is where the profile information will be displayed, along with the information for the user's exercises -->
<?php
    // double check to be sure the person is logged in
    if (isset($_SESSION['user_id'])) {
    
        // make the user's id value available for use in the whole script
        $id = $_SESSION['user_id'];
    
        // get a database connection for all the stuff that's happening on this page if the user is logged in
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                or die('Error connecting to MySQL server.');

    
        //print_r($_POST);
        //echo "<br />";
            // start the update user info logic if the form has been submitted
            if (isset($_POST['submit']))
            {
                //echo "form submitted...<br />checking for empty fields...<br />";
                // the user has submitted the form, so make sure all of the fields are filled in
                if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['gender']) && !empty($_POST['weight']))
                {
                    //echo "all fields filled in...<br />checking that weight is numeric...<br />";
                    // all fields are filled in, check that weight is numeric
                    if (is_numeric($_POST['weight']))
                    {
                        //echo "weight is a numeric value...<br />sanitizing inputs...<br />";
                        
                        // all checks pass, sanitize the inputs from the $_POST array
                        $firstname = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
                        $lastname = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
                        $gender = mysqli_real_escape_string($dbc, trim($_POST['gender']));
                        $weight = mysqli_real_escape_string($dbc, trim($_POST['weight']));
                        
                        //echo "Inputs after sanitizing:<br />";
                        //echo "$firstname, $lastname, $gender, $weight<br />";
                        
                        
                        // insert the new values into the database
                        //echo "Your custom made query:<br />";
                        $query = "UPDATE EXERCISE_USER SET firstname = '$firstname', lastname = '$lastname', gender = '$gender', weight = '$weight' WHERE id = '$id' LIMIT 1";
                        //echo $query;
                        
                        mysqli_query($dbc, $query)
                                or die("There was a problem updating the user information.");
                        
                        $updated = true;
                        
                    } 
                    else 
                    {
                        $error = "Weight must be a numeric value.";
                    }
                    
                }
                else 
                {
                    $error = "All fields are required.";   
                }
            }
        
        // get the info we need for this page from the database
        // two sets of data - one is the user's personal information, the other is the exercises they've logged
        $query = "SELECT * FROM EXERCISE_USER WHERE id = '$id'";
        
        $data = mysqli_query($dbc, $query)
                or die("There was an error querying the database.");
        
        $row = mysqli_fetch_array($data);
    ?>
    
    <div class="row">
        <div id="profile-information" class="col">
            <!-- display the php form validation message if the string is not empty -->
            
            <?php 
                if(!empty($error))
                {
                    echo "<span class='error'>$error</span>";
                } 
                else if ($updated)
                {
                    echo "<span class='success'>$successMessage</span>";
                }
            ?>
            
            <!-- Form to update the user info -->
            <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label>First Name:</label>
                <input type="text" name="firstname" value="<?php echo $row['firstname']; ?>"/><br />
                <label>Last Name:</label>
                <input type="text" name="lastname" value="<?php echo $row['lastname']; ?>"/><br />
                <label>Gender</label>
                <input type="text" name="gender" value="<?php echo $row['gender']; ?>"/><br />
                <label>Weight</label>
                <input type="text" name="weight" value="<?php echo $row['weight']; ?>"/><br />
                <input type="submit" name="submit" value="Update Information" />
            </form>
        </div>
        <div id="recent-exercises" class="col">
        
        <?php
            
            // clear out the query variable, put in a new query string
            $query = '';
            $query = "SELECT * FROM EXERCISE_LOG WHERE EXERCISE_USER_id = '$id' LIMIT 15";
            
            $data = mysqli_query($dbc, $query)
                    or die("Error querying database.");
                    
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
                  
                  <!-- TODO: create deleteexercise.php -->
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
        // user is not logged in, show the "shame on you" message
        echo "Whoops! You must be logged in to view this. ";
        echo '<a href="login.php">Log in.</a>';
    }
?>
<!-- the the footer menu, which is the same as the header menu -->
<?php
    require('navMenu.php');
    
    require_once('footer.php');
?>