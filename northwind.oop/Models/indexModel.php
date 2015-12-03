<?php
class indexModel extends baseModel{
    
    public function getEntries(){
        $return = array();
        $return[0] = array('title' => 'Hello world');
        $return[1] = array('title' => 'Hello universe');
        return $return;
    }
}
