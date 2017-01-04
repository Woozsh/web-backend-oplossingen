<?php

$_SESSION['notification']['type'] = "error";
$_SESSION['notification']['text'] = "Invalid email format";
header('location: ' . $registrationForm );
 ?>
