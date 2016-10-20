<?php
  function searchFiles(){
    if(isset($_GET[])){
      
    }
  }

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" media="screen" title="no title">
    <title>Indexpagina</title>
  </head>
  <body>
    <h2><a href="herhalingsopdracht-01.php">Index Pagina</a></h2>
    <ul>
      <li><a href="herhalingsopdracht-01.php?link=cursus">Cursus</a></li>
      <li><a href="herhalingsopdracht-01.php?link=voorbeelden">Voorbeelden</a></li>
      <li><a href="herhalingsopdracht-01.php?link=opdrachten">Opdrachten</a></li>
      <li><a href="herhalingsopdracht-01.php?link=oplossingen">Oplossingen</a></li>
    </ul>
    <form action="herhalingsopdracht-01.php" method="get">
      <div class="form-group">
        <label for="zoeken">Zoek naar: </label>
        <input type="search" name="zoeken" placeholder="Geef een zoekterm in">
        <input type="submit" class="btn btn-primary" name="send" value="Search">
      </div>
    </form>
    <h2>Inhoud</h2>
    <div class="inhoud">
      <?php
        $page = null;
        if(isset($_GET['link'])){
          $link = $_GET['link'];
          switch($link){
            case "cursus":
              $page = "http://web-backend.local/cursus/web-backend-cursus.pdf";
              ?>
             <iframe src="<?= $page ?>" alt="Hier komt de inhoud van de cursus">
               Hier komt de inhoud van de cursus
             </iframe>
              <?php
              break;
            case "voorbeelden":
              $page = "../../cursus/public/cursus/voorbeelden/";
              chdir($page);
              $pagelink = "http://web-backend.local/cursus/voorbeelden/";
              ?>
              <ul class="voorbeelden">
              <?php foreach (glob("*/*.php") as $file) { ?>

                  <li>
                    <a href=<?= $pagelink . $file ?> target="_blank">
                      <?= $file ?>
                    </a>
                  </li>
              <?php } ?>
              </ul>
              <?php
              break;
            case "opdrachten":
              $page = "../../cursus/public/cursus/opdrachten";
              chdir($page);
              $pagelink = "http://web-backend.local/cursus/opdrachten/";
              ?>
              <ul class="voorbeelden">
              <?php foreach (glob("*/*.html") as $file) { ?>

                  <li>
                    <a href=<?= $pagelink . $file ?> target="_blank">
                      <?= $file ?>
                    </a>
                  </li>

              <?php } ?>
              </ul>
              <?php
              break;
            case "oplossingen":
              $page = "../";
              chdir($page);
              $pagelink = "http://oplossingen.web-backend.local/";
              ?>
              <ul class="voorbeelden">
              <?php foreach (glob("*/*.php") as $file) { ?>

                  <li>
                    <a href=<?= $pagelink . $file ?> target="_blank">
                      <?= $file ?>
                    </a>
                  </li>

              <?php } ?>
              </ul>
              <?php
              break;

          }
        }
       ?>
    </div>
  </body>
</html>
