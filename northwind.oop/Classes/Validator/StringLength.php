<?php
class StringLength
{
    public static $minimum;
    public static $maximum;

    #region Public Properties
    public static function setMinimum($value){
        self::$minimum = $value;
    }
    public static function setMaximum($value){
        self::$maximum = $value;
    }
    #endregion

    #region Functions and Methods
    public static function validate($value = null){
        if(!is_string($value) || !self::$minimum || !self::$maximum){
            return false;
        }

        $length = strlen($value);
        if($length > self::$minimum && $length < self::$maximum){
            return true;
        }

        return false;
    }
    #endregion
}
