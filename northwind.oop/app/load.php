<?php
class Load
{
    

    #region Constructors and Destructors
    public function __construct(){
        
    }
    #endregion

    #region Functions and Methods
    public function model($name){
        $model = $name.'Model';
        $modelPath = SITE_PATH.'Models/'.$model.'.php';

        //check for existence of 
        if(is_readable($modelPath)){
            require_once($modelPath);

            //check if class exists
            if(class_exists($model)){
                //store model in registry
                $registry = Registry::getInstance();
                $registry->$name = new $model;
                return true;
            }
        }
        throw new Exception('Model issues');
    }
    public function view($name, array $vars = null){
        $file = SITE_PATH."Views/$name/".$name."View.php";

        //check for existence of 
        if(is_readable($file)){
            //check input variables
            if(isset($vars))
                extract($vars);

            require($file);
            return true;
        }
        throw new Exception('View issues');
    }
    #endregion
}
