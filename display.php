<?php
session_start();
include('connect.php');


// Check if the logged-in user is an admin
if ($_SESSION['email'] !== 'admin@gmail.com') {
  header('Location: display2.php'); // Redirect to display2.php for non-admin users
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudConnect Info</title>
    <link href="/crud/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="listicon.png" type="image/x-icon">
     <style>
        body {
        font-family: 'Inter', sans-serif;
        background-color: #a1f0bd;
        /* background-image: url(https://64.media.tumblr.com/b5e56c692f9ac06506717d72496a593b/173b746cda50fdb8-f0/s400x600/d08b029e5a55c3c7707b5e91ec0c8b68437f4298.gifv); */
        background-size: cover;
        background-position: center;
        }
.container my-5{
  margin-top: 50px;
}

.search-bar {
  margin-bottom: 20px;
}

.search-bar input[type="text"] {
  padding: 5px;
  width: 860px;
}

.search-bar button[type="submit"] {
  padding: 5px 10px;
  background-color: #007bff;
  color: #fff;
  border: none;
}

.table {
  width: 100%;
  border-collapse: collapse;
}

.table th,
.table td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

.table thead {
  background-color: #f5f5f5;
}

.table-hover tbody tr:hover {
  background-color: #f5f5f5;
}

.btn-block {
  width: 100%;
}
button[type="back"] {
    margin-left: 952px;
    padding: 10px 20px;
    margin: center;
    background-color: #DAFFFB;
    color: black;
    border: none;
    border-radius: 5px;
    cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
       <br> 
       <center>
        <a href="user.php" class="text-decoration-none text-light">
          <button type="add" class="btn btn-secondary btn-lg btn-block">STUDENTS INFORMATION SYSTEM</button></a>
      </center><br>
          <!-- HTML for the search bar -->
  <div class="search-bar">
    <input type="text" placeholder="Search...">
    <button type="submit">Search</button>
  </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">idno</th> 
                <th scope="col">name</th> 
                <th scope="col">email</th>
                <th scope="col">mobile</th>
                <th scope="col">password</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        
        <tbody>
            <?php
            $sql = "SELECT * FROM `student`";
            $result = mysqli_query($con, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                    <tr>
                        <th scope="row">' . $row['idno'] . '</th>
                        <td>' . $row['name'] . '</td>
                        <td>' . $row['email'] . '</td>
                        <td>' . $row['mobile'] . '</td>
                        <td>' . $row['password'] . '</td>
                        <td>
                            <button class="btn btn-primary"><a href="update.php?updateid=' . $row['idno'] . '" class="text-decoration-none text-light">Update</a></button>
                            <button class="btn btn-danger"><a href="delete.php?deleteid=' . $row['idno'] . '" class="text-decoration-none text-light">Delete</a></button>
                        </td>
                    </tr>
                    ';
                }
            } else {
                die(mysqli_error($con));
            }
            ?>
        </tbody>
    </table>    
    </div>
    <a href="logintest.php"><button type="Back" class="btn btn-outline-info">Log Out</button></a>

</body>
</html>
