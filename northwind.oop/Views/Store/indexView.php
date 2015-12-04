<!--Layout HEADER-->
<?php include '/Views/Shared/Layout_Header.php';?>

    <div id="content_wrapper">
        <div class="container">
            <div class="row">
                <div class='col-sm-12'>
                    <div class='well'>
                        <?php
                        if(isset($AlertMessages) && count($AlertMessages) > 0){
                            $result = '';
                            foreach($AlertMessages as $message){
                                $result .= $message . "<br />";
                            }
                            echo AlertMsg($result);
                            $AlertMessages = [];
                        }

                        if($debug){
                            if(isset($DebugMessages) && count($DebugMessages) > 0){
                                $result = '';
                                foreach($DebugMessages as $message){
                                    $result .= $message . "<br />";
                                }
                                echo DebugMsg($result);
                                $DebugMessages = [];
                            }
                        }
                        ?>
                        <form id="formSearch" name="formSearch" action="products.php" method="post">
                            <table style="">
                                <tbody>
                                    <tr>
                                        <td class="col-md-1">
                                            <label style="padding-right:15px;">Name:</label>
                                        </td>
                                        <td class="">
                                            <input type="text" class="form-control" name="productName" id="productName" autocomplete="off" autofocus value="<?php echo $searchForProduct; ?>" />
                                        </td>
                                        <td class="col-md-3">
                                            <input type="submit" class="btn btn-default" name="searchForProduct" value="Search" />
                                            <a href="productadd.php" class="btn btn-default" name="addProduct" id="addProduct">Add</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>

                        <br />

                        <?php

                        # Search for Products
                        try{
                            $db = new PDO($constring, $dbuser, $dbpswd);
                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        }
                        catch(PDOException $e)
                        {
                            array_push($AlertMessages, $e->getMessage());
                        }

                        try{
                            $searchValue = addslashes($searchForProduct);
                            $query = $db->prepare("SELECT * FROM Products WHERE ProductName like ? ORDER BY ProductName ASC");
                            
                            #DEBUG CODE DISPLAY
                            if($debug){
                                array_push($DebugMessages, $query->queryString);
                            }

                            $query->execute(array("%$searchValue%"));

                            # Get Row Count -- Only works in MySQL
                            $rowCount = $query->rowCount(); 

                            echo "
                                <table id=\"products_table\" class='table table-hover'>
                                    <thead>
                                        <tr>
                                            <th class='col-md-2'></th>
                                            <th>Name</th>
                                            <th>Quanity</th>
                                            <th>Price</th>
                                            <th>In Stock</th>
                                            <th>On Order</th>
                                            <th>Reorder</th>
                                            <th>Disc.</th>
                                        </tr>
                                    </thead>
                                    <tbody>";

                            while($row = $query->fetch(PDO::FETCH_ASSOC))
                            {
                                echo "<tr>";
                                echo "<td><a class='btn btn-default' href='productEdit.php?prodid=". urlencode($row["ProductID"]) . "'>Edit</a>";
                                echo "<a class='btn btn-default' data-bb=\"confirm\" onclick='return confirm(\"Want to delete?\");' href='productdelete.php?prodid=". urlencode($row["ProductID"]) . "'>Delete</a></td>"; 
                                echo "<td>" . htmlentities($row["ProductName"]) . "</td>";
                                echo "<td>" . htmlentities($row["QuantityPerUnit"]) . "</td>";
                                echo "<td>" . htmlentities($row['UnitPrice']) . "</td>";
                                echo "<td>" . htmlentities($row['UnitsInStock']) . "</td>";
                                echo "<td>" . htmlentities($row['UnitsOnOrder']) . "</td>";
                                echo "<td>" . htmlentities($row['ReorderLevel']) . "</td>";
                                echo "<td>" . htmlentities($row['Discontinued']) . "</td>";
                                echo "<td></td>";
                                echo "</tr>";
                            }

                            echo "
                                    </tbody>
                                </table>
                                ";
                        }
                        catch(PDOException $e)
                        {
                            array_push($AlertMessages, $e->getMessage());
                        }      
                        
                        echo SuccessMsg("We found " . $rowCount . " products matching your search");
                        ?>                           
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--Layout FOOTER-->
<?php include '/Views/Shared/Layout_Footer.php';?>
