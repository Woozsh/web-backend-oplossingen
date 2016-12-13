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
    <title>Artikels Toevoegen</title>
  </head>
  <body>
    <!-- topbar -->
    <p ><a href="<?= $dashboard ?>">Terug naar Dashboard</a> | Ingelogd als <?= $cookie[0] ?> | <a href="<?= $logoutForm ?>">uitloggen</a></p>
    <p><a href="<?= $artikelOverzicht ?>">Terug naar overzicht</a></p>

    <!-- messages -->
    <?php include_once('partials/message-show.php') ?>

    <!-- context -->
    <div >
      <form action="<?= $artikelToevoegenProcess ?>" method="post">
        <div class="row">
          <h1 >Artikel Toevoegen</h1>

        </div>
        <div class="row">
          <div class="medium-6 columns">
            <label for="titel">Titel</label>
            <input type="text" name="titel" value="">
          </div>
        </div>
        <div class="row">
          <div class="medium-6 columns">
            <label for="artikel">Artikel</label>
            <input type="text" name="artikel" value="">
          </div>
        </div>
        <div class="row">
          <div class="medium-6 columns">
            <label for="kernwoorden">Kernwoorden</label>
            <input type="text" name="kernwoorden" value="">
          </div>
        </div>
        <div class="row">
          <div class="medium-6 columns">
            <label for="datum">Datum (jjjj-mm-dd)</label>
            <input type="text" name="datum" value="">
          </div>
        </div>
        <div class="row">
          <input class="button" type="submit" name="artikelToevoegen" value="Artikel Toevoegen">
        </div>
      </form>
    </div>
  </body>
</html>
