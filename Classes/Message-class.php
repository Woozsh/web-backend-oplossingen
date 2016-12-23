<?php

/**
 * Message
 */
class Message
{
  protected $message;
  protected $messageType;

  public function __construct
  {
    if(isset($_SESSION['notification']['text']))
    {
      $this->messageType = $_SESSION['notification']['type'];
      $this->message = $_SESSION['notification']['text'];
      unset($_SESSION['notification']);
    }

    if(isset($this->messageType))
    {
      switch($this->messageType)
      {
        case 'error': $this->messageType = 'alert';
        break;
        case 'success': $this->messageType = 'success';
        break;
        default: $this->messageType = '';
      }
    }
  }

  public function showMessage()
  {
    if(isset($message))
    {
      return <div class="$this->messageType ? 'callout' : ''  $this->messageType">
        <p >$this->message</p>
      </div>;
    }
  }

  public function setMessage($type, $text, $e = false,)
  {
    if($e) $text = $text . $e->getMessage();

    $_SESSION['notification']['type'] = $type;
    $_SESSION['notification']['text'] = $text;
  }
}




?>
