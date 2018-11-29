<?php require_once("./includes/session.php"); ?>
<?php require_once("./includes/functions.php"); ?>
<?php
confirm_logged_in();
?>

<?php include("./includes/header.php"); ?>


<body>
<h2>Staff Menu</h2>
<p>Welcome to the Staff Area, <?php echo $_SESSION['username'];?></p>
<ul>
  <li><a href="content.php">Manage Website</a></li>
  <li><a href="new_user.php">Add Staff User</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
</body>
</html>
