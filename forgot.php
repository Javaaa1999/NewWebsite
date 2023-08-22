<?php
include('connect.php');

if (isset($_POST['forgot'])) {
    $email = $_POST['email'];
        // Validate the email (e.g., check if it exists in your database)
  
    // Generate a unique reset token (e.g., using random_bytes or a token library)
    $resetToken = generateResetToken();
  
    // Store the reset token and its associated user in your database (e.g., save it in a reset_tokens table)
  
    // Send the password reset email
    $resetLink = 'https://example.com/reset-password.php?token=' . urlencode($resetToken);
    $message = "Click the following link to reset your password: $resetLink";
    $subject = "Password Reset";
    $headers = "From: Your Website <noreply@example.com>";
  
    if (mail($email, $subject, $message, $headers)) {
      // Email sent successfully
      echo "An email with password reset instructions has been sent to your email address.";
    } else {
      // Failed to send email
      echo "Sorry, an error occurred while sending the email. Please try again later.";
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="shortcut icon" href="password.png" type="image/x-icon">
</head>
  <style>
    body {
        margin-top: 120px;
        background-color: #64CCC5;
    }
    .container {
  background-color: #088395;
  max-width: 400px;
  margin: 20px auto;
  padding: 20px;
  border-radius: 5px;
}
.container .password {
  color: black;
}

h2 {
  text-align: center;
}
#email {
    color: black;
}
form {
  display: flex;
  flex-direction: column;
}

label {
  margin-bottom: 10px;
}

input {
  padding: 10px;
  margin-bottom: 20px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

button {
  padding: 10px 20px;
  background-color: #0EA293;
  color: black;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
button[type="back"] {
    padding: 10px 20px;
    margin: 10px;
    background-color: #569DAA;
    color: black;
    border: none;
    border-radius: 5px;
    cursor: pointer;
        }
  </style>
<body>
  <div class="container">
    <h2>Forgot Password</h2>
    <form>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
      <button type="submit" >Reset Password</button>
    </form>
    <a href="index.php"><button type="Back" class="bck">Back</button></a>
  </div>
</body>
</html>