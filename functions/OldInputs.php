<?php
class OldInputs{
  public static function set($inputs)
  {
    $_SESSION['old_inputs'] = $inputs;
  }

  public static function get($key)
  {
    if (isset($_SESSION['old_inputs'][$key])) {
      return $_SESSION['old_inputs'][$key];
    }
  }

  public static function remove(){
    if (isset($_SESSION['old_inputs'])){
      unset($_SESSION['old_inputs']);
    }
  }

}
