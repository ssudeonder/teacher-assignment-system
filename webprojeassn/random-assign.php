<?php require_once 'common.php';?>
<html>
<head>
<title>Clear</title>
<link rel="stylesheet" type="text/css" href="/style.css">
</head>
<body>
<div class="main">
<?php
$conn = new mysqli('127.0.0.1:3306', 'root', '', 'okul');
if ($conn->connect_error) {
    die("Unable to connect!");
}

function assign($schoolId, $teacherId)
{
    $conn = new mysqli('127.0.0.1:3306', 'root', '', 'okul');
    if ($conn->connect_error) {
        die("Unable to connect!");
    }
    $sql = "INSERT INTO assign (teacher_id, school_id) VALUES (".$teacherId.", ".$schoolId.");";
    if ($conn->query($sql) !== true) {
        die("Error!");
    }
    $conn->close();
}
//clear all assign
$sql = "DELETE FROM assign";
$conn->query($sql);

$teacherSql = "SELECT * FROM teacher";
$teacherResult = $conn->query($teacherSql);
$teachers = [
    "Physics" => [],
    "Math" => [],
    "Computer" => [],
    "History" => [],
    "Music" => [],
];
if ($teacherResult->num_rows < 0) {
    header("Location:assigns.php");
} else {
    while ($teacher = $teacherResult->fetch_assoc()) {
        $teachers[$teacher['section']][] =$teacher;
    }
}


$schoolSql = "SELECT * FROM school";
$schoolResult = $conn->query($schoolSql);
$schools = [];
if ($schoolResult->num_rows > 0) {
    while ($school = $schoolResult->fetch_assoc()) {
        $schools[] = $school;
    }
}
//randomize schools
shuffle($schools);

$physics_teachers = $teachers["Physics"];
shuffle($physics_teachers);
$math_teachers = $teachers["Math"];
shuffle($math_teachers);
$computer_teachers = $teachers["Computer"];
shuffle($computer_teachers);
$history_teachers = $teachers["History"];
shuffle($history_teachers);
$music_teachers = $teachers["Music"];
shuffle($music_teachers);

foreach ($schools as $key => $school) {
    $physics_count = (int)$school["physics"];
    $math_count = (int)$school["math"];
    $computer_count = (int)$school["computer"];
    $history_count = (int)$school["history"];
    $music_count = (int)$school["music"];

    for ($i=0; $i < $physics_count ; $i++) {
        $teacher = current($physics_teachers);
        if (!$teacher) {
            break;
        }
        assign($school['id'], $teacher['id']);
        next($physics_teachers);
    }

    for ($i=0; $i < $math_count ; $i++) {
        $teacher = current($math_teachers);
        if (!$teacher) {
            break;
        }
        assign($school['id'], $teacher['id']);
        next($math_teachers);
    }

    for ($i=0; $i < $computer_count ; $i++) {
        $teacher = current($computer_teachers);
        if (!$teacher) {
            break;
        }
        assign($school['id'], $teacher['id']);
        next($computer_teachers);
    }

    for ($i=0; $i < $history_count ; $i++) {
        $teacher = current($history_teachers);
        if (!$teacher) {
            break;
        }
        assign($school['id'], $teacher['id']);
        next($history_teachers);
    }
    for ($i=0; $i < $music_count ; $i++) {
        $teacher = current($music_teachers);
        if (!$teacher) {
            break;
        }
        assign($school['id'], $teacher['id']);
        next($music_teachers);
    }
}
header("Location:assigns.php");

?>
</div>
</body>
</html>
<?php
$conn->close();
    ?>