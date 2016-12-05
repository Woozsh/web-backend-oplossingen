<?php
try {
  $db = new PDO('mysql:host=localhost;dbname=bieren', 'root', '', array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  $queryString = "SELECT * FROM bieren LEFT JOIN brouwers ON bieren.brouwernr = brouwers.brouwernr WHERE bieren.naam LIKE 'du%'  AND brouwers.brnaam LIKE '%a%'";

  $statement = $db->prepare($queryString);

  $statement->execute();

  $fetchAssoc = array();

  while ($row = $statement->fetch(PDO::FETCH_ASSOC))
  {
    $fetchAssoc[] = $row;
  }
  $messageContainer = '';


} catch (PDOException $e) {
  $messageContainer = 'Er ging iets mis: ' . $e->getMessage();
}
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../foundation.min.css">
    <link rel="stylesheet" href="css/master.css">
    <title></title>
  </head>
  <body>
    <h1>Overzicht van Bieren</h1>

    <p><?= $messageContainer ?></p>
    <table>
      <thead>
        <td>#</td>
        <td>biernr (PK)</td>
        <td>naam</td>
        <td>brouwernr</td>
        <td>soortnr</td>
        <td>alcohol</td>
        <td>brnaam</td>
        <td>adres</td>
        <td>postcode</td>
        <td>gemeente</td>
        <td>omzet</td>
      </thead>
      <?php $i = 1;foreach($fetchAssoc as $row): ?>
        <tbody>
          <tr>
            <td><?= $i ?></td>
            <td><?= $row['biernr'] ?></td>
            <td><?= $row['naam'] ?></td>
            <td><?= $row['brouwernr'] ?></td>
            <td><?= $row['soortnr'] ?></td>
            <td><?= $row['alcohol'] ?></td>
            <td><?= $row['brnaam'] ?></td>
            <td><?= $row['adres'] ?></td>
            <td><?= $row['postcode'] ?></td>
            <td><?= $row['gemeente'] ?></td>
            <td><?= $row['omzet'] ?></td>
          </tr>
        </tbody>
      <?php $i++;endforeach; ?>
    </table>
  </body>
</html>
