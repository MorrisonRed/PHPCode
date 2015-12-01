<!DOCTYPE html>
<?php
$pageTitle = 'Edit Category';
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
if(isset($_POST['submit'])){
    $categoryID = (int)$_POST['categoryid'];
    $categoryName = htmlspecialchars($_POST['categoryname']);
    $description = htmlspecialchars($_POST['description']);    
    $picture = file_get_contents($_FILES['picture']['tmp_name']);
    $picture_name = addslashes($_FILES['picture']['name']);
    $picture_size = getimagesize($_FILES['picture']['tmp_name']);

    try{
        //check if there is an uploaded image
        if(!$picture_size == FALSE){
            $stmt = $db->prepare("UPDATE Categories SET CategoryName=:categoryname, Description=:description, Picture=:picture WHERE CategoryID=:categoryid");
            $stmt->bindParam(":categoryname", $categoryName);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":picture", $picture);
            $stmt->bindParam(":categoryid", $categoryID);
            $stmt->execute(); 
        }
        else{
            $stmt = $db->prepare("UPDATE Categories SET CategoryName=:categoryname, Description=:description WHERE CategoryID=:categoryid");
            $stmt->bindParam(":categoryname", $categoryName);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":categoryid", $categoryID);
            $stmt->execute();
        }

        //DEBUG WINDOW
        if($debug){
            array_push($DebugMessages, $stmt->queryString);
        }
    }
    catch(PDOException $e){
        array_push($AlertMessages, "Category $categoryID has been updated");
    }
}
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>
        <?php
        if(isset($pageTitle))
            echo $pageTitle;
        else
            echo 'NorthWind Admin Site';
        ?>
    </title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" />
    <link href='https://fonts.googleapis.com/css?family=Cinzel:400,700|Courgette' rel='stylesheet' type='text/css' />
    <link href="/css/bootstrap.northwind.css" rel="stylesheet" />


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="/js/html5shiv.min.js"></script>
      <script src="/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <!--HEADER NAVIGATION-->
    <?php include '../includes/header_nav_admin.php';?>
    <!--HEADER MENU-->
    <?php include '../includes/header.php';?>

    <div class="container">
         <ul class="breadcrumb">
              <li><a href="/admin">Admin</a></li>
              <li><a href="/admin/categories.php">Categories</a></li>
              <li class="active">Update Category</li>
         </ul>
    </div>

    <div id="content_wrapper">
        <div class="container">
            <div class="row">
                <div class='col-sm-8'>
                    <div class='well'>
                         <?php
                         if(isset($AlertMessages) && count($AlertMessages) > 0){
                             $result = '';
                             foreach($AlertMessages as $message){
                                 $result .= $message . "<br />";
                             }
                             echo AlertMsg($result);
                             $AlertMessages = [];
                         }

                         if($debug){
                             if(isset($DebugMessages) && count($DebugMessages) > 0){
                                 $result = '';
                                 foreach($DebugMessages as $message){
                                     $result .= $message . "<br />";
                                 }
                                 echo DebugMsg($result);
                                 $DebugMessages = [];
                             }
                         }
                         ?>

                        <!-- if you keep the action string empty it will be the same uri string including get parameters -->
                        <form action="" method="post" id="form1" enctype="multipart/form-data">
                        <?php
                        //load category
                        try{
                            $stmt = $db->prepare("select * from Categories where CategoryId=:categoryid");
                            $stmt->bindParam(":categoryid", $_GET['catid']);
                            $stmt->execute();
                            $rowCount = $stmt->rowCount();

                            //DEBUG WINDOW
                            if($debug){
                                array_push($DebugMessages, $stmt->queryString);
                            }

                            //check if there are any records found
                            if($rowCount >= 1){
                                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                                {
                                    echo "<dl>";
                                    echo "<dt>Category Id:</dt>";
                                    echo "<dd><input type=\"text\" class=\"form-control\" name=\"categoryid\" id=\"categoryid\" readonly value='". $row["CategoryID"] . "' /></dd>";
                                    echo "<dt>Category Name:</dt>";
                                    echo "<dd><input type=\"text\" class=\"form-control\" name=\"categoryname\" id=\"categoryname\" required value='". $row["CategoryName"] . "' /></dd>";
                                    echo "<dt>Description:</dt>";
                                    echo "<dd><textarea class=\"form-control\" name=\"description\" id=\"description\" rows=\"5\" required cols=\"10\">". $row["Description"] . "</textarea></dd>";
                                    echo "<dt>Picture:</dt>";
                                    echo "<dd>";
                                    echo "<img class='img' style='' alt='' src='" . Data_Uri($row["Picture"], "image/png") . "' />";
                                    echo "<input type=\"file\" name=\"picture\" />";
                                    echo "</dd>";
                                    echo "</dl>";
                                }

                                echo "<input type=\"submit\" class=\"form-control\" name=\"submit\" id=\"submit\" value=\"Save\" />";
                            }
                            else{
                                array_push($AlertMessages, "Category $categoryID has been added");
                            }
                           
                        }
                        catch(PDOException $e){
                            array_push($AlertMessages, "Category $categoryID has been added");
                        }
                        ?>
                        </form>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="well">
                        At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                        praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias
                        excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui
                        officia deserunt mollitia animi.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--FOOTER MENU-->
    <?php include '../includes/footer.php';?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
</body>
</html>
