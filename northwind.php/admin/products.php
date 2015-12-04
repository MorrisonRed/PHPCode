<!DOCTYPE html>
<?php
$pageTitle = 'Products';
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
    <style type="text/css">
        .table-responsive{height:180px;}
    </style>

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
            <li class="active">Products</li>
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
                        <form id="formSearch" name="formSearch" action="products.php" method="post">
                            <table style="">
                                <tbody>
                                    <tr>
                                        <td class="col-md-1">
                                            <label style="padding-right:15px;">Name:</label>
                                        </td>
                                        <td class="">
                                            <input type="text" class="form-control" name="productName" id="productName" autocomplete="off" autofocus value="<?php echo $searchForProduct; ?>" />
                                        </td>
                                        <td class="col-md-3">
                                            <input type="submit" class="btn btn-default" name="searchForProduct" value="Search" />
                                            <a href="productadd.php" class="btn btn-default" name="addProduct" id="addProduct">Add</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>

                        <br />

                        <?php

                        # Search for Products
                        try{
                            $db = new PDO($constring, $dbuser, $dbpswd);
                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        }
                        catch(PDOException $e)
                        {
                            array_push($AlertMessages, $e->getMessage());
                        }

                        try{
                            $searchValue = addslashes($searchForProduct);
                            $query = $db->prepare("SELECT * FROM Products WHERE ProductName like ? ORDER BY ProductName ASC");
                                
                            #DEBUG CODE DISPLAY
                            if($debug){
                                array_push($DebugMessages, $query->queryString);
                            }

                            $query->execute(array("%$searchValue%"));

                            # Get Row Count -- Only works in MySQL
                            $rowCount = $query->rowCount(); 

                            echo "
                                <table id=\"products_table\" class='table table-hover'>
                                    <thead>
                                        <tr>
                                            <th class='col-md-2'></th>
                                            <th>Name</th>
                                            <th>Quanity</th>
                                            <th>Price</th>
                                            <th>In Stock</th>
                                            <th>On Order</th>
                                            <th>Reorder</th>
                                            <th>Disc.</th>
                                        </tr>
                                    </thead>
                                    <tbody>";

                            while($row = $query->fetch(PDO::FETCH_ASSOC))
                            {
                                echo "<tr>";
                                echo "<td><a class='btn btn-default' href='productEdit.php?prodid=". urlencode($row["ProductID"]) . "'>Edit</a>";
                                echo "<a class='btn btn-default' data-bb=\"confirm\" onclick='return confirm(\"Want to delete?\");' href='productdelete.php?prodid=". urlencode($row["ProductID"]) . "'>Delete</a></td>"; 
                                echo "<td>" . htmlentities($row["ProductName"]) . "</td>";
                                echo "<td>" . htmlentities($row["QuantityPerUnit"]) . "</td>";
                                echo "<td>" . htmlentities($row['UnitPrice']) . "</td>";
                                echo "<td>" . htmlentities($row['UnitsInStock']) . "</td>";
                                echo "<td>" . htmlentities($row['UnitsOnOrder']) . "</td>";
                                echo "<td>" . htmlentities($row['ReorderLevel']) . "</td>";
                                echo "<td>" . htmlentities($row['Discontinued']) . "</td>";
                                echo "<td></td>";
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
                        
                        echo SuccessMsg("We found " . $rowCount . " products matching your search");
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
            
        });
    </script>
</body>
</html>
