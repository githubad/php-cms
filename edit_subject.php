<?php require_once("./includes/session.php"); ?>
<?php require_once("./includes/connection.php"); ?>
<?php require_once("./includes/functions.php"); ?>
<?php
confirm_logged_in();
?>

<?php
if(intval($_GET['subj']) == 0) {
  redirect_to("content.php");
}
$errors = array();
if(isset($_POST['submit'])){

  // Form Validation
    $required_fields = array('menu_name', 'position', 'visible');
    foreach($required_fields as $fieldname) {
        if ((!isset($_POST[$fieldname])) || (empty($_POST[$fieldname]) && $_POST[$fieldname] != 0) || $_POST[$fieldname] === "") {
          $errors[] = $fieldname;
        }
  }

  $fields_with_lengths = array('menu_name' => 30);
  foreach($fields_with_lengths as $fieldname => $maxlength) {
    if(strlen(trim(mysql_prep($con, $_POST[$fieldname]))) > $maxlength) {
      $errors[] = $fieldname;
    }
  }
    if(empty($errors)){
    // Perform Update
    $id = mysql_prep($con, $_GET['subj']);
    $menu_name = mysql_prep($con, $_POST['menu_name']);
    $position = mysql_prep($con, $_POST['position']);
    $visible = mysql_prep($con, $_POST['visible']);

    $query = "UPDATE subjects SET
              menu_name = '{$menu_name}',
              position = {$position},
              visible = {$visible}
              WHERE id = {$id}";

              $result  = mysqli_query($con, $query);
              if(mysqli_affected_rows($con) == 1) {
                // Success
                  $message = "The subject was successfully updated";
              } else {
                // Failed
                $message = "The subject updated failed <br />" . mysqli_error($con);
              }
  } else {
    //Errors Occured
    $message = "There were " . count($errors) . " errors  in the form.";

  }


} // end if(isset($_POST['submit']))
?>
<?php find_selected_page(); ?>
<?php include("./includes/header.php"); ?>
<body>
  <div>
  <?php echo navigation($sel_subject, $sel_page) ?>

  <h2>Edit Subject: <?php echo $sel_subject['menu_name']; ?></h2>
  <?php if(!empty($message)) {
    echo "<p class=\"message\">" . $message . "</p>";
  } ?>
  <?php
  if(!empty($errors)) {
    echo "<p class='errors'></p>";
    echo "Please review the following fields:";
    foreach($errors as $error) {
      echo " - " . $error . "<br />";
    }
    echo "</p>";
  }
  ?>

  <form class="" action="edit_subject.php?subj=<?php echo urlencode($sel_subject['id']) ;?>" method="post">
    <p>Subject name:
    <input type="text" name="menu_name" value="<?php echo $sel_subject['menu_name']; ?>" />
  </p>
  <p>Position:
  <select name="position">
    <?php
    $subject_set = get_all_subjects();
    $subject_count = mysqli_num_rows($subject_set);
    for($count=1; $count < $subject_count +1; $count++){
      echo "<option value=\"{$count}\"";
      if($sel_subject['position'] == $count) {
        echo "selected";
      }
      echo ">{$count}</option>";
    }
    ?>
  </select>
</p>
<p>Visible:
<input type="radio" name="visible" value="0" <?php if($sel_subject['visible'] == 0) { echo " checked";} ?> /> No
<input type="radio" name="visible" value="1" <?php if($sel_subject['visible'] == 1) { echo " checked";} ?>/> Yes
</p>
<input type="submit" name="submit" value="Edit Subject" />
<a href="delete_subject.php?subj=<?php echo urlencode($sel_subject['id']);  ?>" onclick="return confirm('Are you sure?');" >Delete Subject</a>

  </form>
  <br />
  <a href="content.php">Cancel</a>
  </div>

  <div>
    <ul>
      <?php
      $allPages = get_pages_for_subject($sel_subject['id']);
      while($page = mysqli_fetch_array($allPages)) {
      echo "<li><a href='edit_page.php?page=" . urlencode($sel_subject['id']) . "'>{$page['menu_name']}</a></li>";
    }
      ?>
    </ul>

    <a href="<?php echo "new_page.php?subj=" . $sel_subject['id']; ?>">Add a New Page to this Subject</a>
  </div>

<?php require("./includes/footer.php"); ?>
</body>
</html>
