<?php


$lang='';

if(isSet($_SESSION['lang']))
{
$lang = $_SESSION['lang'];
}


else
{
$_SESSION['lang'] = getUserLanguage();
$lang = $_SESSION['lang'];
}

switch ($lang) {
  case '1':
  $lang_file = 'languages/lang_en.php';
  break;

  case '2':
  $lang_file = 'languages/lang_ar.php';
  break;

  case '3':
  $lang_file = 'languages/lang_tr.php';
  break;

  default:
  $lang_file = 'languages/lang_en.php';

}

include_once $lang_file;
?>