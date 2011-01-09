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
    case 'details';
      $page = 'Fiche profil';
      break;
    case 'comments';
      $page = 'Commentaires';
      break;
    case 'admin';
      $page = 'Administration';
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