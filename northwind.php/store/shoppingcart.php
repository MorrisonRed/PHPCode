<!DOCTYPE html>
<?php
session_start();
$pageTitle = 'View Cart';
?>

<html lang="en">
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
            echo 'Welcome To The NorthWind Store!';
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
    <?php include '../includes/header_nav.php';?>
    <!--HEADER MENU-->
    <?php include '../includes/header.php';?>

    <div id="content_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="well">
                        <?php
                    if(!isset($_SESSION["shoppingcart"]))
                    {
                        echo "
                            <p>
                                <a href='shoppingcart.php' style='padding-right:10px;' target='_parent'>View Cart</a>
                                <a href='productsearch.php' style='padding-right:10px;' target='_parent'>Back to Shopping</a>
                            </p>
                            You have no products ordered";
                    }
                    else{
                        echo "
                            <p>
                                <a href='shoppingcart.php' style='padding-right:10px;' target='_parent'>View Cart</a>
                                <a href='productsearch.php' style='padding-right:10px;' target='_parent'>Search for another product</a>
                            </p>
                            You have order these books: <br />";
                        $shoppingCart = split("/", $_SESSION["shoppingcart"]);
                        foreach($shoppingCart as $prodid)
                        {
                            //PHP evaluates an empty string to false
                            if(trim($prodid))
                                echo "productId = ".$prodid . "<br />";
                        }
                    }
                        ?>
                    </div>
                </div>

                <div class="col-sm-6">
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
