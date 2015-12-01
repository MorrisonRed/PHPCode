<?php
include $_SERVER['DOCUMENT_ROOT']."/config/configuration.php";
include $_SERVER['DOCUMENT_ROOT']."/includes/Common_UI_Controls.php";

//Test connection
try{
    $db = new PDO($constring, $dbuser, $dbpswd);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    array_push($AlertMessages, "Category $categoryID has been added");
}

//check for post back, if yes then update category
if(isset($_GET['catid'])){
    $categoryID = (int)$_GET['catid'];

    try{
        $stmt = $db->prepare("DELETE FROM Categories WHERE CategoryID=:categoryid");
        $stmt->bindParam(":categoryid", $categoryID);
        $stmt->execute(); 

        //DEBUG WINDOW
        if($debug){
            array_push($DebugMessages, $stmt->queryString);
        }
    }
    catch(PDOException $e){
        array_push($AlertMessages, "Category $categoryID has been deleted");
    }
}
else{
    array_push($AlertMessages, "No such Category was found!");
}

//goto main page
header("location:/admin/categories.php");

?>