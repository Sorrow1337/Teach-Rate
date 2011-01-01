<?php
require_once 'config/configuration.php';

$page = htmlentities(@$_GET['page']);

include_once 'build/header.php';

if(isset($page) && $page != '')
{
  if(file_exists(PAGES . $page . PHP))
  {
    include_once PAGES . $page . PHP;
  }
  else
  {
    include_once PAGES . '404' . PHP;
  }
}
else
{
  include_once PAGES . 'home' . PHP;
}

include_once 'build/footer.php';