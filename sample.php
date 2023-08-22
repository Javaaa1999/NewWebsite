<?php
include 'connect.php';

$message = ''; // Variable to store the error message

if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $password = $_POST['password'];

  // Check if the email already exists in the database
  $checkEmailQuery = "SELECT * FROM student WHERE email = '$email'";
  $checkEmailResult = mysqli_query($con, $checkEmailQuery);

  if(mysqli_num_rows($checkEmailResult) > 0){
    // Email already registered
    $message = "Your email is already registered";
  } else {
    // Insert the data into the database
    $sql = "INSERT INTO student (name,email,mobile,password) VALUES ('$name','$email','$mobile','$password')";
    $result = mysqli_query($con, $sql);

    if($result){
      $message = "Data inserted successfully";
    } else {
      die(mysqli_error($con));
    }
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Information System</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
      .success-message {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid transparent;
        border-radius: .25rem;
      }
      header {
        background-color: transparent;
        border: none;    }
    </style>
  </head>
  <body>
  <header><h1 class="text-center">Add User</h1></header>
    <div class="container mt-3">
      <form method="post">
        <div class="mb-3">
          <label>Name</label>
          <input type="text" class="form-control" placeholder="Enter your name" name="name" autocomplete="off">
        </div>
        <div class="mb-3">
          <label>Email</label>
          <input type="email" class="form-control" placeholder="Enter your email" name="email" autocomplete="off">
        </div>
        <div class="mb-3">
          <label>Mobile</label>
          <input type="text" class="form-control" placeholder="Enter your mobile" name="mobile" autocomplete="off">
        </div>
        <div class="mb-3">
          <label>Password</label>
          <input type="password" class="form-control" placeholder="Enter your password" name="password" autocomplete="off">
        </div>
        <?php if(!empty($message)): ?>
        <div class="<?php echo ($message === 'Data inserted successfully') ? 'success-message' : 'alert alert-danger'; ?>"><?php echo $message; ?></div>
      <?php endif; ?>
      <button class="btn btn-primary"><a href="display.php" class="text-decoration-none text-light">Back</a></button>
        <button type="submit" class="btn <?php echo ($message === 'Data inserted successfully') ? 'btn-primary' : 'btn-primary'; ?>" name="submit">Submit</button>
      </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>