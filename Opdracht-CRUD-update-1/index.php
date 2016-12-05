<?php
$messageContainer = '';
$messageDelete = '';
try {
  $db = new PDO('mysql:host=localhost;dbname=bieren', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  $queryString = "SELECT * FROM brouwers";

  $statement = $db->prepare($queryString);
  $statement->execute();

  $brouwersArray = array();

  while( $row = $statement->fetch(PDO::FETCH_ASSOC)){
    $brouwersArray[] = $row;
  }

  if(isset($_GET['edit'])){

    $queryEdit = "SELECT * FROM brouwers WHERE brouwernr = :brouwersid";

    $statementEdit = $db->prepare($queryEdit);

    $statementEdit->bindValue(':brouwersid', $_GET['edit']);

    $statementEdit->execute();

    $editArray = array();
    while($row= $statementEdit->fetch(PDO::FETCH_ASSOC)){
      $editArray[] = $row;
    }
  }
  if(isset($_POST['wijzigen'])){
    $queryWijzigen = "UPDATE brouwers SET brnaam = :brnaam, adres = :adres, postcode = :postcode, gemeente = :gemeente, omzet = :omzet WHERE brouwernr = :brouwernr LIMIT 1";

    $statementWijzigen = $db->prepare($queryWijzigen);

    $statementWijzigen->bindValue(":brnaam", $_POST['brnaam']);
    $statementWijzigen->bindValue(":adres", $_POST['adres']);
    $statementWijzigen->bindValue(":postcode", $_POST['postcode']);
    $statementWijzigen->bindValue(":gemeente", $_POST['gemeente']);
    $statementWijzigen->bindValue(":omzet", $_POST['omzet']);
    $statementWijzigen->bindValue(":brouwernr", $_POST['brouwernr']);

    $statementWijzigen->execute();

    $messageContainer = "Gelukt, met succes gewijzigd";
  }

} catch (PDOException $e) {
  $messageContainer = 'Er ging iets mis: ' . $e->getMessage();
}

if(isset($_GET['delete']))
{
  try {
    $brouwernr = $_GET['delete'];

    $queryString = "DELETE FROM brouwers WHERE brouwers.brouwernr = :brouwernr";

    $statement = $db->prepare($queryString);

    $statement->bindValue(':brouwernr', $brouwernr);

    $statement->execute();

    $messageDelete = "Gelukt. De datarij is verwijderd.";
  } catch (PDOException $e) {
    $messageDelete = "De datarij kon niet verwijderd worden. Probeer opnieuw: " . $e->getMessage();
  }

}

 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="../foundation.min.css">
     <link rel="stylesheet" href="css/master.css">
     <title>Delete</title>
   </head>
   <body>
    <?php if(isset($_GET['edit'])): ?>
      <h1>Brouwerij <?= $brouwersArray[0]['brnaam'] ?> ( #<?= $_GET['edit'] ?> ) wijzigen</h1>
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="brnaam">Brouwernaam</label>
        <input type="text" name="brnaam" value="<?= $brouwersArray[0]['brnaam'] ?>">
        <label for="adres">adres</label>
        <input type="text" name="adres" value="<?= $brouwersArray[0]['adres'] ?>">
        <label for="postcode">postcode</label>
        <input type="text" name="postcode" value="<?= $brouwersArray[0]['postcode'] ?>">
        <label for="gemeente">gemeente</label>
        <input type="text" name="gemeente" value="<?= $brouwersArray[0]['gemeente'] ?>">
        <label for="omzet">omzet</label>
        <input type="text" name="omzet" value="<?= $brouwersArray[0]['omzet'] ?>">
        <input type="submit" class="button" name="wijzigen" value="Verzenden">
      </form>
    <?php endif; ?>
    <h1>Overzicht van brouwers</h1>
    <p><?= $messageContainer ?></p>
    <p><?= $messageDelete ?></p>

    <table>
      <thead>
        <td>#</td>
        <td>brouwernr</td>
        <td>brnaam</td>
        <td>adres</td>
        <td>postcode</td>
        <td>gemeente</td>
        <td>omzet</td>
        <td></td>
        <td></td>
      </thead>
      <tbody>
        <?php $i=1;foreach($brouwersArray as $row): ?>
          <tr>
            <td><?= $i ?></td>
            <td><?= $row['brouwernr'] ?></td>
            <td><?= $row['brnaam'] ?></td>
            <td><?= $row['adres'] ?></td>
            <td><?= $row['postcode'] ?></td>
            <td><?= $row['gemeente'] ?></td>
            <td><?= $row['omzet'] ?></td>
            <td><form method="get">
              <button type="submit" name="delete" value="<?= $row['brouwernr'] ?>"><img src="img/icon-delete.png" alt="delete-icon"></button>
            </form></td>
            <td><form method="get">
              <button type="submit" name="edit" value="<?= $row['brouwernr'] ?>"><img src="img/edit.png" alt="edit-icon" height="16px" width="16px"></button>
            </form></td>
          </tr>
        <?php $i++;endforeach; ?>
      </tbody>
    </table>
   </body>
 </html>
