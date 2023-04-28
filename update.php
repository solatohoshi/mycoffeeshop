<?php
// Include productsDAO file
require_once('./dao/productsDAO.php');
 
// Define variables and initialize with empty values
$name = $img_path = $description = $date = $price = "";
$name_err = $img_path_err = $description_err = $date_err = $price_err = "";
$productsDAO = new productsDAO(); 

// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate img
    $input_img = $_FILES["img"]["name"];
if (!empty($_FILES["img"]["name"])) {
    $target_dir = "imgs/";
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $uploadOk = true;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the image file is a valid image
    $check = getimagesize($_FILES["img"]["tmp_name"]);
    if ($check !== false) {
        // Check if the image file already exists
        if (file_exists($target_file)) {
            $img_path_err = "Sorry, file already exists.";
            $uploadOk = false;
        }
        // Check the file size (max 5MB)
        if ($_FILES["img"]["size"] > 5000000) {
            $img_path_err = "Sorry, your file is too large. Max size is 5MB.";
            $uploadOk = false;
        }
        // Allow only certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $img_path_err = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = false;
        }
        // If all checks pass, try to upload the file
        if ($uploadOk) {
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                $img_path = $input_img;
            } else {
                $img_path_err = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $img_path_err = "File is not an image.";
    }
} 
else {
    if(empty($input_img)) {
        $img_path_err = "Please upload an image file.";
    } else {
        $img_path = $input_img;
    }
}
    
//validate description
    $input_description = trim($_POST["description"]);
    if(empty($input_description)){
        $description_err = "Please enter a description.";
    } else{
        $description = $input_description;
    }

//validate date
$input_date = trim($_POST["date"]);
if(empty($input_date)){
    $date_err = "Please enter a date.";
} else{
    $date = $input_date;
}
 // Validate price
 $input_price = trim($_POST["price"]);
 if(empty($input_price)){
     $price_err = "Please enter the price amount.";
 } elseif(!filter_var($input_price, FILTER_VALIDATE_FLOAT) && $input_price < 0){
     $price_err = "Please enter a positive price value.";
 } else{
     $price = $input_price;
 }
    // Check input errors before inserting in database
    if(empty($name_err) && empty($img_path_err) && empty($description_err) && empty($date_err) && empty($price_err)){
        $product = new Product($id, $name, $img_path, $description, $date, $price);
        $result = $productsDAO->updateProduct($product);        
		header("refresh:2; url=index.php");
		echo '<br><h6 style="text-align:center">' . $result . '</h6>';
        // Close connection
        $productsDAO->getMysqli()->close();
    }

} else{
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
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        .valid-feedback{
            display: inline;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the product record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                        <label>Image</label>
                        <div class="input-group">
                            <input type="file" accept="image/*" name="img" class="form-control <?php echo (!empty($img_path_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $img_path; ?>" alt="<?php echo $img_path; ?>">
                            <span class="valid-feedback"><?php echo $img_path;?></span>
                            <span class="invalid-feedback"><?php echo $img_path_err;?></span>
                        </div>
                         </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"><?php echo $description; ?></textarea>
                            <span class="invalid-feedback"><?php echo $description_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Date of Production</label>
                            <input type="date" name="date" class="form-control <?php echo (!empty($date_err)) ? 'is-invalid' : ''; ?>"><?php echo $date; ?>
                            <span class="invalid-feedback"><?php echo $date_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Sales Price</label>
                            <input type="text" name="price" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $price; ?>">
                            <span class="invalid-feedback"><?php echo $price_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>