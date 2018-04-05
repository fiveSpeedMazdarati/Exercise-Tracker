<?php
    require_once('connectvars.php');

    // Start the session
    session_start();

    // Clear the error message
    $error_msg = "";

    // If the user isn't logged in, try to log them in
    if (!isset($_SESSION['user_id'])) {
        
        if (isset($_POST['submit'])) {
            // Connect to the database
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                    or die("There was a problem connecting to the database.");

            // Grab the user-entered log-in data
            $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
            $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));

            if (!empty($user_username) && !empty($user_password)) {
                
                // user filled in both required fields, so get the user info from the db
                $query = "SELECT id, username, password FROM EXERCISE_USER WHERE username = '$user_username'";
                $data = mysqli_query($dbc, $query)
                        or die("There was a problem querying the database.");
                
                $row = mysqli_fetch_array($data);
                $hash = $row['password'];
                
                if (password_verify($user_password, $hash)) {
                
                    // passwords match, now check that there is only one user with this info
                    if (mysqli_num_rows($data) == 1) {
                        
                        // there is only one user in the db with this information, so continue
                        // The log-in is OK so set the user ID and username session vars, and redirect to the home page
        
                        $_SESSION['user_id'] = $row['id'];
                        $_SESSION['username'] = $row['username'];
                  
                        $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
                        header('Location: ' . $home_url);
                    } else {
                        // something is really wrong, because there are somehow two people with the same username
                        $error_msg = 'There was an error. Please contact the system administrator. Reference Error Code: 51.';
                    } 
                    
                } else {
                    $error_msg = 'Sorry, your username and password combination is incorrect.';
                }
            } else {
                // The username/password weren't entered so set an error message
                $error_msg = 'Sorry, you must enter your username and password to log in.';
            }
        
            mysqli_close($dbc);    
        }
        
    }

    require_once('header.php');
  
  // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
  if (empty($_SESSION['user_id'])) {
    echo '<p class="error">' . $error_msg . '</p>';
?>
<h2>Log In</h2>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <label for="username">Username:</label>
      <input type="text" name="username" value="<?php if (!empty($user_username)) echo $user_username; ?>" /><br />
      <label for="password">Password:</label>
      <input type="password" name="password" /><br />
    <input type="submit" value="Log In" name="submit" />
  </form>
  
  <p>Perhaps you would like to <a href="signup.php">Sign Up</a> instead?</p>

<?php
  }
  else {
    // Confirm the successful log-in
    echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '.</p>');
    echo('<p>Looking for the <a href="index.php">home page?</a></p>');
  }
?>

</body>
</html>
