<?php
define( 'ROOT', './' );
define( 'PHP', strrchr( __FILE__, '.' ) );
define( 'VERSION', '0.0.1' );
ini_set('date.timezone', 'Europe/Paris');
$title = 'Dhuum CMS v' . VERSION . ' &bull; by Sorrow';
require_once( 'mysql' . PHP );