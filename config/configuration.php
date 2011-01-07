<?php
define( 'ROOT', './' ); // Pour plus tard
define( 'PAGES', 'pages/' );
define( 'PHP', strrchr( __FILE__, '.' ) );
define( 'VERSION', '0.0.4' );
ini_set('date.timezone', 'Europe/Paris');

require_once( 'functions' . PHP );
require_once( 'SystemClass' . PHP );

$sys = new SystemClass;

$sys->dbHost= 'localhost'; //Database Host
$sys->dbName= 'teachrate'; //Database Name
$sys->dbUser= 'root'; //Database Username
$sys->dbPass= ''; //Database Password

$title = 'Teach Rate v' . VERSION;
$description = 'Nothing';