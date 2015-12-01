<!DOCTYPE html>
<?php
$pageTitle = 'Categories';
include $_SERVER['DOCUMENT_ROOT']."/config/configuration.php";
include $_SERVER['DOCUMENT_ROOT']."/includes/Common_UI_Controls.php";

# GET values from input feild
$searchForCategory = trim($_POST["categoryName"]);
$errorMessage = "";
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
            <li class="active">Categories</li>
        </ul>
    </div>

    <div id="content_wrapper">
        <div class="container">
            <div class="row">
                <div class='col-sm-12'>
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
                        <form id="formSearch" name="formSearch" action="categories.php" method="post">
                            <table style="">
                                <tbody>
                                    <tr>
                                        <td class="col-md-1">
                                            <label style="padding-right:15px;">Name:</label>
                                        </td>
                                        <td class="">
                                            <input type="text" class="form-control" name="categoryName" id="categoryName" autocomplete="off" autofocus value="<?php echo $searchForCategory; ?>" />
                                        </td>
                                        <td class="col-md-3">
                                            <input type="submit" class="btn btn-default" name="searchForCategory" value="Search" />
                                            <a href="categoryadd.php" class="btn btn-default" name="addCategory" id="addCategory">Add</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>

                        <br />

                        <?php

                        # Search for Categories
                        # Open Database 
                        try{
                            $db = new PDO($constring, $dbuser, $dbpswd);
                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        }
                        catch(PDOException $e)
                        {
                            array_push($AlertMessages, $e->getMessage());
                        }

                        try{
                            $searchValue = addslashes($searchForCategory);
                            $query = $db->prepare("SELECT * FROM Categories WHERE CategoryName like ? ORDER BY CategoryName ASC");
                                
                            #DEBUG CODE DISPLAY
                            if($debug){
                                array_push($DebugMessages, $query->queryString);
                            }

                            $query->execute(array("%$searchValue%"));

                            # Get Row Count -- Only works in MySQL
                            $rowCount = $query->rowCount(); 

                            echo "
                                <table class='table table-striped'>
                                    <thead>
                                        <tr>
                                            <td class='col-md-2'></td>
                                            <td>Name</td>
                                            <td>Description</td>
                                            <td class='col-md-2'>Picture</td>
                                        </tr>
                                    </thead>
                                    <tbody>";

                            while($row = $query->fetch(PDO::FETCH_ASSOC))
                            {
                                echo "<tr>";
                                echo "<td><a class='btn btn-default' href='categoryedit.php?catid=". urlencode($row["CategoryID"]) . "'>Edit</a>";
                                echo "<a class='btn btn-default' data-bb=\"confirm\" onclick='return confirm(\"Want to delete?\");' href='categorydelete.php?catid=". urlencode($row["CategoryID"]) . "'>Delete</a></td>"; 
                                echo "<td>" . htmlentities($row["CategoryName"]) . "</td>";
                                echo "<td>" . htmlentities($row["Description"]) . "</td>";
                                echo "<td><img class='img-thumbnail img-responsive' style='' alt='' src='" . Data_Uri($row["Picture"], "image/png") . "' /></td>";
                                echo "</tr>";
                            }

                            echo "
                                    </tbody>
                                </table>
                                ";
                             

                        }
                        catch(PDOException $e)
                        {
                            array_push($AlertMessages, $e->getMessage());
                        }      
                        
                        echo SuccessMsg("We found " . $rowCount . " categories matching your search");
                        ?>                           
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

    <script type="text/javascript">
        $(document).ready(function () {
            bootbox.confirm("Are you sure?", function (result) {
                //Example.show("Confirm result: " + result);
            });

        });
    </script>
</body>
</html>
