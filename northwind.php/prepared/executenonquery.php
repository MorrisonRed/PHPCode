<?php
include $_SERVER['DOCUMENT_ROOT']."/config/configuration.php";

    try
    {
        $db = new PDO($constring, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        printf("Unable to open database $s\n", $e->getMessage());
    }

    $argv[1] = 4;

    //SELECT CustomerID,CompanyName,ContactName,ContactTitle,Address,City
    //  ,Region,PostalCode,Country,Phone,Fax FROM Customers;
    switch($argv[1])
    {
        case 1:
            try
            {
                $stmt = $db->prepare("insert into Customers (CompanyID,CompanyName,ContactTitle) values" .
                    "(:id,:company,:contact)");
                $stmt->execute(array(":id" => "MOR", 
                                ":company" => "MorrisonRed", 
                                ":contact" => "Ian Morrison"));
                $stmt->execute(array(":id" => "MOR", 
                                ":company" => "MorrisonRed", 
                                ":contact" => "Sheila Morrison"));
            }
            catch(PDOException $e)
            {
                printf("We had a problem: %s\n", $e->getMessage());
            }
            break;
        case 2:
            $stmt = $db->prepare("delete from Customers where CompanyName = ?");
            $stmt->execute(array("Morrisonred"));
            printf("%d rows deleted <br />", $stmt->rowCount());
            break;
        case 3:
            $stmt = $db->query("select count(*) from Customers where ContactName like '%Ana%'");
            printf("We have %d customers that contain 'ana'<br />", $stmt->fetchColumn());
            break;
        case 4:  //Use a stored procedure
            $stmt = $db->query("call sp_employees_rownum()");

            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                printf("%s %s <br />", $row["LastName"], $row["FirstName"]);
            }
            
            break;
    }

?>