<?php
include("includes/db.php");

if (!isset($_POST['quiz_id']) || !isset($_POST['answers'])) {
    echo "Invalid access.";
    exit();
}

$quiz_id = $_POST['quiz_id'];
$submitted_answers = $_POST['answers'];

// Fetch all correct answers for this quiz
$query = "SELECT id, correct_option FROM questions WHERE quiz_id = $quiz_id";
$result = mysqli_query($conn, $query);

$total_questions = mysqli_num_rows($result);
$score = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $qid = $row['id'];
    $correct = $row['correct_option'];

    if (isset($submitted_answers[$qid]) && $submitted_answers[$qid] == $correct) {
        $score++;
    }
}

// OPTIONAL: Save result (if needed)
$name = "Anonymous"; // You can modify to collect name before quiz
mysqli_query($conn, "INSERT INTO results (quiz_id, user_name, score, total) VALUES ($quiz_id, '$name', $score, $total_questions)");
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