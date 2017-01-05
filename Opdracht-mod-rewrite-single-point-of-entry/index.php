<?php
var_dump($_GET);
spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.php';
});

if(isset($_GET['controller']))
{
  $class = ucfirst($_GET['controller']);
  $object = new $class;
  if(isset($_GET['method']))
  {
    $method = $_GET['method'];
    $object->$method();

  }
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="/../foundation.min.css">
    <meta charset="utf-8">
    <title>Index</title>
  </head>
  <body>
    <?php

     ?>
  </body>
</html>
