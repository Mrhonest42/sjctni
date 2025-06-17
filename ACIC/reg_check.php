<!-- reg_check.php -->
<?php
session_start();
?>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

<?php
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
    
    $query = "SELECT * FROM students WHERE mobile_number = '$mobile' and email='$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
           
            // Store necessary session data
            $_SESSION['category'] = $row['category'];
            $_SESSION['txt_src_mobile'] = $mobile;
            $_SESSION['username'] = $row['name'];

            //Changes made here
            header("Location: payment.php");
            
            echo "<script>
                document.querySelector('input[name=\"txt_src_mobile\"]').value = '';
                document.querySelector('input[name=\"txt_src_emailid\"]').value = '';
            </script>";
            exit();
    } else {
        echo "<script>
            setTimeout(function() {
                swal({
                    title: 'Not Found!',
                    text: 'mobile number & Email id not matched',
                    type: 'error'
                }, function() {
                    window.location = 'index.php';
                });
            }, 100);
        </script>";
    }
}
?>
