<!DOCTYPE html>
<html lang="en" >
<?php
require_once('./dao/productsDAO.php');
$productsDAO = new productsDAO();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $login = $productsDAO->login($username, $password);
    if($login) {
        // If login is successful, redirect to dashboard page
        header('refresh:1;url=dashboard.php');
        exit;
    } else {
        // If login fails, display an error message
        echo "<script>alert('Invalid Username or Password!');</script>"; 
    }
}

?>

<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
    .container {
        position: relative;
        z-index: 1;
        max-width: 300px;
        margin: 0 auto;
    }
    .form .thumbnail {
        background: #5c4ac7;
        width: 150px;
        height: 150px;
        margin: 0 auto 30px;
        padding: 50px 30px;
        border-top-left-radius: 100%;
        border-top-right-radius: 100%;
        border-bottom-left-radius: 100%;
        border-bottom-right-radius: 100%;
        box-sizing: border-box;
    }
</style>
</head>

<body>

  
<div class="container">
    <div class="col-sm align-items-center">
    <h1 class="my-5">Admin Panel </h1>
  
<div class="form text-center">
  <div class="thumbnail"><img src="imgs/manager.png" class="img-fluid"/></div>
  <form action="index.php" method="post">
  <div class="form-group">
    <input class="form-control" type="text" placeholder="Username" name="username"/>
  </div>
  <div class="form-group">
    <input class="form-control" type="password" placeholder="Password" name="password"/>
</div>
    <input class="btn btn-primary" type="submit"  name="submit" value="Login" />

  </form>
  </div>
</div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>

</html>
