<?php
try {
  $db = new PDO('mysql:host=localhost;dbname=bieren', 'root', '', array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  $queryString = "SELECT brouwernr, brnaam FROM brouwers";

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
if(isset($_GET['send'])){
  try {
    $db = new PDO('mysql:host=localhost;dbname=bieren', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $biermerk = $_GET['biermerk'];

    $queryString = "SELECT naam FROM bieren WHERE brouwernr = :biermerk";

    $statement = $db->prepare($queryString);

    $statement->bindValue(':biermerk', $biermerk);

    $statement->execute();

    $bierenArray = array();

    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
      $bierenArray[] = $row;
    }

  } catch (PDOException $e) {
    $messageContainer = 'Er ging iets mis met de tabel: ' . $e->getMessage();
  }

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
    <form method="get">
      <div class="row">
        <select  name="biermerk">
          <?php foreach($fetchAssoc as $row): ?>
          <option value="<?= $row['brouwernr'] ?>" <?php if(isset($_GET['send']) && $row['brouwernr'] == $_GET['biermerk']): ?> selected <?php endif; ?>><?= $row['brnaam'] ?></option>
        <?php endforeach; ?>
        </select>
        <input type="submit" name="send" value="Geef mij alle bieren van deze brouwerij">
      </div>
    </form>

    <?php if(isset($_GET['send'])): ?>
      <table>
        <thead>
          <td>Aantal</td>
          <td>naam</td>
        </thead>
        <tbody>
          <?php $i = 1; foreach($bierenArray as $row): ?>
            <tr>
              <td><?= $i ?></td>
              <td><?= $row['naam'] ?></td>
            </tr>
          <?php $i++; endforeach; ?>
        </tbody>
        <tfoot>
          <td><?= count($bierenArray) ?></td>
          <td>total</td>
        </tfoot>
      </table>
    <?php endif; ?>
  </body>
</html>
