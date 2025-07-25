<?php
session_start();
include("includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reg = $_POST['reg_no'];
    $pass = $_POST['password'];

    $q = mysqli_query($conn, "SELECT * FROM students WHERE reg_no = '$reg'");
    $student = mysqli_fetch_assoc($q);

    if ($student && password_verify($pass, $student['password'])) {
        $_SESSION['student_id'] = $student['id'];
        $_SESSION['student_name'] = $student['name'];
        header("Location: quiz_interface.php");
        exit();
    } else {
        $error = "Invalid credentials.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Student Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container" style="margin-top: 200px;display: flex;justify-content: center;align-items: center;">
  <div class="card p-4 shadow w-50 d-flex flex-column gap-3">
    <h3 class="mb-3">Student Login</h3>
    <?php if (isset($error)): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
    <form method="POST" class="d-flex flex-column gap-3">
      <div class="mb-2"><input name="reg_no" class="form-control" placeholder="Register No" required></div>
      <div class="mb-2"><input type="password" name="password" class="form-control" placeholder="Password" required></div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <p class="mt-2 text-center"><a href="register.php" style="text-decoration: none;">Don't have an account? Register</a></p>
  </div>
</div>
</body>
</html>