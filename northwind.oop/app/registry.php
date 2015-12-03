<?php
    /*where you store objects and is a singleton*/
class Registry
{
    private static $_instance;
    private $_storage;

    #region Getter and Setters
    public function __set($key,$val){
        //if(!isset($this->_storage)) $this->_storage = [];

        $this->_storage[$key] = $val;
    }
    public function __get($key){
        if(isset($this->_storage[$key])){
            return $this->_storage[$key];
        }
        return false;
    }
    #endregion

    #region Constructors and Destructors
    private function __construct(){}
    #endregion

    #region Methods and Functions
    public static function getInstance(){
        if(!self::$_instance instanceof self){
            self::$_instance = new Registry();
        }
        return self::$_instance;
    }
    #endregion
}


