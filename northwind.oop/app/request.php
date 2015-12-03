<?php
class Request
{
    private $_controller;
    private $_action;
    private $_args;

    #region Getters and Setters
    public function getController(){
        return $this->_controller;
    }
    public function getAction(){
        return $this->_action;
    }
    public function getArgs(){
        return $this->_args;
    }
    #endregion

    #region Constructors and Destructors
    public function __construct(){
        //parse URI into array
        $parts = explode('/', $_SERVER['REQUEST_URI']);
        //remove empty element from array
        $parts = array_filter($parts);
        //display URI array
        //echo '<pre>'.print_r($parts, true).'</pre>';

        //pop the first element in the array off and store it in controller
        $this->_controller = ($c = array_shift($parts)) ? $c: 'index';
        //override index.php to /index
        $pos = strpos($this->_controller, 'index.php');
        if( $pos !== false) $this->_controller = "index";

        //pop the second element off the array and store it in method
        $this->_action = ($m = array_shift($parts)) ? $m : 'index';
        $this->_args = (isset($parts[0])) ? $parts : array();
    }
    #endregion

    #region Functions and Methods

    #endregion
}
