<?php
class InArray
{
    public static $values = [];

    #region Functions and Methods
    public static function validate($value = null){
        if(self::$values && in_array($value, self::$values)){
            return true;
        }
        return false;
    }
    public static function setValues(array $values){
        self::$values = $values;
    }
    #endregion 
}
