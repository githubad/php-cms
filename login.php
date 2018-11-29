<?php require_once("./includes/session.php"); ?>
<?php require_once("./includes/connection.php"); ?>
<?php require_once("./includes/functions.php"); ?>
<?php
if(logged_in()) {
  redirect_to('staff.php');
};
?>
<?php include("./includes/header.php"); ?>

<?php if(isset($_POST['submit'])) {

  $errors = array();
  $required_fields  =  array('username', 'password');
  $errors = array_merge($errors, check_required_fields($required_fields, $_POST));

  $fields_with_lengths = array('username' => 30, 'password' =>  30);
  $errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));

$username = trim(mysql_prep($con, $_POST['username']));
$password = trim(mysql_prep($con, $_POST['password']));
$hashed_password = md5($password);

if(empty($errors)) {
$query = "SELECT id, username, hashed_password from users where username = '{$username}' LIMIT 1";
$result = mysqli_query($con, $query);
if(!confirm_query($result)) { $message = "No such username exist"; }
while($login = mysqli_fetch_array($result)) {
    $access = false;
    (($login['username'] == $username) && ($login['hashed_password'] == $hashed_password) ? $access = true : $access = false);
    if($access) {
      $message = "You have successfully logged in";
      // $_COOKIE['user_id'] = $login['id'];
      $_SESSION['user_id'] = $login['id'];
      $_SESSION['username'] = $login['username'];

      redirect_to('staff.php');
    } else {
      $message = "Sorry, please fill the right credentials to login.";
    }

  }
  }
  else {
    //Errors Occured
    $message = "There were " . count($errors) . " errors  in the form. <br />";

  }
} else {
  if(isset($_GET['logout']) && $_GET['logout'] == 1 ) {
    $message = "You are now logged out";
  }
  $username = "";
  $password = "";
}
?>
<body>
  <?php if(!empty($message)) {
    echo $message;
  }
  if(!empty($errors)) {
    echo display_errors($errors) . '<br />';
  }
  ?>
<form class="" action="login.php" method="post">
  <label for="">Username</label>
  <input type="text" name="username" value="" placeholder="Username">
  <br />
  <br />
  <label for="">Password</label>
  <input type="text" name="password" value="" placeholder="Password">
  <br />
  <br />
  <input type="submit" name="submit" value="Login">
</form>
<?php require('./includes/footer.php'); ?>
</body>
</html>
