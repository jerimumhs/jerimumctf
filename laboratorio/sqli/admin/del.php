<?php 
  require("../classes/auth.php");
  require("header.php");
  require("../classes/db.php");
  require("../classes/phpfix.php");
  require("../classes/picture.php");
?>

<?php  
  $picture = Picture::delete((int)($_GET["id"]));
  header("Location: ./index.php");
?>

