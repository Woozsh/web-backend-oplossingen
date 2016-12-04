<?php
session_start();

$createMessage = false;
$isValid = false;
$errorMessage = '';
try
{
  if(isset($_POST['submit']))
  {
    if($_POST['code'] == '')
    {
      throw new Exception("SUBMIT-ERROR");
    }
    elseif(strlen($_POST['code']) == 8 )
    {
      $isValid = true;
    }
    else {
      throw new Exception("VALIDATION-CODE-LENGTH");
    }
  }
}
catch (Exception $e)
{
  $messageCode = $e->getMessage();

  switch($messageCode){ //Makes an appropriate message depending on the error code.
    case 'SUBMIT-ERROR': $message['text'] = "Er werd met het formulier geknoeid"; $message['type'] = 'error';
    $createMessage = true;
    break;
    case 'VALIDATION-CODE-LENGTH': $message['text'] = "De kortingscode heeft niet de juiste lengte"; $message['type'] = 'error';
    $createMessage = true;
    break;
  }
  if($createMessage) createMessage($message);

  $errorMessage = showMessage();
  logToFile($message);
}

function logToFile($message){
  $date = "[" . date("H:i:s d/m/Y", time()) . "]" ;

  $errorString = $date . " - " . $_SERVER['REMOTE_ADDR'] . " - " . "type:[" . $message['type'] . "] " . $message['text'] . "\n\r";

  file_put_contents( 'log.txt', $errorString, FILE_APPEND);
}

function createMessage($message){
  $_SESSION['message']['type'] = $message['type'];
  $_SESSION['message']['message'] = $message['text'];
}

function showMessage(){
  if($_SESSION['message'] != ''){
    $message = $_SESSION['message']['message'];
    unset($_SESSION['message']);
    return $message;
  }else return false;
}
 ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../foundation.min.css">
    <link rel="stylesheet" href="css/global.css">
    <title>Form</title>
  </head>
  <body>
    <h1>Geef uw kortingscode op</h1>
    <?php if(!$isValid): ?>
      <form method="post">
        <div class="label alert">
          <?= $errorMessage ?>
        </div>
        <div class="large-4">
        <label for="code">Kortingscode</label>
        <input type="text" name="code">
        </div>
        <input type="submit" class="button" name="submit" value="Verzenden">
      </form>
    <?php else: ?>
      <p>Korting toegekend!</p>
    <?php endif; ?>
  </body>
</html>
