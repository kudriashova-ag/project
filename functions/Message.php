<?php
class Message{
  public static function set($text, $type='success')
  {
    $_SESSION['message'] = [$text, $type];
  }

  public static function get()
  {
    if (isset($_SESSION['message'])) {
      list($text, $type) = $_SESSION['message'];
      $text = is_array($text) ? implode('<br>', $text)  : $text;
      echo "<div class='alert alert-$type'>$text</div>";
      unset($_SESSION['message']);
    }
  }
}

