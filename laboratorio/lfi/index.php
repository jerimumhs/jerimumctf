


<?php
  $site = "Call for Papers for Web Security 3000";
  require "header.php";

  if(isset($_FILES['pdf'])){
      Submission::create();
  }
  
  if(!isset($_FILES['pdf']) and isset($_POST["email"])){
      echo Submission::display();
      DIE();
  }
  


?>
  <div class="block" id="block-text">
    <div class="secondary-navigation">

      <div class="content">
<?php if (isset($_GET['page']) )
        $page = $_GET['page'].".php";
      else 
        $page = "main.php";
      include($page);
?>
     </div>

    </div>
  </div>


<?php


  require "footer.php";
?>

