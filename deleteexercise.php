<?php 
    session_start();
    
    require_once('connectvars.php');
    
    // check that the user is logged in
    if (isset($_SESSION['user_id']))
    {
        // user is logged in, so do whatever this page is going to do
        $user_id = $_SESSION['user_id'];

        // get the exercise entry id from the GET array in order to delete it 
        if (isset($_GET['id']))
        {
            $id = $_GET['id'];
            $referrer = '/' . $_GET['referrer'];
            
            // delete the value from the exercise log based on the value from the $_GET array
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                    or die("There was a problem connecting to the database.");
            
            $query = "delete from EXERCISE_LOG where id = '$id'";
            
            //echo $query;
            mysqli_query($dbc, $query)
                    or die("There was a problem deleting the record from the database.");
            
            mysqli_close($dbc);
            
            // send the user back to the page they were viewing
            $previous_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . $referrer;
            //echo "redirecting to $previous_url";
            
            header('Location: ' . $previous_url);
            exit();
            
        }
    }
    else
    {
        // user is not logged in, so show an error message
        echo "<span class='error'>You must be logged in to do that.</span>";
    }
    
?>