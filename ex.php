<?php
session_start();

$errorMessage = ""; // Initialize the error message variable

if (isset($_POST['submit'])) {
  include 'connect.php';

  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM student WHERE email = '$email' AND password = '$password'";
  $result = mysqli_query($con, $sql);

  if ($result && mysqli_num_rows($result) == 1) {
    // Valid login credentials
    $_SESSION['email'] = $email;
    header('Location: display2.php');
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
      Don't have an account? <a href="user.php">Register Here</a>
    </p>
  </form>
  </div>
</body>
</html>