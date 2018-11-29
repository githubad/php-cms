<?php require_once("./includes/session.php"); ?>
<?php require_once("./includes/connection.php"); ?>
<?php require_once("./includes/functions.php"); ?>
<?php
confirm_logged_in();
?>

<?php find_selected_page(); ?>
<?php include("./includes/header.php"); ?>

<body>
  <div>
   <?php echo navigation($sel_subject, $sel_page) ?>
<a href="new_subject.php">+ Add a New Subject</a>
  </div>
<h2>Staff Menu</h2>
<p>Welcome to the Content Area</p>
<?php
if(!is_null($sel_subject)) {
echo $sel_subject['menu_name'];
}
  elseif (!is_null($sel_page))  {
echo $sel_page['menu_name'];
?>
<br />
<?php
echo $sel_page['content'];
echo "<br /> <a href='edit_page.php?page={$sel_page['id']}'>Edit Page</a>";
} else {
  echo "<p>Please select a subject or page to edit the content.</p>";
}
?>
<ul>
  <li><a href="content.php">Manage Website</a></li>
  <li><a href="new_user.php">Add Staff User</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
<?php require("./includes/footer.php"); ?>
</body>
</html>
