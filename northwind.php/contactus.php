<!DOCTYPE html>
<?php
$pageTitle = 'Contact Us';
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
    <!--HEADER NAVIGATION-->
    <?php include '/includes/header_nav.php';?>
    <!--HEADER MENU-->
    <?php include '/includes/header.php';?>

    <div id="content_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="well">
                        <form action="contactussend.php" method="post">
                            <dl>
                                <dt>Email:</dt>
                                <dd>
                                    <input type="text" class="form-control" name="customeremail" id="customeremail" />
                                </dd>
                                <dt>Messages</dt>
                                <dd>
                                    <textarea class="form-control" name="message" id="message" rows="8"></textarea>
                                </dd>
                                <dt>
                                    Do you want a reply?  <input type="checkbox" name="replywanted" id="replywanted" />
                                </dt>
                            </dl>

                            <input type="submit" name="submit" class="btn btn-default" value="Send Message" />
                        </form>
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
    <?php include '/includes/footer.php';?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
</body>
</html>

