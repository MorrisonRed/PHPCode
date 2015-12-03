<?php
class Router
{
    
    public static function route(Request $request){
        $controller = $request->getController().'Controller';
        $action = $request->getAction();
        $args = $request->getArgs();

        $controllerFile = SITE_PATH.'Controllers/'.$controller.'.php';
        if(is_readable($controllerFile))
        {
            require_once $controllerFile;
            $controller = new $controller;

            $action = (is_callable(array($controller,$action))) ? $action : 'index';

            if(!empty($args)){
                call_user_func_array(array($controller,$action), $args);
            }
            else{
                call_user_func(array($controller,$action));
            }
            return;
        }
        throw new Exception('404 - '.$request->getController().' not found');
    }
}
