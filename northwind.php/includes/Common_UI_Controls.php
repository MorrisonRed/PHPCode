<?php
$AlertMessages = [];
$ErrorMessages = [];
$DebugMessages = [];

/**
 * Returns Standard Bootstrap Alert Box
 * @param string $message Message text that will be displayed
 * @return string
 */
function AlertMsg($message)
{
    return ("
            <div class='alert alert-danger' role='alert'>
                <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                <span class='sr-only'>Error:</span>
                $message
            </div>
            ");
}

/**
 * Returns Bootstrap Success Box
 * @param mixed $message 
 * @return string
 */
function SuccessMsg($message)
{
    return ("
            <div class='alert alert-success' role='alert'>
                <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
                <span class='sr-only'>Success: </span>
                We found $message matching products
            </div>
        ");
}

/**
 * Returns Standard Bootstrap Debug Box
 * @param string $message 
 * @return string
 */
function DebugMsg($message)
{
    return ("
            <div class='alert alert-info' role='alert'>
                <span class='glyphicon glyphicon-tower' aria-hidden='true'></span>
                <span class='sr-only'>Debug:</span>
                $message
            </div>
            ");
}

/**
 * Convert Binary Image to URI encoded Image
 * @param mixed $data Binary Image to Convert
 * @param mixed $mime Mime Type
 * @return string
 */
function Data_Uri($data, $mime) 
{  
    $base64   = base64_encode($data); 
    return ('data:' . $mime . ';base64,' . $base64);
}
    
?>