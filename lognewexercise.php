<?php
    session_start();
    
    require_once('connectvars.php');
    require_once('header.php');
    require('navMenu.php');
    require_once('functions.php');

    if (isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        
        if ($_POST['submit'])
        {
            $time = $_POST['time'];
            $heart_rate = $_POST['average_heart_rate'];
            $exercise_type = $_POST['exercise_type'];
            
            // check to see if time and heart rate fields are populated
            if (!empty($time) && !empty($heart_rate))
            {
                // fields are populated, check that the values entered are numeric
                if (is_numeric($time) && is_numeric($heart_rate))
                {
                    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                            or die('Error connecting to MySQL server.');
        
                    $query = "select gender, weight, birthdate from EXERCISE_USER where id = '$id'";
                    
                    $result = mysqli_query($dbc, $query);
                    
                    $data = mysqli_fetch_array($result);
                    
                    // sanitize the user inputs
                    $heart_rate = mysqli_real_escape_string($dbc, trim($heart_rate));
                    $time = mysqli_real_escape_string($dbc, trim($time));
                    
                    $gender = $data['gender'];
                    $weight = $data['weight'];
                    $birthdate = $data['birthdate'];
                    
                    $age = calculate_age($birthdate);
                    
                    $calorie_burn = calculate_calorie_burn($age, $gender, $weight, $heart_rate, $time);
                    
                    // echo "Calories burned: $calorie_burn";
                    
                    // write the exercise record to the log
                    $query = "insert into EXERCISE_LOG (date, time_in_minutes, heartrate, calories, type, EXERCISE_USER_id) VALUES "
                            . "(NOW(), '$time', '$heart_rate', '$calorie_burn', '$exercise_type', '$id')";
                    
                    $result = mysqli_query($dbc, $query)
                            or die("Could not add exercise to the database.");
                            
                    mysqli_close($dbc);
                }
                else 
                {
                    // output an error message if time or heart rate is not numeric
                    echo '<span class="error">Time and Heart Rate must be numeric.</span>';
                }
            }
            else
            {
                // output an error message if time or heart rate is empty
                echo '<span class="error">Time and Heart Rate are required.</span>';
            }
        } // end of form submitted actions
    
    ?>
    <!-- The new exercise form -->
    <h2>Log a New Exercise</h2>
    <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <label for="time">Duration (minutes):</label>
      <input type="text" name="time" value="<?php echo $time; ?>" /><br />
      <label for="average_heart_rate">Average Heart Rate:</label>
      <input type="text" name="average_heart_rate" value="<?php echo $heart_rate; ?>" /><br />
      <label for="exercise_type">Type of Exercise:</label>
        <select name="exercise_type">
           <option value="Jogging">Jogging</option>
           <option value="Biking">Biking</option>
           <option value="Walking">Walking</option>
           <option value="Swimming">Swimming</option>
        </select><br /> 
      <input type="submit" name="submit"/>
    </form>

<?php
    } else {
        echo "You must be logged in to do that.";
    }
    require('navMenu.php');
    
    require_once('footer.php');
?>