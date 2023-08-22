<?php

include 'connect.php';

session_start(); // Start session to store user data

// Redirect to login.php if not logged in
if (!isset($_SESSION['email'])) {
  header('Location: display2.php');
  exit();
}

// Check if the logged-in user is an admin
if ($_SESSION['email'] !== 'admin@Ggmail.com') {
  header('Location: display.php'); // Redirect to display2.php for non-admin users
  exit();
}

// Logout functionality
if (isset($_POST['logout'])) {
  session_destroy();
  header('Location: logintest.php');
  exit();
}

$email = "";
$password = "";
$errorMsg = "";

if(isset($_POST['submit'])){
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Retrieve user data from the database
  $sql = "SELECT * FROM `student` WHERE email='$email'";
  $result = mysqli_query($con, $sql);

  if($result && mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $storedPassword = $row['password'];

    // Compare the entered password with the stored password
    if($password === $storedPassword || password_verify($password, $storedPassword)){
      // Passwords match, log in the user
      $_SESSION['user_id'] = $row['idno'];
      $_SESSION['user_name'] = $row['name'];
      header("Location: display2.php"); // Replace with the URL of your logged-in page
      exit();
    } else {
      $errorMsg = "Invalid email or password";
    }
  } else {
    $errorMsg = "Invalid email or password";
  }
}
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="icons8-log-in-100.png" type="image/x-icon">
  <title>Student | Log In</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
body {
  font-family: 'Inter', sans-serif;
  background-image: url('https://media1.giphy.com/media/3o6vXRpbptjHM70EzS/giphy.gif?cid=ecf05e470doh9j8vmv1foafy5dqskh9mw7hmnj8glhkiuia1&ep=v1_gifs_related&rid=giphy.gif&ct=g');
  background-size: cover;
  background-position: center;
  padding: 150px 50px;
    }

  body::before {
  content: "";
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(255, 255, 255, 0.5);
  backdrop-filter: blur(70px);
  z-index: -1;
    }
.container {
      border-radius: 19px;
      padding:20px;
      max-width: 800px;
      margin: 0 auto;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    } 
  form {
  background-color: #f7f7f7;
  border: 1px solid #ccc;
  padding: 20px;
  width: 300px;
  margin: 0 auto;
  text-align:center;
}
.form-input {
  margin-top: 10px;
  margin-bottom: 20px;
}

label {
  font-weight: bold;
  display: block;
  margin-bottom: 5px;
}

input[type="text"], input[type="password"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

button[type="submit"] {
  background-color: #4CAF50;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 4px;
  cursor: pointer;
}
  </style>
</head>
<body>
<form>
  <div class="container">
  <div class="form-input">
    <label>Email</label>
    <input type="text" placeholder="Enter email">
  </div>
  <div class="form-input">
    <label>Password</label>
    <input type="password" placeholder="Enter password">
  </div>
  <button type="submit" name="submit"></a>Login</button>
  <p class="register">

  <?php if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['password']) && isset($errorMessage)) { ?>
      <p class="error"><?php echo $errorMessage; ?></p>
    <?php } ?>

      Don't have an account? <a href="user.php">Register Here</a>
    </p>
  </div>
</form>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="main.js"></script>
</body>
</html>

<?php
session_start();

$errorMessage = ""; // Initialize the error message variable

if (isset($_POST['submit'])) {
  include 'connect.php';

  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
  $result = mysqli_query($con, $sql);

  if ($result && mysqli_num_rows($result) == 1) {
    // Valid login credentials
    $_SESSION['email'] = $email;
    header('Location: home.php');
    exit();
  } else {
    // Incorrect login credentials
    $errorMessage = "Incorrect email or password. Please try again.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-image: url('/centralhub/img/cover.webp');
      background-size: cover;
      background-position: center;
    }

    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.5);
      backdrop-filter: blur(70px);
      z-index: -1;
    }
    .container {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    h1 {
      text-align: center;
      margin-top: 50px;
    }

    form {
      max-width: 500px;
      margin: 0 auto;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.5);
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="email"],
    input[type="password"] {
      display: block;
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
      font-size: 16px;
    }

    button[type="submit"] {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #007aff;
      color: #fff;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    button[type="submit"]:hover {
      background-color: #0062cc;
    }

    p.error {
      color: #ff3b30;
      margin-top: 10px;
    }

    p.register {
      text-align: center;
      margin-top: 10px;
    }

    p.register a {
      color: #007aff;
      text-decoration: none;
    }
  .hx {
  max-width: 400px;
        margin: 0 auto;
        margin-bottom: 20px;
        margin-top: 20px;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.5);
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
  </style>
</head>
<body>
  <div class="container">
  <h1 class="hx">Login to CentralHub</h1>
  <form method="post">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Enter your email" autocomplete="off" required>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Enter your password" autocomplete="off" required>

    <button type="submit" name="submit">Log In</button>

    <?php if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['password']) && isset($errorMessage)) { ?>
      <p class="error"><?php echo $errorMessage; ?></p>
    <?php } ?>

    <p class="register">
      Don't have an account? <a href="use.php">Register Here</a>
    </p>
  </form>
  </div>
</body>
</html>