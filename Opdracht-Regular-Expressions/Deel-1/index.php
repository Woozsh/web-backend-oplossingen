<?php
if(isset($_POST['submit']))
{
	$reg = $_POST['regex'];
	$regEx = '/' . $_POST['regex'] . '/';
	$searchString = $_POST['string'];
	$replaceString = '<span>#</span>';
	$resultaat = preg_replace($regEx, $replaceString, $searchString);
}

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
		<link rel="stylesheet" href="css/master.css">
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
        <input type="text" name="regex" value="<?php if(isset($reg)) echo $reg ?>">
      </div>
			<div class="row">
        <label for="string">String</label>
        <textarea name="string" rows="8" cols="80"><?php if(isset($searchString)) echo $searchString ?></textarea>
      </div>
			<div class="row">
				<input class="button" type="submit" name="submit" value="Submit">
      </div>
      <?php if(isset($resultaat)): ?>
      <div class="row">
        <p class="resultaat">Resultaat: <?= $resultaat ?></p>
      </div>
      <?php endif; ?>
    </form>
  </body>
</html>
