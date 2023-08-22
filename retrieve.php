<?php
include('connect.php');

if (isset($_GET['restoreid'])) {
    $restoreId = $_GET['restoreid'];

    // Retrieve the record from the 'deleted_records' table
    $retrieveSql = "SELECT * FROM deleted_records WHERE IDno = '$restoreId'";
    $retrieveResult = mysqli_query($con, $retrieveSql);
    $record = mysqli_fetch_assoc($retrieveResult);

    if ($record) {
        // Insert the record into the 'student' table
        $insertSql = "INSERT INTO student (idno, name, email, mobile, password) VALUES ";
        $insertSql .= "('".$record['IDno']."', '".$record['Name']."', '".$record['Email']."', '".$record['Mobile']."', '".$record['Password']."')";
        $insertResult = mysqli_query($con, $insertSql);

        if ($insertResult) {
            // Delete the record from the 'deleted_records' table
            $deleteSql = "DELETE FROM deleted_records WHERE ID = '$restoreId'";
            $deleteResult = mysqli_query($con, $deleteSql);

            if ($deleteResult) {
                echo '<div class="alert alert-success" role="alert">Record restored successfully.</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Failed to restore the record.</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Failed to insert the record.</div>';
        }
    } else {
        echo '<div class="alert alert-info" role="alert">No record found.</div>';
    }
}

if (isset($_GET['deleteid'])) {
    $deleteId = $_GET['deleteid'];

    // Delete the record from the 'deleted_records' table
    $deleteSql = "DELETE FROM deleted_records WHERE ID = '$deleteId'";
    $deleteResult = mysqli_query($con, $deleteSql);

    if ($deleteResult) {
        echo '<div class="alert alert-success" role="alert">Record deleted permanently.</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Failed to delete the record.</div>';
    }
}

$sql = "SELECT * FROM deleted_records";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information System</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
    body {
        background-image: url('images/background.gif');
        background-size: cover;
        color:#fff;
        min-height: 100vh;
        width: 100%;
    }
    .table{
        color:#fff;
    }
    </style>
</head>
<body>
<header><h1 class="text-center">Recently Deleted<h1></header>
    <div class="container mt-3">
        <form method="post" action="search.php">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search by lrn" name="search" value="<?php echo isset($searchValue) ? $searchValue : ''; ?>">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    <div class="table">
    <table class="table ">
        <thead>
            <tr>
                <th scope="col">IDNO</th> 
                <th scope="col">NAME</th>   
                <th scope="col">EMAIL</th>
                <th scope="col">MOBILE</th>
                <th scope="col">PASSWORD</th>
                <th scope="col">ACTION</th>
            </tr>
        </thead>
        <tbody>
        
            <?php
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                    <tr>
                        <td>'.$row['IDno'].'</td>
                        <td>'.$row['Name'].'</td>
                        <td>'.$row['Email'].'</td>
                        <td>'.$row['Mobile'].'</td>
                        <td>'.$row['Password'].'</td>
                        <td>
                            <button class="btn btn-primary"><a href="retrieve.php?restoreid='.$row['IDno'].'" class="text-decoration-none text-light">Restore</a></button>
                            <button class="btn btn-danger"><a href="retrieve.php?deleteid='.$row['IDno'].'" class="text-decoration-none text-light">Delete Permanently</a></button>
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
    <button class="btn btn-primary"><a href="display.php" class="text-decoration-none text-light">Back</a></button>
</body>
</html>