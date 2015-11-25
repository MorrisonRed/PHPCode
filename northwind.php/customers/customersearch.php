<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Customer Search</title>
</head>
<body>
    <h1>Search for Customers</h1>
    <hr />
    <h3>You may search by company, or by contact, or both</h3>
    <form action="customersearchresult.php" method="post">
        <table cellpadding="16" style="background-color:#cab7f5">
            <tr>
                <td>Company:</td>
                <td><input type="text" name="searchcompany" id="searchcompany" /></td>
            </tr>
            <tr>
                <td>Contact:</td>
                <td><input type="text" name="searchcontactname" id="searchcontactname" /></td>
            </tr>
            <tr>
                <td><input type="submit" name="search" id="search" value="Submit" /></td>
            </tr>
        </table>
    </form>
</body>
</html>
