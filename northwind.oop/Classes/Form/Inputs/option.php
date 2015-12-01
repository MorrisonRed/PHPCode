<?php

class Option
{
    public $label;
    public $disabled = false;
    public $selected = false;
    public $value;
    public $optionString;

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
    public function setType($param){
        $this->type = $param;
    }
    public function setRequired(){
        $this->required = true;
    }
    public function isRequired(){
        return $this->required;
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
    public function setValidator($param){
        $name = null;
        if(is_array($param)){
            $name = key($param);
        }
        elseif(is_string($param)){
            $name = ucfirst($param);
        }

        if(!$name) return false;
        require_once CLASSES . 'Validator/' . $name . '.php';
        $validator = new $name;

        switch(true){
            case $validator instanceof StringLength:
                $validator->setMinimum($param['StringLength']['minimum']);
                $validator->setMaximum($param['StringLength']['maximum']);
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
    public function getOption(){
        $option = "<option ";
        $option .= $this->value ? " value=\"$this->value\"" : null;
        $option .= $this->disabled ? " disabled" : null;
        $option .= $this->label ? " label=\"$this->label\"" : null;
        $option .= $this->selected ? " selected" : null;
        $option .= ">";
        $option .= $this->optionString;
        $option .= "</option>";
        return $option;

    }
    public function getOptions($options){
        $results = null;
        foreach($options as $option){
            $value = ucwords($option);
            $this->value = $value;
            $this->optionString = $value;
            $results[] = $this->getOption($option);
        }
        return $results ?: false;
    }

    #endregion

}
