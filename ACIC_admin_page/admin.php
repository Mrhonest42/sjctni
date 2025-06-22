<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Admin Page</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="js/jquery.min.js"></script> 
    <script src="js/bootstrap.min.js"></script> 
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src='main.js'></script>
    <style>
        body{
            width: 100vw;
            height: 100vh;
            padding:0;
            margin:0;
            background-color:#74b9ff;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container{
            box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
        }
        .form-group{
            display:flex;
            flex-direction:column;
            margin: 10px auto;
        }
        input{
            outline:none;
            border: 1px solid #ccc;
        }
        select{
            padding: 6px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <div class="container w-50 bg-light p-5">
        <form action="#" method="POST">
        <div class="heading mb-5">
            <h1 class="fw-bold text-center">Register Here For New Event</h1>
        </div>
        <div class="d-flex gap-4">
        <div class="form-group fs-4 w-100">
            <label for="title fw-light">Title</label>
            <input type="text" name="title" id="title" class="title p-2" required>
        </div>
        <div class="form-group fs-4 w-100">
            <label for="uname fw-light">Name</label>
            <input type="text" name="uname" id="uname" class="uname p-2" required>
        </div>
        <div class="form-group fs-4 w-100">
            <label for="mobno">Mobile Number</label>
            <input type="text" name="mobno" id="mobno" class="mobno p-2" required>
        </div>
        </div>
        <div class="d-flex justify-content-center gap-4">
            <div class="d-flex flex-column justify-content-center w-100">
                <div class="form-group fs-4 w-100">
                    <label for="department">Department</label>
                    <select name="department" id="department" class="bg-light">
                        <option value="Tamil">Tamil</option>
                        <option value="English">English</option>
                        <option value="Mathemtics">Mathemtics</option>
                        <option value="Physics">Physics</option>
                        <option value="Chemistry">Chemistry</option>
                        <option value="Botany">Botany</option>
                        <option value="Computer Science">Computer Science</option>
                        <option value="Commerce">Commerce</option>
                        <option value="Histry">Histry</option>
                        <option value="Economics">Economics</option>
                        <option value="Visual Communication">Visual Communication</option>
                        <option value="Electronics">Electronics</option>
                    </select>
                </div>
                <div class="form-group fs-4 w-100">
                    <label for="class">Classification</label>
                    <select name="class" id="class" class="class px-3 py-2 bg-light" required>
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
            <div class="d-flex flex-column justify-content-center w-100">
                <div class="form-group fs-4 w-100">
            <label for="startdate">Starting Date</label>
            <input type="date" name="startdate" id="startdate" class="startdate p-2" required>
        </div>
        <div class="form-group fs-4 w-100">
            <label for="enddate">Ending Date</label>
            <input type="date" name="enddate" id="enddate" class="enddate p-2" required>
        </div>
            </div>
            <div class="d-flex flex-column justify-content-center w-100">
                <div class="form-group fs-4 w-100">
                    <label for="starttime fw-light">Starting Time</label>
                    <input type="time" name="starttime" id="starttime" class="starttime p-2" required>
                </div>
                <div class="form-group fs-4 w-100">
                    <label for="endingtime">Ending Time</label>
                    <input type="time" name="endingtime" id="endingtime" class="mobno p-2" required>
                </div>
            </div>
        </div>



        <div class="d-flex gap-4">
            <div class="form-group fs-4 w-50">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="email p-2" required>
            </div>
        <div class="form-group fs-4 w-100">
            <label for="text">Instition Name</label>
            <input type="text" name="text" id="text" class="text p-2" required>
        </div>
        </div>
        <div class="d-flex gap-4">
        <div class="form-group fs-4 w-75">
            <label for="city">City</label>
            <input type="text" name="city" id="city" class="city p-2" required>
        </div>
        <div class="form-group fs-4 w-75">
            <label for="state">State</label>
            <input type="text" name="state" id="state" class="state p-2" required>
        </div>
        </div>
        <div class="form-group w-50">
            <input type="submit" value="Submit" class="submit btn btn-primary p-3 fs-4" id="submit">
        </div>
        </form>
    </div>
</body>
</html>