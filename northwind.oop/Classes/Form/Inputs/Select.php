<?php

class Select
{
    public $label;
    public $name;
    public $required = false;
    public $multiple = false;
    public $options = [];
    public $validator; 
    public $valid = false;

    #region Public Properties
    public function setValue($param){
        $this->value = $param;
    }
    public function getName(){
        return $this->name;
    }
    public function setName($param){
        $this->name = $param;
    }
    public function setRequired(){
        $this->required = true;
    }
    public function isRequired(){
        return $this->required;
    }
    public function setMultiple($multiple){
        $this->multiple = $multiple;
    }
    public function isMultiple(){
        return $this->multiple;
    }
    public function getOptions(){
        return $this->options;
    }
    public function setOptions(array $options){
        $this->options = $options;
    }
    public function getLabelTag(){
        return ucfirst($this->label);
    }
    public function setLabel($label){
        $this->label = $label;
    }
    public function getValidator(){
        return $this->validator;
    }
    public function setValidator($param, $values){
        /** @noinspaction PhpIncldeInspaction */
        require_once CLASSES . 'Validator/' . ucfirst($param) . '.php';
        $validator = new $param;
        switch(true){
            case ($validator instanceof InArray): 
                $validator->setValues($values);
                break;
        }
        $this->validator = $validator;
        return $this;
    }
    public function isValid(){
        return $this->valid;
    }
    public function setValid(){
        $this->valid = true;
    }
    #endregion

    #region Functions and Methods
    public function getInput(){
        $select = "<select";
        $select .= $this->name ? " name\"$this->name\"" : null;
        $select .= $this->required ? " required" : null;
        $select .= $this->multiple ? " multiple" : null;
        $select .= ">";
        foreach($this->options as $option){
            $select .= $option;
        }
        $select .= "</select>";
        return $select;
    }

    #endregion 
}
