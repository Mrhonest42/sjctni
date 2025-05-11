<?php
include 'db.php';

$staff_id = $_POST['staff_id'];
$password = md5($_POST['staff_password']);

$sql = "SELECT * FROM staff WHERE staff_id='$staff_id' AND staff_password ='$password' ";
$result = $conn-> query($sql);

if($result->num_rows === 1){
    $row = $result->fetch_assoc();
    echo "<h2>Welcome, ". $row['staff_name'] . "!</h2>";
    echo "<p>Department: " .$row['department'] . "</p>";
    echo "<p>Email: ". $row['email'] . "</p>";
} else {
    echo "<p> Invalid staff ID or Password </p>";
}