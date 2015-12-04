<!DOCTYPE html>
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
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
<div class="navbar transparent navbar-inverse navbar-fixed-top hr">
    <div class="navbar-brand-right">
        
    </div>
    <div class="container">
        <div class="navbar-header">
            <a href="/admin/" name="contactUs" id="contactUS" class="btn-button-transparent pull-right">Admin</a>
            <a href="/contactus.php" name="contactUs" id="contactUS" class="btn-button-transparent pull-right">Contact Us</a>
        </div>
    </div>
</div>

<header>
    <div class="jumbotron">
        <div class="container">
            <h1>
                <a href="/" style="text-decoration:none;color:inherit;" target="_parent">
                    <span style="font-family:Cinzel;">North</span>
                    <span style="font-family:Courgette;margin-left:-12px;">Wind</span>
                </a>
                Demo Store
            </h1>
            <h3>
                <?php
                if(isset($pageTitle))
                    echo $pageTitle;
                else
                    echo 'Welcome To The NorthWind Store!';
                ?>
            </h3>
        </div>
    </div>
</header>
