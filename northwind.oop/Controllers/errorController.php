<?php
    class errorController extends baseController{

        #region Functions and Methods
        public function index(){}
        public function error($message = 'No information about the error'){
            echo '<pre>'.print_r($message, true).'</pre>';
        }
        #endregion
    }
?>