<?php
define( 'PAGES', 'pages/' );
define( 'PHP', strrchr( __FILE__, '.' ) );
define( 'VERSION', '0.0.5' );
ini_set('date.timezone', 'Europe/Paris');

require_once( 'functions' . PHP );
require_once( 'SystemClass' . PHP );

$sys = new SystemClass;

$sys->dbHost = 'localhost';
$sys->dbName = 'teachrate';
$sys->dbUser = 'root';
$sys->dbPass = '';

$sys->size = 'medium'; // (small,medium,large)
$sys->color = 'green'; // (orange,red,blue,green,pink,purple,black,white)

$sys->website = $_SERVER['HTTP_HOST'];

$title = 'Teach Rate v' . VERSION;
$description = 'Note t\'es profs';