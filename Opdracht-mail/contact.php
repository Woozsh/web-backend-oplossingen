<?php
include_once('partials/config.php');

try {
  if(isset($_POST['send']))
  {
    $admin = "jordypeww@gmail.com";
    $email = $_POST['email'];
    $boodschap = $_POST['boodschap'];
    $kopie = (isset($_POST['kopie']) && $_POST['kopie'] == '1') ? true : false;

    $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBHOST, DBPW);

    $queryAddMail = "INSERT INTO contact_messages (email, message, time_sent) VALUES (:email, :boodschap, NOW())";

    $statementAddMail = $db->prepare($queryAddMail);
    $statementAddMail->bindValue(":email", $email);
    $statementAddMail->bindValue(":boodschap", $boodschap);
    $statementAddMail->execute();

    $headers[] = 'From: '. $email;
    $headers[] = 'Content-type: text/html; charset=iso-8859-1';

    if($kopie){
      mail($email,"Question",$boodschap,implode("\r\n", $headers));
    }
    $success = mail($admin,"Question",$boodschap,implode("\r\n", $headers));

    if($success)
    {
      $_SESSION['notification']['type'] = "success";
      $_SESSION['notification']['text'] =  "De mail is verzonden.";
      header('location: contact-form.php');
    }else{
      $_SESSION['contact-data']['email'] = $email;
      $_SESSION['contact-data']['boodschap'] = $boodschap;
      $_SESSION['contact-data']['kopie'] = $kopie;
      throw new Exception("Sending mail failed");
    }
  }
  else {
    throw new Exception("Submit failed");
  }
} catch (PDOException $e) {
  $_SESSION['notification']['type'] = "error";
  $_SESSION['notification']['text'] =  "Fout: " . $e->getMessage();
  // header('location: contact-form.php');
}

// header('location: contact-form.php');

 ?>
