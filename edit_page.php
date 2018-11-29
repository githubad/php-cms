<?php require_once("./includes/session.php"); ?>
<?php require_once("./includes/connection.php"); ?>
<?php require_once("./includes/functions.php"); ?>
<?php
confirm_logged_in();
?>

<?php
if(intval($_GET['page']) == 0) {
  redirect_to("content.php");
}
$errors = array();
if(isset($_POST['submit'])){

  // Form Validation
    $required_fields = array('menu_name', 'position', 'visible', 'content');
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
    $id = mysql_prep($con, $_GET['page']);
    $menu_name = mysql_prep($con, $_POST['menu_name']);
    $position = mysql_prep($con, $_POST['position']);
    $visible = mysql_prep($con, $_POST['visible']);
    $content = mysql_prep($con, $_POST['content']);

    $query = "UPDATE pages SET
              menu_name = '{$menu_name}',
              position = {$position},
              visible = {$visible},
              content = '{$content}'
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

  <h2>Edit Page: <?php echo $sel_page['menu_name']; ?></h2>
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

  <form class="" action="edit_page.php?page=<?php echo urlencode($sel_page['id']) ;?>" method="post">
    <p>Page name:
    <input type="text" name="menu_name" value="<?php echo $sel_page['menu_name']; ?>" />
  </p>
  <p>Position:
  <select name="position">
    <?php
    $page_set = get_all_pages();
    $page_count = mysqli_num_rows($page_set);
    for($count=1; $count < $page_count +1; $count++){
      echo "<option value=\"{$count}\"";
      if($sel_page['position'] == $count) {
        echo "selected";
      }
      echo ">{$count}</option>";
    }
    ?>
  </select>
</p>
<p>Visible:
<input type="radio" name="visible" value="0" <?php if($sel_page['visible'] == 0) { echo " checked";} ?> /> No
<input type="radio" name="visible" value="1" <?php if($sel_page['visible'] == 1) { echo " checked";} ?>/> Yes
</p>

<p>
  <textarea name="content" rows="20" cols="100"><?php echo $sel_page['content']; ?></textarea>
</p>
<input type="submit" name="submit" value="Edit Page" />
<a href="delete_page.php?page=<?php echo urlencode($sel_page['id']);  ?>" onclick="return confirm('Are you sure?');" >Delete Page</a>

  </form>
  <br />
  <a href="content.php">Cancel</a>
  </div>

<?php require("./includes/footer.php"); ?>
</body>
</html>
