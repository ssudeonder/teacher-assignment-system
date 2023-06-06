<?php require_once 'common.php'; ?>
<html>
<head>
<title>Teachers</title>
<link rel="stylesheet" type="text/css" href="/style.css">
</head>
<body>

<div class="top">
  <div class="bar white padding card" style="letter-spacing:4px;">
    <a href="/" class="bar-item button">Teacher management</a>
    <!-- Right-sided navbar links. Hide them on small screens -->
    <div class="right hide-small">
      <a href="/schools.php" class="bar-item button">Schools</a>
      <a href="/teachers.php" class="bar-item button">Teachers</a>
      <a href="/assigns.php" class="bar-item button">Assigns</a>
    </div>
  </div>
</div>
<div class="main">
    <h1 style="text-align: center;">Assigns</h1>
    <p style="text-align:center;"><a href="/random-assign.php" class="button">Randomly Assign All Teachers</a></p>
    <p style="text-align:center;"><a href="/clear-assigns.php" class="button">Clear All Assigns</a></p>
<?php

function emptyPositionCount($section, $exclude)
{
    $conn = new mysqli('127.0.0.1:3306', 'root', '', 'okul');
    if ($conn->connect_error) {
        die("Unable to connect!");
    }

    $res = mysqli_query($conn, "SELECT SUM(".strtolower($section).") as sum FROM school where id!=".$exclude);
    $row = mysqli_fetch_row($res);
    $sum = $row[0];

    $res = mysqli_query($conn, "SELECT COUNT(*) FROM assign LEFT JOIN teacher on teacher.id=teacher_id WHERE teacher.section='".$section."' and assign.school_id!=".$exclude.";");
    $row = mysqli_fetch_row($res);
    $assignCount = $row[0];

    return $sum - $assignCount;
}


$conn = new mysqli('127.0.0.1:3306', 'root', '', 'okul');
if ($conn->connect_error) {
    die("Unable to connect!");
}
$sql = "SELECT school.id as school_id, school.name as school_name, teacher.name as teacher_name, teacher.section as section, teacher.id as teacher_id FROM assign left join teacher on teacher.id=assign.teacher_id left join school on school.id=assign.school_id;";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    ?>
    <table>
      <tr>
        <th>School Name</th>
        <th>Teacher Name</th>
        <th>Section</th>
        <th></th>
      </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?= $row['school_name'] ?></td>
            <td><?= $row['teacher_name'] ?></td>
            <td><?= $row['section'] ?></td>
            <td>
            <?php
                $emptyPositionCount = emptyPositionCount($row['section'], (int)$row['school_id']);
        if ($emptyPositionCount > 0) {
            ?>
                            <p style="text-align:center;"><a href="/manual-assign.php?teacherId=<?= $row['teacher_id'] ?>" class="button">Change Assigment</a></p>
                            <?php
        } ?>
            </td>
        </tr>
        <?php
    } ?>
    </table>
    <?php
} else {
        ?>
    <h2 style="text-align:center;">There is no teacher assigned to the schools.</h2>
    <?php
    }
?>
</div>
</body>
</html>
<?php
$conn->close();
    ?>