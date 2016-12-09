<?php

session_start();
$messageContainer = '';
$messageDelete = '';
try {
  $db = new PDO('mysql:host=localhost;dbname=bieren', 'root', '');

  $queryString = "SELECT * FROM brouwers";

  //display brouwers data via functie
  $brouwersQuery = query($db, $queryString); //db link + query + (opt.) VARS
  $brouwersFieldnames = $brouwersQuery['fieldnames'];
  $brouwers = $brouwersQuery['data'];


  if(isset($_POST['edit'])){

    $queryEdit = "SELECT * FROM brouwers WHERE brouwernr = :brouwersid";

    $statementEdit = $db->prepare($queryEdit);

    $_SESSION['editnr'] = $_POST['edit'];

    $statementEdit->bindValue(':brouwersid', $_SESSION['editnr']);

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

    $wijzigenSucces = $statementWijzigen->execute();

    if($wijzigenSucces)
    {
      $messageContainer = "Gelukt, brouwer nr " . $_SESSION['editnr'] . " met succes gewijzigd";
    }
  }

} catch (PDOException $e) {
  $messageContainer = 'Er ging iets mis: ' . $e->getMessage();
}

//OUR FUNCTION TO EXECUTE A QUERY
function query($db, $query, $tokens = false){
  $statement = $db->prepare($query);

  if($tokens){ //assign variables as $var[':var'] = $var
    foreach($tokens as $token => $tokenValue){
      $statement->bindValue($token, $tokenValue);
    }
  }

  $statement->execute();

  //Veldnamen
  $fieldNames = array();

  for($i = 0; $i < $statement->columnCount(); ++$i){ //overloopt alle kolommen
    $fieldnames[] = $statement->getColumnMeta($i)['name']; //slaat de headername van de kolom op
  }

  //De data ophalen
  while($row = $statement->fetch(PDO::FETCH_ASSOC))
  {
    $data[] = $row;
  }

  $returnarray['fieldnames'] = $fieldnames;
  $returnarray['data'] = $data;

  return $returnarray;

}
if(isset($_POST['delete']))
{
  try {
    $brouwernr = $_POST['delete'];

    $queryString = "DELETE FROM brouwers WHERE brouwers.brouwernr = :brouwernr";

    $statement = $db->prepare($queryString);

    $statement->bindValue(':brouwernr', $brouwernr);

    $isDeleted = $statement->execute();

    if($isDeleted){
      $messageDelete = "Gelukt. De datarij is verwijderd.";
    }else{
      $messageDelete = "De datarij kon niet verwijderd worden. Reden: " . $statement->errorInfo()[2];
    }

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
    <?php if(isset($_POST['edit'])): ?>
      <h1>Brouwerij <?= $editArray[0]['brnaam'] ?> ( #<?= $_POST['edit'] ?> ) wijzigen</h1>
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <?php foreach($editArray[0] as $edit => $value): ?>
          <label for="<?= $edit ?>"><?= $edit ?></label>
          <input type="text" name="<?= $edit ?>" value="<?= $value ?>">
        <?php endforeach ?>
        <input type="submit" class="button" name="wijzigen" value="Verzenden">
      </form>
    <?php endif; ?>
    <h1>Overzicht van brouwers</h1>
    <p><?= $messageContainer ?></p>
    <p><?= $messageDelete ?></p>

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
      <table>

        <thead>
          <tr>
            <?php foreach($brouwersFieldnames as $headerRow): ?>
              <th><?= $headerRow ?></th>
            <?php endforeach; ?>
            <th></th>
            <th></th>
          </tr>
        </thead>

        <tbody>
          <?php foreach($brouwers as $brouwer): ?>
            <tr>
              <?php foreach($brouwer as $row): ?>
                <td><?= $row ?></td>
              <?php endforeach ?>
              <td>
                <button type="submit" name="delete" value="<?= $brouwer['brouwernr'] ?>"><img src="img/icon-delete.png" alt="delete-icon"></button>
              </td>
              <td>
                <button type="submit" name="edit" value="<?= $brouwer['brouwernr'] ?>"><img src="img/edit.png" alt="edit-icon" height="16px" width="16px"></button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </form>

   </body>
 </html>
