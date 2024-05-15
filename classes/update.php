<?php
require_once('classes/database.php');
$con = new database();

if (empty($_POST['id'])) {
    header('localation:index.php');
    }else{
        $id = $_POST['id'];
        $data = $con->viewdata($id);
    }
    if (isset($_POST['update'])) 
     $username = $_POST['username'];
     $password = $_POST['password'];
     $username =$_POST['username'];
     $password=$_POST['password'];
     $firstName=$_POST['firstName'];
     $lastName=$_POST['lastName'];
     $birthday=$_POST['birthday'];
     $sex=$_POST['sex'];
     //address information
     $province = $_POST['province'];
     $barangay = $_POST['barangay'];
     $street= $_POST['street'];
     $city = $_POST['city'];
     $confirm = $_POST['c_password'];
     //userid
     $user_id = $_POST['id'];
    
     if ($password == $confirm) { // Passwords match, proceed with signup
        if ($con->UpdateUser($user_id, $username, $password, $firstName, $lastName, $birthday, $sex)) { // Insert into users table and get user_id
            if ($user_id) { // Signup successful, insert address into users_address table
                if ($con->UpdateUserAddress($user_id, $city, $province, $barangay, $street)) { // Address insertion successful
                    // Redirect to login page
                    header('location: login.php');
                    exit();
                } else { // Address insertion failed, display error message
                    $error = "Error occurred while signing up. Please try again.";
                }
            } else { // user update failed
                $error = "Error occurred while updating user information. Please try again.";
            }
        }
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MultiSave Page</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style>
    .custom-container{
        width: 800px;
    }
    body{
    font-family: 'Roboto', sans-serif;
    }
  </style>

</head>
<body>

<div class="container custom-container rounded-3 shadow my-5 p-3 px-5">
  <h3 class="text-center mt-4"> Update Form</h3>

  <form method="post">
    <!-- Personal Information -->
    <div class="card mt-4">
      <div class="card-header bg-info text-white">Personal Information</div>
      <div class="card-body">
        <div class="form-row">
          <div class="form-group col-md-6 col-sm-12">
            <label for="firstName">FirstName:</label>
            <input type="text" class="form-control" name="firstName" value="<?php echo $data['Firstname'];?>" placeholder="Enter first name">
          </div>
          <div class="form-group col-md-6 col-sm-12">
            <label for="lastName">LastName:</label>
            <input type="text" class="form-control" name="lastName" value="<?php echo $data['Lastname'];?>"placeholder="Enter last name">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="birthday">Birthday:</label>
            <input type="date" class="form-control" name="birthday" value="<?php echo $data['birthday'];?>">
          </div>
          <div class="form-group col-md-6">
            <label for="sex">Sex:</label>
            <select class="form-control" name="sex">
              <option value="Male" <?php if ($data['user_sex']) echo 'selected'; ?>>Male</option>
              <option value="Female" <?php if ($data['user_sex']) echo 'selected'; ?>>Female</option>

              <option>Male</option>
              <option>Female</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" class="form-control" name="username" placeholder="Enter username" value="<?php echo $data['username'];?>">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" name="password" placeholder="Enter password" value="<?php echo $data['passwords'];?>">
        </div>
        <div class="form-group">
          <label for="password">c_password:</label>
          <input type="password" class="form-control" name="c_password" placeholder="Enter password" value="<?php echo $data['c_password'];?>">
        </div>
      </div>
    </div>
    
    <!-- Address Information -->
    <div class="card mt-4">
      <div class="card-header bg-info text-white">Address Information</div>
      <div class="card-body">
        <div class="form-group">
          <label for="street">Street:</label>
          <input type="text" class="form-control" name="street" placeholder="Enter street">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="barangay">Barangay:</label>
            <input type="text" class="form-control" name="barangay" placeholder="Enter barangay">
          </div>
          <div class="form-group col-md-6">
            <label for="city">City:</label>
            <input type="text" class="form-control" name="city" placeholder="Enter city">
          </div>
        </div>
        <div class="form-group">
          <label for="province">Province:</label>
          <input type="text" class="form-control" name="province" placeholder="Enter province">
        </div>
      </div>
    </div>
    
    <!-- Submit Button -->
    
    <div class="container">
    <div class="row justify-content-center gx-0">
        <div class="col-lg-3 col-md-4">
        <input type="hidden" name="id"value="<?php echo $data ['user_id'];?>">
        <input type="submit" name="update" class="btn btn-outline-primary btn-block mt-4" value="Sign Up">
        </div>
        <div class="col-lg-3 col-md-4"> 
            <a class="btn btn-outline-danger btn-block mt-4" href="login.php">Go Back</a>
        </div>
    </div>
</div>


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
