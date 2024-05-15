<?php
require_once('classes/database.php');
$con=new database();
 
if(isset($_POST['signup'])){
$username=$_POST['username'];
$password=$_POST['password'];
$confirm=$_POST['passwords'];
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$birthday=$_POST['birthday'];
$sex=$_POST['sex'];
 
if ($con->signup($username, $password, $confirm, $firstname, $lastname, $birthday)) {
  header('Location: login.php');
  exit();
} else {
  $error_message = "Username already exists. Please choose a different username.";
 }
}
?>
 
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .login-container {
      max-width: 400px;
      margin: 0 auto;
      margin-top: 100px;
      height: auto;
      padding: 20px;
    }
  </style>
</head>
<body>
 
 
<div class="container-fluid login-container rounded shadow">
  <h2 class="text-center mb-4">Register Now</h2>
 
  <form method="post">
    <div class="form-group">
      <label for="Firstname">First name:</label>
      <input type="text" class="form-control" name="firstname" placeholder="Firstname">
    </div>
 
    <form method="post">
    <div class="form-group">
      <label for="Lastname">Last name:</label>
      <input type="text" class="form-control" name="lastname" placeholder="Lastname">
    </div>
 
    <div class="mb-3">
    <label for="birthday" class="form-label">Birthday:</label>
    <input type="date" class="form-control" name="birthday">
    </div>
   
    <div class="mb-3">
    <label for="sex" class="form-label">sex:</label>
    <select class="form-select" name="sex"> 
    <option selected disabled>Select sex</option>
    <option value="male">Male</option>
    <option value="female">Female</option>
    </select>
    </div>
 
    <form method="post">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" name="username" placeholder="Enter username">
    </div>
 
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" name="password" placeholder="Enter password">
    </div>
 
 
    <div class="form-group">
      <label for="passwords">Confirm:</label>
      <input type="password" class="form-control" name="passwords" placeholder="Confirm password">
    </div>
 
 
     <?php if (!empty($error_message)): ?>
     <div class="alert alert-danger"><?php echo $error_message; ?></div>
     <?php endif; ?>
 
    <input type="submit" name="signup" class="btn btn-danger btn-block" value="Sign Up">
  </form>
</div>
 
 
 
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<!-- Bootsrap JS na nagpapagana ng danger alert natin -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>