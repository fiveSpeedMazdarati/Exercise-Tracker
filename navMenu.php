<div class="row">
  <div class="col">
<hr />
<?php
  // Generate the navigation menu
  
  if (isset($_SESSION['username'])) {
    ?>
    <ul class="nav">
      <li><a href="lognewexercise.php">Log New Exercise</a></li>
      <li><a href="viewprofile.php">View Profile</a></li>
      <li><a href="editprofile.php">Edit Profile</a></li>
      <li><a href="logout.php">Log Out (<?php echo $_SESSION['username'];?>)</a></li>
    </ul>
    <?php
  }
  else {
    ?>
    <ul class="nav">
      <li><a href="login.php">Log In</a></li>
      <li><a href="signup.php">Sign Up</a></li>
    </ul>
    <?php
  }
?>
<hr />
  <div>
</div>
