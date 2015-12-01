<?php
class Text
{
    public $label;
    public $type;
    public $name;
    public $value;
    public $required = false;
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
    public function getInput(){
        $required = $this->required ? ' required' : null;
        return "<input type=\"$this->type\" name=\"$this->name\" $required />";
    }

    #endregion

}
