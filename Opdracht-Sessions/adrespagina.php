<?php
  session_start();
  var_dump($_SESSION);


  if(isset($_POST['volgende']))
  {
    $_SESSION['mail'] = $_POST['mail'];
    $_SESSION['nickname'] = $_POST['nickname'];
  }


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sessions</title>
    <link rel="stylesheet" href="../foundation.min.css" media="screen" title="no title">
    <link rel="stylesheet" href="style.css" media="screen" title="no title">
  </head>
  <body>
    <h2>Registratiegegevens</h2>
    <ul>
      <li>e-mail: <?= $_SESSION['mail']; ?></li>
      <li>nickname: <?= $_SESSION['nickname']; ?></li>
    </ul>
    <h2>Deel 2: Adres</h2>
    <form class="" action="overzichtspagina.php" method="post">
      <div class="row">
        <label for="straat">Straat</label>
        <input type="text" name="straat" value="<?= (isset($_SESSION['straat']) ? $_SESSION['straat'] : '') ?>" id="straat" required>
        <label for="nummer">Nummer</label>
        <input type="tel" name="nummer" id="nummer" value="<?= (isset($_SESSION['nummer']) ? $_SESSION['nummer'] : '') ?>" required>
        <label for="gemeente">Gemeente</label>
        <input type="text" name="gemeente" id="gemeente" value="<?= (isset($_SESSION['gemeente']) ? $_SESSION['gemeente'] : '') ?>" required>
        <label for="postcode">Postcode</label>
        <input type="text" name="postcode" id="postcode" value="<?= (isset($_SESSION['postcode']) ? $_SESSION['postcode'] : '') ?>" required>
        <input type="submit" name="adres" class="button" value="Volgende">
      </div>

    </form>
  </body>
</html>
