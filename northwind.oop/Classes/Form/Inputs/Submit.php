<?php
class Submit
{
    public $type = 'submit';
    public $value = 'submit';
    public $name;

    #region Public Properties
    public function setValue($param){
        $this->value = $param;
    }
    public function setType($param){
        $this->type = $param;
    }
    public function getName(){
        return $this->name;
    }
    public function setName($param){
        $this->name = $param;
    }
    #endregion

    #region Functions and Methods
    public function getInput(){
        return "<input type=\"$this->type\" name=\"$this->name\" value=\"$this->value\" />";
    }
    #endregion
}
