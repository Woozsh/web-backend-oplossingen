<?php
function schrikkel ($jaar){
  if($jaar%4 == 0 && $jaar%100 != 0){
    return "een schrikkeljaar";
  }
  else{
    if($jaar%400 == 0) return "een schrikkeljaar";
    else return "geen schrikkeljaar";
  }
}
$date = date("Y");

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Schrikkeljaar</title>
  </head>
  <body>
      <h1>Dit jaar is <?= schrikkel($date) ?>.</h1>
  </body>
</html>
