<!-- reg_final.php -->
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

<?php
session_start();
$host = 'localhost';
$db = 'college';
$user = 'root';
$pass = '';

$con = new mysqli($host, $user, $pass, $db);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_POST['submit_reg'])) {
    $name        = addslashes($_POST['txtfirstname']);
    $department  = addslashes($_POST['txtdepartmentname']);
    $college     = addslashes($_POST['txtcollegename']);
    $purpose     = addslashes($_POST['txtpurpose']);
    $category    = $_POST['category'];
    $mobile      = $_POST['txtmobile'];
    $email       = $_POST['emailid'];

    if (empty($name) || empty($department) || empty($college) || empty($purpose) || empty($category) || empty($mobile) || empty($email)) {
        echo "<script>
            setTimeout(function() {
                swal({
                    title: 'Error!',
                    text: 'Please fill all fields!',
                    type: 'error'
                }, function() {
                    window.location = 'index.php';
                });
            }, 100);
        </script>";
        exit;
    }

    $check = "SELECT * FROM students WHERE mobile_number = '$mobile'";
    $res = mysqli_query($con, $check);

    if (mysqli_num_rows($res) > 0) {
        echo "<script>
            setTimeout(function() {
                swal({
                    title: 'Registration Failed!',
                    text: 'Mobile number already registered.',
                    type: 'error'
                }, function() {
                    window.location = 'index.php';
                });
            }, 100);
        </script>";
    } else {
        $query = "INSERT INTO students 
                    (name, email, mobile_number, department, college_name, purpose, category) 
                  VALUES 
                    ('$name', '$email', '$mobile', '$department', '$college', '$purpose', '$category')";

        if (mysqli_query($con, $query)) {
            $_SESSION['category'] = $category;
            $_SESSION['txtmobile'] = $mobile;
            $_SESSION['username'] = $name;
            echo "<script>
                setTimeout(function() {
                    swal({
                        title: 'Success!',
                        text: 'Registration completed successfully.',
                        type: 'success'
                    }, function() {
                        window.location = 'payment.php';
                    });
                }, 100);
            </script>";
        } else {
            echo "<script>
                setTimeout(function() {
                    swal({
                        title: 'Database Error!',
                        text: 'Failed to insert record.',
                        type: 'error'
                    }, function() {
                        window.location = 'index.php';
                    });
                }, 100);
            </script>";
        }
    }
}
?>