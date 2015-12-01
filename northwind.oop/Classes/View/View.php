<?php
class View
{
    public $results; 

    #region Functions and Methods
    public function setResults($results){
        $this->results = $results;
    }
    public function set($param, $value){
        $this->$param = $value;
    }
    public function render($param){
        require LAYOUTS . $param . '.php'; 
    }
    #endregion
}
