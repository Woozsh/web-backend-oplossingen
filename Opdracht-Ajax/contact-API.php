<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
    if(isset($_POST['email']) && isset($_POST['boodschap']))
    {
      $ajaxMessage['type'] = 'success';
      $jsonDATA = json_encode($ajaxMessage);

      echo $jsonDATA;
    }
    else {
      //geen post waardes
    }
  }
  else {
    //geen ajax request
  }


 ?>
