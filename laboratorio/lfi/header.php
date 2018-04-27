<?php 
  require 'classes/db.php';
  require 'classes/php.php';
  require 'classes/submission.php';
?>


<html>
  <head>
    <link rel="stylesheet" id="base" href="css/default.css" type="text/css" media="screen" />

    <title><?php echo (isset($site)) ? h($site) :"Call for Papers for Web Security 3000" ; ?></title>
  </head>
  <body>
    
  <div id="header">
    <div id="logo">
      <h1><a href="index.php">Call for Papers for Web Security 3000</a></h1>
    </div>
    <div id="menu">
      <ul> 
  
        <li class="active">
            <a href="./"> Home  |</a> 
        </li>
        <li class="active">
            <a href="./index.php?page=submit"> Submit |  </a> 
        </li>
     
        <li class="active">
            <a href="./index.php?page=login"> Login  </a> 
        </li>
        </ul>
      </div>
    </div> 

  </div>

    <div id="page">
      <div id="content">
        

  
