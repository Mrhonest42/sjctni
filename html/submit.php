<?php
$conn = new mysqli("localhost", "root", "", "database_name");

if($conn->connect_error){
    die("Connection failed:" . $conn->connect_error);
}

$name = $_POST['name'];
$dob = $_POST['dob'];
$place = $_POST['place'];
$priestPlace = $_POST['priestPlace'];
$casteName = $_POST['casteName'];
$caste = $_POST['caste'];
$orphan = $_POST['orphan'];
$semiOrphan = $_POST['semiOrphan'];
$image = $_POST['image'];
$fm1 = $_POST['fm1'];
$fm1Occupation = $_POST['fm1-occupation'];
$fm1Income = $_POST['fm1-income'];
$fm2 = $_POST['fm2'];
$fm2Occupation = $_POST['fm2-occupation'];
$fm2Income = $_POST['fm2-income'];
$s1 = $_POST['s1'];
$s1Study = $_POST['s1-study'];
$s1Year = $_POST['s1-year'];
$s2 = $_POST['s2'];
$s2Study = $_POST['s2-study'];
$s2Year = $_POST['s2-year'];
$s3 = $_POST['s3'];
$s3Study = $_POST['s3-study'];
$s3Year = $_POST['s3-year'];
$address = $_POST['address'];
$district = $_POST['district'];
$phoneNo = $_POST['phoneNo'];
$schoolCollege = $_POST['school-college'];
$schoolCollegeAddress = $_POST['school-college-address'];
$subject = $_POST['subject'];
$years = $_POST['years'];
$currentYear = $_POST['current-year'];

if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
    $targetDir = "uploads/";
    $imagePath = $targetDir . basename($_FILES["image"]["name"]);

    move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
}

$sql = "INSERT INTO STUDENTS
    (name, dob,place,priestPlace,casteName, caste, orphan, semiOrphan, image, fm1,fm1Occupation, fm1Income, fm2, fm2Occupation, fm2Income, s1, s1Study, s1Year, s2, s2Study, s2Year, s3, s3Study, s3Year, address, district, phoneNo, schoolCollege, schoolCollegeAddress, subject, years, currentYear)
    VALUES
    (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssssississississississsii", $name, $dob,$place,$priestPlace,$casteName, $caste, $orphan, $semiOrphan, $image, $fm1,$fm1Occupation, $fm1Income, $fm2, $fm2Occupation, $fm2Income, $s1, $s1Study, $s1Year, $s2, $s2Study, $s2Year, $s3, $s3Study, $s3Year, $address, $district, $phoneNo, $schoolCollege, $schoolCollegeAddress, $subject, $years, $currentYear);

if($stmt->execute()){
    echo "Data saved successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>