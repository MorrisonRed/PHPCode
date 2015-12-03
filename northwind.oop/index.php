<?php
//youtube video to composer installation and usage
//https://www.youtube.com/watch?v=317AtqzbKho
//require_once __DIR__ . "/vendor/autoload.php";
require_once('vendor/autoload.php');

define('SITE_PATH', realpath(dirname(__FILE__)).'/');

/*Required necessary files.*/
//require_once(SITE_PATH.'app/request.php');
//require_once(SITE_PATH.'app/router.php');
//require_once(SITE_PATH.'app/baseController.php');
//require_once(SITE_PATH.'app/baseModel.php');
//require_once(SITE_PATH.'app/registry.php');
//require_once(SITE_PATH.'app/load.php');
//require_once(SITE_PATH.'Controllers/indexController.php');
//require_once(SITE_PATH.'Controllers/errorController.php');

//override defualt index.php page


try{
    Router::route(new Request);
}
catch(Exception $e)
{
    $controller = new errorController;
    $controller->error($e->getMessage());
}
?>