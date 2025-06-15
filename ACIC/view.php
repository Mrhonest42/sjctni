<!-- index.php -->
<?php 
session_start();
if (!isset($_SESSION['mobno'])) {
    header("Location: index.php");
    exit();
}
include 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Purchase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4 text-center">Purchase Summary</h2>

    <?php
    if (isset($_POST['selectedItems']) && isset($_POST['totalAmount'])) {
        $items = json_decode($_POST['selectedItems'], true);
        $totalAmount = htmlspecialchars($_POST['totalAmount']);
        $mobno = $_SESSION['mobno']; // Retrieved from session

        $instruments = [];
        $counts = [];
        $amounts = [];

        foreach ($items as $item) {
            $instruments[] = htmlspecialchars($item['instrument']);
            $counts[] = htmlspecialchars($item['count']);
            $amounts[] = htmlspecialchars($item['amount']);
        }

        // Show the table
        echo '<table class="table table-bordered table-striped" style="font-size: 15px;">';
        echo '<thead class="table-dark">
                <tr>
                    <th>Mobile Number</th>
                    <th>Instruments</th>
                    <th>Counts</th>
                    <th>Amounts (₹)</th>
                    <th>Total (₹)</th>
                    <th>Action</th>
                </tr>
              </thead>';
        echo '<tbody>';
        echo '<tr>
                <td>' . htmlspecialchars($mobno) . '</td>
                <td>' . implode(', ', $instruments) . '</td>
                <td>' . implode(', ', $counts) . '</td>
                <td>' . implode(', ', $amounts) . '</td>
                <td>₹' . $totalAmount . '</td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="finalPay" value="1">
                        <input type="hidden" name="mobno" value="' . htmlspecialchars($mobno) . '">
                        <input type="hidden" name="instruments" value="' . implode(', ', $instruments) . '">
                        <input type="hidden" name="counts" value="' . implode(', ', $counts) . '">
                        <input type="hidden" name="amounts" value="' . implode(', ', $amounts) . '">
                        <input type="hidden" name="total" value="' . $totalAmount . '">
                        <button type="submit" class="btn btn-success w-75 p-2 fs-5">Pay</button>
                    </form>
                </td>
              </tr>';
        echo '</tbody></table>';
    }

    // Handle Pay button submission
    if (isset($_POST['finalPay'])) {
        $purchase_id = strtoupper(substr(md5(uniqid(date('YmdHis'), true)), 0, 10));
        $mobno = htmlspecialchars($_POST['mobno']);
        $instruments = htmlspecialchars($_POST['instruments']);
        $counts = htmlspecialchars($_POST['counts']);
        $amounts = htmlspecialchars($_POST['amounts']);
        $total = htmlspecialchars($_POST['total']);
        $datetime = date('YmdHis');

        $conn = new mysqli("localhost", "root", "", "college");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO instruments (purchase_id, mobile, instruments, counts, amounts, total, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $purchase_id, $mobno, $instruments, $counts, $amounts, $total, $datetime);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        echo "<script>
            Swal.fire({
            icon: 'success',
            title: 'Payment Successful!',
            html: `<strong>Purchase ID:</strong> $purchase_id<br>
                <strong>Mobile:</strong> $mobno<br>
                <strong>Items:</strong> $instruments<br>
                <strong>Total:</strong> ₹$total`,
            confirmButtonText: 'Done'
        }).then(() => {
            window.location.href = 'index.php';
        });
        </script>";
    }
    ?>
</div>
</body>
</html>
