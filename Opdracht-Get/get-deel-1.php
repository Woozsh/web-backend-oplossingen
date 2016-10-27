<?php
  $artikel1 = array("titel" => "LEONARD COHEN MAKES IT DARKER", "paragraaf" => "When Leonard Cohen was twenty-five, he was living in London, sitting in cold rooms writing sad poems. He got by on a three-thousand-dollar grant from the Canada Council for the Arts. This was 1960, long before he played the festival at the Isle of Wight in front of six hundred thousand people. In those days, he was a Jamesian Jew, the provincial abroad, a refugee from the Montreal literary scene. Cohen, whose family was both prominent and cultivated, had an ironical view of himself. He was a bohemian with a cushion whose first purchases in London were an Olivetti typewriter and a blue raincoat at Burberry. Even before he had much of an audience, he had a distinct idea of the audience he wanted. In a letter to his publisher, he said that he was out to reach “inner-directed adolescents, lovers in all degrees of anguish, disappointed Platonists, pornography-peepers, hair-handed monks and Popists.”
", "afbeelding" => "http://www.newyorker.com/wp-content/uploads/2016/10/161017_r28842_rd-903x1200-1476123800.jpg", "beschrijving" => "een man die zit");
$artikel2 = array("titel" => "TIME BANDITS", "paragraaf" => "In 1933, with his great scientific discoveries behind him, Albert Einstein came to America. He spent the last twenty-two years of his life in Princeton, New Jersey, where he had been recruited as the star member of the Institute for Advanced Study. Einstein was reasonably content with his new milieu, taking its pretensions in stride. “Princeton is a wonderful piece of earth, and at the same time an exceedingly amusing ceremonial backwater of tiny spindle-shanked demigods,” he observed. His daily routine began with a leisurely walk from his house, at 115 Mercer Street, to his office at the institute. He was by then one of the most famous and, with his distinctive appearance—the whirl of pillow-combed hair, the baggy pants held up by suspenders—most recognizable people in the world.
", "afbeelding" => "http://www.newyorker.com/wp-content/uploads/2005/02/050228_r13893-1200.jpg", "beschrijving" => "2 mannen die lachen en wat rond kijken enzo");
$artikel3 = array("titel" => "Canonical releases Ubuntu 16.10
", "paragraaf" => "LONDON 13th October 2016: Ubuntu, the platform used in the majority of cloud deployments worldwide, today released version 16.10 with hybrid cloud operations, bare-metal cloud performance, the ability to lift-and-shift 80% of Linux VMs to machine containers, Kubernetes for world-leading process-container coordination, full container support in OpenStack, and telco-grade networking latency enhancements.”
", "afbeelding" => "http://design.ubuntu.com/wp-content/uploads/logo-ubuntu_st_no%C2%AE-black_orange-hex.png", "beschrijving" => "ubuntu logo");

$artikels = array($artikel1, $artikel2, $artikel3);

$individueelArtikel = false;


if (isset($_GET['id'])) {

  $id = $_GET['id'];

  if ( isset( $artikels[$id] )) {
    $individueelArtikel = true;

  }

}
 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
     <link rel="stylesheet" href="style.css" media="screen" title="no title">
     <title>
       Get!
     </title>
   </head>
   <body>
     <h1>Kranten Artikels</h1>
     <div class="articles">
       <?php if( $individueelArtikel ): ?>
         <article class="box" >
           <h2><?= ucfirst(strtolower($artikels[$_GET['id']]["titel"])) ?></h2>
           <img class="img-responsive img-thumbnail" src=<?= $artikels[$_GET['id']]["afbeelding"] ?> alt=<?= $artikels[$_GET['id']]["beschrijving"] ?> />
           <p>
             <?= $artikels[$_GET['id']]["paragraaf"] ?>
           </p>
           <a href="get-deel-1.php">Ga Terug!!!!</a>
         </article>
       <?php else: ?>
       <?php foreach ($artikels as $key => $artikel): ?>
       <article class="box" id=<?= $key ?>>
         <h2><?= ucfirst(strtolower($artikel["titel"])) ?></h2>
         <img class="img-responsive img-thumbnail" src=<?= $artikel["afbeelding"] ?> alt=<?= $artikel["beschrijving"] ?> />
         <p>
           <?= substr($artikel["paragraaf"], 0, 50) ?>...
         </p>
         <a href="get-deel-1.php?id=<?= $key ?>">Lees meer!!!!</a>
       </article>
     <?php endforeach; endif; ?>
     </div>

   </body>
 </html>
