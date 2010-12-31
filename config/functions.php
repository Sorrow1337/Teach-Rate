<?php
function page_name($page)
{
  switch($page)
  {
    case 'acceuil';
      $page = 'Acceuil';
      break;
    /*case '';
      $page = '';
      break;
    case '';
      $page = '';
      break;
    case '';
      $page = '';
      break;
    case '';
      $page = '';
      break;*/
    default :
      $page = 'Unknown';
      break;
  }
  return $page;
}