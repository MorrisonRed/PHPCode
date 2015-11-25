<?php
include $_SERVER['DOCUMENT_ROOT']."/config/configuration.php";

    $argv[1] = 5;
    $searchcontactname = "Ana";
    $searchcompany = "Horn";

    try
    {
        $db = new PDO($constring, $dbuser, $dbpswd);
        
        switch($argv[1]) 
        {
            case 1: // Build and SQl query explicitly
                $query = "select * from Customers where CompanyName like '%$searchcompany%' or ContactName like '%$searchcontanctname%'";
                $stmt = $db->query($query);
                
                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    printf("%-40s %-20s<br />", $row["CompanyName"], $row["ContactName"]);
                }
                break;
            case 2: // Use a prepared statement with paramters bound by position - Method 1
                $stmt = $db->prepare("select * from Customers where CompanyName like ? or ContactName like ?");
                $stmt->execute(array("%$searchcompany%", "%$searchcontactname%"));

                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    printf("%-40s %-20s<br />", $row["CompanyName"], $row["ContactName"]);
                }
                break;
            case 5: // Use a prepared statement with parpeters bound by name - Method 2
                $stmt = $db->prepare("select * from Customers where CompanyName regexp :company or ContactName regexp :contact");
                $stmt->bindParam(':company', $searchcompany);
                $stmt->bindParam(':contact', $searchcontactname);
                $stmt->execute();
                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    printf("%-40s %-20s<br />", $row["CompanyName"], $row["ContactName"]);
                }
                break;
        }
    }
    catch(PDOException $e)
    {
        
    }
?>