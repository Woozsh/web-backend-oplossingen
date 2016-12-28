<?php
session_start();

include_once('partials/message.php');


if(isset($_SESSION['contact-data']))
{
  $email = $_SESSION['contact-data']['email'];
  $boodschap = $_SESSION['contact-data']['boodschap'];
  $kopie =  $_SESSION['contact-data']['kopie'];
  unset($_SESSION['contact-data']);
}
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../foundation.min.css">
    <link rel="stylesheet" href="css/master.css">
    <title>Contact</title>
  </head>
  <body>
    <div class="container">
      <form action="contact.php" method="post">
        <div class="row">
          <div class="medium-6">
            <h1>Contacteer ons</h1>
          </div>
        </div>
        <div class="row">
          <div class="medium-6">
            <label for="email">E-mailadres</label>
            <input type="mail" name="email" value="<?php if(isset($email)) echo $email ?>">
          </div>
        </div>
        <div class="row">
          <div class="medium-6">
            <label for="boodschap">Boodschap</label>
            <textarea name="boodschap" rows="8" ><?php if(isset($boodschap)) echo $boodschap ?></textarea>
          </div>
        </div>
        <div class="row">
          <div class="medium-6">
            <input type="checkbox" name="kopie" value='1' <?php if(isset($kopie) && $kopie) echo 'checked' ?>> Stuur een kopie naar mezelf
          </div>
        </div>
        <div class="row">
          <div class="medium-6">
            <input class="button" type="submit" name="send" value="Verzenden">
          </div>
        </div>
      </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
      $(function()
      {
        $('form').on('submit',function()
        {
          var input = $( this ).serialize();
          $.ajax({
            type: 'post',
            url: 'contact-API.php',
            data: input,
            success: function(data)
  					{
              output = JSON.parse(data);
              if(output['type'] === 'success')
              {
                $('form').fadeOut(1000, function(){
                  $(this).empty().append('<p>Bedankt! Uw bericht is goed verzonden!<p>').fadeIn();
                });

              }
              else if(output['type'] === 'error'){
                $('form').prepend('<p>Oeps, er ging iets mis. Probeer opnieuw!<p>').hide().fadeIn();
              }
  					}
          });
          return false;
        })
      })
    </script>
  </body>
</html>
