<?php 
session_start();
include 'header.php';

$mobno = $_GET['mobno'] ?? $_SESSION['mobno'] ?? $_POST['mobno'] ?? '';
$_SESSION['mobno'] = $mobno; // Store it for reuse
$name = $_SESSION['name'] ?? '';

if (empty($mobno)) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Purchase History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4 text-center">Purchase History for <span class="text-primary"><?= htmlspecialchars($mobno) ?></span></h2>

    <div class="d-flex justify-content-end align-items-center gap-3 mb-5">
        <form action="payment.php" method="post">
            <input type="hidden" name="mobno" value="<?= htmlspecialchars($mobno) ?>">
            <input type="hidden" name="name" value="<?= htmlspecialchars($name) ?>">
            <button type="submit" class="border p-3 rounded-3 btn-secondary fs-4 text-white">+ New Purchase</button>
        </form>
        <button class="border p-3 rounded-3 btn-danger fs-4 text-white" onclick="logout()">Logout</button>
    </div>

    <?php
    $conn = new mysqli("localhost", "root", "", "college");
    if ($conn->connect_error) {
        die("<p class='text-danger'>Connection failed: " . $conn->connect_error . "</p>");
    }

    $stmt = $conn->prepare("SELECT purchase_id, mobile, instruments, quantity, amounts, total, created_at FROM instruments WHERE mobile = ?");
    $stmt->bind_param("s", $mobno);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<table class="table table-bordered table-striped" style="font-size: 15px;">';
        echo '<thead class="table-dark">
                <tr>  
                    <th>Purchase ID</th>
                    <th>Mobile Number</th>
                    <th>Instrument</th>
                    <th>Quantity</th>
                    <th>Amount (₹)</th>
                    <th>Total (₹)</th>
                    <th>Purchased On</th>
                    <th>Payment Status</th>
                </tr>
              </thead><tbody>';

        while ($row = $result->fetch_assoc()) {
            $purchase_id = htmlspecialchars($row['purchase_id']);
            $mobile = htmlspecialchars($row['mobile']);
            $instruments = explode(',', $row['instruments']);
            $quantity = explode(',', $row['quantity']);
            $amounts = explode(',', $row['amounts']);
            $total = htmlspecialchars($row['total']);
            $created_at_raw = $row['created_at'];
            $created_at = date('d/m/Y', strtotime($created_at_raw));

            $payment_status = "Paid"; // Assuming all records are paid since they made it to the DB
            $maxRows = max(count($instruments), count($quantity), count($amounts));

            for ($i = 0; $i < $maxRows; $i++) {
                echo '<tr>';
                echo $i === 0 ? "<td rowspan='$maxRows' class='align-middle'>$purchase_id</td>" : '';
                echo $i === 0 ? "<td rowspan='$maxRows' class='align-middle'>$mobile</td>" : '';
                echo "<td>" . htmlspecialchars(trim($instruments[$i] ?? '')) . "</td>";
                echo "<td>" . htmlspecialchars(trim($quantity[$i] ?? '')) . "</td>";
                echo "<td>₹" . htmlspecialchars(trim($amounts[$i] ?? '')) . "</td>";
                echo $i === 0 ? "<td rowspan='$maxRows' class='align-middle'>₹$total</td>" : '';
                echo $i === 0 ? "<td rowspan='$maxRows' class='align-middle'>$created_at</td>" : '';
                echo $i === 0 ? "<td rowspan='$maxRows' class='align-middle text-success'>$payment_status</td>" : '';
                echo '</tr>';
            }
        }

        echo '</tbody></table>';
    } else {
        echo "<p class='text-warning text-center fs-5'>No purchases found for <strong>$mobno</strong>.</p>";
    }

    $stmt->close();
    $conn->close();
    ?>
</div>
<script src="./js/logout.js"></script>
</body>
</html>
