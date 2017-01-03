<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
    if(isset($_POST['regex']) && isset($_POST['string']))
    {
      echo $resultaat = "12";
    }
  }
  else {
    //geen ajax request
  }

 ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../foundation.min.css">
    <title>RegEx Tester</title>
  </head>
  <body>
    <form class="" action="" method="post">
      <div class="row">
        <h1>RegEx Tester</h1>
      </div>
      <div class="row">
        <label for="regex">Regular Expression</label>
        <input type="text" name="regex" value="">
      </div>
      <div class="row">
        <label for="string">String</label>
        <textarea name="string" rows="8" cols="80"></textarea>
      </div>
      <?php if(isset($resultaat)): ?>
      <div class="row">
        <p>Resultaat: <?= $resultaat ?></p>
      </div>
      <?php endif; ?>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script>
      $(function(){
        $('form').keypress(function(e){
          if(e.which == 13) {
            $.ajax({
              type: 'post',
              url: 'index.php',
              data: input,
              success: function(data)
    					{
    					}
            });
          }
        });
      })
    </script>
  </body>
</html>
