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
    <h1 style="text-align: center;">Add Teacher</h1>
    <p style="text-align:center;"><a href="/teachers.php" class="button">Return</a></p>
<?php
if (!isset($_GET['id'])) {
    header("Location:teachers.php");
}
$conn    = new mysqli('127.0.0.1:3306', 'root', '', 'okul') or die('Unable To connect');
$id = $_GET['id'];
$selectSql = "SELECT * FROM teacher where id=".$id;
$selectResult = $conn->query($selectSql);
if ($selectResult->num_rows > 0) {
    $teacher = $selectResult->fetch_assoc();
} else {
    header("Location:teachers.php");
}
if (count($_POST) > 0) {
    $name = $_POST['name'];
    $section = $_POST['section'];
    if ($name && $section) {
        $sql = "UPDATE teacher SET name='".$name."', section='".$section."' where id=".$id.";";
        if ($conn->query($sql) === true) {
            header("Location:teachers.php");
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
    <div><label>School Name:</label></div>
    <div><input type="text" name="name" value="<?= $teacher['name'] ?>"></div>
  </div>
  <div>
    <div><label>Section</label></div>
    <div>
      <select name="section" id="section">
        <option value="Physics" <?= $teacher['section'] == "Physics" ? 'selected="selected"': '' ?>>Physics</option>
        <option value="Math" <?= $teacher['section'] == "Math" ? 'selected="selected"': '' ?>>Math</option>
        <option value="Computer" <?= $teacher['section'] == "Computer" ? 'selected="selected"': '' ?>>Computer</option>
        <option value="History" <?= $teacher['section'] == "History" ? 'selected="selected"': '' ?>>History</option>
        <option value="Music" <?= $teacher['section'] == "Music" ? 'selected="selected"': '' ?>>Music</option>
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