<?php
if (isset($_GET['query-woord'])) {
  header('location: ' . '/Opdracht-Mod-Rewrite-Blog/artikels/zoeken/content/' . $_GET['query-woord'] . "/");

}

//zoeken op datum
if (isset($_GET['query-datum'])) {
  header('location: ' . '/Opdracht-Mod-Rewrite-Blog/artikels/zoeken/datum/' . $_GET['query-datum'] . "/");
}


 ?>
