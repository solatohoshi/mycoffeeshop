<?php require_once('./dao/productsDAO.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        table tr td:last-child{
            width: 120px;
        }
        table tr:first-child{
            text-align: center;
        }
        .coffee{
            background-color: #8D7B68;
            color: #F9F5E7;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <header>
            <div class="col coffee justify-content-md-center p-5">
                <div class="container p-5">
                <h1 class="text-center">My Coffee Shop</h1>
    </div>
    </div>
    </header>

        <div class="container">
            <div class="product">
                <div class="col-md-10 mx-auto">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Products Details</h2>
                        <a href="create.php" class="btn coffee pull-right"><i class="fa fa-plus"></i> Add New Product</a>
                    </div>
                    <?php
                        $productsDAO = new productsDAO();
                        $products = $productsDAO->getProducts();
                        
                        if($products){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Image</th>";
                                        echo "<th>Description</th>";
                                        echo "<th>Date of Production</th>";
                                        echo "<th>Sales Price</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                foreach($products as $product){
                                    echo "<tr>";
                                        echo "<td>" . $product->getId(). "</td>";
                                        echo "<td>" . $product->getName() . "</td>";
                                        echo "<td><img src='imgs/" . $product->getImgPath() . "' class='img-fluid'></td>";
                                        echo "<td>" . $product->getDescription() . "</td>";
                                        echo "<td>" . $product->getDate() . "</td>";
                                        echo "<td> $" . $product->getPrice() . "</td>";
                                        echo "<td>";
                                            echo '<a href="read.php?id='. $product->getId() .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="update.php?id='. $product->getId() .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="delete.php?id='. $product->getId() .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                           // $result->free();
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                   
                    // Close connection
                    $productsDAO->getMysqli()->close();
                     include 'footer.php';
                    ?>
                </div>
            </div>        
        </div>
    </div>

</body>
</html>