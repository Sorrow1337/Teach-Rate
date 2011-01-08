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

$title = 'Teach Rate v' . VERSION;
$description = 'Note t\'es profs';