<?php
include "db_conn.php";

if (!isset($_POST['num'], $_POST['name'])) {
    exit("Empty Fields Found / Fields Not Found");
}
if (empty($_POST['num'] || $_POST['name'] )) {
    exit("Empty Fields Found");
}

$num = $_POST['num'];
$name = $_POST['name'];

$payment = "INSERT INTO `payment` (`num`, `name`) 
VALUES ('$num', '$name')";

$query = mysqli_query($conn,$payment);
if($query) {
    echo "Payment Successful";
}
else {
    echo 'Error Occurred';
}
?>