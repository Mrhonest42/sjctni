<?php include 'header.php';?>
<script>
	// validates text only
	function Validate(txt) {
		txt.value = txt.value.replace(/[^a-zA-Z- '\n\r.]+/g, '');
	}
	
	// validates text only
	function Validate_name(txt) {
		txt.value = txt.value.replace(/[^a-zA-Z- (\)\'\n\r.]+/g, '');
	}
	
	// validates text only
	function Validate1(txt) {
		txt.value = txt.value.replace(/[^a-zA-Z0-9\n\r.]+/g, '');
	}
	
	function validatephone(phone) 
	{
		
		var maintainplus = '';
		var numval = phone.value
		if ( numval.charAt(0)=='+' )
		{
			var maintainplus = '';
		}
		curphonevar = numval.replace(/[\\A-Za-z!"£$%^&\,*+_={};:'@#~,.Š\/<>?|`¬\]\[]/g,'');
		phone.value = maintainplus + curphonevar;
		var maintainplus = '';
		phone.focus;
	}
	
	// validate email
	function email_validate(email)
	{
		//var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;
		//if(regMail.test(emailid) == false)
		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(instructionForm.emailid.value))
		{
			document.getElementById("status").innerHTML	= "<span class='valid'><font color=red>Thanks, you have entered a valid Email address!</font></span>";	
		}
		else
		{
			document.getElementById("status").innerHTML    = "<span class='warning'><font color=red>Email address is not valid yet.</font></span>";
		}
	}
	function valid1()
	{
		if(document.getElementById("txt_src_mobile").value != "")
		{
			if(document.getElementById("txt_src_mobile").value.length != 10)
			{
				swal("Please enter the 10 digit mobile no!");
				document.getElementById("txt_src_mobile").value = "";
				document.getElementById("txt_src_mobile").focus();
				return false;
			}
		}
	}
	function valid2()
	{
		if(document.getElementById("txtmobile").value != "")
		{
			if(document.getElementById("txtmobile").value.length != 10)
			{
				swal("Please enter the 10 digit mobile no!");
				document.getElementById("txtmobile").value = "";
				document.getElementById("txtmobile").focus();
				return false;
			}
		}
	}
</script>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<!--<h2 style="color: red; text-align: center;">For Demo Purpose</h2>-->
			<div style="text-align: right; color: blue;"><a target="_blank" href="img/NXPWP_fdp.pdf" class="button123">Brochure</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="paid_status.php" class="button123">Paid Status</a></div>
		</div>
	</div>
	<div class="row" style="border-bottom: 1px solid #f1f1f1;">
		<div class="col-md-6">
			<!--<h4 style="color: red;">Registration Closed<br>Although the registration for the workshop is currently closed, if you have an interest in attending a similar workshop in the near future, please feel free to send an email to csdept@mail.sjctni.edu.</h4>-->
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
				<br><input class="btn btn-primary" type="submit" name="sub_reg_check" onclick="valid1();" value="Check & To Pay" />
			</div>
		</div>
	</div>
</div>
</form>

<br><hr style="border-bottom: 1px solid #f1f1f1;" /><br>

<div class="container">
	<div class="row" style="border-bottom: 1px solid #f1f1f1;">
		<div class="col-md-6">
			<h4 style="color: red;">Fresh Online Registration</h4>
		</div>
		<div class="col-md-6" style="text-align: right;">
			<span class="req"><small style="color: #150af3;">Fields marked with (<font color = red>*</font>) are mandatory</small></span>
		</div>
	</div>
</div>
<form action="reg_final.php" method="post" id="fileForm" autocomplete="off">
<div class="container" style="background-color: #d7defe;">
	<div class="row" style="padding-top: 10px;">
		<div class="col-md-4">
			<div class="form-group"> 	 
				<label for="firstname" style="color: #a52a2a;"><span class="req">* </span> Full Name (in Capital Letters)</label>
				<input class="form-control" type="text" name="txtfirstname" id = "txt" onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" maxlength="80" onkeyup = "Validate(this)" required /> 
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="lastname" style="color: #a52a2a;"><span class="req">* </span> Class / Designation: </label> 
				<select name="designVal" id="designVal" class="form-control" required="">
					<option value="">Select Designation</option>
					<option value="Associate Professor">Associate Professor</option>
					<option value="Assistant Professor">Assistant Professor</option>
					<option value="Guest Lecturer">Guest Lecturer</option>
					<option value="Research Scholar">Research Scholar</option>
					<option value="Professional">Professional</option>
					<option value="College Student">College Student</option>
				</select>  
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="fathername" style="color: #a52a2a;"><span class="req">* </span> Institution / University: </label> 
				<input class="form-control" type="text" name="txtcollegename" id = "txt" onkeyup = "Validate_name(this)" required />  
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label for="fathername" style="color: #a52a2a;"><span class="req">* </span> City: </label> 
				<input class="form-control" type="text" name="txtcity" id = "txt" onkeyup = "Validate1(this)" required />  
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="fathername" style="color: #a52a2a;"><span class="req">* </span> State: </label> 
				<input class="form-control" type="text" name="txtstate" id = "txt" onkeyup = "Validate1(this)" required />  
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="mobile" style="color: #a52a2a;"><span class="req">* </span> WhatsApp Mobile No:</label> 
				<input class="form-control" type="text" name="txtmobile" id = "txtmobile" minlength="10" maxlength="10" onkeyup = "validatephone(this)" required />  
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label for="email" style="color: #a52a2a;"><span class="req">* </span> Email:</label> 
				<input type="email" class="form-control" name="emailid" id="emailid" placeholder="joseph@gmail.com" onkeyup = "email_validate(this)" required />
				<span id="status" class="confirmMessage"></span>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				
			</div>
		</div>
		<div class="col-md-4"><h4 style="color: #e1300d; font-weight: bold; text-align: right;">Registration Amount : ₹.300/-</h4></div>
		
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group" style="text-align: right;">
				<br><input class="btn btn-danger" type="submit" name="submit_reg" onclick="valid2();" value="Register & To Pay" />
			</div>
		</div>
	</div>
</div>
</form>


</body>
</html>