<?php
include "db_conn.php";
// echo "$_POST[First_name]  $_POST[Last_name] $_POST[Email] $_POST[Message]";
// exit();

if (!isset($_POST['First_name'], $_POST['Last_name'], $_POST['Email'], $_POST['Message'])) {
    exit("Empty Fields Found / Fields Not Found");
}

if (empty($_POST['First_name'] || $_POST['Last_name'] || $_POST['Email'] || $_POST['Message'])) {
    exit("Empty Fields Found");
}

$First_name = $_POST['First_name'];
$Last_name = $_POST['Last_name'];
$Email = $_POST['Email'];
$Message = $_POST['Message'];

$Contact = "INSERT INTO `contact` (`First_name`, `Last_name`, `Email`, `Message`) 
VALUES ('$First_name', '$Last_name', '$Email', '$Message')";

$query = mysqli_query($conn,$Contact);
if($query) {
    echo "Review administered successfully";
}
else {
    echo 'Error Occurred';
}
?>