<?php
session_start();

include("includes/db.php");

// Redirect if not logged in
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit();
}

// Handle quiz creation
if (isset($_POST["create_quiz"])) {
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $time_limit = (int) $_POST["time_limit"];

    $insertQuiz = "INSERT INTO quizzes (title, description, time_limit) VALUES ('$title', '$description', '$time_limit')";
    mysqli_query($conn, $insertQuiz);
}

// Handle question submission
if (isset($_POST["add_question"])) {
    $quiz_id = $_POST["quiz_id"];
    $question_text = mysqli_real_escape_string($conn, $_POST["question_text"]);
    $a = mysqli_real_escape_string($conn, $_POST["option_a"]);
    $b = mysqli_real_escape_string($conn, $_POST["option_b"]);
    $c = mysqli_real_escape_string($conn, $_POST["option_c"]);
    $d = mysqli_real_escape_string($conn, $_POST["option_d"]);
    $correct = $_POST["correct_option"];

    $insertQ = "INSERT INTO questions (quiz_id, question_text, option_a, option_b, option_c, option_d, correct_option)
                VALUES ('$quiz_id', '$question_text', '$a', '$b', '$c', '$d', '$correct')";
    mysqli_query($conn, $insertQ);
}

// Fetch all quizzes
$quizzes = mysqli_query($conn, "SELECT * FROM quizzes");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
  <h2 class="mb-4">Admin Dashboard</h2>
  <div class="mb-3">
    <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
  </div>

  <!-- Create Quiz Form -->
  <div class="card mb-4">
    <div class="card-header">Create New Quiz</div>
    <div class="card-body">
      <form method="POST">
        <div class="mb-3">
          <label class="form-label">Quiz Title</label>
          <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="2"></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Time Limit (in minutes)</label>
          <input type="number" name="time_limit" class="form-control" min="1" required>
        </div>
        <button type="submit" name="create_quiz" class="btn btn-primary">Create Quiz</button>
      </form>
    </div>
  </div>

  <!-- Add Question Form -->
  <div class="card mb-4">
    <div class="card-header">Add Question to Quiz</div>
    <div class="card-body">
      <form method="POST">
        <div class="mb-3">
          <label class="form-label">Select Quiz</label>
          <select name="quiz_id" class="form-select" required>
            <option value="">-- Select Quiz --</option>
            <?php while ($quiz = mysqli_fetch_assoc($quizzes)): ?>
              <option value="<?= $quiz['id'] ?>"><?= htmlspecialchars($quiz['title']) ?></option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Question</label>
          <textarea name="question_text" class="form-control" rows="2" required></textarea>
        </div>
        <div class="mb-3 row">
          <div class="col-md-6">
            <label class="form-label">Option A</label>
            <input type="text" name="option_a" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Option B</label>
            <input type="text" name="option_b" class="form-control" required>
          </div>
        </div>
        <div class="mb-3 row">
          <div class="col-md-6">
            <label class="form-label">Option C</label>
            <input type="text" name="option_c" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Option D</label>
            <input type="text" name="option_d" class="form-control" required>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Correct Option</label>
          <select name="correct_option" class="form-select" required>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
          </select>
        </div>
        <button type="submit" name="add_question" class="btn btn-success">Add Question</button>
      </form>
    </div>
  </div>
</div>
<!-- Result Board -->
<div class="card mt-5">
  <div class="card-header">Result Board</div>
  <div class="card-body">
    <form method="GET">
      <label>Select Quiz</label>
      <select name="quiz_result_id" class="form-select mb-3" onchange="this.form.submit()">
        <option value="">-- Select Quiz --</option>
        <?php
        $qz = mysqli_query($conn, "SELECT * FROM quizzes");
        while($q = mysqli_fetch_assoc($qz)) {
          $selected = (isset($_GET['quiz_result_id']) && $_GET['quiz_result_id'] == $q['id']) ? 'selected' : '';
          echo "<option value='{$q['id']}' $selected>{$q['title']}</option>";
        }
        ?>
      </select>
    </form>

    <?php
    if (isset($_GET['quiz_result_id'])) {
      $quizId = $_GET['quiz_result_id'];

      $resQuery = "SELECT r.*, s.name, s.reg_no, s.department FROM results r 
                   JOIN students s ON r.student_id = s.id 
                   WHERE r.quiz_id = $quizId ORDER BY r.percentage DESC";

      $resResult = mysqli_query($conn, $resQuery);
    ?>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Name</th>
            <th>Register No</th>
            <th>Department</th>
            <th>Max Marks</th>
            <th>Marks Scored</th>
            <th>Unanswered</th>
            <th>Wrong</th>
            <th>Percentage</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_assoc($resResult)): ?>
          <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['reg_no']) ?></td>
            <td><?= htmlspecialchars($row['department']) ?></td>
            <td><?= $row['total'] ?></td>
            <td><?= $row['score'] ?></td>
            <td><?= $row['unanswered'] ?></td>
            <td><?= $row['wrong'] ?></td>
            <td><?= $row['percentage'] ?>%</td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php } ?>
  </div>
</div>
</body>
</html>