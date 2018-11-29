<?php require_once("./includes/session.php"); ?>
<?php require_once("./includes/connection.php"); ?>
<?php require_once("./includes/functions.php"); ?>
<?php
confirm_logged_in();
?>
<?php if(intval($_GET['subj']) == 0) {
  redirect_to("content.php");
}

$id = mysql_prep($con, $_GET['subj']);
if($subject = get_subject_by_id($id)) {
$query = "DELETE FROM subjects WHERE id = {$id} LIMIT 1";
$result = mysqli_query($con, $query);
if(mysqli_affected_rows($con) == 1) {
  redirect_to('content.php');
} else {
  // Deletion failed

  echo "<p>Deletion failed." . mysqli_error($con) . "<a href='content.php'>Return to Main Page</a></p>";
  }
} else {
  redirect_to('content.php');
}

 ?>



<?php mysqli_close($con); ?>
