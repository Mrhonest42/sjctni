<?php
// includes/db.php
include("includes/db.php");

// Fetch all quizzes
$quizQuery = "SELECT * FROM quizzes";
$quizResult = mysqli_query($conn, $quizQuery);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Quiz Website</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Available Quizzes</h2>
    <a href="admin.php" class="btn btn-outline-primary">Admin Login</a>
  </div>

  <div class="row">
    <?php while($quiz = mysqli_fetch_assoc($quizResult)): ?>
      <div class="col-md-4 mb-3">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($quiz['title']) ?></h5>
            <p class="card-text"><?= htmlspecialchars($quiz['description']) ?></p>
            <a href="quiz.php?quiz_id=<?= $quiz['id'] ?>" class="btn btn-success">Start Quiz</a>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

</body>
</html>
