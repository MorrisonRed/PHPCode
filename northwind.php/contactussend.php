<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Contact Us</title>
    <meta name="generator" content="PHP Tools" />
    <meta name="author" content="Ian Morrison" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
    <?php
    // get the data from the form

    if ($_POST["customeremail"] == "")
    {
        echo "You did not enter an email address";
        exit;
    }

    if (!ereg("^[A-Za-z0-9\.|-|_]*[@]{1}[A-Za-z0-9\.|-|_]*[.]{1}[a-z]{2,5}$", $_POST["customeremail"]))
    {
        echo "Email address is not valid";
        exit;
    }

    $customeremail = $_POST["customeremail"];
    $message = $_POST["message"];
    $replywanted = false;

    if(isset($_POST["replywnated"])) $replywanted = true;

    // build the text email
    $t = "You have received a message from " . $customeremail . " :\n";
    $t = $t . $message . "\n";

    if ($replywanted)
        $t = $t . "A reply was requested";
    else
        $t = $t . "No reply was requested";

    // Send an email to the librarian
    mail("john.doe@example.com", "Customer Message", $t);

    echo "Thank you. Your message has been sent"
    ?>
</body>
</html>
