<?php session_start(); ?>
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
        	<a href="repo.php">Digital Library</a> | <a href="view.php">View Library</a>
          <?php require 'alert.php' ?>
        </h1>
        <div class="info">
          <input type="text" name="title" placeholder="Title">
          <input type="text" name="creator" placeholder="Creator">
          <input type="date" name="date" placeholder="Date">
          <input type="text" name="subject" placeholder="Subject">
          <select name="format">
          	<option>JPEG</option>
          	<option>JPG</option>
          	<option>PNG</option>
          	<option>TIFF</option>
          	<option>PDF</option>
          	<option>Video</option>
          </select>
          <input type="text" name="language" placeholder="Language">
          <input type="text" name="rights" placeholder="Rights">
        </div>
        <p>Description</p>
        <div>
          <textarea name="description" rows="4"></textarea>
        </div>
        <input type="file" name="files" multiple placeholder="files">
        <button type="submit" name="submit_data" >Submit</button>
      </form>
    </div>
  </body>
</html>