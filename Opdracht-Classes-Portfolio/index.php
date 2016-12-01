<?php
function __autoload($className){
  include 'classes/' . $className . '.php';
}
$html = new HTMLBuilder("header", "body" , "footer");
 ?>

 <?php $html->buildHeader() ?>
 <?php $html->buildBody() ?>
 <?php $html->buildFooter() ?> 
