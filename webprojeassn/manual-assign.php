<?php require_once 'common.php';?>
<html>
<head>
<title>Schools</title>
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
    <h1 style="text-align: center;">Change Assign</h1>
    <p style="text-align:center;"><a href="/assigns.php" class="button">Return</a></p>
<?php
if (!isset($_GET['teacherId'])) {
    header("Location:assigns.php");
}
$conn    = new mysqli('127.0.0.1:3306', 'root', '', 'okul') or die('Unable To connect');
$id = $_GET['teacherId'];
$selectSql = "SELECT teacher.*, assign.school_id FROM teacher LEFT JOIN assign on assign.teacher_id=teacher.id where teacher.id=".$id;
$selectResult = $conn->query($selectSql);
if ($selectResult->num_rows > 0) {
    $teacher = $selectResult->fetch_assoc();
} else {
    header("Location:assigns.php");
}

$sql = "SELECT * FROM school WHERE id!=".$teacher['school_id']." AND ".strtolower($teacher['section'])." > (SELECT count(*) FROM assign LEFT JOIN teacher ON teacher.id=assign.teacher_id WHERE teacher.section='".$teacher['section']."' AND assign.school_id=school.id)";
$availableSchoolsResult = $conn->query($sql);
if ($availableSchoolsResult->num_rows < 1) {
    header("Location:assigns.php");
}

if (count($_POST) > 0) {
    $school = (int)$_POST['school'];
    if ($school) {
        $sql = "UPDATE assign SET school_id=".$school." where teacher_id=".$teacher['id'].";";
        if ($conn->query($sql) === true) {
            header("Location:assigns.php");
        } else {
            echo "<p style=\"text-align:center;\">Error. Please check your input.</p>";
        }
    } else {
        echo "<p style=\"text-align:center;\">Error. Please check your input.</p>";
    }
}
?>
<form name="form" method="post" action="" align="center">
  <div>
    <div><label>School:</label></div>
    <div>
      <select name="school" id="school">
        <?php
        while ($row = $availableSchoolsResult->fetch_assoc()) {
            ?>
            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
            <?php
        }
        ?>
      </select>
    </div>
  </div>
  <input type="submit" name="submit" value="Submit">
  <input type="reset">
</form>
</div>
</body>
</html>
<?php
$conn->close();
    ?>