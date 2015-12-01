<?php
//Define a path contants for requires
define('CLASSES', __DIR__ . '/Classes/');
define('LAYOUTS', __DIR__ . '/Layouts/');
require 'Controllers/AppController.php';

$controller = new AppController();
$controller->init();

?>