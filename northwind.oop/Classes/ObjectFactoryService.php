<?php
require 'Session.php';
require '/Classes/Model/Model.php';

class ObjectFactoryService
{
    public static $pdo;
    public static $session;
    public static $model;

    #region Functions and Methods
    public static function getDb(array $connectionParams = null){
        if(!self::$pdo){
            try{
                $config = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];
                self::$pdo = new PDO($connectionParams['db']['dsn'], 
                    $connectionParams['db']['user'], 
                    $connectionParams['db']['pass'], 
                    $config);

            }
            catch(PDOException $e){
                echo 'Failed connection' . $e->getMessage();
            }
        }

        return self::$pdo;
    }
    public static function getSession(){
        if(!self::$session){
            self::$session = new Session();
        }
        return self::$session;
    }
    public static function getModel($pdo){
        if(!self::$model){
            self::$model = new Model($pdo);
        }

        return self::$model;
    }
    #endregion
}
