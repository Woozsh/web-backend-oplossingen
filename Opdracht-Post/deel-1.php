<?php
  $password = "admin";
  $username = "admin";
  $msg = "";
  if(isset($_POST['send'])){
    if($_POST['username'] == $username && $_POST['password'] == $password){
      $msg = "Gelukt. U bent ingelogd.";
    }else{
      $msg = "Aanmelden mislukt";
    }
  }
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Post</title>
  </head>
  <body>
    <h1>Inloggen</h1>
      <form  action="deel-1.php" method="post">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="username" name="password">
        </div>
        <input type="button" id="send" name="send" value="Send">
      </form>
      <p>
        <?= $msg ?>
      </p>
  </body>
</html>
