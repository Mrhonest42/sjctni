<!-- confirmation.php -->
<?php 
session_start();
include 'header.php'; 

// Handle Pay button POST
if (isset($_POST['finalPay'])) {
    $mobno = $_SESSION['mobno'];
    $items = json_decode($_POST['selectedItems'], true);
    $total = $_POST['totalAmount'];

    $instruments = [];
    $counts = [];
    $amounts = [];

    foreach ($items as $item) {
        $instruments[] = addslashes($item['instrument']);
        $counts[] = addslashes($item['count']);
        $amounts[] = addslashes($item['amount']);
    }

    $purchase_id = "acic" . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    $instruments_str = implode(', ', $instruments);
    $counts_str = implode(', ', $counts);
    $amounts_str = implode(', ', $amounts);
    $datetime = date('YmdHis');

    $conn = new mysqli("localhost", "root", "", "college");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO instruments (purchase_id, mobile, instruments, quantity, amounts, total, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $purchase_id, $mobno, $instruments_str, $counts_str, $amounts_str, $total, $datetime);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Payment Successful!',
        html: `<strong>Purchase ID:</strong> $purchase_id<br>
               <strong>Mobile:</strong> $mobno<br>
               <strong>Items:</strong> $instruments_str<br>
               <strong>Total:</strong> ₹$total`,
        showDenyButton: true,
        confirmButtonText: 'Done',
        denyButtonText: 'Purchase History',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'index.php';
        } else if (result.isDenied) {
            window.location.href = 'view.php';
        }
    });
    </script>";

    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Confirmation Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
</head>
<body class="bg-light">
<div class="container mt-5">
    <?php
    $username = $_POST['username'] ?? '';
    $mobno = $_POST['mobno'] ?? '';
    $_SESSION['mobno'] = $mobno; // Store in session
    $grandTotal = 0;
    $items = [];

    echo '<div class="d-flex justify-content-end align-items-center gap-3 mb-5">
        <button class="border p-3 rounded-3 btn-secondary fs-4 text-white" onclick="visitHistory()">Purchase History</button>
        <button class="border p-3 rounded-3 btn-primary fs-4">Name: ' . htmlspecialchars($username) . '</button>
        <button class="border p-3 rounded-3 btn-success text-light fs-4">Mobile: ' . htmlspecialchars($mobno) . '</button>
        <button class="border p-3 rounded-3 btn-danger fs-4 text-white" onclick="logout()" id="logoutBtn">Logout</button>
    </div>';

    if (isset($_POST['selectedItems'])) {
        $items = json_decode($_POST['selectedItems'], true);

        if (!empty($items)) {
            echo '<h2 class="mb-4 text-center">Confirmed Instrument Details</h2>';
            echo '<table class="table table-bordered table-striped" style="font-size: 14px;">';
            echo '<thead class="table-dark"><tr><th>S.No</th><th>Instrument</th><th>Count</th><th>Amount (₹)</th></tr></thead><tbody>';

            $serial = 1;
            foreach ($items as $index => $item) {
                $instrument = htmlspecialchars($item['instrument']);
                $count = htmlspecialchars($item['count']);
                $amount = htmlspecialchars($item['amount']);
                $grandTotal += $amount;

                echo "<tr data-index='$index'>
                        <td>$serial</td>
                        <td><input type='checkbox' class='toggle-check' data-index='$index' checked> $instrument</td>
                        <td class='count' id='count-$index'>$count</td>
                        <td class='amount' id='amount-$index' data-amount='$amount'>₹$amount</td>
                      </tr>";
                $serial++;
            }

            echo "<tr class='fw-bold table-secondary'>
                    <td colspan='3' class='text-end'>Total</td>
                    <td id='total-cell'>₹$grandTotal</td>
                  </tr>";

            echo '</tbody></table>';
            echo "<div class='d-flex justify-content-between'>
                    <button class='btn btn-primary fs-4 w-25 py-2' onclick='goBack()'><span class='fs-3 fw-bold'>&lt;</span> Back</button> 
                    <button class='btn btn-success fs-4 py-2 w-25' onclick='proceed()'>Pay</button>
                  </div>";
        } else {
            echo "<p class='text-danger'>No items selected.</p>";
        }
    } else {
        echo "<p class='text-danger'>No data received.</p>";
    }
    ?>
</div>

<!-- Final Pay Form (hidden, POST to same page) -->
<form id="payForm" method="POST" action="confirmation.php" style="display: none;">
    <input type="hidden" name="finalPay" value="1">
    <input type="hidden" name="selectedItems" id="selectedItemsInput">
    <input type="hidden" name="totalAmount" id="totalAmountInput">
</form>

<script>
    let total = <?= $grandTotal ?>;
    const selectedItems = <?= json_encode($items) ?>;

    function visitHistory() {
        const mobno = <?= json_encode($mobno) ?>;
        window.location.href = `view.php?mobno=${encodeURIComponent(mobno)}`;
    }

    function goBack() {
        window.history.back();
    }

    function logout(){
        window.location.href = 'index.php';
    }

    function proceed() {
        const checkedIndices = Array.from(document.querySelectorAll('.toggle-check'))
            .map((el, i) => el.checked ? i : null)
            .filter(i => i !== null);

        const filteredItems = selectedItems.filter((_, i) => checkedIndices.includes(i));

        document.getElementById('selectedItemsInput').value = JSON.stringify(filteredItems);
        document.getElementById('totalAmountInput').value = total;

        document.getElementById('payForm').submit();
    }

    document.querySelectorAll('.toggle-check').forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const index = this.dataset.index;
            const amountEl = document.getElementById('amount-' + index);
            const countEl = document.getElementById('count-' + index);
            const itemAmount = parseInt(amountEl.dataset.amount);

            if (this.checked) {
                amountEl.classList.remove('text-muted', 'text-decoration-line-through');
                countEl.classList.remove('text-muted', 'text-decoration-line-through');
                total += itemAmount;
            } else {
                amountEl.classList.add('text-muted', 'text-decoration-line-through');
                countEl.classList.add('text-muted', 'text-decoration-line-through');
                total -= itemAmount;
            }

            document.getElementById('total-cell').innerText = '₹' + total;
        });
    });
</script>
</body>
</html>
