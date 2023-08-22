<?php

include('connect.php');
if(isset($_GET['updateid'])){
    $id = $_GET['updateid'];
    $sql = "SELECT * FROM `student` WHERE idno='$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
}
if(isset($_POST['submit'])){
    $id = $_POST['idno'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    
    $sql = "UPDATE `student` SET name='$name', email='$email', mobile='$mobile', password='$password' WHERE idno='$id'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        header('Location: display.php');
    } else {
        die(mysqli_error($con));
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <link href="/crud/css/bootstrap.min.css" rel="stylesheet">
     <style>
body {
    background-color: #0E8388;
}
.container {
  background-color: #87CBB9;
  max-width: 500px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

h1 {
  font-size: 24px;
  margin-bottom: 20px;
}

.form-control {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.mb-3 {
  margin-bottom: 20px;
}

label {
  font-weight: bold;
}

.btn {
  display: inline-block;
  padding: 10px 20px;
  font-size: 16px;
  text-align: center;
  text-decoration: none;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.btn-primary {
  background-color: #007bff;
}

.btn-primary:hover {
  background-color: #0069d9;
}

input[type="text"],
input[type="email"],
input[type="password"] {
  margin-top: 5px;
}

input[type="submit"] {
  background-color: #007bff;
  color: #fff;
  cursor: pointer;
}

    </style>
</head>
<body>
    <div class="container my-5">
        <h1>Update Student Record</h1>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $row['idno']; ?>">
            <div class="mb-3">
                <label>Name:</label>
                <input type="text" class="form-control" placeholder="Enter your name" name="name" value="<?php echo $row['name']; ?>" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Email:</label>
                <input type="email" class="form-control" placeholder="Enter your email" name="email" value="<?php echo $row['email']; ?>" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Mobile:</label>
                <input type="text" class="form-control" placeholder="Enter your mobile" name="mobile" value="<?php echo $row['mobile']; ?>" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Password:</label>
                <input type="password" class="form-control" placeholder="Enter your password" name="password" value="<?php echo $row['password']; ?>" autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
    </div>
    <script src="/crud/css/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
