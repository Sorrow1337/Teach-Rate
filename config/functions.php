<?php
function page_name($page)
{
  switch($page)
  {
    case 'home';
      $page = 'Acceuil';
      break;
    case ''; // Si $page est vide
      $page = 'Acceuil';
      break;
    case '404';
      $page = 'Erreur 404';
      break;
    /*case '';
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