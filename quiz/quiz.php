<?php
session_start();
include("includes/db.php");

// Prevent browser back navigation cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Check if quiz_id is provided
if (!isset($_GET['quiz_id'])) {
    echo "Quiz not selected.";
    exit();
}

$quiz_id = $_GET['quiz_id'];

// Fetch quiz details
$quizQuery = mysqli_query($conn, "SELECT * FROM quizzes WHERE id = $quiz_id");
$quiz = mysqli_fetch_assoc($quizQuery);
$time_limit = (int)$quiz['time_limit'];

// Fetch questions
$questionQuery = mysqli_query($conn, "SELECT * FROM questions WHERE quiz_id = $quiz_id");
?>

<!DOCTYPE html>
<html>
<head>
  <title><?= htmlspecialchars($quiz['title']) ?> | Quiz</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .timer {
      font-size: 1.5rem;
      font-weight: bold;
      color: red;
    }
  </style>
</head>
<body class="bg-light">

<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3><?= htmlspecialchars($quiz['title']) ?></h3>
    <div class="timer" id="timer">Time Left: <?= $time_limit ?>:00</div>
  </div>

  <form method="POST" action="result.php" id="quizForm">
    <input type="hidden" name="quiz_id" value="<?= $quiz_id ?>">

    <?php $qNum = 1; while($q = mysqli_fetch_assoc($questionQuery)): ?>
      <div class="card mb-3">
        <div class="card-body">
          <p><strong>Q<?= $qNum++ ?>. <?= htmlspecialchars($q['question_text']) ?></strong></p>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="answers[<?= $q['id'] ?>]" value="A" id="q<?= $q['id'] ?>a">
            <label class="form-check-label" for="q<?= $q['id'] ?>a"><?= htmlspecialchars($q['option_a']) ?></label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="answers[<?= $q['id'] ?>]" value="B" id="q<?= $q['id'] ?>b">
            <label class="form-check-label" for="q<?= $q['id'] ?>b"><?= htmlspecialchars($q['option_b']) ?></label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="answers[<?= $q['id'] ?>]" value="C" id="q<?= $q['id'] ?>c">
            <label class="form-check-label" for="q<?= $q['id'] ?>c"><?= htmlspecialchars($q['option_c']) ?></label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="answers[<?= $q['id'] ?>]" value="D" id="q<?= $q['id'] ?>d">
            <label class="form-check-label" for="q<?= $q['id'] ?>d"><?= htmlspecialchars($q['option_d']) ?></label>
          </div>
        </div>
      </div>
    <?php endwhile; ?>

    <div class="text-center">
      <button type="submit" class="btn btn-primary px-5">Submit</button>
    </div>
  </form>
</div>

<!-- JS Timer and Navigation Protection -->
<script>
  // Timer Countdown
  let timeLeft = <?= $time_limit ?> * 60;
  const timerEl = document.getElementById("timer");

  const countdown = setInterval(() => {
    let minutes = Math.floor(timeLeft / 60);
    let seconds = timeLeft % 60;

    timerEl.textContent = `Time Left: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
    timeLeft--;

    if (timeLeft < 0) {
      clearInterval(countdown);
      alert("Time's up! Your answers will be submitted automatically.");
      document.getElementById("quizForm").submit();
    }
  }, 1000);

  // Disable back navigation
  history.pushState(null, null, location.href);
  window.onpopstate = function () {
    history.go(1);
  };
</script>

</body>
</html>