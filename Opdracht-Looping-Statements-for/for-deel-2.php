<?php
$rijen = 10;
$kolommen = 10;

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>For loop</title>
  </head>
  <body>
    <table class="table table-bordered">
      <?php for ($i=0; $i <= $rijen; $i++) { ?>
        <tr>
          <?php for ($j=0; $j <= $kolommen; $j++) { ?>
            <td>
              <?php echo $i*$j; ?>
            </td>
          <?php } ?>
        </tr>
      <?php } ?>
    </table>
  </body>
</html>
