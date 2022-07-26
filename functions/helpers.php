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

function translit($st)
{
  $st = mb_strtolower($st, "utf-8");
  $st = str_replace([
    '?', '!', '.', ',', ':', ';', '*', '(', ')', '{', '}', '[', ']', '%', '#', '№', '@', '$', '^', '-', '+', '/', '\\', '=', '|', '"', '\'',
    'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'з', 'и', 'й', 'к',
    'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х',
    'ъ', 'ы', 'э', ' ', 'ж', 'ц', 'ч', 'ш', 'щ', 'ь', 'ю', 'я'
  ], [
    '_', '_', '.', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_',
    'a', 'b', 'v', 'g', 'd', 'e', 'e', 'z', 'i', 'y', 'k',
    'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h',
    'j', 'i', 'e', '_', 'zh', 'ts', 'ch', 'sh', 'shch',
    '', 'yu', 'ya'
  ], $st);
  $st = preg_replace("/[^a-z0-9_.]/", "", $st);
  $st = trim($st, '_');

  $prev_st = '';
  do {
    $prev_st = $st;
    $st = preg_replace("/_[a-z0-9]_/", "_", $st);
  } while ($st != $prev_st);

  $st = preg_replace("/_{2,}/", "_", $st);
  return $st;
}
