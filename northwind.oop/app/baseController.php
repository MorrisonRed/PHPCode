<?php
/*Standard for all Controllers 
 * Define functionality here that will methods are 
 * present in derived controllers
 * */
abstract class baseController
{
    protected $_registry;
    protected $load;

    #region Getters and Setters
    //Prevent overriding in derived Controllers
    final public function __get($key){
        if($return = $this->_registry->$key){
            return $return;
        }
        else{
            return false;
        }
    }
    //Prevent overridding in derived Controllers
    final public function __set($key, $val){
        $this->_registry[$key] = $val;
    }
    #endregion

    #region Constructors and Destructors
    public function __construct(){
        $this->_registry = Registry::getInstance();
        $this->load = new Load();
    }
    #endregion

    #region Functions and Methods
    abstract public function index();
    #endregion
}
