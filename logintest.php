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
    header('Location: display.php');
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
  <link rel="shortcut icon" href="img/avatar.svg" type="image/x-icon">

  <title>Login</title>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #a1f0bd;
      /* background-image: url('https://img.freepik.com/free-vector/blue-pink-halftone-background_53876-99004.jpg?w=2000'); */
      background-size: cover;
      background-position: center;
    }
    .wave{
	position: fixed;
	bottom: 0;
	left: 0;
	height: 100%;
	z-index: -1;
}
.img{
  position: fixed;
	top: 20%;
	left: 20%;
	height: 100%;
}

    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.5);
      backdrop-filter: blur(10px);
      z-index: -1;
    }
    .container {
      position: absolute;
      top: 50%;
      left: 75%;
      transform: translate(-50%, -50%);
    }
    .container {
      position: absolute;
      top: 50%;
      left: 75%;
      transform: translate(-50%, -50%);
    }

    h1 {
      text-align: center;
    }

    form {
      max-width: 500px;
      margin: 0 auto;
      padding: 20px;
      background-color: rgba(255, 255, 255);
      border-radius: 20px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
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
      background-color: #75f0a2;
      color: #fff;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    button[type="submit"]:hover {
      background-color: #42855b;
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
      color: #77e6a0;
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
/* footer {
  background-color: #f2f2f2;
  padding: 20px;
  text-align: center;
}

.container {
  max-width: 960px;
  margin: 0 auto;
}

p {
  margin: 0;
  font-size: 14px;
  color: #888;
} */

    
  </style>
</head>
<body>
<img class="wave" src="img/wave.png">
<div class="img">
			<img src="FINAL_SEAL.png">
		</div>
  <div class="container">
  <!-- <h1 class="hx">StudConnect</h1> -->
  <form method="post">
  <h1>StudConnect</h1>
  <!-- <p>Enter your Em</p> -->
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
  <!-- </div>
  <div class="footer">
  <p>&copy; 2023 Our StudConnect. All rights reserved.</p>
  </div> -->
  <!-- <footer>
  <div class="container">
    <p>&copy; 2023 Your Website Name. All rights reserved.</p>
  </div> -->
</footer> 
</body>
</html>