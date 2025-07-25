<?php
include("includes/db.php");
include("submit.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Quiz Result</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5 text-center">
    <div class="card p-4 shadow">
      <h2 class="mb-3">🎉 Quiz Completed!</h2>
      <p class="fs-4">You scored <strong><?= $score ?></strong> out of <strong><?= $total_questions ?></strong>.</p>
      <a href="index.php" class="btn btn-success mt-3">Back to Home</a>
    </div>
  </div>
</body>
</html>