<?php require_once("./includes/session.php"); ?>
<?php require_once("./includes/connection.php"); ?>
<?php require_once("./includes/functions.php"); ?>
<?php
confirm_logged_in();
?>
<?php
if(isset($_POST['submit'])) {

  $errors = array();
  $required_fields  =  array('username', 'password');
  $errors = array_merge($errors, check_required_fields($required_fields, $_POST));

  $fields_with_lengths = array('username' => 30, 'password' =>  30);
  $errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));

 $username  = trim(mysql_prep($con, $_POST['username']));
 $password  = trim(mysql_prep($con, $_POST['password']));
 $hashed_password = sha1($password);

 if(empty($errors)) {

   $query = "SELECT username from users where username = '{$username}' LIMIT 1";
   $result = mysqli_query($con, $query);
   if(mysqli_affected_rows($con) > 0) { $message = "Please choose a different username, it already exists"; }
   else {

   $query = "INSERT INTO users (
     username, hashed_password
   ) values (
     '{$username}',
     '{$hashed_password}'
   )";
   $result = mysqli_query($con, $query);
   if($result) {
     $message = "The user was successfully created" . "<br /><a href=\"./staff.php\">Go Back to Staff</a>";
   } else {
     $message = "The user could not be created.";
     $message .= "<br />" . mysqli_error();
   }
}


 } else {
   if(count($errors) == 1) {
     $message = "There was 1 error in the form";
   }
   else {
     $message = "There were " . count($errors) . "errors in the form";
   }
 }


} else {
  $username = "";
  $password = "";
}
 ?>
<?php include("./includes/header.php"); ?>

<body>
  <?php
  if(!empty($message)) {
    echo $message;
  }
  echo "<br />";
  if(!empty($errors)) { display_errors($errors); }
  ?>
<form class="" action="new_user.php" method="post">
  <label for="">Username</label>
  <input type="text" name="username" value="<?php echo htmlentities($username); ?>" placeholder="Username">
  <br />
  <br />
  <label for="">Password</label>
  <input type="text" name="password" value="<?php echo htmlentities($password);  ?>" placeholder="Password">
  <br />
  <br />
  <input type="submit" name="submit" value="Create User">
</form>
</body>
</html>
