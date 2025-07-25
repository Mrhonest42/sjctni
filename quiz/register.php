<?php
include("includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $reg = $_POST['reg_no'];
    $dept = $_POST['department'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $insert = "INSERT INTO students (name, reg_no, department, password) VALUES ('$name', '$reg', '$dept', '$pass')";
    if (mysqli_query($conn, $insert)) {
        header("Location: index.php");
        exit();
    } else {
        $error = "Registration failed. Reg No might be duplicate.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Student Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container d-flex justify-content-center" style="margin-top: 150px;">
  <div class="card p-4 shadow w-50 d-flex flex-column gap-3">
    <h3 class="mb-3">Student Registration</h3>
    <?php if (isset($error)): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
    <form method="POST" class="d-flex flex-column gap-3">
      <div class="mb-2"><input name="name" class="form-control" placeholder="Full Name" required></div>
      <div class="mb-2"><input name="reg_no" class="form-control" placeholder="Register No" required></div>
      <div class="mb-2"><input name="department" class="form-control" placeholder="Department" required></div>
      <div class="mb-2"><input type="password" name="password" class="form-control" placeholder="Password" required></div>
      <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
    <p class="mt-2 text-center"><a href="index.php" style="text-decoration: none;">Already have an account? Login</a></p>
  </div>
</div>
</body>
</html>
