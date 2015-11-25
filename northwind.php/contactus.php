<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Contact Us</title>
    <meta name="generator" content="PHP Tools" />
    <meta name="author" content="Ian Morrison" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
    <form action="contactus.php" method="post">
        <table cellspacing="12">
            <tr>
                <td>Your email:</td>
                <td><input type="text" name="customeremail" id="customeremail" /></td>
            </tr>
            <tr>
                <td>your message:</td>
                <td><textarea name="message" id="message"></textarea></td>
            </tr>
            <tr>
                <td>Do you want a reply?</td>
                <td><input type="checkbox" name="replywanted" id="replywanted" /></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Send Message" /></td>
            </tr>
        </table>
    </form>
</body>
</html>
