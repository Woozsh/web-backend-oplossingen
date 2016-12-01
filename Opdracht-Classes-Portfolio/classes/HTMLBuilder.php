<?php
class HTMLBuilder
{
  public $headerName;
  public $bodyName;
  public $footerName;
  public $cssFiles = array();

  // private function buildCSS(){
  //   foreach (glob("css/*.css") as $cssFile){
  //     $this->cssFiles += $cssFile;
  //   }
  // }
  public function __construct($headerName, $bodyName, $footerName)
  {
    $this->headerName = "html/" . $headerName . ".partial.php";
    $this->bodyName = "html/" . $bodyName . ".partial.php";
    $this->footerName = "html/" . $footerName . ".partial.php";
  }

  public function buildHeader(){
    // $this->buildCSS();
    include $this->headerName;
  }
  public function buildbody(){
    include $this->bodyName;
  }
  public function buildfooter(){
    include $this->footerName;
  }
}

 ?>
