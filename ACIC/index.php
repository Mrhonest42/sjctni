<!-- index.php -->
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQDMlFnUBR5ALVnUcyIKMSO8ceM0v9VhokODSoY_GbHj2LRLkuMQV0oqj7CQCOKYa6WXFM&usqp=CAU" type="image/x-icon">
    <title>Registration Form</title>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <style>
        .container { padding: 20px; }
        label { font-weight: bold; }
        .req { color: red; }
    </style>
    <script>
        function validateAlphaOnly(txt) {
            txt.value = txt.value.replace(/[^a-zA-Z\s]/g, '');
        }

        function validateEmail(email) {
            const emailField = email.value;
            const status = document.getElementById("status");
            const regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if (regex.test(emailField)) {
                status.innerHTML = "<font color='green'>Valid Email</font>";
            } else {
                status.innerHTML = "<font color='red'>Invalid Email</font>";
            }
        }

        function validatePhoneLength(inputId) {
            const input = document.getElementById(inputId);
            if (input.value.length !== 10) {
                swal("Please enter a valid 10-digit phone number!");
                input.focus();
                return false;
            }
            return true;
        }

        function validateForm() {
            return validatePhoneLength('txtmobile');
        }
    </script>
    <style>
        input, label{
            font-size: 12px;
        }
    </style>
</head>
<body>

<div class="container">
	<div class="row" style="border-bottom: 1px solid #f1f1f1;">
		<div class="col-md-6">
			<h4 style="color: red;">Already Registered</h4>
		</div>
	</div>
</div>

<form action="reg_check.php" method="post" id="frmcheck" autocomplete="off">
<div class="container" style="background-color: #ffe2c0;">
	<div class="row" style="padding-top: 10px;">
		<div class="col-md-4">
			<div class="form-group">
				<label for="mobile" style="color: #a52a2a;"><span class="req">* </span> WhatsApp Mobile No:</label> 
				<input class="form-control" type="text" name="txt_src_mobile" id = "mobile" minlength="10" maxlength="10" onkeyup = "validatephone(this)" required />  
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="mobile" style="color: #a52a2a;"><span class="req">* </span> Email:</label> 
				<input type="email" class="form-control" name="txt_src_emailid" id="emailid" placeholder="joseph@gmail.com" onkeyup = "email_validate(this)" required />
				<span id="status" class="confirmMessage"></span>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group" style="text-align: center;">
				<br><input class="btn btn-primary w-25 p-3" style="font-weight: 600;" type="submit" name="sub_reg_check" onclick="valid1();" value="Check & To Pay" />
			</div>
		</div>
	</div>
</div>
</form>

<div class="container">
	<div class="row" style="border-bottom: 1px solid #f1f1f1;">
		<div class="col-md-6">
			<h4 style="color: red;">New Registration</h4>
		</div>
	</div>
</div>

<form action="reg_final.php" method="post" onsubmit="return validateForm();" autocomplete="off">

    <div class="container" style="background-color: #d7defe; border: 1px solid #ccc; font-size: 12px;">
        <p style="text-align: right;"><small><span class="req">*</span> Required fields</small></p>
        
        <div class="row">
            <div class="col-md-4 form-group">
                <label>Full Name <span class="req">*</span></label>
                <input type="text" name="txtfirstname" class="form-control" maxlength="80" required onkeyup="validateAlphaOnly(this)">
            </div>

            <div class="col-md-4 form-group">
                <label>Department <span class="req">*</span></label>
                <input type="text" name="txtdepartmentname" class="form-control" maxlength="80" required onkeyup="validateAlphaOnly(this)">
            </div>

            <div class="col-md-4 form-group">
                <label>Institution / University <span class="req">*</span></label>
                <input type="text" name="txtcollegename" class="form-control" maxlength="80" required onkeyup="validateAlphaOnly(this)">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 form-group">
                <label>Email <span class="req">*</span></label>
                <input type="email" name="emailid" id="emailid" class="form-control" required onkeyup="validateEmail(this)">
                <span id="status"></span>
            </div>

            <div class="col-md-4 form-group">
                <label>Phone No <span class="req">*</span></label>
                <input type="text" name="txtmobile" id="txtmobile" class="form-control" maxlength="10" minlength="10" required oninput="this.value=this.value.replace(/[^0-9]/g,'')">
            </div>

            <div class="col-md-4 form-group">
                <label>Purpose <span class="req">*</span></label>
                <input type="text" name="txtpurpose" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 form-group">
                <label>Category <span class="req">*</span></label>
                <select name="category" class="form-control" required>
                    <option value="SJC">SJC</option>
                    <option value="Outside SJC">Outside SJC</option>
                </select>
            </div>
        </div>

        <div class="form-group text-end">
            <button type="submit" name="submit_reg" class="btn btn-primary p-3" style="width: 10%; font-size: 14px;">Register</button>
        </div>
    </div>
</form>

</body>
</html>
