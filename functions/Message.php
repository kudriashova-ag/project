<?php

class Message
{
  static public function set($msg, $type = 'success')
  {
    $_SESSION['message'] = [$msg, $type];
  }

  static public function get()
  {
    if(self::isset()){
      list($msg, $type) = $_SESSION['message'];
      if(is_array($msg)){
        $msg = implode('<br>', $msg);
      }
      echo "<div class='alert alert-$type'>$msg</div>";
      self::remove();
    }
  }

  static public function remove()
  {
    if(self::isset()) unset($_SESSION['message']);
  }

  static private function isset()
  {
    return isset($_SESSION['message']);
  }
}
