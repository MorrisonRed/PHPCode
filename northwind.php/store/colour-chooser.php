<!DOCTYPE html>
<?php
$pageTitle = 'Choose Colour Preference';  

// Build the array of colours
$colours = array("Pink" => "f0d0d0",
                "Violet" => "cda8ef",
                "Blue" => "a8c1ef",
                "Green" => "a8efab",
                "Yellow" => "efee7b");
//NOTE: THERE COOKIE IS NOT CHECK TO SEE IF IT IS SET
// Check for Postback, create the cookie
if (isset($_GET['colourchosen'])){
    setcookie('colourpreference', $colours[$_GET['colourchosen']], time() + 24*3600, "/");
}
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
    <link href="/css/bootstrap.min.css" rel="stylesheet">
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

    <div class="container">
        <div class="row">
            <?php
            if(isset($_GET['colourchosen'])){ 
                //This is the post back message
            ?>
            <div class="col-sm-6">
                <div class='well'>
                    Your colour preference has been recorded <br />
                    echo "You have selected colour = <?php echo $_GET['colourchosen']; ?>
                    <br /><br />
                    <a href='/index.php'>Return to home page</a>
                </div>
            </div>
            <?php
            }
            else{
            //Not a postback, so present the colour selection form
            ?>
            <div class="col-sm-6">
                <div class="well">
                    <form action="colour-chooser.php" method="get">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        Choose your colour:
                                    </td>
                                    <td>
                                        <select sise="1" name="colourchosen">
                                            <?php
                                                //Populate the drop-down from the array
                                                foreach($colours as $name => $hex)
                                                {
                                                    echo "<option>" . $name;
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <br />
                                        <input type="submit" name="Confirm" value="Confirm Preference" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <?php
            }
            ?>

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

    <!--FOOTER MENU-->
    <?php include '../includes/footer.php';?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
</body>
</html>
