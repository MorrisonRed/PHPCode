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

    <div id="content_wrapper">
        <div class="container">
            <div class="row">
                <div class='col-sm-8'>
                    <div class='well'>
                        <form id="formSearch" name="formSearch" action="categories.php" method="post">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="col-md-2">
                                            <label style="padding-right:15px;">Name:</label>
                                        </td>
                                        <td class="col-md-7">
                                            <input type="text" class="form-control" name="categoryName" id="categoryName" autocomplete="off" autofocus value="<?php echo $searchForCategory; ?>" />
                                        </td>
                                        <td class="col-md-3">
                                            <input type="submit" class="btn btn-default" name="searchForCategory" value="Search for Category" />
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
                            echo AlertMsg($e->getMessage());
                            exit;
                        }

                        try{
                            $searchValue = addslashes($searchForCategory);
                            $query = $db->prepare("SELECT * FROM Categories WHERE CategoryName like ? ORDER BY CategoryName ASC");
                                
                            #DEBUG CODE DISPLAY
                            if($debug)
                            {
                                echo DebugMsg("RUNNING QUERY " . $query->queryString);
                            }    
                            $query->execute(array("%$searchValue%"));

                            # Get Row Count -- Only works in MySQL
                            $rowCount = $query->rowCount(); 

                            echo "
                                <table class='table table-striped'>
                                    <thead>
                                        <tr>
                                            <td class='col-md-1'></td>
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
                            echo AlertMsg($e->getMessage());
                        }      
                        
                        echo SuccessMsg("We found " . $rowCount . " categories matching your search");
                        ?>                           
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

    <script type="text/javascript">
        $(document).ready(function () {
            //$('#categoryName').keydown(function (event) {
            //    var keypressed = event.keyCode || event.which;
            //    if (keypressed == 13) {
            //        $(this).closest('formSearch').submit();
            //    }
            //});

        });
    </script>
</body>
</html>
