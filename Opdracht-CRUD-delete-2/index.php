<?php
$messageContainer = '';
$messageDelete = '';
$confirmDelete = false;
//SHOW TABLE
try {
  $db = new PDO('mysql:host=localhost;dbname=bieren', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  $queryString = "SELECT * FROM brouwers";

  $statement = $db->prepare($queryString);

  $statement->execute();

  $brouwersArray = array();

  while( $row = $statement->fetch(PDO::FETCH_ASSOC)){
    $brouwersArray[] = $row;
  }


} catch (PDOException $e) {
  $messageContainer = 'Er ging iets mis: ' . $e->getMessage();
}

//DELETE ROW
if(isset($_GET['delete']))
{
  try {
    $brouwernr = $_GET['delete'];

    $queryString = "DELETE FROM brouwers WHERE brouwers.brouwernr = :brouwernr";

    $statement = $db->prepare($queryString);

    $statement->bindValue(':brouwernr', $brouwernr);

    confirmDelete(); //Asks for confirmation to delete

    if($confirmDelete) $statement->execute();

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
    <h1>Overzicht van brouwers</h1>
    <p><?= $messageContainer ?></p>
    <?php function confirmDelete(){
      ?><div class="alert-box [radius round]">Bent u zeker dat u deze datarij wil verwijderen?<form method="get">
        <button class="button" type="submit" name="confirmDelete">Ja!</button>
        <button type="submit" class="button alert" name="abortDelete">Neeee!</button>
      </form></div>
    <?php if(isset($_GET['confirmDelete'])) $confirmDelete = true;} ?>

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
          </tr>
        <?php $i++;endforeach; ?>
      </tbody>
    </table>
   </body>
 </html>
