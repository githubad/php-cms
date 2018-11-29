<?php require_once("./includes/session.php"); ?>
<?php require_once("./includes/connection.php"); ?>
<?php require_once("./includes/functions.php"); ?>
<?php
confirm_logged_in();
?>
<?php find_selected_page(); ?>


<body>
  <div>
  <?php echo navigation($sel_subject, $sel_page) ?>

  <h2>Add Subject</h2>
  <form class="" action="create_subject.php" method="post">
    <p>Subject name:
    <input type="text" name="menu_name" value="" id="menu_name" />
  </p>
  <p>Position:
  <select name="position">
    <?php
    $subject_set = get_all_subjects();
    $subject_count = mysqli_num_rows($subject_set);
    for($count=1; $count < $subject_count +1; $count++){
      echo "<option value=\"{$count}\">{$count}</option>";
    }
    ?>
  </select>
</p>
<p>Visible:
<input type="radio" name="visible" value="0" /> No
<input type="radio" name="visible" value="1" /> Yes
</p>
<input type="submit" value="Add Subject" />


  </form>
  <br />
  <a href="content.php">Cancel</a>
  </div>

<?php require("./includes/footer.php"); ?>
</body>
</html>
