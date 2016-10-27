<?php
  if(isset($_GET['status'])){
    if($_GET['status'] == "logOut"){
      setcookie('loggedIn', false);
    }
  }
    if(isset($_COOKIE['loggedIn'])){
      header("Location: dashboard.php");
    }
  $fileName = "pw.txt";
  $file = file_get_contents($fileName);
  $fileArray = explode(",", $file);

  $textCorrect = "Inloggen succesvol";
  $textWrong = "Gebruikersnaam en/of paswoord niet correct. Probeer opnieuw.";
  $text = "";
  if(isset($_POST['verzenden'])){
    if($_POST['name'] == $fileArray[0] && $_POST['pw'] == "paswoord01"){
      $text = $textCorrect;
      setcookie('loggedIn', TRUE, time() + 3600*6);
      header("Location: dashboard.php");
    }else{
      $text = $textWrong;
    }
  }
 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="../foundation.min.css" media="screen" title="no title">
     <link rel="stylesheet" href="style.css" media="screen" title="no title">
     <title>Cookies</title>
   </head>
   <body>

      <form  action="Opdracht-Cookies-Deel-1.php" method="post">
      <div class="row">
        <?php if($text != ""): ?>
          <p class="alert label">
            <?= $text ?>
          </p>
        <?php endif; ?>
          <h2>Inloggen</h2>
          <hr>
          <label for="naam">Gebruikersnaam</label>
          <input type="text" name="name" id="name" required>
          <label for="pw">Paswoord</label>
          <input type="password" name="pw" id="pw" required>
          <input type="submit" class="button primary" name="verzenden" id="verzenden" value="Verzenden">
        </div>
      </form>
   </body>
 </html>
