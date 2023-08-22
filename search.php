<?php
include('connect.php');

if (isset($_POST['search'])) {
    $searchValue = $_POST['search'];

    $sql = "SELECT * FROM `student` WHERE name LIKE '%$searchValue%'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
    <title>Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="icon" href="images/logo.jpg">
    <style>
      body{
        background-image: url('images/gray.gif');
        background-size: cover;
        color: #fff;
        min-height: 100vh;
        width: 100%;
      }
    </style>
</head>

<body>
<div class="container my-5">
    <button class="btn btn-primary"><a href="user.php" class="text-decoration-none text-light">Add User</a></button>
    </div>
    <div class="container">
        <form method="post">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search by Name" name="search" value="<?php echo isset($searchValue) ? $searchValue : ''; ?>">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <?php if (isset($rows) && !empty($rows)) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
foreach ($rows as $row) {
    echo '
    <tr>
        <td>'.$row['Idno'].'</td>
        <td>'.$row['Name'].'</td>
        <td>'.$row['Email'].'</td>
        <td>'.$row['Mobile'].'</td>
        <td>'.$row['Password'].'</td>
        <td>
            <button class="btn btn-success"><a href="update.php?updateid='.$row['Idno'].'" class="text-decoration-none text-light">Update</a></button>
            <button class="btn btn-danger"><a href="delete.php?deleteid='.$row['Idno'].'" class="text-decoration-none text-light">Delete</a></button>
        </td>
    </tr>
    ';
}
?>
</tbody>
</table>
<?php elseif (isset($searchValue)) : ?>
            <p>No results found.</p>
        <?php endif; ?>
    </div>
</body>

</html>
