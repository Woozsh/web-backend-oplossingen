<?php
include_once 'view/header-partial.html';
include_once 'view/body-start-articles-partial.html';

$artikels = array(
  '0' => array(
'title' => "Tovenaars",
'img' => "https://a2ua.com/wizard/wizard-003.jpg",
'text' => "Tovenaars zijn heel trendy de laatste tijd.",
'tags' => array( '0' => "wizards" )
),
'1' => array(
'title' => "Weerwolven",
'img' => "http://i439.photobucket.com/albums/qq118/simsuniverse/spellen/desims2/tips_tricks/weerwolf/01.jpg",
'text' => "Weerwolven kom je steeds minder tegen. De laatste gemoedstellingen worden zwaar beïnvloedt door het tekort aan endorfine.",
'tags' => array(
'0' => "hairy",
'1' => "sad" )
),
'2' => array(
'title' => "Spooks",
'img' => "https://i.ytimg.com/vi/VQOfcBKHP7k/maxresdefault.jpg",
'text' => "Laatst is er een enorme stijging in het aantal Spooky Spooks dat er in de regio voorkomen. ",
'tags' => array(
'0' => "spookie",
'1' => "boe",
'2' => "ohnee" )
)
);
foreach($artikels as $artikel):
?>
<div class="blog-post">
  <h3><?= $artikel['title'] ?> <small>3/6/2015</small></h3>
  <img class="thumbnail" src="<?= $artikel['img'] ?>">
  <p><?= $artikel['text'] ?></p>
  <div class="callout">
    <ul class="menu simple">
      <?php foreach($artikel['tags'] as $tag): ?>
      <li><a href="#"><?= $tag ?></a></li>
    <?php endforeach; ?>
    </ul>
  </div>
</div>
<?php
endforeach;
include_once 'view/body-end-articles-partial.html';

include_once 'view/footer-partial.html';

 ?>
