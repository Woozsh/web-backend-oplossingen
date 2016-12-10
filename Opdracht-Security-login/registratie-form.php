<?php
  function generatePassword{

  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../foundation.min.css">
    <link rel="stylesheet" href="css/master.css">
    <title>Registreren</title>
  </head>
  <body>
    <h1>Registreren</h1>
    <form action="registratie-process.php" method="post">
      <label for="email">e-mail</label>
      <input type="text" name="email" value="">
      <label for="password">paswoord</label>
      <div class="row">
        <input type="password" name="password" value="">
        <button class="button" type="submit" name="generate">Genereer een paswoord</button>
      </div>
      <input type="submit" name="send" value="Registreer">
    </form>
  </body>
</html>
