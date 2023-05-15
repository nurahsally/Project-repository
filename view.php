<?php session_start(); ?>
<?php
$hostname = "localhost";
$database = "digital_library";
$username = "digital_library";
$password = "DJvmypDMXFyZ5GA";
$Con    = mysqli_connect($hostname, $username, $password,$database) or trigger_error(mysql_error(),E_USER_ERROR);

$DBhost = "localhost";
$DBuser = "digital_library";
$DBpass = "DJvmypDMXFyZ5GA";
$DBname = "digital_library";

try{
  
  $DBcon = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpass);
  $DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Digital Library</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link href="main.css" rel="stylesheet">
  </head>
  <body>
    <div class="main-block">
      <div class="left-part">
        <i class="fas fa-book"></i>
        <i class="fas fa-file-pdf"></i>
        <i class="fas fa-at"></i>
        <i class="fas fa-file-word"></i>
        <i class="fas fa-music"></i>
        <i class="fas fa-home"></i>
        <i class="fas fa-users"></i>
        <i class="fas fa-mail-bulk"></i>
        <i class="fas fa-paperclip"></i>
      </div>
      <form method="POST" action="upload.php" enctype="multipart/form-data">
        <h1>
        	<a href="repo.php">Digital Library</a>
          <?php require 'alert.php' ?>
        </h1>
        <hr>
        <div class="info">
          <?php
          if (mysqli_num_rows(mysqli_query($Con, "SELECT * FROM `repository`")) > 0) {

            $get_files = mysqli_query($Con, "SELECT * FROM `repository`);
            while($show_files = mysqli_fetch_assoc($get_files)){
              echo "<p>" . $show_files['file'] . "</p>" 
