<?php
session_start();
$messageContainer = '';
$order = 'asc';
$orderName = 'bi.biernr';
try {
  $db = new PDO('mysql:host=localhost;dbname=bieren', 'root', '');

  $bierenQuery = "SELECT bi.biernr, bi.naam, br.brnaam, s.soort, bi.alcohol FROM bieren AS bi
LEFT JOIN brouwers AS br ON bi.brouwernr = br.brouwernr
LEFT JOIN soorten AS s ON bi.soortnr = s.soortnr";

  if(isset($_GET['order_by']))
  {
    $orderby = explode("-", $_GET['order_by']);
    $order = $orderby[1];
    $orderName = $orderby[0];

    if($_SESSION['oldName'] === $orderName){
      if($order == $_SESSION['oldOrder']) //switch asc -> desc
      {
        if($order === 'desc'){
          $order = 'asc';
          $_SESSION['oldOrder'] = $order;
        }else {
          $order = 'desc';
          $_SESSION['oldOrder'] = $order;
        }
      }else $_SESSION['oldOrder'] = $order;
    }else {
      $_SESSION['oldName'] = $orderName;
      $_SESSION['oldOrder'] = $order;
    }

    $bierenQuery = "SELECT bi.biernr, bi.naam, br.brnaam, s.soort, bi.alcohol FROM bieren AS bi
  LEFT JOIN brouwers AS br ON bi.brouwernr = br.brouwernr
  LEFT JOIN soorten AS s ON bi.soortnr = s.soortnr ORDER BY " .  $orderName . " " . $order;
  }

  $statement = $db->prepare($bierenQuery);

  $statement->execute();

  $bierenArray = array();

  while($row = $statement->fetch(PDO::FETCH_ASSOC))
  {
    $bierenArray[] = $row;
  }


} catch (PDOException $e) {
  $messageContainer = "Er is iets fout gegaan: " . $e->getMessage();
}

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../foundation.min.css">
    <link rel="stylesheet" href="css/master.css">
    <title>Query Order By</title>
  </head>
  <body>
    <h1 class="text-center">Bieren Order by</h1>
    <p><?= $messageContainer ?></p>
    <table>
      <thead>
        <tr>
          <th class="order <?= ($order === 'desc' && $orderName === "biernr") ? 'descending' : 'ascending' ?>"><a href="index.php?order_by=biernr-asc" >Biernummer </a></th>
          <th class="order <?= ($order === 'desc' && $orderName === "naam") ? 'descending' : 'ascending' ?>"><a href="index.php?order_by=naam-asc">Bier</a></th>
          <th class="order <?= ($order === 'desc' && $orderName === "brnaam") ? 'descending' : 'ascending' ?>"><a href="index.php?order_by=brnaam-asc">Brouwer</a></th>
          <th class="order <?= ($order === 'desc' && $orderName === "soort") ? 'descending' : 'ascending' ?>"><a href="index.php?order_by=soort-asc">Soort</a></th>
          <th class="order <?= ($order === 'desc' && $orderName === "alcohol") ? 'descending' : 'ascending' ?>"><a href="index.php?order_by=alcohol-asc">Alcoholpercentage</a></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($bierenArray as $bier): ?>
          <tr>
            <?php foreach($bier as $row): ?>
              <td><?= $row ?></td>
            <?php endforeach ?>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </body>
</html>
