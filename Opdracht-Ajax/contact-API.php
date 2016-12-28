<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
    if(isset($_POST['email']) && isset($_POST['boodschap']))
    {
			$admin = "jordypeww@gmail.com";
	    $email = $_POST['email'];
	    $boodschap = $_POST['boodschap'];
	    $kopie = (isset($_POST['kopie']) && $_POST['kopie'] == 1) ? true : false;

	    $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBHOST, DBPW, array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

	    $queryAddMail = "INSERT INTO contact_messages (email, message, time_sent) VALUES ( :email, :boodschap, NOW() )";

	    $statementAddMail = $db->prepare($queryAddMail);
	    $statementAddMail->bindValue(":email", $email);
	    $statementAddMail->bindValue(":boodschap", $boodschap);
	    $added = $statementAddMail->execute();

	    if($added)
	    {
	      $headers[] = 'From: '. $email;
	      $headers[] = 'Content-type: text/html; charset=iso-8859-1';

	      if($kopie){
	        echo "kopie checked";
	        $success = mail($email,"Question",$boodschap,implode("\r\n", $headers));
	      }
	      $success = mail($admin,"Question",$boodschap,implode("\r\n", $headers));

	      if($success)
	      {
					$ajaxMessage['type'] = 'success';

	      }else{
					$ajaxMessage['type'] = 'error';

				}
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
