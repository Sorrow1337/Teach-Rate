<?php
define( 'ROOT', './' ); // Pour plus tard
define( 'PHP', strrchr( __FILE__, '.' ) );
define( 'VERSION', '0.0.1' );
ini_set('date.timezone', 'Europe/Paris');

require_once( 'mysql' . PHP );
require_once( 'functions' . PHP );

$title = 'Dhuum CMS v' . VERSION . ' &bull; by Sorrow';
$description = 'Nothing';