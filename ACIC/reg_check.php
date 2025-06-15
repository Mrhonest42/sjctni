<!-- reg_check.php // login logic -->
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

if (isset($_POST['sub_reg_check'])) {
    $mobile = $_POST['txt_src_mobile'];
    $email = $_POST['txt_src_emailid'];

    $query = "SELECT * FROM students WHERE mobile_number = '$mobile'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $registered_email = $row['email'];

        if ($email === $registered_email) {
            // Store necessary session data
            $_SESSION['category'] = $row['category'];
            $_SESSION['txt_src_mobile'] = $row['mobile_number'];
            $_SESSION['username'] = $row['name'];

            echo "<script>
                setTimeout(function() {
                    swal({
                        title: 'Login Success!',
                        text: 'Redirecting to payment...',
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
                        title: 'Login Failed!',
                        text: 'Email does not match our records.',
                        type: 'error'
                    }, function() {
                        window.location = 'index.php';
                    });
                }, 100);
            </script>";
        }
    } else {
        echo "<script>
            setTimeout(function() {
                swal({
                    title: 'Not Found!',
                    text: 'No user found with this mobile number.',
                    type: 'error'
                }, function() {
                    window.location = 'index.php';
                });
            }, 100);
        </script>";
    }
}
?>
