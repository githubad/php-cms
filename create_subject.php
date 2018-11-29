<?php require_once("./includes/session.php"); ?>
<?php require_once("./includes/connection.php"); ?>
<?php require_once("./includes/functions.php"); ?>
<?php
confirm_logged_in();
?>
<?php
$errors = array();
// Form Validation
  $required_fields = array('menu_name', 'position', 'visible');
  foreach($required_fields as $fieldname) {
      if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
        $errors[] = $fieldname;
      }
}

$fields_with_lengths = array('menu_name' => 30);
foreach($fields_with_lengths as $fieldname => $maxlength) {
  if(strlen(trim(mysql_prep($con, $_POST[$fieldname]))) > $maxlength) {
    $errors[] = $fieldname;
  }
}
  if(!empty($errors)){
  redirect_to("new_subject.php");
  }
 ?>
<?php
    $menu_name = mysql_prep($con, $_POST['menu_name']);
    $position = mysql_prep($con, $_POST['position']);
    $visible = mysql_prep($con, $_POST['visible']);
 ?>

 <?php

  $query = "INSERT INTO subjects (
    menu_name, position, visible
  ) values (
    '{$menu_name}', {$position}, {$visible}
  )";

  if(mysqli_query($con, $query)) {
  redirect_to("content.php");
  } else {
    echo "<p>Subject creation failed.</p>";
    echo "<p>" . mysqli_error($con) . "</p>";
  }
  ?>

<?php mysqli_close($con); ?>
