<?php
/**
 *
 */
class Percent
{
  public $absolute;
  public $relative;
  public $hundred;
  public $nominal;

  public function __construct($new, $unit)
  {
    $this->absolute = ($new / $unit);
    $this->relative = $this->absolute - 1;
    $this->hundred = $this->absolute * 100;
    $this->nominal = ($this->absolute > 1) ? 'positive' : (($this->absolute < 1) ? 'negative' : 'status-quo');
    // $this->formatNumber($this->absolute);
    // $this->formatNumber($this->relative);

  }

  public function formatNumber ($number){
    return formatNumber($number, 2, ',');
  }
}



 ?>
