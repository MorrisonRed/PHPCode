<!DOCTYPE html>
<?php
$pageTitle = 'Search Results'; 
include $_SERVER['DOCUMENT_ROOT']."/config/configuration.php";
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>
        <?php
        if(isset($pageTitle))
            echo $pageTitle;
        else
            echo 'Welcome To The NorthWind Store!';
        ?>
    </title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Cinzel:400,700|Courgette' rel='stylesheet' type='text/css'>
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
    <?php include '../includes/header_nav.php';?>
    <!--HEADER MENU-->
    <?php include '../includes/header.php';?>

    <div id="content_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="well">
                        <?php
                        #Get data from form
                        $searchproductname = trim($_POST["productname"]);
                        if (!$searchproductname)
                        {
                            echo "
                                <a href='shoppingcart.php' style='padding-right:10px;' target='_parent'>View Cart</a>
                                <a href='productsearch.php' style='padding-right:10px;' target='_parent'>Search for another product</a>
                                <br />
                                <p>
                                    You must specify a product name
                                </p>
                                ";
                        }
                        else{
                            echo "
                                <p>
                                    <a href='shoppingcart.php' style='padding-right:10px;' target='_parent'>View Cart</a>
                                    <a href='productsearch.php' style='padding-right:10px;' target='_parent'>Search for another product</a>
                                </p>
                                ";
                            $searchproductname = addslashes($searchproductname);
                            #Open database
                            try
                            {
                                $db = new PDO($constring, $dbuser, $dbpswd);
                                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            }
                            catch(PDOException $e)
                            {
                                printf("Unable to open database $s\n", $e->getMessage());
                            }
                            #Build the query.
                            $query = "select * from Products";
                            $query = $query . " where ProductName LIKE '%" . $searchproductname . "%'";
                            #DEBUG CODE DISPLAY
                            if($debug)
                            {
                                echo "
                                    <div class='alert alert-info' role='alert'>
                                        DEBUG: RUNNING QUERY $query
                                    </div>
                                ";
                            }
                            try
                            {
                                $sth = $db->query($query);
                                $customercount = $sth->rowCount(); #Only works for MySQL
                                if($customercount == 0)
                                {
                                    printf("Sorry, we did not find any matching books");
                                    exit;
                                }
                                // If the user has specified a colour preference,
                                // use it for the table background
                                if (isset($_COOKIE['colorpreference']))
                                    $colourpreference = $_COOKIE['colorpreference'];
                                else
                                    $colourpreference = "#dddddd";
                                printf('<table class="table table-striped" style="background-color:%s !important;">', $colourpreference);
                                printf('<thead>');
                                printf('<tr><td>Product</td><td>Pkg Quanity</td><td>Price</td><td>Stock</td><td></td></tr>');
                                printf('</thead>');
                                printf('<tbody>');
                                while($row = $sth->fetch(PDO::FETCH_ASSOC))
                                {
                                    // We add a link on each row to allow the user to add product to cart
                                    $orderanchor = '<a href="productorder.php?productid='. urlencode($row["ProductID"]) . '">Order</a>';
                                    printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",
                                        htmlentities($row["ProductName"]),
                                        htmlentities($row["QuantityPerUnit"]),
                                        htmlentities(number_format($row["UnitPrice"], 2, '.', '')),
                                        htmlentities($row["UnitsInStock"]),
                                        $orderanchor);
                                }
                                printf('</tbody>');
                            }
                            catch(PDOException $e)
                            {
                                printf("We had a problem: %s\n", $e->getMessage());
                            }
                            printf('</table>');
                            echo "
                                <div class='alert alert-success' role='alert'>
                                    We found $customercount matching products
                                </div>
                            ";
                        }
                        ?>
                    </div>
                </div>

                <div class="col-md-4">
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