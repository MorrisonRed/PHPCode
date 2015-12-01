<?php
//use SimpleFactoryDesign\Session as Session;
//use SimpleFactoryDesign\Model as Model;
//use SimpleFactoryDesign\View as View;
//use SimpleFactoryDesign\ObjectFactoryService as ObjectFactoryService;

require 'config/configuration.php';
//youtube video to composer installation and usage
//https://www.youtube.com/watch?v=317AtqzbKho
//require_once __DIR__ . "/vendor/autoload.php";
require_once('vendor/autoload.php');

$params = $FactoryConfig;

//Get a Session
$session = SimpleFactoryDesign\ObjectFactoryService::getSession();
$session->start();

//Get required object from the service OFS
$db = SimpleFactoryDesign\ObjectFactoryService::getDb($params);
$model = SimpleFactoryDesign\ObjectFactoryService::getModel($db);
$view = SimpleFactoryDesign\ObjectFactoryService::getView();

//Get results from the db
$users = $model->getUsers();

//Save the users result state
//$session->save(['users' => $users]);

//Set the results into the view container
$view->setResults($users);

//Gernate the response
$view->render();

require 'config/configuration.php';
require 'lib/Xfactor/ObjectFactoryService.php';

//$params = $FactoryConfig;

////Get a Session
//$session = ObjectFactoryService::getSession();
//$session->start();

////Get required object from the service OFS
//$db = ObjectFactoryService::getDb($params);
//$model = ObjectFactoryService::getModel($db);
//$view = ObjectFactoryService::getView();

////Get results from the db
//$users = $model->getUsers();

////Save the users result state
////$session->save(['users' => $users]);

////Set the results into the view container
//$view->setResults($users);

////Gernate the response
//$view->render();

?>