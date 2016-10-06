<?php
$getal = 0;
while($getal < 101){
  echo $getal . ", ";
  $getal++;
}
$getal = 0;
echo "<br><br>";
while($getal < 101){
  if($getal%3 == 0 && ($getal < 80 && $getal > 40))
  echo $getal . ", ";
  $getal++;
}

 ?>
