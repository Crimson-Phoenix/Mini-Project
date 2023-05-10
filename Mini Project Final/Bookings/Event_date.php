<?php
include "config.php";

if (!isset($_POST['event'])) {
    exit("Empty Fields Found / Fields Not Found");
}
if (empty($_POST['event'])) {
    exit("Empty Fields Found");
}

$event = $_POST['event'];

$event1 = "INSERT INTO `event` (`event`) VALUES ('$event')";

$query = mysqli_query($conn,$event1);
if($query) {
    echo "Date Registered";
}
else {
    echo 'Error Occurred';
}
?>