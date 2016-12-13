<?php

class Thumbnail
{
  protected $imgpath;
  protected $thumbpath;

  public function __construct($thumbpath)
  {
    $this->thumbpath = $thumbpath;
  }

  public function getPath($filename)
  {
    $fileParts	=	pathinfo($filename);

    $thumbfilepath = $this->thumbpath . $fileParts['filename'] . "_thumbs." . $fileParts['extension'];

    return $thumbfilepath;
  }
  public function getFilename($filename)
  {
    $fileParts	=	pathinfo($filename);

    $thumbfilename = $fileParts['filename'] . "_thumbs." . $fileParts['extension'];

    return $thumbfilename;
  }
}

 ?>
