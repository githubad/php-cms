<?php require_once("./includes/session.php"); ?>
<?php require_once("./includes/connection.php"); ?>
<?php require_once("./includes/functions.php"); ?>
<?php
confirm_logged_in();
?>
<?php find_selected_page(); ?>
<?php include("./includes/header.php"); ?>


<?php if(isset($_POST['submit'])) {
  $errors = array();
  // Form Validation
    $required_fields = array('menu_name', 'position', 'visible', 'content');
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
    if(empty($errors)){
    //   echo "Errors";
    // redirect_to("new_page.php");

    $subject_id = mysql_prep($con, $_GET['subj']);
    $menu_name = mysql_prep($con, $_POST['menu_name']);
    $position = mysql_prep($con, $_POST['position']);
    $visible = mysql_prep($con, $_POST['visible']);
    $content = mysql_prep($con, $_POST['content']);

    $query = "INSERT INTO pages (
    subject_id,  menu_name, position, visible, content
    ) values (
      {$subject_id}, '{$menu_name}', {$position}, {$visible}, '{$content}'
    )";

    if(mysqli_query($con, $query)) {
    redirect_to("new_page.php?subj=" . $subject_id );
    } else {
      echo "<p>Page creation failed.</p>";
      echo "<p>" . mysqli_error($con) . "</p>";
    }


  }   else {
        redirect_to("new_page.php?subj=" . $subject_id);
  }

}

   ?>







<body>
  <div>
  <?php echo navigation($sel_subject, $sel_page) ?>

  <h2>Add Page</h2>
  <form class="" action="<?php echo "new_page.php?subj=" . urlencode($sel_subject['id']); ?>" method="post">
    <p>Page name:
    <input type="text" name="menu_name" value="" id="menu_name" />
  </p>
  <p>Position:
  <select name="position">
    <?php
    $pages_set = get_pages_for_subject($sel_subject['id']);
    $pages_count = mysqli_num_rows($pages_set);
    for($count=1; $count < $pages_count + 2; $count++){
      echo "<option value=\"{$count}\">{$count}</option>";
    }
    ?>
  </select>
</p>
<p>Visible:
<input type="radio" name="visible" value="0" /> No
<input type="radio" name="visible" value="1" /> Yes
</p>

<p> Content:
  <textarea name="content" rows="20" cols="100"></textarea>
</p>
<input type="submit" name="submit" value="Add Page" />


  </form>
  <br />
  <a href="new_page.php">Cancel</a>
  </div>

<?php require("./includes/footer.php"); ?>
</body>
</html>
