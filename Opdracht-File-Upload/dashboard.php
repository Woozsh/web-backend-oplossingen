<?php
session_start();
include_once('partials/variables.php');


//Cookie Check
include_once('partials/cookieCheck.php');


//MESSAGE

include_once('partials/message.php');

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../foundation.min.css">
    <link rel="stylesheet" href="css/master.css">
    <title>Dashboard</title>
  </head>
  <body>
    <!-- topbar -->
    <p ><a href="<?= $dashboard ?>">Terug naar Dashboard</a> | Ingelogd als <?= $cookie[0] ?> | <a href="<?= $logoutForm ?>">uitloggen</a></p>

    <!-- titel -->
    <h1 >Dashboard</h1>

    <!-- messages -->
    <?php include_once('partials/message-show.php') ?>

    <!-- context -->
    <div >
      <ul>
        <li><a href="<?= $artikelOverzicht ?>">Artikels</a></li>
      </ul>
      <ul>
        <li><a href="<?= $gegevensWijzigenForm ?>">Gegevens Wijzigen </a></li>
      </ul>
    </div>
  </body>
</html>
