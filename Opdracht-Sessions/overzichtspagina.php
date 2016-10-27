<?php
session_start();
  $_SESSION['straat'] = $_POST['straat'];
  $_SESSION['nummer'] = $_POST['nummer'];
  $_SESSION['gemeente'] = $_POST['gemeente'];
  $_SESSION['postcode'] = $_POST['postcode'];

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
    <h2>Overzicht Gegevens</h2>
    <ul>
      <li>e-mail: <?= $_SESSION['mail']; ?> | <a href="Opdracht-Sessions-Deel-1.php">wijzig</a></li>
      <li>nickname: <?= $_SESSION['nickname']; ?> | <a href="Opdracht-Sessions-Deel-1.php">wijzig</a></li>
      <li>straat: <?= $_SESSION['straat']; ?> | <a href="adrespagina.php">wijzig</a></li>
      <li>nummer: <?= $_SESSION['nummer']; ?> | <a href="adrespagina.php">wijzig</a></li>
      <li>gemeente: <?= $_SESSION['gemeente']; ?> | <a href="adrespagina.php">wijzig</a></li>
      <li>postcode: <?= $_SESSION['postcode']; ?> | <a href="adrespagina.php">wijzig</a></li>

    </ul>

    <!-- <form action="<?php session_destroy();?>" method="post">
      <button type="button" name="button" class="button alert">Destroy Session!</button>

    </form> -->
  </body>
</html>
