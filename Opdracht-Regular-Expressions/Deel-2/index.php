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
    <link rel="stylesheet" href="../../foundation.min.css">
		<link rel="stylesheet" href="css/master.css">
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
		<ul>
			<li>Match alle letters tussen a en d, en u en z (hoofdletters inclusief)
				<ul>
				<li>Memory can change the shape of a room; it can change the color of a car. And memories can be distorted. They're just an interpretation, they're not a record, and they're irrelevant if you have the facts.</li>
				<li>[a-dA-Du-zU-Z]</li>
				<li>Memor# ##n #h#nge the sh#pe of # room; it ##n #h#nge the #olor of # ##r. #n# memories ##n #e #istorte#. The#'re j#st #n interpret#tion, the#'re not # re#or#, #n# the#'re irrele##nt if #o# h##e the f##ts.</li>
				</ul>
			</li>
			<li>Match zowel colour als color
				<ul>
				<li>Zowel colour als color zijn correct Engels.</li>
				<li>colour|color</li>
				<li>Zowel # als # zijn correct Engels.</li>
				</ul>
			</li>
			<li>Match enkel de getallen die een 1 als duizendtal hebben.
				<ul>
				<li>1020 1050 9784 1560 0231 1546 8745</li>
				<li>1\d+</li>
				<li># # 9784 # 0231 # 8745</li>
				</ul>
			</li>
			<li>Match alle data zodat er enkel een reeks "en" overblijft.
				<ul>
				<li>24/07/1978 en 24-07-1978 en 24.07.1978</li>
				<li>1\d+</li>
				<li># # 9784 # 0231 # 8745</li>
				</ul>
			</li>
		</ul>
  </body>
</html>
