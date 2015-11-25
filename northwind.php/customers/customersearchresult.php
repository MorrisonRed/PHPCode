<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Customer Search Results</title>
</head>
<body>
    <h3>Book search Results</h3>
    <hr />
    <?php
    include $_SERVER['DOCUMENT_ROOT']."/config/configuration.php";

    #This is the PDO version
    #Get data from form
    $searchcontactname = trim($_POST["searchcontactname"]);
    $searchcompany = trim($_POST["searchcompany"]);

    if (!$searchcontactname && !$searchcompany)
    {
        printf("You must specify either a contact name or a company");
        exit;
    }

    $searchcompany = addslashes($searchcompany);
    $searchcontactname = addslashes($searchcontactname);

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

    #Build the query.  Users are allowed to search on 
    $query = "select * from Customers";
    if($searchcompany && !$searchcontactname)
        $query = $query . " where CompanyName LIKE '%" . $searchcompany . "%'";
    if(!$searchcompany && $searchcontactname)
        $query = $query . " where ContactName LIKE '%" . $serachcontactname . "%'";
    if($searchcompany && $searchcontactname)
    {
        $query = $query . " where CompanyName LIKE '%" . $searchcompany . "%'";
        $query = $query . " and ContacdtName LIKE '%" . $searchcontactname . "%'";
    }

    printf("Debug: running the query %s <br />", $query);
    
    try
    {
        $sth = $db->query($query);
        $customercount = $sth->rowCount(); #Only works for MySQL
        if($customercount == 0)
        {
            printf("Sorry, we did not find any matching books");
            exit;
        }

        printf('<table bgcolor="#bdc0ff" cellpadding="6">');
        printf('<tr><b><td>Company</td><td>Contact</td></b></tr>');

        while($row = $sth->fetch(PDO::FETCH_ASSOC))
        {
            printf("<tr><td>%s</td><td>%s</td></tr>", 
                htmlentities($row["CompanyName"]), htmlentities($row["ContactName"]));
        }
    }
    catch(PDOException $e)
    {
        printf("We had a problem: %s\n", $e->getMessage());
    }

    printf('</table>');       
    printf("<br /> We found %s matching customers", $customercount);
    ?>
</body>
</html>
