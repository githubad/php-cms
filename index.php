<?php require_once("./includes/connection.php"); ?>
<?php require_once("./includes/functions.php"); ?>
<?php find_selected_page(); ?>
<?php include("./includes/header.php"); ?>

<body>
  <div>
   <?php echo publicNavigation($sel_subject, $sel_page) ?>
  </div>
<h2>Public Website</h2>
<p>Welcome to the Content Area</p>
<?php
if($sel_subject) {
echo htmlentities($sel_subject['menu_name']) . "<br /><br />" ;
}
if ($sel_page)  {
echo  htmlentities($sel_page['menu_name']);
?>
<br />
<?php
echo strip_tags(nl2br($sel_page['content']),"<br><b><p>");
} else {
  echo "<p>Please select.</p>";
}
?>

<?php require("./includes/footer.php"); ?>
</body>
</html>
