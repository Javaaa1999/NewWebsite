
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="account.png" type="image/x-icon">
    <title>Register</title>
    <link href="/crud1/css/bootstrap.min.css" rel="stylesheet">
  </head>
    <style>
      body {
        background-color: #a1f0bd;
        /* background-image: url(https://64.media.tumblr.com/b5e56c692f9ac06506717d72496a593b/173b746cda50fdb8-f0/s400x600/d08b029e5a55c3c7707b5e91ec0c8b68437f4298.gifv); */
        background-size: cover;
        min-height: 100vh;
        width: 100%;
      }
      .container {
  max-width: 400px;
  margin: 10px auto;
  background-color: #9be09b;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

h1 {
  text-align: center;
  color: #333;
  font-size: 24px;
  margin-top: -57px;
  margin-bottom: 10px;
}

.logo {
  display: block;
  margin-top: 100px;
  margin: 0 auto 20px;
}

.form-label {
  font-weight: bold;
  color: #333;
}

.form-control {
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

.btn {
  display: block;
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  cursor: pointer;
  background-color: #4CAF50;
  color: #fff;
  border: none;
}

.btn:hover {
  background-color: #2E8B57;
}

.mb-3 {
  margin-bottom: 15px;
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
      <center>
        <img src="monkey1.gif" style="width: 80px; height: 80px;" alt="Logo" class="logo">
        <h1>REGISTER</h1>
      </center>
      <form method="post">
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name" autocomplete="off">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" autocomplete="off">
        </div>
        <div class="mb-3">
          <label for="mobile" class="form-label">Mobile</label>
          <input type="text" class="form-control" id="mobile" placeholder="Enter your mobile" name="mobile" autocomplete="off">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" autocomplete="off">
        </div>
        <p></p>
        <button type="submit" class="btn btn-secondary btn-lg" name="submit">Submit</button>
      </form>
      <a href="logintest.php"><button type="Back" class="bck">Back</button></a>
      <?php
        include 'connect.php';
        if(isset($_POST['submit'])){
          $idno = $_POST['idno'];
          $name = $_POST['name'];
          $email = $_POST['email'];
          $mobile = $_POST['mobile'];
          $password = $_POST['password'];
          $sql = "insert into `student` (name,email,mobile,password) values ('$name','$email','$mobile','$password')";
          $result = mysqli_query($con,$sql);
          if($result){
            echo "\nData registered successfully";
            header('location: logintest.php');
          }else{
            die(mysqli_error($con));
          }
        }
      ?>
    </div>
    <script src="/crud/css/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
