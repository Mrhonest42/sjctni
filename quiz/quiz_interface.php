<?php
session_start();
include("includes/db.php");

// Redirect if student not logged in
if (!isset($_SESSION['student_id'])) {
    header("Location: index.php");
    exit();
}

// Fetch all quizzes
$quizQuery = "SELECT * FROM quizzes";
$quizResult = mysqli_query($conn, $quizQuery);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Quiz Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .profile-icon {
      width: 35px;
      height: 35px;
      border-radius: 50%;
      background-color: #0d6efd;
      color: white;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      margin-right: 10px;
    }
  </style>
</head>
<body class="bg-light">

<div class="container py-3">
  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex align-items-center">
      <div class="profile-icon"><?= strtoupper(substr($_SESSION['student_name'], 0, 1)) ?></div>
      <span class="fw-bold"><?= htmlspecialchars($_SESSION['student_name']) ?></span>
    </div>
    <div>
      <button class="btn btn-danger btn-sm" id="logout">logout</button>
    </div>
  </div>

  <h3 class="mb-3">Available Quizzes</h3>

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

<script>
  document.getElementById("logout").addEventListener('click', ()=>{
    window.location.href="index.php";
  })
</script>
</body>
</html>