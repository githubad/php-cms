<?php
require("constants.php");
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
if(!$con) {
  die('Couldn\'t connect to database' . mysql_error() );
}

$db = mysqli_select_db( $con, DB_NAME);
if(!$db){
  die('Couldn\'t use selected database' . mysql_error());
}
?>
