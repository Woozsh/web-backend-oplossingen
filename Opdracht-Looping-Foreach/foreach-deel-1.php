<?php
$text = file_get_contents('text-file.txt');
$textChars = str_split($text);
  sort($textChars);
$textChars = array_reverse($textChars);
$uniqueChars = array_count_values($textChars);
$uniqueCharsCount = count($uniqueChars);

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Foreach</title>
  </head>
  <body>
    <h2>Er komen in totaal <?= $uniqueCharsCount ?> verschillende karakters voor.</h2>
    <table>
      <?php foreach ($uniqueChars as $key => $value) { ?>
        <tr>
          <td>
             <?= $key ?>
          </td>
          <td>
            <?= $value ?>
          </td>
        </tr>
      <?php } ?>
    </table>

  </body>
</html>
