<?php
session_start();

// Redirect to login.php if not logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

// Logout functionality
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}
include('connect.php');

// Check if the form has been submitted
if (isset($_POST['search'])) {
  // Sanitize the search query
  $search = mysqli_real_escape_string($con, $_POST['search']);

  // Retrieve the records that match the search query
  $sql = "SELECT * FROM student WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR mobile LIKE '%$search%' OR password LIKE '%$search%'";
  $result = mysqli_query($con, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search</title>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: url(https://wallup.net/wp-content/uploads/2018/09/27/10043-green-gaussian-blur-backgrounds.jpg);
      background-position: center;
    }

    form {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
    }

    input[type="text"] {
      padding: 20px;
      border: none;
      border-radius: 5px;
      margin-bottom: 20px;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 600px;
      font-size: 24px;
      text-align: center;
    }

    button[type="submit"] {
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      background-color: #007aff;
      color: #fff;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.2s ease-in-out;
    }

    button[type="submit"]:hover {
      background-color: #0062cc;
    }

    
    table {
      border-collapse: collapse;
      width: 100%;
      max-width: 800px;
      margin: 0 auto;
    }

    th,
    td {
      text-align: left;
      padding: 8px;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    .update-button,
    .delete-button {
      display: inline-block;
      padding: 8px 16px;
      border-radius: 5px;
      text-decoration: none;
      color: #fff;
      font-weight: bold;
      transition: background-color 0.2s ease-in-out;
    }

    .update-button {
      background-color: #007aff;
    }

    .delete-button {
      background-color: #ff3b30;
    }

    .update-button:hover,
    .delete-button:hover {
      background-color: #4c4c4c;
    }
  </style>
</head>
<body>
  <br><br>
  <form method="POST">
    <input type="text" name="search" autocomplete="off" placeholder="Search...">
    <button class="add-user btn" type="submit" 
    style="background-color: #007aff; color: #fff; border: none; border-radius: 4px; padding: 12px 50px; font-size: 16px; font-weight: bold; text-decoration: none;">Search</button>
    <!-- <center>
      <a href="welcome.php" class="add-user btn" type="submit" style="background-color: #007aff; color: #fff; border: none; border-radius: 4px; padding: 12px 50px; font-size: 16px; font-weight: bold; text-decoration: none;">Home</a>
      <button class="add-user btn" type="submit" style="background-color: #007aff; color: #fff; border: none; border-radius: 4px; padding: 12px 50px; font-size: 16px; font-weight: bold; text-decoration: none;">Search</button>
    </center> -->
    <br>
  </form>

  <?php if (isset($result)): ?>
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Mobile</th>
          <th>Password</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['mobile'] ?></td>
            <td><?= $row['password'] ?></td>
            </td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>
  <?php endif ?>
</body>
</html>