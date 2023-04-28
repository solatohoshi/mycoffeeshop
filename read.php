<?php
// Include productDAO file
require_once('./dao/productsDAO.php');
$productsDAO = new productsDAO(); 

// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Get URL parameter
    $id =  trim($_GET["id"]);
    $product = $productsDAO->getProduct($id);
            
    if($product){
        // Retrieve individual field value
        $name = $product->getName();
        $img_path = $product->getImgPath();
		$description = $product->getDescription();
        $date = $product->getDate();
        $price = $product->getPrice();
    } else{
        // URL doesn't contain valid id. Redirect to error page
        header("location: error.php");
        exit();
    }
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
} 

// Close connection
$productsDAO->getMysqli()->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>Name</label>
                        <p><b><?php echo $name; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <?php echo "<img src='imgs/" . $img_path . "' class='img-fluid'>"; ?>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <p><b><?php echo $description; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Date of Production</label>
                        <p><b><?php echo $date; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Sales Price</label>
                        <p><b><?php echo "$" . $price; ?></b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>