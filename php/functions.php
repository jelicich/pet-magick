<?php
function currentPage($var){
  $cp = basename($_SERVER['REQUEST_URI']);
  if(strpos($cp, $var) !== false)
  {
    echo 'active';
    return;
  }
}

function delete_all_between($beginning, $end, $string) 
{
  $beginningPos = strpos($string, $beginning);
  $endPos = strpos($string, $end);
  if (!$beginningPos || !$endPos) {
    return $string;
  }

  $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);

  return str_replace($textToDelete, '', $string);
}

function replace_between($beginning, $end, $string, $newString) 
{
  $beginningPos = strpos($string, $beginning);
  $endPos = strpos($string, $end);
  if (!$beginningPos || !$endPos) {
    return $string;
  }

  $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);

  return str_replace($textToDelete, $newString, $string);
}
?>