<?php
    session_start();
    include('header.php');
    include('navMenu.php');
    require_once('connectvars.php');
 
 
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or die("There was a problem connecting to the database.");
 
    if (isset($_POST['submit'])) 
    {
        // Grab the profile data from the POST
        $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
        $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
        $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
 
        if (!empty($username) && !empty($password1) && !empty($password2) && 
                ($password1 == $password2)) 
        {
            // Make sure someone isn't already registered using this username
            $query = "SELECT * FROM EXERCISE_USER WHERE username = '$username'";
            
            $data = mysqli_query($dbc, $query)
                    or die("There was a problem querying the database.");
                    
            if (mysqli_num_rows($data) == 0) 
            {
                $hashed_password = password_hash($password1, PASSWORD_DEFAULT);
                // The username is unique, so insert the data into the database
                $query = "INSERT INTO EXERCISE_USER (username, password) " .
                        "VALUES ('$username', '$hashed_password')";
                mysqli_query($dbc, $query)
                        or die("There was a problem inserting values into the database.");
 
                // Confirm success with the user
                echo "Your new account has been successfully created. Please login and complete your profile.";
                
                // ideally there would be something here to log the user in and force them to the edit profile page
                
                mysqli_close($dbc);
                exit();
            }
            else
            {
                // An account already exists for this username, so display an error message
                echo '<p class="error">An account already exists for this username. ' .
                        'Please choose a different one.</p>';
                $username = "";
            }
        }
        else
        {
            echo '<p class="error">All fields are required.</p>';
        }
    }
 
    mysqli_close($dbc);
?>
 
  <p>Please enter a username and password to sign up</p>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Registration Info</legend>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username"
          value="<?php if (!empty($username)) echo $username; ?>" /><br />
      <label for="password1">Password:</label>
      <input type="password" id="password1" name="password1" /><br />
      <label for="password2">Password (retype):</label>
      <input type="password" id="password2" name="password2" /><br />
    </fieldset>
    <input type="submit" value="Sign Up" name="submit" />
  </form>
<?php 
    include('navMenu.php');
    include('footer.php');
?>
