<?php
include('connect.php');
$id = $_GET['deleteid'];
$sql = "DELETE FROM `student` WHERE idno='$id'";
$result = mysqli_query($con, $sql);
if ($result) {
    header('Location: display.php');
} else {
    die(mysqli_error($con));
}
?>
