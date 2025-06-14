<<<<<<< HEAD
<?php 
session_start();
include 'header.php'; 
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

    echo '<div class="d-flex justify-content-end align-items-center gap-3">
        <h3 class="border p-3 rounded-3 bg-primary fs-4">Name: ' . htmlspecialchars($username) . '</h3>
        <h3 class="border p-3 rounded-3 bg-success text-light fs-4">Mobile: ' . htmlspecialchars($mobno) . '</h3>
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
                    <button class='btn btn-primary fs-4' onclick='goBack()'><span class='fs-3 fw-bold'>&lt;</span> Back</button> 
                    <button class='btn btn-success fs-4 px-3 py-2' onclick='proceed()'>Proceed <span class='fs-3 fw-bold'>&gt;</span></button>
                  </div>";
        } else {
            echo "<p class='text-danger'>No items selected.</p>";
        }
    } else {
        echo "<p class='text-danger'>No data received.</p>";
    }
    ?>
</div>

<!-- Hidden form to submit to view.php -->
<form id="viewForm" method="POST" action="view.php" style="display: none;">
    <input type="hidden" name="selectedItems" id="selectedItemsInput">
    <input type="hidden" name="totalAmount" id="totalAmountInput">
</form>

<script>
    let total = <?= $grandTotal ?>;
    const selectedItems = <?= json_encode($items) ?>;

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

    function goBack() {
        window.history.back();
    }

    function proceed() {
        const checkedIndices = Array.from(document.querySelectorAll('.toggle-check'))
            .map((el, i) => el.checked ? i : null)
            .filter(i => i !== null);

        const filteredItems = selectedItems.filter((_, i) => checkedIndices.includes(i));

        document.getElementById('selectedItemsInput').value = JSON.stringify(filteredItems);
        document.getElementById('totalAmountInput').value = total;

        document.getElementById('viewForm').submit();
    }
</script>
</body>
=======
<?php
include 'header.php'
?>
<!DOCTYPE html>
<html>
<head>
    <title>Confirmation Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4 text-center">Confirmed Instrument Details</h2>

    <?php
    if (isset($_POST['selectedItems'])) {
        $items = json_decode($_POST['selectedItems'], true);

        if (!empty($items)) {
            echo '<table class="table table-bordered table-striped">';
            echo '<thead class="table-dark"><tr><th>#</th><th>Instrument</th><th>Count</th><th>Amount (₹)</th></tr></thead><tbody>';

            $serial = 1;
            $grandTotal = 0;

            foreach ($items as $item) {
                $instrument = htmlspecialchars($item['instrument']);
                $count = htmlspecialchars($item['count']);
                $amount = htmlspecialchars($item['amount']);
                $grandTotal += $amount;

                echo "<tr>
                        <td>$serial</td>
                        <td>$instrument</td>
                        <td>$count</td>
                        <td>₹$amount</td>
                      </tr>";
                $serial++;
            }

            echo "<tr class='fw-bold table-secondary'>
                    <td colspan='3' class='text-end'>Total</td>
                    <td>₹$grandTotal</td>
                  </tr>";

            echo '</tbody></table>';
        } else {
            echo "<p class='text-danger'>No items selected.</p>";
        }
    } else {
        echo "<p class='text-danger'>No data received.</p>";
    }
    ?>
</div>
</body>
>>>>>>> ae071bb5bf2ae6a78c78c9e213496f9466f325a9
</html>