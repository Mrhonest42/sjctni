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
            margin: 15px auto;
            gap:10px;
        }
        input[type="text"]{
            outline:none;
        }
    </style>
</head>
<body>
    <div class="container w-50 bg-light p-5">
        <form action="#" method="POST">
        <div class="heading">
            <h1 class="fw-bold text-center">Register Here For New Event</h1>
        </div>
        <div class="form-group fs-3 w-75">
            <label for="title fw-light">Title</label>
            <input type="text" name="title" id="title" class="title p-2" required>
        </div>
        <div class="form-group fs-3 w-75">
            <label for="datetime">Date and Time</label>
            <input type="datetime" name="datetime" id="datetime" class="datetime p-2" required>
        </div>
        <div class="form-group fs-3 w-75">
            <label for="department">Department</label>
            <select name="department" id="department" class="p-3 bg-light border border-secondary">
                <option value="Tamil">Tamil</option>
                <option value="English">English</option>
                <option value="Mathemtics">Mathemtics</option>
                <option value="Physics">Physics</option>
                <option value="Chemistry">Chemistry</option>
                <option value="Botany">Botany</option>
                <option value="Computer Science">Computer Science</option>
                <option value="Commerce">Commerce</option>
                <option value="Histry">Histry</option>
                <option value="Economics">Ecnomics</option>
                <option value="Visual Communication">Visual Communication</option>
                <option value="Electronics">Electronics</option>
            </select>
        </div>
        <div class="form-group w-75">
            <input type="submit" value="Submit" class="submit btn btn-primary p-3 fs-4" id="submit">
        </div>
        </form>
    </div>
</body>
</html>