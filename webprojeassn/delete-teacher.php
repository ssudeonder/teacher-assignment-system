<?php require_once 'common.php';?>
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
<?php
if (!isset($_GET['id'])) {
    header("Location:teachers.php");
}
$conn    = new mysqli('127.0.0.1:3306', 'root', '', 'okul') or die('Unable To connect');
$id = $_GET['id'];
$sql = "DELETE FROM teacher where id=".$id;
if ($conn->query($sql) === true) {
    header("Location:teachers.php");
} else {
    echo "<p style=\"text-align:center;\">Error.</p>";
}

?>
</div>
</body>
</html>
<?php
$conn->close();
    ?>