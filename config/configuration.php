<?php
define( 'ROOT', './' ); // Pour plus tard
define( 'PAGES', 'pages/' );
define( 'PHP', strrchr( __FILE__, '.' ) );
define( 'VERSION', '0.0.2' );
ini_set('date.timezone', 'Europe/Paris');

//require_once( 'database' . PHP );
require_once( 'functions' . PHP );
require_once( 'SystemClass' . PHP );

$sys = new SystemClass;

//Database Information
$sys->dbHost= 'localhost'; //Database Host
$sys->dbName= 'teachrate'; //Database Name
$sys->dbUser= 'root'; //Database Username
$sys->dbPass= ''; //Database Password

$sys->tableCheck();

$title = 'Teach Rate v' . VERSION;
$description = 'Nothing';