<!-- payment.php -->
<?php 
session_start();
include 'header.php'; 

$catg = $_SESSION['category'];
$mobno = $_SESSION['txt_src_mobile']; // <- consistent key
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <link rel="shortcut icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQDMlFnUBR5ALVnUcyIKMSO8ceM0v9VhokODSoY_GbHj2LRLkuMQV0oqj7CQCOKYa6WXFM&usqp=CAU" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./js/logout.js"></script>
    <style>
        .hidden { display: none; }
        td { padding: 1% 2%; vertical-align: middle; }
        table { table-layout: fixed; width: 100%; }
        td:first-child { width: 60%; }
        td:nth-child(2), td:nth-child(3) { width: 20%; }
        td input[type="number"] {
            width: 100%;
            padding: 2%;
            box-sizing: border-box;
        }
        td input[type="checkbox"] {
            margin-right: 6px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="container">
        <p class="h3">
            The Following tariff will be followed for the usages of instruments at the instrumentation center (ACIC) for the scholars from St. Joseph's College and other colleges with effect from 01-01-2023
        </p>
    </div>

    <div class="container mt-5">
        <div class="d-flex justify-content-end align-items-center gap-3">
            <button class="border p-3 rounded-3 btn-secondary fs-4 text-white" onclick="visitHistory()">Purchase History</button>
            <button class="border p-3 rounded-3 btn-primary fs-4 text-white">Name: <?php echo htmlspecialchars($username); ?></button>
            <button class="border p-3 rounded-3 btn-success fs-4 text-white">Mobile: <?php echo htmlspecialchars($mobno); ?></button>
            <button class="border p-3 rounded-3 btn-danger fs-4 text-white" onclick="logout()">Logout</button>
        </div>

        <form id="submitForm" method="POST">
            <!-- SJC table -->
            <!-- Check the user whether SJC or Outside. If outside, then class hidden will apply and then hide it to the user -->
            <table class="border bordered <?php echo $catg == 'SJC' ? '' : 'hidden'; ?>">
                <thead>
                    <tr><td class="h4" colspan="3">St. Joseph’s College Student/Staff/Scholar (Per sample)</td></tr>
                </thead>
                <tbody style="font-size: 12px;">
                <?php

                //Creating Array to display items as a table
                $instruments = [
                    ["FTIR", 75],
                    ["UV-Visible", 75],
                    ["Mht", 75],
                    ["Ia-Cv", 200],
                    ["lcrz", 75],
                    ["HPLC", 500],
                    ["Preparative", 750],
                    ["Fluorescence-spectrometer", 75],
                    ["SEM", 400],
                    ["particle-size-Analyzer", 100]
                ];

                //Initializing with 1
                $i = 1;

                //Creating table row for each item
                foreach ($instruments as $instrument) {
                    echo "<tr>
                        <td class='border bordered'><label><input type='checkbox' name='{$instrument[0]}'> {$instrument[0]} ₹{$instrument[1]}/-</label></td>
                        <td class='border bordered'><input type='number' name='{$instrument[0]}-count' onchange='calculateAmount(this)' disabled></td>
                        <td class='border bordered'><input type='number' name='amount{$i}' disabled></td>
                    </tr>";
                    $i++;
                }
                ?>
                <tr><td colspan="3" class="text-end"><button class="btn btn-success fs-5 p-3 w-25" name="total">Proceed</button></td></tr>
                </tbody>
            </table>

            <!-- Outside SJC table -->
             <!-- Check the user whether SJC or Outside. If SJC, then class hidden will apply and then hide it to the user -->
            <table class="border bordered <?php echo $catg == 'Outside SJC' ? '' : 'hidden'; ?>">
                <thead>
                    <tr><td class="h4" colspan="3">Outside College Student/Staff/Scholar (Per sample)</td></tr>
                </thead>
                <tbody style="font-size: 12px;">
                <?php
                $outsideInstruments = [
                    ["FTIR", 100],
                    ["UV-Visible", 100],
                    ["Mht", 100],
                    ["Ia-Cv", 300],
                    ["lcrz", 100],
                    ["HPLC", 700],
                    ["Preparative", 1000],
                    ["Fluorescence-spectrometer", 100],
                    ["SEM", 600],
                    ["particle-size-Analyzer", 150]
                ];
                $i = 1;
                foreach ($outsideInstruments as $instrument) {
                    echo "<tr>
                        <td class='border bordered'><label><input type='checkbox' name='{$instrument[0]}'> {$instrument[0]} ₹{$instrument[1]}/-</label></td>
                        <td class='border bordered'><input type='number' name='{$instrument[0]}-count' onchange='calculateAmount(this)' disabled></td>
                        <td class='border bordered'><input type='number' name='amount{$i}' disabled></td>
                    </tr>";
                    $i++;
                }
                ?>
                <tr><td colspan="3" class="text-end"><button class="btn btn-success fs-5 p-3 w-25" name="total">Proceed</button></td></tr>
                </tbody>
            </table>
        </form>
    </div>
</div>

<script>
const ratesSJC = {
    "FTIR-count": 75,
    "UV-Visible-count": 75,
    "Mht-count": 75,
    "Ia-Cv-count": 200,
    "lcrz-count": 75,
    "HPLC-count": 500,
    "Preparative-count": 750,
    "Fluorescence-spectrometer-count": 75,
    "SEM-count": 400,
    "particle-size-Analyzer-count": 100
};

const ratesOutside = {
    "FTIR-count": 100,
    "UV-Visible-count": 100,
    "Mht-count": 100,
    "Ia-Cv-count": 300,
    "lcrz-count": 100,
    "HPLC-count": 700,
    "Preparative-count": 1000,
    "Fluorescence-spectrometer-count": 100,
    "SEM-count": 600,
    "particle-size-Analyzer-count": 150
};

function calculateAmount(input) {
    const name = input.name;
    const count = parseInt(input.value) || 0;
    const visibleTable = document.querySelector("table:not(.hidden)"); 
    // Avoid getting hidden tables
    const isSJC = visibleTable.textContent.includes("St. Joseph’s College");
    const rates = isSJC ? ratesSJC : ratesOutside;

    if (name in rates) {
        const price = rates[name];
        const row = input.closest("tr");
        //Seleting closeset ancestor of input
        const amountInput = row.querySelector('input[name^="amount"]');
        //Seleting an input element which has name attribute that starts with 'amount'
        amountInput.value = count * price;
    }
}

function calculateTotal() {
    let total = 0;
    const visibleTable = document.querySelector("table:not(.hidden)");//Selecting the visible table
    const amountInputs = visibleTable.querySelectorAll('input[name^="amount"]'); //Selecting all the input elements having name sttribute which starts with 'amount'
    amountInputs.forEach(input => {
        total += parseInt(input.value) || 0;
        //For all the input values converted to int and added to total
    });

    if (total === 0) {
        alert("You haven't selected any item.");
        //Preventing the user entering to confirmation page without buying anything
        return;
    }

    const checkedRows = Array.from(document.querySelectorAll('input[type="checkbox"]:checked')).map(checkbox => {
        const row = checkbox.closest("tr");
        const instrument = row.querySelector("td:first-child label").innerText.split(" ₹")[0].trim();
        const count = parseInt(row.querySelector('input[name$="-count"]').value) || 0;
        const amount = parseInt(row.querySelector('input[name^="amount"]').value) || 0;

        return { instrument, count, amount };
    });

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'confirmation.php';

    const itemsInput = document.createElement('input');
    itemsInput.type = 'hidden';
    itemsInput.name = 'selectedItems';
    itemsInput.value = JSON.stringify(checkedRows);
    form.appendChild(itemsInput);

    const usernameInput = document.createElement('input');
    usernameInput.type = 'hidden';
    usernameInput.name = 'username';
    usernameInput.value = <?php echo json_encode($username); ?>;
    form.appendChild(usernameInput);

    const mobnoInput = document.createElement('input');
    mobnoInput.type = 'hidden';
    mobnoInput.name = 'mobno';
    mobnoInput.value = <?php echo json_encode($mobno); ?>;
    form.appendChild(mobnoInput);

    document.body.appendChild(form);
    form.submit();
}

function toggleRowInputs(checkbox) {
    const row = checkbox.closest("tr");
    const inputs = row.querySelectorAll("input[type='number']");
    
    // Only enable/disable the second input (count), not the third (amount)
    const countInput = inputs[0];  // second column
    const amountInput = inputs[1]; // third column

    countInput.disabled = !checkbox.checked;

    if (!checkbox.checked) {
        countInput.value = "";
        amountInput.value = ""; // clear amount when unchecking
    }
}


document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll("input[type='checkbox']");
    checkboxes.forEach(checkbox => {
        toggleRowInputs(checkbox);
        checkbox.addEventListener("change", () => toggleRowInputs(checkbox));
    });

    const totalButtons = document.querySelectorAll('button[name="total"]');
    totalButtons.forEach(btn => btn.addEventListener("click", (e)=>{
        e.preventDefault();
        calculateTotal();
    }));
});

    function visitHistory() {
        const mobno = <?= json_encode($mobno) ?>;
        window.location.href = `view.php?mobno=${encodeURIComponent(mobno)}`;
    }
</script>
<script src="./js/visitHistory.js"></script>
</body>
</html>
