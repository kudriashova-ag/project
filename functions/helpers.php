<?php

function clear($str)
{
  return htmlentities(trim($str));
}

function dump($arr)
{
  echo '<pre>' . print_r($arr, true) . '</pre>';
}

function redirect($page)
{
  header("Location: index.php?page=$page");
  die();  // exit()
}